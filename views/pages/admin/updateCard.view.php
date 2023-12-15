<div class="container row mx-auto">
    <div class="col-12 col-lg-10 col-xl-8 col-xxl-6 mx-auto border border-3 border-primary mt-5 rounded-3 box-shadow-white fs-5">


        <form class="my-4" method="POST" action="<?=URL?>administrator/validation_update_card">
            <input type="hidden" value="<?= $article['id_article'] ?>" name="id">
            <div class="mb-3">
                <label for="title" class="form-label">Titre article</label>
                <input type="text" class="form-control text-primary fs-5" id="title" name="title"
                value="<?= $article['title'] ?>">
            </div>

            <div class="mb-3">
                <label for="theme" class="form-label">Thème</label>
                <select name="theme" id="theme" class="form-control text-primary fs-5">
                    <?php foreach ($themes as $theme) : ?>
                        <option value="<?= $theme['theme']  ?>" <?= $theme['theme'] === $article['theme'] ? 'selected' : ''  ?>>
                        <?= $theme['theme']  ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-1">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control text-primary fs-5" id="url" name="url" 
                value="<?= $article['url'] ?>">
                <p class="text-danger text-center w-100 fw-bold mt-2" id="badUrl">Seulement des lettres minuscules et "_".</p>
            </div>

            <div class="mb-3">
                <label for="pitch" class="form-label">Pitch</label>
                <input type="text" class="form-control text-primary fs-5 mt-0 pt-0" id="pitch" name="pitch"
                value="<?= $article['pitch'] ?>"
                >
            </div>

            <div class="mt-5 w-75 mx-auto d-flex flex-column gap-3 justify-content-center align-items-center ">

                <button type="submit" class="btn btn-primary w-100 fs-5 text-light disabled " id="btnNewArticleCard">Je valide ces modifications.</button>
                <a href="<?= URL ?>home" class="btn btn-primary w-100  fs-5">
                    Finalement... je ferai ça plus tard...
                </a>
            </div>
        </form>

    </div>
</div>