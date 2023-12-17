<div class="container ">

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
        <div id="article_slider" class="carousel slide my-5 d-flex justify-content-center align-items-center">
            <div class="carousel-indicators">
                <?php for ($i = 0; $i < count($images); $i++) : ?>
                    <button type="button" data-bs-target="#article_slider" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? "active" : "" ?>" aria-current="true" aria-label="Slide <?= $i ?>"></button>
                <?php endfor ?>
            </div>
            <div class="carousel-inner row">
                <?php for ($i = 0; $i < count($images); $i++) : ?>
                    <div class="carousel-item m-0 col-12 col-md-10 col-lg-8 col-xl-6  <?= $i === 0 ? "active" : "" ?>">
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






</div>