
<!DOCTYPE html>
<html lang="fr">
    <head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico"><meta charset="utf-8" />
        <title><?= $titre ?></title>

    <link href="vendor/bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-5.15.2/css/all.min.css" rel="stylesheet">  
    <link href="Ressources/css/style.css" rel="stylesheet"> 
    <?= $css ?> 
    
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- <script src="vendor/@popperjs/core/dist/umd/popper.min.js"></script> -->
    <!-- <script src="vendor/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script> -->
    <script src="vendor/bootstrap-5.0.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/fontawesome-5.15.2/js/all.min.js"></script>
    <script src="Ressources/js/app.js"></script>
    <!-- <script src="Ressources/js/forms.js"></script> -->
    <?= $js ?> 
    
    </head>
        
    <body>
        
    <?php require('header.php'); ?>

   
    <?= $contenu ?>

 
   
    </body>
    
    </html>
    
    