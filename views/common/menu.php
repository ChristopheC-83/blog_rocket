<nav class="navbar navbar-expand navbar-dark bg-black  text-primary sticky-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link text-primary" aria-current="page" href="<?= URL; ?>home">Accueil</a>
        </li>

        <li class="nav-item dropdown mr-auto">
          <a class="nav-link dropdown-toggle text-primary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Thèmes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <!-- boucle sur les Themes -->
            <li><a class="dropdown-item text-primary" href="<?= URL; ?>compte/profil">Theme 1</a></li>
            <li><a class="dropdown-item text-primary" href="<?= URL; ?>page3">Theme 2</a></li>
          </ul>
        </li>

      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">


        <!-- si pas connecté , remplacer mot par logo-->
        <li class="nav-item ml-auto">
          <a class="nav-link text-primary" aria-current="page" href="<?= URL; ?>home">Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" aria-current="page" href="<?= URL; ?>home">Inscription</a>
        </li>
        <!-- si connecté -->
        <!-- <li class="nav-item">
          <a class="nav-link text-primary" aria-current="page" href="<?= URL; ?>home">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" aria-current="page" href="<?= URL; ?>home">Déconnexion</a>
        </li> -->

      </ul>
    </div>
  </div>
</nav>