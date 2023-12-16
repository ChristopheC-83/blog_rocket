<!-- <?= Tools::showArray($oneArticle) ?> -->
<?php if (isset($oneArticle['img1']) && isset($oneArticle['slider_folder']) && isset($oneArticle['video_link'])) : ?>
    <p class="text-center fs-3 m-0">Je souhaite ajouter : </p>

 <?= $oneArticle['id_article'] ?>



    <p class=" text-center text-danger fs-5 mb-4 ">un seul media possible !</p>
    <div class="d-flex justify-content-between justify-content-md-around my-3">
        <div class="btn btn-primary text-light" id="btn-media-image">Une Image</div>
        <div class="btn btn-primary text-light" id="btn-media-slider">Un Slider</div>
        <div class="btn btn-primary text-light" id="btn-media-video">Une Vidéo</div>
    </div>


    <form class="mt-5 mb-3 w-100 d-none" method="POST" action="<?= URL ?>administrator/add_media/image" id="form-image" enctype="multipart/form-data">
        <input type="hidden" value="<?= $oneArticle['id_article'] ?>" name="id">
        <input type="file" name="img1">
        <button type="submit" class="btn btn-primary w-100 text-light mt-4 fs-5">
            J' ajoute cette image !
        </button>

    </form>
    <form class="mt-5 mb-3 w-100 d-none" method="POST" action="<?= URL ?>administrator/add_media/slider" id="form-slider" enctype="multipart/form-data">
        <input type="hidden" value="<?= $oneArticle['id_article'] ?>" name="id">
        <input type="file" name="photo[]" id="slider_files" multiple>
        <button type="submit" class="btn btn-primary w-100 text-light mt-4 fs-5">
            J' ajoute ce slider !
        </button>
    </form>
    <form class="mt-5 mb-3 w-100 d-none" method="POST" action="<?= URL ?>administrator/add_media/video" id="form-video" enctype="multipart/form-data">
        <input type="hidden" value="<?= $oneArticle['id_article'] ?>" name="id">
        <input type="text" name="video" id="video" placeholder="lien de ta vidéo">
        <button type="submit" class="btn btn-primary w-100 text-light mt-4 fs-5">
            J' ajoute cette video !
        </button>
    </form>

<?php endif ?>