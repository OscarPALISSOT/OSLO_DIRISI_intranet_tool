<?php $titre= "ContactOPERA";?>
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
  <a style="position: absolute;bottom: 1em;left: .5em;" class="btn btn-dark align-self-baseline" href="/contactprincipal">Retour</a>
  </li>
  
</ul>

<div class="container"> 
    <div class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
    <div class="container">
             <h1>CONTACT SGA</h1><br>
             <div class="btn-group-vertical" role="group" aria-label="Groupe de boutons en colonne">
                <a class="btn btn-primary" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=SGA"   role="button"><strong>CHARGE DE COMPTE SGA</strong></a><br>
    </div>
    
  </div>
<?php $contenu = ob_get_clean(); ?>
<?php $js ="";
 require('template.php'); ?>




