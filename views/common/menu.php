<!-- menu inclus dans le header -->

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
$colors = $userManager->getPalette();
// Tools::showArray($colors);

?>

<nav class="navbar navbar-expand navbar-dark bg-dark  text-primary sticky-top">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link text-primary fs-4 d-none d-sm-block" aria-current="page" href="<?= URL ?>home">
            Accueil
          </a>
          <a class="nav-link text-primary fs-4 d-block d-sm-none" aria-current="page" href="<?= URL ?>home">
            <i class="fa-solid fa-house"></i>
          </a>
        </li>

        <li class="nav-item dropdown mr-auto">
          <a class="nav-link dropdown-toggle text-primary fs-4" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Thèmes
          </a>
          <ul class="dropdown-menu bg-dark text-light" aria-labelledby="navbarDropdown">
            <!-- boucle sur les Themes -->
            <?php foreach ($themes as $theme) : ?>

              <li class="d-flex">
                <a class="dropdown-item text-<?= $theme['color'] ?> text-capitalize mb-2" href="<?= URL ?>theme/<?= $theme['theme'] ?>"
                
                ><?= $theme['theme'] ?></a>
                <!-- si connecté, possibilité de gestion des themes -->
                <?php if (isset($_SESSION['profile']['role']) && $_SESSION['profile']['role'] === "admin") : ?>
                  <form action="<?= URL ?>administrator/delete_theme" method="post">
                    <input type="hidden" name="id_theme" value="<?= $theme['id_theme'] ?>">
                    <button type="submit" class="btn btn-danger py-1 px-2">X</button>
                  </form>
                <?php endif ?>
              </li>
            <?php endforeach ?>
            <li>
              <?php if (isset($_SESSION['profile']['role']) && $_SESSION['profile']['role'] === "admin") : ?>
                <p class=" border-top boder-primary pt-2 text-decoration-underline">Nouveau Thème :</p>
                <form action="<?= URL ?>administrator/create_theme" method="post">
                  <label for="new_theme">Theme</label>
                  <input type="text" name="new_theme">
                  <label for="description_theme">Description</label>
                  <textarea name="description_theme"></textarea>
                  <label for="color">Couleur</label>

                  <select name="color" id="color" class="form-control fs-5 ">
                    <?php foreach ($colors as $color) : ?>
                      <option value="<?= $color['color_bs']  ?>" class="
                      <?php if ($color['color_bs'] === "white" || $color['color_bs'] === "light") {
                        echo ("text-" . $color['color_bs'] . " bg-dark");
                      } else {
                        echo  "text-" . $color['color_bs'];
                      }
                      ?>">
                        <?= $color['real_color']  ?>
                      </option>
                    <?php endforeach; ?>
                  </select>

                  <button type=" submit" class="w-100 text-center border border-0 mt-2">✅</button>
                </form>
              <?php endif ?>
            </li>
          </ul>
        </li>
        <!-- si connecté, possibilité de creation et MAJ des articles -->
        <!-- l'écriture et la modification d'un article étant plus faciile sur desktop -->
        <!-- les raccourcis ne sont pas dispo sur mobile mais tout de même dans le profil... au cas où ! -->
        <?php if (isset($_SESSION['profile']['role']) && $_SESSION['profile']['role'] === "admin") : ?>
          <li class="px-2 d-flex align-items-center justify-content-center gap-3 gap-xs-4">
            <a href="<?= URL . "administrator/create_article" ?>"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Créer un nouvel article"
            ><i class="fa-regular fa-lightbulb fs-4 d-none d-sm-block"></i></a>
            <a href="<?= URL . "administrator/update_article" ?>"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Compléter ou modifier un article"
            ><i class="fa-solid fa-pen-clip fs-4  d-none d-sm-block"></i></a>
          </li>
        <?php endif ?>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">


        <!-- si pas connecté -->
        <!-- inscription/connexion dans la page de connexion -->
        <?php if (isset($_SESSION['profile']['login']) && !empty($_SESSION['profile']['login'])) :   ?>

          <!-- si connecté -->
          <!-- l'avatar sera le lien vers la page de profil de l'utilisateur -->
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="<?= URL ?>account/profile"
            
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mon profil"
            >

              <img src="<?= AVATARS_PATH ?><?= $_SESSION['profile']['avatar'] ?>" <?= $_SESSION['profile']['avatar'] ?> class="pastille-menu" alt="">

            </a>
          </li>
          <li class="nav-item d-flex align-items-center ">
            <a class="nav-link text-primary px-3 px-md-5" aria-current="page" href="<?= URL ?>account/logout"
            
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Déconnexion"
            >
              <i class="fa-solid fa-right-from-bracket fs-1"></i>
            </a>
          </li>
        <?php else : ?>
          <li class="nav-item ml-auto">
            <a class="nav-link text-primary fs-3 d-none d-md-block" aria-current="page" href="<?= URL ?>connection" >
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