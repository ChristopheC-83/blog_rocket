<nav class="navbar navbar-expand navbar-dark bg-dark  text-primary sticky-top">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link text-primary fs-3" aria-current="page" href="<?= URL; ?>home">
          Accueil
          </a>
        </li>

        <li class="nav-item dropdown mr-auto">
          <a class="nav-link dropdown-toggle text-primary text-shadow-white  fs-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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


        <!-- si pas connecté -->
        <!-- inscription dans la page de connaxion -->
        <li class="nav-item ml-auto">
          <a class="nav-link text-primary text-shadow-white fs-3 d-none d-md-block" aria-current="page" href="<?= URL; ?>home">
            Connexion
          </a>
          <a class="nav-link text-primary text-shadow-white fs-3  d-block d-md-none  " aria-current="page" href="<?= URL; ?>home">
          <i class="fa-solid fa-right-to-bracket"></i>
          </a>
        </li>

        <!-- si connecté -->
        <!-- profil sera l'avatar de l'utilisateur -->
        <!-- <li class="nav-item">
          <a class="nav-link text-primary text-shadow-white" aria-current="page" href="<?= URL; ?>home"><p class="m-0">Profil</p></a>
        </li>
       //déconnexion, un logo pris sur fontaawesome
        <li class="nav-item">
          <a class="nav-link text-primary text-shadow-white" aria-current="page" href="<?= URL; ?>home"><p class="m-0"></p></a>
        </li> -->

      </ul>
    </div>
  </div>
</nav>