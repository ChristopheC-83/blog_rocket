<!-- MAJ de l'article -->

<div class="container">

    <!--  Gestion Carte -->
    <div class="col-12 col-lg-10 col-xl-8  mx-auto border border-3 border-primary my-5 rounded-3 box-shadow-white px-3 fs-5">
        <form class="my-3" method="POST" action="<?= URL ?>administrator/update_article/" id="oneArticleForm">
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

    <!-- Gestion Médias -->

    <div class="col-12 col-lg-10 col-xl-8  mx-auto border border-3 border-primary mt-5 rounded-3 box-shadow-white p-3 pb-0 fs-5">
        <?php require_once("./views/pages/admin/updateMedia.view.php") ?>
    </div>

    <!-- Gestion Texte -->
    <div class="col-12 col-lg-10 col-xl-8  mx-auto border border-3 border-primary  my-5 rounded-3 box-shadow-white px-3 fs-5">
        <form class="my-3" method="POST" action="<?= URL ?>administrator/update_text_article/" id="oneArticleForm">
            <input type="hidden" value="<?= $oneArticle['id_article'] ?>" name="id">
            <label for="default" class="form-label">Ajouter ou modifier le texte :</label>
            <!-- pour ajouter une image au milieur du texte (seulement hébergée en externe) -->
            <p>Pour insérer une image hébergée en externe : <br>
                <i>img src=" url_img " class="d-block mx-auto w-50" alt=" "</i> <br>
                entre 2 chevrons <...>.<br>
            </p>
            <textarea id="default" style="height:50vh" name="text" class="text-light bg-dark"><?= $oneArticle['text'] ?></textarea>
            <button type="submit" class="btn btn-primary w-100 text-light py-3 mt-3 fs-5">
                Je valide le texte de cet article.
            </button>
        </form>
    </div>

    <!-- suppression de l'article -->
    <div class="col-12 col-lg-10 col-xl-8  mx-auto border border-3 border-primary   rounded-3 box-shadow-white px-3 fs-5">
        <div class="btn btn-danger w-100 text-light py-3 my-3 fs-5" id="btnDeleteArticle">
            Je veux supprimer cet article.
        </div>
        <form class="my-3 d-none" method="POST" action="<?= URL ?>administrator/delete_article" id="formDeleteArticle">
            <input type="hidden" value="<?= $oneArticle['id_article'] ?>" name="id_article">
            <button type="submit" class="btn btn-danger w-100 text-dark fw-bold py-3 mt-3 fs-3">
                Suppression définitive et irréversible !
            </button>
        </form>

    </div>
</div>