<?php require_once("views/common/menu.php"); ?>
<header class=" position-relative">
  <div class="position-absolute w-100 h-100">
    <div class="video-background">
      <div class="video-overlay d-flex justify-content-center align-items-center flex-column text-light gap-2">
        <?php if (
          isset($title_page) && !empty($title_page) &&  isset($texte_1_page) && !empty($texte_1_page) &&
          isset($texte_2_page) && !empty($texte_2_page)
        ) : ?>
          <h2 class="arizona text-center display-2 text-shadow-white">
            <h1 class="text-center"><?= $texte_1_page ?></h1>
            <h2 class="mb-5 text-center"><?= $texte_2_page ?></h2>
            <div class=" d-xl-block ">
              <h2 class="arizona text-center display-3  text-shadow-white">
                <?= $title_page ?>
              </h2>

          </h2>

        <?php elseif (isset($choosenTheme) && !empty($choosenTheme)) : ?>

          <h2 class="arizona text-center display-2 text-shadow-white">
            <h1 class="text-center"><?= $choosenTheme['theme'] ?></h1>
            <h2 class="mb-5 text-center"><?= $texte_2_page ?></h2>
            <div class=" d-xl-block ">
              <h2 class="arizona text-center display-3  text-shadow-white">
                <?= $choosenTheme['description_theme'] ?>
              </h2>

          </h2>


        <?php else : ?>
          <h1>Autour du code</h1>
          <h2 class="mb-5">Partageons, échangeons !</h2>
          <div class="d-none d-xl-block ">
            <h2 class="arizona text-center display-3  text-shadow-white">
              Seul on va plus vite, ensemble on va plus loin !
            </h2>
          </div>
          <div class="d-block d-xl-none ">
            <p class="arizona  text-center display-3  text-shadow-white">
              Seul on va plus vite,<br> ensemble on va plus loin !
            </p>
          </div>
        <?php endif ?>
      </div>
      <video autoplay loop muted class="fullscreen-video">
        <source src="<?= URL ?>public/assets/videos/header_blog.mp4" type="video/mp4">
      </video>
    </div>
  </div>
</header>