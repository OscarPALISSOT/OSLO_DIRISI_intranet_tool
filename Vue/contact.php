<?php $titre= "Contact";?>
<?php $css ="<style>body{overflow:hidden}</style>";?>
<?php ob_start(); ?>
<STYLE type="text/css">
.cover-container{position: absolute; top: 150px; left: 100px;}
.nom1{color:grey;}
.nom2{color:grey;}
.accueil{color:grey};
ul.div{display: inline; color:grey; position:absolute; top:108px;}
.bouton{position: absolute; top: -20px; left: 700px;}
</STYLE>
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
<div id="filAriane" class="vingt" itemscope="" itemtype="">
				<ul>
						<a class="accueil" href="/contactprincipal" itemprop=""> Contact </a> >
            <a class="nom1" href="javascript:history.back()"><?php echo $query["Cirisi"]?></a> >
            <a class="nom2" href="javascript:history.back()"><?php echo "Contact " .$query["Enseigne"]. " " .$query["Cirisi"]?></a>	
			  	</ul>
			</div>
			</div>
    <div class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">

<div class="container">
  

  <div class="container">
  
  <?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=bdd-dirisi;charset=utf8', 'root', 'Dir1si_');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table contact
$reponse = $bdd->query('SELECT * FROM contact WHERE Cirisi="'.$query["Cirisi"].'" AND Enseigne="'.$query["Enseigne"].'"');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
  include ('Vue/Formulaires/modifierContact.php')
?> 
<div id="info">
    <div class ="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
    <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="<?php echo "#edit".$query["Cirisi"] .$query["Enseigne"]?>" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
    </div>
  </div>
    <p>
    <strong>Nom : </strong>  <?php echo $donnees['Nom']; ?><br />
    <strong>Prénom :</strong>  <?php echo $donnees['Prénom']; ?><br />
    <strong>Email :</strong>  <?php echo $donnees['Email']; ?></em><br>
    <strong>TPH :</strong> <?php echo $donnees['TPH']; ?></em>
   </p>
<?php
}

$reponse->closeCursor(); // Termine le traitement de la requête

?>

</div>
</div>

<?php $contenu = ob_get_clean(); ?>
<?php $js ="";
 require('template.php'); ?>




