<?php $titre= "Contact BNR";?>
<?php $css ="<style>body{overflow:hidden}</style>";?>
<?php ob_start(); ?>
<div id="main" class="row h-100"> 
    <div class="d-flex align-items-start h-100">

       
    
    <div class="d-flex align-items-start h-100">
<!-- Nav tabs -->
<ul class="sidenav nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="organisme-tab" data-bs-toggle="tab" href="#organisme" role="tab" aria-controls="organisme" aria-selected="true">Contact</a>
  </li>
  <a style="position: absolute;bottom: 1em;left: .5em;" class="btn btn-dark align-self-baseline" href="javascript:history.back()">Retour</a>
  </li>
</ul>

    <div class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
  
    

<div class="container">


<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=bdd-dirisitest;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table contact
$reponse = $bdd->query('SELECT * FROM contact WHERE Enseigne="'.$query["Enseigne"].'" AND Cirisi="'.$query["Cirisi"].'"');

// On affiche chaque entrée une à une
while ($donnees1 = $reponse->fetch())
{
  include ('Vue/Formulaires/modifierContact.php')
?>  
<div id="info">
    <div class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
    <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="<?php echo "#edit".$query["Cirisi"] .$query["Enseigne"]?>" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
    </div>
  </div>
    <p>
    <strong>Nom : </strong> : <?php echo $donnees1['Nom']; ?><br />
    <strong>Prénom :</strong> : <?php echo $donnees1['Prénom']; ?><br />
    <strong>Email :</strong> : <?php echo $donnees1['Email']; ?></em><br>
    <strong>Téléphone :</strong> : <?php echo $donnees1['TPH']; ?></em>
   </p>
   
<?php

}

$reponse->closeCursor(); // Termine le traitement de la requête
?>
</div>
</div>
</div>
</div>






<?php $contenu = ob_get_clean(); ?>
<?php $js ="";
 require('template.php'); ?>




