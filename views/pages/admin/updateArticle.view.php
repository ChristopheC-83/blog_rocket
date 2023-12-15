<div class="container">
    <div class="col-12 col-lg-10 col-xl-8 col-xxl-6 mx-auto border border-3 border-primary my-5 rounded-3 box-shadow-white p-3 fs-5">


        <form class="my-4" method="POST" action="<?= URL?>administrator/update_article/" id="oneArticleForm">

            <div class="mb-3">
                <label for="oneArticle" class="form-label">Article à modifier ou compléter :</label>
                <select name="oneArticle" id="oneArticle" class="form-control text-primary fs-5 my-3">
                    <?php foreach ($articles as $article) : ?>
                        <option value="<?= URL ?>administrator/update_article/<?= $article['id_article']  ?>" <?= $article['id_article'] === $oneArticle['id_article'] ?  'selected' : '' ?>>
                            <?= $article['id_article']  ?> / <?= $article['title']  ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p><b class="text-primary">Theme : </b><?= $oneArticle['theme'] ?></p>
                <p><b class="text-primary">Pitch : </b><?= $oneArticle['pitch'] ?></p>
                <p><b class="text-primary">URL : </b><?= $oneArticle['url'] ?></p>
            </div>
            <a href="<?= URL ?>administrator/update_card/<?= $oneArticle['id_article'] ?>" class="btn btn-primary w-100 text-light py-3  fs-5">
                    Je veux modifier cette carte.
                </a>


        </form>

    </div>
    <div>
        <textarea id="default-editor"></textarea>
    </div>
</div>