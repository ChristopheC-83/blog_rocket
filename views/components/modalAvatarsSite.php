<!-- Modal -->
<div class="modal fade bg-dark" id="avatarSite" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h1 class="modal-title fs-3" id="exampleModalLabel">Choisissez votre nouvel Avatar !</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark ">
                <form action="<?= URL ?>account/modify_avatar_by_site" method="post" class="images_site dnone" id="avatarSite">
                    <?php
                    $dossier = "public/assets/images/avatars/site";
                    // Liste des fichiers dans le dossier
                    $fichiers = scandir($dossier);
                    ?>
                        <div class="row w-100 g-2">
                    <?php foreach ($fichiers  as $fichier) :
                        // Vérifie si le fichier est une image
                        if (in_array(pathinfo($fichier, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif'))) :
                    ?>
                                <div class="image_site col-4 col-md-3 col-lg-2">
                                    <label>
                                        <input type="radio" name="avatar" value="<?= $fichier ?>" onclick="submit()" class="invisible">
                                        <img src="<?= AVATARS_PATH ?>site/<?= $fichier ?>" class="cupo imgAvatar">
                                    </label>
                                </div>
                                <?php endif; ?>
                                <?php endforeach ?>
                            </div>
                </form>
            </div>
            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>