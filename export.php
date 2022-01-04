   
<!DOCTYPE html>
<html>
    <head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico"><meta charset="utf-8" />
      

    <link href="vendor/bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css" rel="stylesheet">  
    <link href="Ressources/css/style.css" rel="stylesheet"> 
    

    <script src="vendor/jquery/jquery.min.js" ></script>
    <script src="vendor/bootstrap-5.0.0-beta1-dist/js/popper.min.js"></script>
    <script src="vendor/bootstrap-5.0.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap-5.0.0-beta1-dist/js/bootstrap.min.js"></script>
    <script src="Ressources/js/app.js"></script>
    <script src="Ressources/js/forms.js"></script>

<script src="vendor/es6-promise/dist/es6-promise.auto.min.js"></script>
<script src="vendor/jspdf/dist/jspdf.min.js"></script>
<script src="vendor/html2canvas/dist/html2canvas.min.js"></script>
<script src="vendor/html2pdf/dist/html2pdf.js"></script>
<script src="Ressources/js/export.js"></script>

    </head>
        
    <body>



<img src="Ressources/images/logo.png">






<div class="pagebreak">
<?php echo pageinfos($query["trigramme"]);?>



<div class="container">
  <div class="row">
    <label class="col-sm-auto"><strong>Nom de l'organisme: </strong></label>
    <div class="">
     <p><?php echo organisme($query["organisme"]);?><p>
    </div>
  </div>
  </div>

</div>

<div class="pagebreak">
 <?php
    $resultat =  routeur($query['trigramme']);?>
    <?php if(!empty($resultat)){
        echo '<h3 style="text-align:center;">Liste des quartiers reliés au RFZ de '.$resultat[0]["RFZ"].'</h3><br><ul class="col-6" style="list-style-type : circle; color:#0111d3;">';
    for($i=0; $i<(count($resultat)); $i++){
    echo "<li><a style='  color: #0111d3;
            text-decoration: underline;
            text-align: left;' href='/quartiers?trigramme=".$resultat[$i]["Trigramme"]."'>".$resultat[$i]['Nom']."</a></li>";
    

       
    } echo "</ul>";

    }
    // var_dump($resultat);?>
</div>
<div class="pagebreak">
<?php echo tableaumodip($query["trigramme"]);?>
</div>
<div class="pagebreak">
<?php echo tableaumim3($query["organisme"]);?>
</div>
<div class="pagebreak">
<?php echo tableauopera($query["trigramme"]);?>
</div>
<div class="pagebreak">
<?php echo tableaubnrv3($query["organisme"]);?>
</div>






</body>
</html>
   
    

















    