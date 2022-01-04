<?php 
global $query;

?>

<?php $titre= "Site"; ?>
<?php $css ="<style>body{overflow:hidden;}</style>";?>
<style>
.police{
  font-size: 25px;
}
.taille{
font-size: 25px;
}
</style>
<?php ob_start(); ?>
<div id="main" class="row h-100"> 
    
 

    
    <div class="d-flex align-items-start h-100">
    
<!-- Nav tabs -->
<ul class="sidenav nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="organisme-tab" data-bs-toggle="tab" href="#organisme" role="tab" aria-controls="organisme" aria-selected="true">Organismes</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="rfz-tab" data-bs-toggle="tab" href="#rfz" role="tab" aria-controls="rfz" aria-selected="true">Routeur fédérateur de zones<br>RFZ</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="opera-tab" data-bs-toggle="tab" href="#opera" role="tab" aria-controls="opera" aria-selected="false">Réseau de transport <br>OPERA</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="modip-tab" data-bs-toggle="tab" href="#modip" role="tab" aria-controls="modip" aria-selected="false">Modernisation des réseaux LAN <br>MODIP</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="mim29-tab" data-bs-toggle="tab" href="#mim29" role="tab" aria-controls="mim29" aria-selected="false">Internet Militaire<br>MIM3</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="bnr-tab" data-bs-toggle="tab" href="#bnr" role="tab" aria-controls="bnr" aria-selected="false">Besoins nouveaux réseaux<br>BNR</a>
  </li>
  <!--<li class="nav-item" role="presentation">
    <a class="nav-link" id="mim3v2-tab" data-bs-toggle="tab" href="#mim3v2" role="tab" aria-controls="mim3v2" aria-selected="false">MIM3 FINIS</a>
  </li>-->
  <li>
  <a style="position: absolute;bottom: 1em;left: .5em;" class="btn btn-dark align-self-baseline" href="/">Retour</a>
  </li>
</ul>

<div class="scroll tab-content col-lg">


  
<div class="info" >
    <div class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
    <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit<?php echo $query["trigramme"]?>" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
      <?php
      echo pageinfos($query['trigramme']);?><br>
    </div>
  </div>

  <div class="tab-pane active" id="organisme" role="tabpanel" aria-labelledby="organisme-tab">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column col-form-label-lg">
      <div class ="taille" class="container" style="display: inline-flex;text-align: inherit;">
        <?php $listeorga = listeorganismes($query['trigramme']);
        $i =0;?>
        <?php if(!empty($listeorga)){
          echo "<ul class='col-6' style='list-style: none;'>";
          for($i; $i<(count($listeorga)/2); $i++){
            echo "<li><a style='  color: #0111d3;
            text-decoration: underline;
            text-align: left;' href='/organisme?trigramme=".$listeorga[$i]["Trigramme"]."&organisme=".$listeorga[$i]["Id_organisme"]."'>".$listeorga[$i]["Nom"]."</a></li>";
          }
          echo "</ul>
          <ul class='col-6' style='list-style: none;'>";
          for($i; $i<(count($listeorga)); $i++){
            echo "<li><a style='  color: #0111d3;
            text-decoration: underline;
            text-align: left;' href='/organisme?trigramme=".$listeorga[$i]["Trigramme"]."&organisme=".$listeorga[$i]["Id_organisme"]."'>".$listeorga[$i]["Nom"]."</a></li>";
          }
          echo "</ul>";
        } else echo "Ce site n'a pas d'organisme"; ?>

        
        <br>
      </div>
    </div>
  </div>

  
  
  <div class="tab-pane" id="opera" role="tabpanel" aria-labelledby="opera-tab">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column col-form-label-lg">
    <?php
    echo tableauopera($query['trigramme']);?><br>
    </div>
  </div>

  
  
  <div class="tab-pane" id="modip" role="tabpanel" aria-labelledby="modip-tab">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column col-form-label-lg">
  <?php
      echo tableaumodip($query['trigramme']);?><br>
    </div>
  </div>

  <div class="tab-pane" id="rfz" role="tabpanel" aria-labelledby="rfz-tab">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column col-form-label-lg">
   
    <?php
    $resultat =  routeur($query['trigramme']);?>
    <?php if(!empty($resultat)){
        echo '<h3 style="text-align:center;">Liste des quartiers reliés au RFZ de '.$resultat[$i]["RFZ"].'</h3><br><ul class="col-6" style="list-style-type : circle; color:#0111d3;">';
    for($i=0; $i<(count($resultat)); $i++){
    echo "<li><a style='  color: #0111d3;
            text-decoration: underline;
            text-align: left;' href='/quartiers?trigramme=".$resultat[$i]["Trigramme"]."'>".$resultat[$i]['Nom']."</a></li>";
    } echo "</ul>";

    }
    // var_dump($resultat);?>
   
    </div>
  </div>

  <div class="tab-pane" id="mim29" role="tabpanel" aria-labelledby="mim29-tab">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column col-form-label-lg">
    <?php
    echo tableaumim3($query['trigramme']);?><br>
    </div>
  </div>

  <div class="tab-pane" id="bnr" role="tabpanel" aria-labelledby="bnr-tab">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column col-form-label-lg">
    <?php
    echo tableaubnrv3($query['trigramme']);?><br>
    </div>
  </div>
</div>
    </div>


<?php $contenu = ob_get_clean(); ?>
<?php $js ="";
 require('template.php'); ?>


