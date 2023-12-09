<?php require_once("views/common/menu.php"); ?>
<header class=" position-relative">
  <div class="position-absolute w-100 h-100">
    <div class="video-background">
      <div class="video-overlay d-flex justify-content-center align-items-center flex-column text-light gap-2">
        <h1>Autour du code</h1>
        <h2 class="mb-5">Partageons, échangeons !</h2>
        <br>
        <div class="d-none d-lg-block ">
          <h2 class="arizona fs-1 text-center ">
            Seul on va plus vite, ensemble on va plus loin !
          </h2>
        </div>
        <div class="d-block d-lg-none ">
          <h2 class="arizona fs-1 text-center ">
            Seul on va plus vite,<br> ensemble on va plus loin !
          </h2>
        </div>
      </div>
      <video autoplay loop muted class="fullscreen-video">
        <source src="<?= URL ?>public/assets/videos/header_blog.mp4" type="video/mp4">
      </video>
    </div>
  </div>
</header>