import { Request, Response, NextFunction } from 'express';

export function requireLogin(req: Request, res: Response, next: NextFunction) {
  if (req.session && req.session.userId) {
    next();
  } else {
    res.status(401).send('ログインが必要です');
  }
}
