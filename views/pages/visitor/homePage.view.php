<div class="container mt-3 text-light">

    <div class="row w-100">
        <?php foreach ($articles as $article) : ?>
            <div class="col-6 col-md-4 col-lg-3 g-3 ">

            <!-- connection à un article par id + url -->
            <!-- vérification concordance pour éviter erreurs -->
                <a href="<?=URL."article/".$article['id_article']?>/<?=$article['url']?>" class=" text-decoration-none link_card">
                    <div class="card border-<?= $mainManager->getColorTheme($article['theme'])['color'] ?>
                 border-4 bg-<?= $mainManager->getColorTheme($article['theme'])['color'] ?>  bg-opacity-25 bg-gradient text-white h-100">
                        <div class="card-header fw-bold"><?= $article['theme']  ?></div>
                        <div class="card-body ">
                            <h5 class="card-title text-shadow"><?= strtoupper($article['title'])  ?></h5>
                            <p class="card-text h-100"><?= $article['pitch']  ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
</div>