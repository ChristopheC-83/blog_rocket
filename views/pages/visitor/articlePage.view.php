<div class="container ">

    <h3 class="text-center my-5 text-decoration-underline"><?= $article['pitch'] ?></h3>
    <?php if (!empty($article['img1'])) : ?>
        <div class="d-flex justify-content-center">
            <img src="<?= URL . MEDIA_PATH . $article['id_article'] ?>/<?= $article['img1'] ?>" alt="" class="w-50 img-fluid">
        </div>

    <?php elseif (!empty($article['slider_folder'])) : ?>
        <?php $directory = MEDIA_PATH . $article['id_article'];
        $images = glob($directory . '/*');
        ?>
        <div class="d-flex justify-content-center container-fluid">
            <img src="<?= URL . $images[0] ?>" alt="image ?" class="w-100 w-lg-50 w-xl-25 img-fluid">
        </div>

    <?php elseif (!empty($article['video_link'])) : ?>
        <div class="d-flex justify-content-center">
            <div class="ratio ratio-16x9 w-50">
                <?= $article['video_link'] ?>
            </div>
        </div>
    <?php endif ?>
    <div class="mx-auto">
        <p>
            <?= html_entity_decode(htmlspecialchars_decode($article['text'])) ?>
        </p>

    </div>






</div>