
<?php if(Auth::isLogged()){
global $query;
} else {
    header('Location: https://'.$_SERVER['HTTP_HOST'].'/login');
    }
?>

<?php $titre= "Gestion BCS"; ?>

<?php $css ="<link rel='stylesheet' href='vendor/bootstrap-table-master/dist/bootstrap-table.min.css'>
<link rel='stylesheet' href='vendor/export/css/all.min.css'>";?>
<?php ob_start(); ?>
  <div class=" d-flex align-items-start">
<!-- Nav tabs -->
<ul class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  
  <?php
      if($_SESSION['Auth']['Login'] == 'OPERA' || Auth::isAdmin()){
      ?>
  <li class="nav-item active" role="presentation">
          <a class="nav-link active" id="opera-tab" data-bs-toggle="tab" href="#opera" role="tab" aria-controls="opera" aria-selected="true">Opera</a>
  </li>
      <?php 
      } 
      if($_SESSION['Auth']['Login'] == 'MIM3' || Auth::isAdmin()){?>
  <li class="nav-item" role="presentation">
        <a class="nav-link" id="mim3-tab" data-bs-toggle="tab" href="#mim3" role="tab" aria-controls="mim3" aria-selected="true">MIM3</a>
  </li>
      <?php }
      ?>
  <?php
      if($_SESSION['Auth']['Login'] == 'OPERA' || Auth::isAdmin()){
      ?>
  <li class="nav-item" role="presentation">
          <a class="nav-link" id="trv-tab-opera" data-bs-toggle="tab" href="#trv-opera" role="tab" aria-controls="trv-opera" aria-selected="false">Travaux Opera</a>
  </li>
      <?php 
      } 
      if($_SESSION['Auth']['Login'] == 'MIM3' || Auth::isAdmin()){?>
  <!--<li class="nav-item" role="presentation">
        <a class="nav-link" id="trv-tab-mim3" data-bs-toggle="tab" href="#trv-mim3" role="tab" aria-controls="trv-mim3" aria-selected="false">Travaux MIM3</a>
  </li>-->
      <?php }
      ?>
</ul>


<div class="tab-content col-lg" style="overflow-y:auto">
<?php
      if($_SESSION['Auth']['Login'] == 'OPERA' || Auth::isAdmin()){
      ?>
	   
  <div class="tab-pane active" id="opera" role="tabpanel" aria-labelledby="opera-tab">
    <div class=" mx-auto flex-column col-form-label-lg">
      <button id="removeBCS1" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
     <button id="exportBCS1" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
      <button id="addBCS1" title="Ajouter un élément OPERA" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#opera_">Ajouter des informations</button>
      <?php include_once("Vue/Formulaires/Opera.php") ?>
      
	  <div class="container-fluid">
      <div id="modalBCS"></div>
        <table class="tableBCS" id="tableOPERA"></table>
      </div>
    </div>
	<br>
      <br> 
      <br>
  </div>

    
  <div class="tab-pane" id="trv-opera" role="tabpanel" aria-labelledby="trv-tab-opera">
    <div class=" mx-auto flex-column col-form-label-lg">
    <button id="removeBCS2" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
      <button id="exportBCS2" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
      <button id="addBCS2" title="Ajouter un travail OPERA" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#travaux_opera_add">Ajouter un travail</button>
       <?php $listeTrvOpera= listeaccess();?>
	  <?php include_once("Vue/Formulaires/TravauxOPERA.php") ?>
      <div class="container-fluid">
        <div id="modalBCStrv"></div>
          <table class="tableBCS" id="tableTrvOPERA"></table>
        </div>
    </div>
  </div>


 <?php 
      } 
      if($_SESSION['Auth']['Login'] == 'MIM3' || Auth::isAdmin()){?>

<div class="tab-pane <?php if($_SESSION['Auth']['Login'] == 'MIM3'){ echo "active";}?>" id="mim3" role="tabpanel" aria-labelledby="mim3-tab">
    <div class=" mx-auto flex-column col-form-label-lg">
    <button id="removeBCS3" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
      <button id="exportBCS3" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
	  <button id="addBCS3" title="Ajouter MIM3" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_mim3">Ajouter informations</button>
      <?php $selorganismes= listeorganisme();?>
	  <?php include_once("Vue/Formulaires/ajoutmim3.php") ?>
      <div class="container-fluid">
	  <div id="modalBCS2"></div>
        <table class="tableBCS" id="tableMIM3"></table>
		
      </div>
    </div>
<br>
      <br> 
      <br>
  </div>
  
  
  

  <!--<div class="tab-pane" id="trv-mim3" role="tabpanel" aria-labelledby="trv-tab-mim3">
    <div class=" mx-auto flex-column col-form-label-lg">
    <button id="removeBCS4" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
      <button id="exportBCS4" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
	   <button id="addBCS4" title="Ajouter un travail MIM3" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#travaux_mim_add">Ajouter un travail</button>
	  <?php $listeTrvMim3= listemasterID();?>
	    
	  <?php  include_once("Vue/Formulaires/TravauxMIM3.php") ?>
      
      <div class="container-fluid">
	  <div id="modalBCStrv2"></div>
          <table class="tableBCS" id="tableTrvMIM3"></table>
        </div>
    </div>

  </div>-->

    
     <?php }
      ?>





    
    

<?php $contenu = ob_get_clean(); ?>
<?php $js ="<script src='vendor/bootstrap-table-master/dist/themes/bootstrap-table/bootstrap-table.min.js'></script>
                <script src='vendor/bootstrap-table-master/dist/bootstrap-table.min.js'></script>
                <script src='vendor/bootstrap-table-master/dist/locale/bootstrap-table-fr-FR.min.js'></script>
				<script src='Ressources/js/forms.js'></script>
                <script>var frole = '".$_SESSION['Auth']['Login']."'</script>
                <script src='Ressources/js/gestion.js'></script>
                <script src='vendor/export/js/shieldui-all.min.js'></script>
                           <script src='vendor/export/js/jszip.min.js'></script>";
 require('template.php'); ?>
  
