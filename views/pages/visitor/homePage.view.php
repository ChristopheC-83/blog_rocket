<div class="container mt-3 text-light">

    <div class="row w-100">
        <?php foreach ($articles as $article) : ?>
            <div class="col-6 col-md-4 col-lg-3 g-3 ">
                <a href="" class=" text-decoration-none link_card">
                    <div class="card border-<?= $mainManager->getColorTheme($article['theme'])['color'] ?>
                 border-4 bg-<?= $mainManager->getColorTheme($article['theme'])['color'] ?>  bg-opacity-25 bg-gradient text-white h-100">
                        <div class="card-header  fw-bold"><?= strtoupper($article['theme'])  ?></div>
                        <div class="card-body ">
                            <h5 class="card-title "><?= $article['title']  ?></h5>
                            <p class="card-text"><?= $article['pitch']  ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
</div>