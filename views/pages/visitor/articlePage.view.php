<div class="container row">

    <h3 class="text-center my-5 text-decoration-underline"><?= $article['pitch'] ?></h3>

    <!-- si le media est une image -->
    <?php if (!empty($article['img1'])) : ?>
        <div class="d-flex justify-content-center">
            <img src="<?= URL . MEDIA_PATH . $article['id_article'] ?>/<?= $article['img1'] ?>" alt="" class="w-50 img-fluid">
        </div>

        <!-- si le media est un slider -->
        <!-- on récupère le dossier en bdd -->
    <?php elseif (!empty($article['slider_folder'])) : ?>
        <?php $directory = MEDIA_PATH . $article['id_article'];
        // on extrait les images du dossier
        $images = glob($directory . '/*');
        ?>
        <div class=" col-md-10 col-lg-8 col-xl-6 mx-auto">
            <div id="article_slider" class="carousel slide my-5 d-flex justify-content-center align-items-center w-100 w-lg-75 w-xl-50 mx-auto"
            style="max-width:700px">
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < count($images); $i++) : ?>
                        <button type="button" data-bs-target="#article_slider" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? "active" : "" ?>" aria-current="true" aria-label="Slide <?= $i ?>"></button>
                    <?php endfor ?>
                </div>
                <div class="carousel-inner ">
                    <?php for ($i = 0; $i < count($images); $i++) : ?>
                        <div class="carousel-item m-0 <?= $i === 0 ? "active" : "" ?>">
                            <img src="<?= URL . $images[$i] ?>" class="d-block w-100 " alt="...">
                        </div>
                    <?php endfor ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#article_slider" data-bs-slide="prev">
                    <div class="p-1 overflow-hidden rounded-circle bg-primary d-flex justify-content-center align-items-center">
                        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </div>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#article_slider" data-bs-slide="next">
                    <div class="p-1 overflow-hidden rounded-circle bg-primary d-flex justify-content-center align-items-center">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </div>
                </button>
            </div>
        </div>

        <!-- si le media est une video -->
    <?php elseif (!empty($article['video_link'])) : ?>
        <div class="d-flex justify-content-center">
            <div class="ratio ratio-16x9 w-50">
                <?= $article['video_link'] ?>
            </div>
        </div>
    <?php endif ?>
    <div class="mx-auto">
        <p>
            <!-- double désencodage pour faire apparaitre images dans le textes -->
            <?= html_entity_decode(htmlspecialchars_decode($article['text'])) ?>
        </p>

    </div>

    <div class="d-flex flex-column justify-content-center border-top border-3 m-0 py-3
    ">
        <?php if (empty($_SESSION['profile']['login'])) : ?>

            <a href="<?= URL ?>connection" class="btn btn-primary mb-4 w-50 mx-auto text-light">
                Connecte toi pour ajouter un commentaire ou poser une question.
            </a>

        <?php else : ?>

            <button type="button" class="btn btn-primary mb-4 w-50 mx-auto text-light" data-bs-toggle="modal" data-bs-target="#commentModal">
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

        <!-- Les commentaires de l'article -->
        <?php foreach ($commentaires as $commentaire) : ?>
            <div class="card bg-dark border border-2 mb-3 pb-2">
                <div class="d-flex justify-content-between text-primary px-3 pt-2 pb-0">
                    <?php
                    $date = new DateTime($commentaire['date']);
                    $date = $date->format('d/m/Y');
                    ?>
                    <?= $commentaire['author'] .", le ".$date?>
                    <?php if ($_SESSION['profile']['role'] === "admin") : ?>
                        <form action="<?= URL ?>administrator/delete_comment" method="POST">
                            <input type="hidden" value=<?=$commentaire['id_comment']?> name="id_comment">
                            <input type="hidden" value=<?=$article['id_article']?> name="id_article">
                            <input type="hidden" value=<?=$article['url']?> name="url">
                            <button class="text-decoration-none fw-bold rounded-circle text-primary" >X</button>
                        </form>
                    <?php endif ?>
                </div>
                <div class="card-body py-1">
                    <p class="card-text text-light"><?= $commentaire['comment'] ?></p>
                </div>
            </div>
        <?php endforeach ?>
    </div>