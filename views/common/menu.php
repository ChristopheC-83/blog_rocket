<?php
if (empty($_GET['page'])) {
  $url[0] = "accueil";
} else {
  $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
  $page = $url[0];
}
require_once("./models/MainManager.model.php");
$userManager = new MainManager();
$themes = $userManager->getAllThemes();


?>

<nav class="navbar navbar-expand navbar-dark bg-dark  text-primary sticky-top">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link text-primary fs-4" aria-current="page" href="<?= URL; ?>home">
            Accueil
          </a>
        </li>

        <li class="nav-item dropdown mr-auto">
          <a class="nav-link dropdown-toggle text-primary fs-4" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Thèmes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <!-- boucle sur les Themes -->
            <?php foreach ($themes as $theme) : ?>

              <li class="d-flex">
                <a class="dropdown-item text-primary text-capitalize" href="<?= URL ?>theme/<?= $theme['theme'] ?>"><?= $theme['theme'] ?></a>
                <?php if (isset($_SESSION['profile']['role']) && $_SESSION['profile']['role'] === "admin") : ?>
                  <form action="<?=URL?>administrator/delete_theme" method="post">
                    <input type="hidden" name="id_theme" value="<?= $theme['id_theme'] ?>">
                    <button type="submit" class="btn btn-danger">X</button>
                  </form>
                <?php endif ?>
              </li>
            <?php endforeach ?>
            <li>
              <?php if (isset($_SESSION['profile']['role']) && $_SESSION['profile']['role'] === "admin") : ?>
                  <form action="<?=URL?>administrator/create_theme" method="post">
                    <label for="new_theme">Theme</label>
                    <input type="text" name="new_theme" >
                    <label for="description_theme">Description</label>
                    <textarea name="description_theme" ></textarea>
                    <button type="submit" class="w-100 text-center border border-0">✅</button>
                  </form>
                <?php endif ?>
            </li>
          </ul>
        </li>

      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">


        <!-- si pas connecté -->
        <!-- inscription dans la page de connexion -->
        <?php if (isset($_SESSION['profile']['login']) && !empty($_SESSION['profile']['login'])) :   ?>

          <!-- si connecté -->
          <!-- profil sera l'avatar de l'utilisateur -->
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="<?= URL ?>account/profile">

              <img src="<?= AVATARS_PATH ?><?= $_SESSION['profile']['avatar'] ?>" <?= $_SESSION['profile']['avatar'] ?> class="pastille-menu" alt="">

            </a>
          </li>
          <li class="nav-item d-flex align-items-center ">
            <a class="nav-link text-primary px-3 px-md-5" aria-current="page" href="<?= URL ?>account/logout">
              <i class="fa-solid fa-right-from-bracket fs-1"></i>
            </a>
          </li>
        <?php else : ?>
          <li class="nav-item ml-auto">
            <a class="nav-link text-primary fs-3 d-none d-md-block" aria-current="page" href="<?= URL ?>connection">
              Connexion
            </a>
            <a class="nav-link text-primary fs-3  d-block d-md-none  " aria-current="page" href="<?= URL ?>connection">
              <i class="fa-solid fa-right-to-bracket"></i>
            </a>
          </li>
        <?php endif ?>



      </ul>
    </div>
  </div>
</nav>