<?php $titre= "Organisme";?>
<?php $css ="<style>body{overflow:hidden}</style>";?>
<?php ob_start(); ?>
<div id="main" class="row h-100"> 
    <div class="d-flex align-items-start h-100">

<!-- Nav tabs -->
<ul class="sidenav nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <div class="nomorganisme">
  <?php
      echo organisme($query['organisme']);?> <?php
      echo " - ".nomBDD($query['trigramme']);?> 
  </div>
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="mim3-tab" data-bs-toggle="tab" href="#mim3" role="tab" aria-controls="mim3" aria-selected="false">Internet militaire <br>MIM3</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="bnr-tab" data-bs-toggle="tab" href="#bnr" role="tab" aria-controls="bnr" aria-selected="false">Besoins nouveaux réseaux<br>BNR</a>
  </li>
  <!--<li> <a id="cmd" style="position: absolute;bottom: 1em;right: .5em;"class="btn btn-dark" href="/export?trigramme=<?php //echo $query['trigramme']?>&organisme=<?php //echo $query['organisme']?>"> Exporter</a></li>-->
  <li>
  <a  style="position: absolute;bottom: 1em;left: .5em;" class="btn btn-dark" href="<?php echo "/quartiers?trigramme=".$query['trigramme']?>">Retour</a>
  </li>
</ul>



<div class="scroll tab-content h-auto col-lg">
    
    
    <div class="tab-pane active" id="mim3" role="tabpanel" aria-labelledby="mim3-tab">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column col-form-label-lg">
    <?php
    echo tableaumim3v2($query['organisme']);?>
    </div>
    </div>


    <div class="tab-pane" id="bnr" role="tabpanel" aria-labelledby="bnr-tab">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column col-form-label-lg">
    <?php
    echo tableaubnrv4($query['organisme']);?><br>
    </div>
  </div>
  <br>
  <br>
  <br>
</div>






<?php $contenu = ob_get_clean();
$js ='';
 require('template.php'); ?>


