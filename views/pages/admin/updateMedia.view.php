<?php if (empty($oneArticle['img1']) && empty($oneArticle['slider_folder']) && empty($oneArticle['video_link'])) : ?>

    <!--  si pas de médias pour cet article, on choisit un type de média à insérer -->
    <p class="text-center fs-3 m-0">Je souhaite ajouter : </p>


    <!--  si l'article possède une image, on visualise une miniature, puis  on choisit un type de média pour remplacer-->
<?php elseif (!empty($oneArticle['img1'])) : ?>

    <div class="d-flex flex-column flex-md-row  text-sm-center align-items-center justify-content-evenly w-100">
        Je veux remplacer l'image :
        <img src="<?= URL . MEDIA_PATH . $oneArticle['id_article'] ?>/<?= $oneArticle['img1'] ?>" alt="" class="w-50 img-fluid">
    </div>


    <!--  si l'article possède unslider,  on visualise une miniature de la 1ere image, puis  on choisit un type de média pour remplacer-->
<?php elseif (!empty($oneArticle['slider_folder'])) : ?>

    <?php $directory = MEDIA_PATH . $oneArticle['id_article'];
    $images = glob($directory . '/*');
    ?>

    <div class="d-flex flex-column flex-md-row  text-sm-center align-items-center justify-content-evenly w-100">
        Je veux remplacer le slider commençant par :
        <img src="<?= URL . $images[0] ?>" alt="image ?" class="w-50 img-fluid">
    </div>


    <!--  si l'article possède une video, on visualise une miniature, puis  on choisit un type de média pour remplacer-->
<?php elseif (!empty($oneArticle['video_link'])) : ?>

    <div class="d-flex flex-column flex-md-row  text-sm-center align-items-center justify-content-evenly w-100">
        Je veux remplacer la vidéo :
        <div class="ratio ratio-16x9 w-50">
            <?= $oneArticle['video_link'] ?>
        </div>
    </div>


    <!-- les boutons font disparaitre les input et apparaitre l'input correspondant au média choisit. -->
<?php endif ?>
<p class=" text-center text-danger fs-5 mb-4 ">un seul media possible !</p>
<div class=" d-flex flex-column justify-content-around  my-3">
    <div class="w-75 mx-auto d-flex justify-content-between justify-content-around my-3">
        <div class="btn btn-primary text-light " style="width:133px" id="btn-media-image">Une Image</div>
        <div class="btn btn-primary text-light ms-3" style="width:133px" id="btn-media-slider">Un Slider</div>
    </div>
    <div class="w-75 mx-auto d-flex justify-content-between justify-content-around my-3">
        <div class="btn btn-primary text-light " style="width:133px" id="btn-media-video">Une Vidéo</div>
        <a class="btn btn-primary text-light ms-3" style="width:133px" id="btn-media-erase">Supprimer</a>
    </div>
</div>


<!--  input pour l'ajout d'une image-->
<form class="mt-5 mb-3 w-100 d-none" method="POST" action="<?= URL ?>administrator/add_media/image" id="form-image" enctype="multipart/form-data">
    <input type="hidden" value="<?= $oneArticle['id_article'] ?>" name="id">
    <input type="file" name="img1">
    <button type="submit" class="btn btn-primary w-100 text-light mt-4 fs-5">
        J' ajoute cette image !
    </button>
</form>


<!--  input pour l'ajout d'un slider-->
<form class="mt-5 mb-3 w-100 d-none" method="POST" action="<?= URL ?>administrator/add_media/slider" id="form-slider" enctype="multipart/form-data">
    <input type="hidden" value="<?= $oneArticle['id_article'] ?>" name="id">
    <input type="file" name="photo[]" id="slider_files" multiple>
    <button type="submit" class="btn btn-primary w-100 text-light mt-4 fs-5">
        J' ajoute ce slider !
    </button>
</form>


<!--  input pour l'ajout d'une video-->
<form class="mt-5 mb-3 w-100 d-none" method="POST" action="<?= URL ?>administrator/add_media/video" id="form-video" enctype="multipart/form-data">
    <input type="hidden" value="<?= $oneArticle['id_article'] ?>" name="id">
    <input type="text" name="video" id="video" placeholder="lien de ta vidéo">
    <button type="submit" class="btn btn-primary w-100 text-light mt-4 fs-5">
        J' ajoute cette video !
    </button>
</form>


<!--  input pour la suppression de tous les médias -->
<form class="mt-5 mb-3 w-100 d-none" method="POST" action="<?= URL ?>administrator/add_media/erase" id="form-erase" enctype="multipart/form-data">
    <input type="hidden" value="<?= $oneArticle['id_article'] ?>" name="id">
    <button type="submit" class="btn btn-primary w-100 text-light mt-4 fs-5">
        Je supprime tous les médias !
    </button>
</form>