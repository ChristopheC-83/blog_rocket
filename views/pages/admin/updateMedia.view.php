
<!-- <?=  Tools::showArray($oneArticle) ?> -->
<?php if (isset($oneArticle['img1']) && isset($oneArticle['slider_folder']) && isset($oneArticle['video_link'])) : ?>
    <p class="text-center fs-3 m-0">Je souhaite ajouter : </p>
    <p class=" text-center text-danger fs-5 mb-4 ">un seul media possible !</p>
    <div class="d-flex justify-content-between justify-content-md-around my-3">
        <div class="btn btn-primary text-light" id="btn-media-image">Une Image</div>
        <div class="btn btn-primary text-light" id="btn-media-slider">Un Slider</div>
        <div class="btn btn-primary text-light" id="btn-media-video">Une Vidéo</div>
    </div>
    
    <form class="my-5 w-100 dnone" method="POST" action="" id="addImage" enctype="multipart/form-data">
        <input type="hidden" value="<?=$oneArticle?>">
        <input type="file" name="img1">
    </form>
    <form class="my-5 w-100 d-none" method="POST" action="" id="addSlider" enctype="multipart/form-data">
        <input type="hidden" value="<?=$oneArticle?>">
                <input type="file" name="photo[]" id="slider_files" multiple>
    </form>
    <form class="my-5 w-100 d-none" method="POST" action="" id="addVideo" enctype="multipart/form-data">
        <input type="hidden" value="<?=$oneArticle?>">
        <input type="text" name="video" id="video" placeholder="lien de ta vidéo">
    </form>

<?php endif ?>