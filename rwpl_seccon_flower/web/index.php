<?php

  // Super Secret SSH Password
  // rwpl:Rwpl_Sup3r_s3cr3t_p4ssw0rd

  if (isset($_GET['page'])) {
    $page = $_GET['page'] . '.php';
    include($page);
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Atelier Website</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Open+Sans:wght@400;700&display=swap"
    rel="stylesheet"
  >
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- ヘッダー -->
  <header>
  <div class="logo">
  <a href="/">Atelier</a>
  </div>
    <nav>
      <ul>
        <li><a href="#home">ホーム</a></li>
        <li><a href="#gallery">ギャラリー</a></li>
        <li><a href="#about">プロフィール</a></li>
        <li><a href="#contact">お問い合わせ</a></li>
        <li><a href="?page=en">English</a></li>
      </ul>
    </nav>
  </header>
  
  <section class="hero" id="home">
    <h1>ようこそ、私のアトリエへ</h1>
    <p>ここでは、作品を通してアートの世界を旅します</p>
  </section>

  <section class="gallery" id="gallery">
    <h2>ギャラリー</h2>
    <div class="gallery-container">
      <!-- 作品サンプル。画像パスやURLを変更して使ってください -->
      <div class="art-item" style="background-image: url('https://cdn.pixabay.com/photo/2016/10/04/13/21/background-1713360_1280.jpg');"></div>
      <div class="art-item" style="background-image: url('https://cdn.pixabay.com/photo/2015/04/19/08/32/rose-729509_1280.jpg');"></div>
      <div class="art-item" style="background-image: url('https://cdn.pixabay.com/photo/2020/06/10/07/28/texture-5281091_1280.jpg');"></div>
      <div class="art-item" style="background-image: url('https://cdn.pixabay.com/photo/2015/04/19/08/32/rose-729509_1280.jpg');"></div>
    </div>
  </section>

  <section class="about" id="about">
    <h2>私について</h2>
    <p>
      アーティストとして日々の生活や旅先の風景からインスピレーションを得ています。<br>
      絵画やオブジェの制作を中心に、ワークショップや展示会などにも力を入れています。
    </p>
  </section>

  <section class="contact" id="contact">
    <h2>お問い合わせ</h2>
    <p>作品に関するご質問やコラボレーションのご相談など、お気軽にお問い合わせください。</p>
    <form action="#" method="post">
      <input type="text" name="name" placeholder="お名前" required>
      <input type="email" name="email" placeholder="メールアドレス" required>
      <textarea name="message" rows="5" placeholder="メッセージ" required></textarea>
      <button type="submit">送信</button>
    </form>
  </section>

  <footer>
    <p>© 2025 Atelier Web. All rights reserved.</p>
  </footer>
</body>
</html>
