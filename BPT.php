<?php if(Auth::isLogged()){
global $query;
} else {
    header('Location: https://'.$_SERVER['HTTP_HOST'].'/login');
    }
?>
<?php $titre= "Gestion BPT"; ?>
<?php $css ="<link rel='stylesheet' href='vendor/bootstrap-table-master/dist/bootstrap-table.min.css'>
<link rel='stylesheet' href='vendor/export/css/all.min.css'>";?>
<?php ob_start(); ?>



<div class="d-flex align-items-start ">

  <ul class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="bnrprevus-tab" data-bs-toggle="tab" href="#bnrprevus" role="tab" aria-controls="fbnrprevus" aria-selected="true">BNR/PDCA prévus</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="bnrfinis-tab" data-bs-toggle="tab" href="#bnrfinis" role="tab" aria-controls="fbnrfinis" aria-selected="false">BNR/PDCA traités</a>
  </li>
  <li class="nav-item" role="presentation">
      <a class="nav-link" id="modip-planif-tab" data-bs-toggle="tab" href="#planif" role="tab" aria-controls="modip" aria-selected="true">MODIP planifiés</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="modip-tab" data-bs-toggle="tab" href="#modip" role="tab" aria-controls="fmodip" aria-selected="false">MODIP traités</a>
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

<div class="tab-pane" id="bnrfinis" role="tabpanel" aria-labelledby="bnrfinis-tab">
    <div class="mx-auto flex-column col-form-label-lg">

    <button id="removeBRC2" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
          <button id="exportBRCfinis" class="export btn btn-secondary">Exporter les données (.xlsx)</button>


      <div class="container-fluid">
       <div id="modalBRCfini"></div>
      <table id="tableBRCfinis" class="tableBRC28"></table>
      </div>
<br>
<br>
      </div>

    </div>
<div class="tab-pane" id="modip" role="tabpanel" aria-labelledby="modip-tab">
      <div class="mx-auto flex-column col-form-label-lg">
        <!-- <div id="toolbar"> -->
          <button id="removeBRC3" class="remove btn btn-danger">Supprimer les lignes sélectionnées</button>
          <button id="exportBRC3" class="export btn btn-secondary">Exporter les données (.xlsx)</button>
           <button id="addBRCfini" title="Ajouter un élément MODIP" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_modip">Ajouter des informations</button>
        <!-- </div> -->
        <div class="container-fluid">
        <div id="modalBRCfini2"></div>
          <table id="tableMODIPfini" class="tableBRC55"></table>
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
          <table id="tableMODIPprevu" class="tableBRC56"></table>
        </div>
      </div>
      <br>
      <br> 
      <br>
    </div>
    <br>
    <br>
    <br>
    <?php include_once ('Vue/Formulaires/AjoutBnr.php');?>
 <?php include_once ('Vue/Formulaires/AjoutModip.php');?>
  </div>
  <br>
  <br>
  <br>
  
</div>
<br>
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
