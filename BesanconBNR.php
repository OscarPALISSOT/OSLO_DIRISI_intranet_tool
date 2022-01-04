<?php $titre= "Contact Besancon BNR";?>
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
  <a style="position: absolute;bottom: 1em;left: .5em;" class="btn btn-dark align-self-baseline" href="/contactprincipal">Retour</a>
  </li>
</ul>

<div id="filAriane" class="vingt" itemscope="" itemtype="">
				<ul>
						<a class="accueil" href="/contactprincipal" itemprop=""> Contact </a> > 
            <a class="nom1" href="javascript:history.back()"><?php echo "CIRISI " .$query["Cirisi"]?></a>
			  	</ul>
			</div>
    <div class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
    <div class="container">
             <h1>CIRISI BESANCON</h1><br>
             <div class="btn-group-vertical" role="group" aria-label="Groupe de boutons en colonne">
                <a class="btn btn-primary" href="/contact?Enseigne=BRC_RELATIONS_CLIENTS&Cirisi=Besançon"   role="button">CONTACT CIRISI BESANCON RELATIONS CLIENTS</a><br>
                <a class="btn btn-primary" href="/contact?Enseigne=BRC_CHARGE_DE_COMMUNICATION&Cirisi=Besançon"  role="button">CONTACT CIRISI BESANCON CHARGE DE COMMUNICATION</a><br>
    </div>
    
  </div>
  




<?php $contenu = ob_get_clean(); ?>
<?php $js ="";
 require('template.php'); ?>




