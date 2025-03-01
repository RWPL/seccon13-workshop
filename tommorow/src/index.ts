import express, { Request, Response, NextFunction } from 'express';
import session from 'express-session';
import helmet from 'helmet';
import path from 'path';
import fs from 'fs';
import { pool } from './db';
import { requireLogin } from './auth';
import { exec, ExecException } from 'child_process';
import dotenv from 'dotenv';
dotenv.config();

const app = express();
const PORT = process.env.PORT || 3000;

app.use((req: Request, res: Response, next: NextFunction) => {
  res.setHeader('Cross-Origin-Embedder-Policy', 'unsafe-none');
  next();
});

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, '../views'));

app.use(helmet({
  contentSecurityPolicy: false,
  crossOriginOpenerPolicy: false,
  crossOriginResourcePolicy: false,
  crossOriginEmbedderPolicy: false,
  hsts: false
}));

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use(session({
  secret: process.env.SESSION_SECRET || 'rwplsecret',
  resave: false,
  saveUninitialized: false,
  cookie: { secure: false }
}));

const allowedPaths = ['/', '/login', '/credits', '/robots.txt'];
app.use((req: Request, res: Response, next: NextFunction) => {
  if (req.session.userId || allowedPaths.includes(req.path)) {
    return next();
  }
  res.redirect('/login');
});

app.get('/', (req: Request, res: Response) => {
  const links = req.session.userId
    ? `<a href="/credits">クレジット</a> | <a href="/tommorow?day=1">明日の日付</a> | <a href="/logout">ログアウト</a>`
    : `<a href="/login">ログイン</a>`;

  res.render('index', { links });
});

app.get('/robots.txt', (req: Request, res: Response) => {
  res.type('text/plain');
  res.send(
    "User-agent: *\n" +
    "Disallow: /credits\n\n"
  );
});

app.get('/login', (req: Request, res: Response) => {
  res.render('login');
});

app.post('/login', async (req: Request, res: Response) => {
  const { email, password } = req.body;
  try {

    const query = "SELECT * FROM users WHERE email = '" + email + "'";
    const [rows]: any = await pool.query(query);

    console.log('Query result:', rows);

    if (rows.length === 0) {
      return res.status(401).send("メールアドレスか、パスワードが違います");
    }

    const user = rows[0];
    const match = password === user.password;
    if (!match) {
      return res.status(401).send("メールアドレスか、パスワードが違います");
    }

    req.session.userId = user.id;
    res.redirect('/');
  } catch (err) {
    res.status(500).send("SQL Error: " + err);
  }
});

app.get('/logout', (req: Request, res: Response) => {
  req.session.destroy((err) => {
    if (err) {
      console.error(err);
      res.status(500).send('ログアウトに失敗しました');
    } else {
      res.send('ログアウトしました');
    }
  });
});

app.get('/credits', (req: Request, res: Response) => {
  // 認証状態に応じて返す JSON ファイルを切り替える
  const filePath = req.session.userId
    ? path.join(__dirname, '../data/credits.step2.json')
    : path.join(__dirname, '../data/credits.step1.json');
  
  fs.readFile(filePath, 'utf-8', (err, data) => {
    if (err) {
      console.error('クレジット情報読み込みエラー:', err);
      return res.status(500).json({ error: '情報の読み込みに失敗しました' });
    }
    try {
      const credits = JSON.parse(data);
      res.json(credits);
    } catch (parseErr) {
      console.error('JSON解析エラー:', parseErr);
      res.status(500).json({ error: 'データ形式が不正です' });
    }
  });
});

app.get('/tommorow', requireLogin, (req: Request, res: Response) => {
  const day = req.query.day;
  if (!day || typeof day !== 'string') {
    return res.status(400).send(`?day=1`);
  }

  const command = `date '+%Y-%m-%d' -d '${day} day'`;
  exec(command, (error: ExecException | null, stdout: string, stderr: string) => {
    let out: string = stdout;
    if (error) {
      console.error(`コマンド実行エラー: ${error}`);
      out = error.message;
    }
    res.send(`<pre>${day}日後は${out}ですね ;)</pre>`);
  });
});

app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
