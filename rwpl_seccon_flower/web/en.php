<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Atelier Website</title>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Open+Sans:wght@400;700&display=swap"
    rel="stylesheet"
  >
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Header -->
  <header>
    <div class="logo">
    <a href="/">Atelier</a>
    </div>
    <nav>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="?page=en.php">English</a></li>
      </ul>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero" id="home">
    <h1>Welcome to My Atelier</h1>
    <p>Here, we travel through the world of art with these works.</p>
  </section>

  <!-- Gallery Section -->
  <section class="gallery" id="gallery">
    <h2>Gallery</h2>
    <div class="gallery-container">
      <!-- Sample artworks. Change image paths/URLs as needed. -->
      <div class="art-item" style="background-image: url('https://cdn.pixabay.com/photo/2016/10/04/13/21/background-1713360_1280.jpg');"></div>
      <div class="art-item" style="background-image: url('https://cdn.pixabay.com/photo/2015/04/19/08/32/rose-729509_1280.jpg');"></div>
      <div class="art-item" style="background-image: url('https://cdn.pixabay.com/photo/2020/06/10/07/28/texture-5281091_1280.jpg');"></div>
      <div class="art-item" style="background-image: url('https://cdn.pixabay.com/photo/2015/04/19/08/32/rose-729509_1280.jpg');"></div>
    </div>
  </section>

  <!-- About Section -->
  <section class="about" id="about">
    <h2>About Me</h2>
    <p>
      As an artist, I draw inspiration from my daily life and travels.<br>
      I focus primarily on painting and creating objects, and I also host workshops and exhibitions.
    </p>
  </section>

  <!-- Contact Section -->
  <section class="contact" id="contact">
    <h2>Contact</h2>
    <p>If you have any questions about my works or would like to discuss a collaboration, feel free to get in touch.</p>
    <form action="#" method="post">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <textarea name="message" rows="5" placeholder="Message" required></textarea>
      <button type="submit">Send</button>
    </form>
  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 Atelier Web. All rights reserved.</p>
  </footer>
</body>
</html>