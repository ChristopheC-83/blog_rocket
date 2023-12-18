<?php require_once("views/common/menu.php"); ?>
<header class=" position-relative">
  <div class="position-absolute w-100 h-100">
    <div class="video-background">
      <div class="video-overlay d-flex justify-content-center align-items-center flex-column text-light gap-2">
       
          <h2 class="arizona text-center display-2 text-shadow-white">
            <h1 class="text-center"><?= $texte_1_page ?></h1>
            <h2 class="mb-5 text-center"><?= $texte_2_page ?></h2>
            <div class=" d-xl-block ">
              <h2 class="arizona text-center display-3  text-shadow-white">
                <?= isset($title_page) ? $title_page : "Tu as cherché un thème non règlementaire ! 🫣" ?>
              </h2>

          </h2>

        
      </div>
      <video autoplay loop muted class="fullscreen-video">
        <source src="<?= URL ?>public/assets/videos/header_blog.mp4" type="video/mp4">
      </video>
    </div>
  </div>
</header>