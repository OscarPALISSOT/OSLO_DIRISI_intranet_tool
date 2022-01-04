<?php $titre= "ContactOPERA";?>
<?php $css ="<style>body{overflow:hidden}</style>";?>
<?php ob_start(); ?>
<STYLE type="text/css">
.cover-container{position: absolute; top: 150px; left: 100px;}
.nom1{color:grey;}
.nom2{color:grey;}
.accueil{color:grey};
ul.div{display: inline;  color:grey; position:absolute; top:108px; }
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
            <a class="nom1" href="javascript:history.back()"><?php echo $query["BdD"]?></a>
			  	</ul>
			</div>

    <div class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
    <div class="container">
             <h1>Base de Défense de Charleville</h1><br>
             <div class="btn-group-vertical" role="group" aria-label="Groupe de boutons en colonne">
                <a class="btn btn-primary" href="/contactBdD?Enseigne=COORDINATEURS_SIC&BdD=Charleville-Mezières"   role="button">CONTACT COORDINATEUR SIC CHARLEVILLE</a><br>
    </div>
    
  </div>
  




<?php $contenu = ob_get_clean(); ?>
<?php $js ="";
 require('template.php'); ?>




