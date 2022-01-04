
<?php if(Auth::isLogged()){
global $query;
} else {
    header('Location: https://'.$_SERVER['HTTP_HOST'].'/login');
    }
?>
<?php $titre= "Gestion BRC"; ?>
<?php $css ="<link rel='stylesheet' href='vendor/bootstrap-table-master/dist/bootstrap-table.min.css'>
<link rel='stylesheet' href='vendor/export/css/all.min.css'>";?>
<?php ob_start(); ?>

    
    <div class="d-flex align-items-start ">
<!-- Nav tabs -->
<ul class="sidenav nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="bnrprevus-tab" data-bs-toggle="tab" href="#bnrprevus" role="tab" aria-controls="fbnrprevus" aria-selected="true">BNR/PDCA prévus</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="bnrfinis-tab" data-bs-toggle="tab" href="#bnrfini" role="tab" aria-controls="fbnrfini" aria-selected="false">BNR/PDCA traités</a>
  </li>
  <li class="nav-item" role="presentation">
      <a class="nav-link" id="modip-planif-tab" data-bs-toggle="tab" href="#planif" role="tab" aria-controls="planif" aria-selected="true">MODIP planifiés</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="modip-tab" data-bs-toggle="tab" href="#modip" role="tab" aria-controls="fmodip" aria-selected="false">MODIP traités</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="mim3-tab" data-bs-toggle="tab" href="#mim3" role="tab" aria-controls="mim3" aria-selected="true">MIM3</a>
  </li>
  <!--<li class="nav-item" role="presentation">
        <a class="nav-link" id="trv-tab-mim35" data-bs-toggle="tab" href="#trv-mim35" role="tab" aria-controls="trv-mim35" aria-selected="false">Travaux MIM3</a>
  </li>-->
  <li class="nav-item" role="presentation">
          <a class="nav-link" id="opera-tab" data-bs-toggle="tab" href="#opera" role="tab" aria-controls="opera" aria-selected="true">Opera</a>
  </li>
  <li class="nav-item" role="presentation">
          <a class="nav-link" id="trv-tab-opera" data-bs-toggle="tab" href="#trv-opera" role="tab" aria-controls="trv-opera" aria-selected="false">Travaux Opera</a>
  </li>
</ul>

<div class="tab-content col-lg" style="overflow-y:auto">

<div class="tab-pane active" id="bnrprevus" role="tabpanel" aria-labelledby="bnrprevus-tab">
    <div class="mx-auto flex-column col-form-label-lg">

          <button id="removeBRC" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
          <button id="exportBRCprevus" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
          <button id="addBRC" title="Ajouter un élément BNR" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_bnr">Ajouter des informations</button>
      <div class="container-fluid">
      
        <div id="modalBRC"></div>
      <table id="tableBRCprevus" class="tableBRC"></table>
      </div>
<br>
<br>
      </div>      
      
      </div>

      <div class="tab-pane" id="bnrfini" role="tabpanel" aria-labelledby="bnrfinis-tab">
    <div class="h-100 p-3 mx-auto flex-column col-form-label-lg">
    <!-- <div id="toolbar"> -->
    <button id="removeBRC2" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
          <button id="exportBRCfinis" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
          <!-- </div> -->
      <div class="container-fluid">
       <div id="modalBRCFINI"></div>
      <table id="tableBRCfinis" class="tableBRC"></table>
      </div>
      </div></div>


      <div class="tab-pane" id="modip" role="tabpanel" aria-labelledby="modip-tab">
      <div class="mx-auto flex-column col-form-label-lg">
        <!-- <div id="toolbar"> -->
          <button id="removeBRC3" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
          <button id="exportBRC3" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
           <button id="addBRCfini" title="Ajouter un élément MODIP" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_modip">Ajouter des informations</button>
        <!-- </div> -->
        <div class="container-fluid">
        <div id="modalBRCfini2"></div>
          <table id="tableMODIPfini" class="tableBRC29"></table>
        </div>
      </div>
      </div>

      <div class="tab-pane" id="planif" role="tabpanel" aria-labelledby="modip-planif-tab">
      <div class="mx-auto flex-column col-form-label-lg">
        <!-- <div id="toolbar"> -->
          <button id="removeBRC4" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
          <button id="exportBRC4" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
            <button id="addBRC" title="Ajouter un élément MODIP" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_modip">Ajouter des informations</button>


        <div class="container-fluid">
        <div id="modalBRC2"></div>
          <table id="tableMODIPprevu" class="tableBRC65"></table>
        </div>
      </div>
      <br>
      <br> 
      <br>
    </div>
    <div class="tab-pane" id="mim3" role="tabpanel" aria-labelledby="mim3-tab">
    <div class=" mx-auto flex-column col-form-label-lg">
    <button id="removeBCS3" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
      <button id="exportBCS3" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
	  <button id="addBCS3" title="Ajouter MIM3" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_mim3">Ajouter informations</button>
      <div class="container-fluid">
	  <div id="modalBCS2"></div>
        <table class="tableBCS" id="tableMIM3"></table>
		
      </div>
    </div>
<br>
      <br> 
      <br>
  </div>
  
  <!--<div class="tab-pane" id="trv-mim35" role="tabpanel" aria-labelledby="trv-tab-mim35">
    <div class=" mx-auto flex-column col-form-label-lg">
    <button id="removeBCS4" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
      <button id="exportBCS4" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
	   <button id="addBCS4" title="Ajouter un travail MIM3" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#travaux_mim_add">Ajouter un travail</button>

      <div class="container-fluid">
	  <div id="modalBCStrv2"></div>
          <table class="tableBCS" id="tableTrvMIM3"></table>
        </div>
    </div>

  </div>-->
  
  <div class="tab-pane" id="opera" role="tabpanel" aria-labelledby="opera-tab">
    <div class=" mx-auto flex-column col-form-label-lg">
      <button id="removeBCS1" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
     <button id="exportBCS1" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
      <button id="addBCS1" title="Ajouter un élément OPERA" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#opera_">Ajouter des informations</button>
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
      <div class="container-fluid">
        <div id="modalBCStrv"></div>
          <table class="tableBCS" id="tableTrvOPERA"></table>
        </div>
    </div>
  </div>
  
      
  <?php $selorganismes= listeorganisme();?>
 <?php include_once ('Vue/Formulaires/AjoutBnr.php');?>
 <?php include_once ('Vue/Formulaires/AjoutModip.php');?>
 <?php include_once ('Vue/Formulaires/TravauxMIM3.php'); ?>
 <?php include_once ('Vue/Formulaires/ajoutmim3.php'); ?>
 <?php include_once ('Vue/Formulaires/Opera.php') ?>
 <?php include_once ('Vue/Formulaires/TravauxOPERA.php') ?>
 <?php include_once ('Vue/Formulaires/ModifierModip.php') ?>
</div>



</div>
<br>
<br>

<?php $contenu = ob_get_clean(); ?>
<?php $js ="<script src='vendor/bootstrap-table-master/dist/themes/bootstrap-table/bootstrap-table.min.js'></script>
                <script src='vendor/bootstrap-table-master/dist/bootstrap-table.min.js'></script>
                <script src='vendor/bootstrap-table-master/dist/locale/bootstrap-table-fr-FR.min.js'></script>
                <script>var frole = '".$_SESSION['Auth']['Login']."'</script>
           
<script src='Ressources/js/gestion.js'></script>
 <script src='vendor/export/js/shieldui-all.min.js'></script>
            <script src='vendor/export/js/jszip.min.js'></script>";
 require('template.php'); ?>

