<!-- affichage article complet -->

<div class="container row mx-auto">

    <div class="col-12 col-lg-10   mx-auto">
        <h3 class="text-center my-5 text-decoration-underline"><?= $article['pitch'] ?></h3>

        <!-- si le media est une image -->
        <?php if (!empty($article['img1'])) : ?>
            <div class="col-12 col-lg-10 mx-auto d-flex justify-content-center">
                <img src="<?= URL . MEDIA_PATH . $article['id_article'] ?>/<?= $article['img1'] ?>" alt="" class="w-100 w-75 img-fluid rounded-2 box-shadow-white mb-5">
            </div>

            <!-- si le media est un slider -->
            <!-- on récupère le dossier en bdd -->
        <?php elseif (!empty($article['slider_folder'])) : ?>
            <?php $directory = MEDIA_PATH . $article['id_article'];
            // on extrait les images du dossier
            $images = glob($directory . '/*');
            ?>
            <!-- on affiche le slider / caroussel -->
            <div class=" w-100 w-lg-75 mx-auto">
                <div id="carouselExampleFade" class="carousel slide carousel-fade  my-5 d-flex justify-content-center align-items-center w-100 w-lg-75 w-xl-50 mx-auto rounded-2  overflow-hidden box-shadow-white" style="max-width:700px">
                    <div class="carousel-indicators ">
                        <?php for ($i = 0; $i < count($images); $i++) : ?>
                            <button type="button" data-bs-target="#article_slider" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? "active" : "" ?> " aria-current="true" aria-label="Slide <?= $i ?>"></button>
                        <?php endfor ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($images as $index => $image) : ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <img src="<?= URL . $image ?>" class="d-block w-100" alt="...">
                            </div>
                        <?php endforeach ?>
                    </div>
                    <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-primary rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-primary rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- si le media est une video -->
        <?php elseif (!empty($article['video_link'])) : ?>
            <div class="d-flex justify-content-center">
                <div class="ratio ratio-16x9 w-100 w-md-75 mb-5">
                    <?= $article['video_link'] ?>
                </div>
            </div>
        <?php endif ?>

        <!--  le texte de l'article -->
        <div class="mx-auto customP">

            <!-- double désencodage pour faire apparaitre images dans le textes -->
            <?= html_entity_decode(htmlspecialchars_decode($article['text'])) ?>

        </div>

        <!--  pour ajouter un commentaire, il faut être connecté -->

        <div class="d-flex flex-column justify-content-center border-top border-3 m-0 py-3">
            <?php if (empty($_SESSION['profile']['login'])) : ?>
                <a href="<?= URL ?>connection" class="btn btn-primary mb-4 w-100 w-md-75 w-lg-50 mx-auto text-light customP">
                    Connecte toi pour ajouter un commentaire ou poser une question.
                </a>
            <?php else : ?>
                <button type="button" class="btn btn-primary mb-4 w-100 w-md-75 w-lg-50 mx-auto text-light customP" data-bs-toggle="modal" data-bs-target="#commentModal">
                    Ajoute un commentaire ou pose une question !
                </button>
                <div class="modal fade" id="commentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-primary" id="staticBackdropLabel">Ajoute ton commentaire :</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= URL ?>account/post_comment" method="POST">
                                <input type="hidden" name="author" value="<?= $_SESSION['profile']['login'] ?>">
                                <input type="hidden" name="id_article" value="<?= $article['id_article'] ?>">
                                <input type="hidden" name="url" value="<?= $article['url'] ?>">
                                <div class="modal-body d-flex justify-content-center">
                                    <textarea name="text" id="" cols="50" rows="10"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <!-- Lecture des commentaires de l'article -->
            <?php foreach ($commentaires as $commentaire) : ?>
                <div class="card bg-dark border border-2 mb-3 pb-2">
                    <div class="d-flex justify-content-between text-primary px-3 pt-2 pb-0">
                        <?php
                        $date = new DateTime($commentaire['date']);
                        $date = $date->format('d/m/Y');
                        ?>
                        <?= $commentaire['author'] . ", le " . $date ?>
                        <?php if (isset($_SESSION['profile']['role']) && $_SESSION['profile']['role'] === "admin") : ?>
                            <form action="<?= URL ?>administrator/delete_comment" method="POST">
                                <input type="hidden" value=<?= $commentaire['id_comment'] ?> name="id_comment">
                                <input type="hidden" value=<?= $article['id_article'] ?> name="id_article">
                                <input type="hidden" value=<?= $article['url'] ?> name="url">
                                <button class="text-decoration-none fw-bold rounded-circle text-primary">X</button>
                            </form>
                        <?php endif ?>
                    </div>
                    <div class="card-body py-1">
                        <p class="card-text text-light"><?= $commentaire['comment'] ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    </div>
</div>

