<!-- template de base -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=arizonia:400|roboto:100,400,700,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $page_description ?>">
    <title><?= $page_title ?></title>
    <link href="<?= URL ?>public/css/main.css" rel="stylesheet" />
  
    </script>
</head>

<body class="min-vh-100 d-flex flex-column bg-dark text-light position-relative">

    <!-- un loader -->
    <?php require_once("views/components/overlay.php") ?>
    <!-- insertion du header / menu -->
    <?php require_once("views/common/header.php"); ?>

    <!-- afficharge des alertes s'il y en a -->

    <div class="container flex-grow-1">
        <?php
        if (!empty($_SESSION['alert'])) {
            foreach ($_SESSION['alert'] as $alert) {
                echo "<div class='alert " . $alert['type'] . "' role='alert'>
                        " . $alert['message'] . "
                    </div>";
            }
            unset($_SESSION['alert']);
        }
        ?>

        <!-- affichage du contenu de la page -->

        <?= $page_content ?>


    </div>

    <!-- affichage du footer -->

    <?php require_once("views/common/footer.php"); ?>


    <!-- fichier js de bootstrap, isolé pour être saugardé après purge -->
    <script src="<?= URL ?>public/javascript/bootstrap.bundle.js"></script>
    <script src="<?= URL ?>public/javascript/alert.js"></script>
    <!-- pozsibilité d'avoir des fichiers js spécifiques par page -->
    <?php if (!empty($javascript)) : ?>
        <?php foreach ($javascript as $fichier_js) : ?>
            <script src="<?= URL ?>public/javascript/<?= $fichier_js ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>