<?php $titre= "Recherche"; ?>
<STYLE type="text/css">
.container {position:absolute;}
 .count{color:red;}
 .table-responsive {width: 2000px;}
 .table{border-color: red;}
 table, th, td {
  border: 1px solid RED;
}
</STYLE>
<?php $css = "<link rel='stylesheet' href='vendor/bootstrap-table-master/dist/bootstrap-table.min.css'>";?>
<?php ob_start(); ?>
<div class="d-flex align-items-start ">
<div class="container"> 


<html>
<head>
</head>
  
<body>
    
  
    <form method="post" action="">
    <br>
    
    Rechercher :
    <select name="filtre">
    
        <!--<option value="Site entier">Dans toute la base</option>-->
        <option value="bnrs_finis">BNRS/PDCA Traités</option>
        <option value="bnrs_prévus">BNRS/PDCA Prévus</option>
        <option value="Inférieur à">Montant FEB BNRS/PDCA traités inférieur ou égale à</option>
        <option value="Supérieur à">Montant FEB BNRS/PDCA traités supérieur ou égale à</option>
        <option value="Contact">Contact</option>
        <option value="NomOrganisme">Trigramme</option>
        <option value="modip">Modip prévus</option>
        <option value="modip finis">Modip finis</option>
        <option value="modip finis inférieur à">Cout MODIP traités inférieur ou égale à</option>
        <option value="modip finis supérieur à">Cout MODIP traités supérieur ou égale à</option>
        <option value="modip finis datant d'après ou de">MODIP traités datant d'après ou de</option>
        <option value="modip finis datant d'avant ou de">MODIP traités datant d'avant ou de</option>
        <option value="modip prévus datant d'avant ou de">MODIP prévus avant l'année</option>
        <option value="modip prévus datant d'après ou de">MODIP prévus après l'année</option>
        <label for="query">Entrer votre recherche</label>
    <input type="search" name="query" maxlength="80px" size="80px" id="query"><br><br>
<input type="submit" value="Rechercher">
</form>

<?php 

include ("Modèle/recherche.php");

?>
 
</body>

</div>

</div>   

</html>

    

<?php $contenu = ob_get_clean(); ?>
<?php $js ="";
 require('template.php'); ?>

