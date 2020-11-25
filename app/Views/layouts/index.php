<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Files Fiddle</title>

      <!-- stylesheet -->
      <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/utama/style.css">

      <!-- google fonts -->
      <link href=" https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

      <!-- icons -->
      <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

      <!-- gsap -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>

      <!-- AnimeJS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

      <!-- JQuery -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
</head>

<body>

      <div class="container">

            <div class="loading-screen"></div>

            <div class="loader">
                  <div class="ringOne ring">
                        <img src="<?= base_url(); ?>/upload/img/logo/ring.png" alt="">
                  </div>
                  <div class="ringTwo ring">
                        <img src="<?= base_url(); ?>/upload/img/logo/ring.png" alt="">
                  </div>
            </div>

      </div>

      <div class="logo">
            <ion-icon name="git-compare"></ion-icon>FilesFiddle
      </div>

      <div class="contact">GET IN TOUCH</div>

      <div class="menu">
            <ion-icon name="options"></ion-icon>
      </div>

      <div class="header">

            <h1 class="ml7" id="title">
                  <span class="text-wrapper">
                        <span class="letters">The connected world</span>
                  </span>
            </h1>


            <p id="tagline" class="p1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim blanditiis voluptatum, magnam odio, tempora asperiores, quod quasi alias expedita esse eveniet impedit nihil quae nulla sint iure accusantium architecto aperiam.</p>

            <br><br>

            <p id="tagline" class="p2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla facere ad illo, perferendis impedit animi quasi iure provident! Iste, facere!</p>

            <div class="buttons">
                  <button id="one">LEARN MORE</button>
                  <button id="two">BUY NOW</button>
            </div>

      </div>

      <div class="bottom-text">+0.00001db</div>

      <div class="copyright">© 2019 by Codegrid. All rights reserved.</div>


      <div class="media">
            <ul>
                  <li>
                        <ion-icon name="logo-facebook"></ion-icon>
                  </li>
                  <li>
                        <ion-icon name="logo-instagram"></ion-icon>
                  </li>
                  <li>
                        <ion-icon name="logo-twitter"></ion-icon>
                  </li>
                  <li>
                        <ion-icon name="logo-youtube"></ion-icon>
                  </li>
            </ul>
      </div>

      <!-- js -->
      <script src="<?= base_url() ?>/assets/plugins/utama/script.js"></script>
</body>

</html>