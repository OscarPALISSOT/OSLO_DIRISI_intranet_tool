<?php $titre = "Accueil"; 
$css ="";

ob_start(); ?>
<STYLE type="text/css">
.test{position:absolute; top:250px; left:170px;}
.majuscule{font-size: 3em;}
.minuscule{font-size: 3em;}
.majuscule::first-letter{font-size:2em; font-weight:bold;}
.oui{font-size:2em;}
</STYLE>


 <div id="main" class="mx-auto flex-column" style="text-align:center">
 <div class="test">
  <p class="majuscule">Outil de</p>
  <p class="majuscule">Suivi</p>
  <p class="minuscule">des Réseaux</p>
  <p class="majuscule">L<strong class="oui">O</strong>caux</p>
  </div>
 <div style="margin:auto;width:803px;height:817px"><img src="Ressources/images/carte.png" alt="" usemap="#image-map" id="map" class="h-100 w-100"/></div>
<map id="map_ID" name="image-map" data-toggle="modal" data-target="#myModal">
    <area id="1" class="areaclick" target="" alt="Lille" title="Lille" href="" coords="178,117,28" shape="circle">
    <area id="2" class="areaclick" target="" alt="Charleville-Mézières" title="Charleville-Mézières" href="" coords="394,221,27" shape="circle">
    <area id="11" class="areaclick" target="" alt="Mourmelon" title="Mourmelon" href="" coords="320,340,27" shape="circle">
    <area id="10" class="areaclick" target="" alt="Verdun" title="Verdun" href="" coords="463,341,27" shape="circle">
    <area id="3" class="areaclick" target="" alt="Metz" title="Metz" href="" coords="530,292,27" shape="circle">
    <area id="7" class="areaclick" target="" alt="Phalsbourg" title="Phalsbourg" href="" coords="644,364,27" shape="circle">
    <area id="6" class="areaclick" target="" alt="Nancy" title="Nancy" href="" coords="523,410,26" shape="circle">
    <area id="12" class="areaclick" target="" alt="Saint-Dizier" title="Saint-Dizier" href="" coords="382,478,27" shape="circle">
    <area id="8" class="areaclick" target="" alt="Luxeuil-lès-Bains" title="Luxeuil-lès-Bains" href="" coords="550,521,27" shape="circle">
    <area id="5" class="areaclick" target="" alt="Strasbourg" title="Strasbourg" href="" coords="697,470,26" shape="circle">
    <area id="9" class="areaclick" target="" alt="Belfort" title="Belfort" href="" coords="633,559,27" shape="circle">
    <area id="4" class="areaclick" target="" alt="Besançon" title="Besançon" href="" coords="401,669,26" shape="circle">
</map>
</div>
<?php
 

for($i=1; $i<=12;$i++){
  $sites = listesites($i);
 ?>
  
  <div class="modal fade" id="<?php echo $sites[0]["Libelle"];?>" tabindex="-1" aria-labelledby="sitelabel" aria-hidden="true">
    <div class="modal-dialog modal-sm-4 modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title" id="sitelabel">Liste des quartiers - <?php echo $sites[0]["Libelle"]?></h5>
                    <form action="/export" method="post" id="formexport<?php echo $i?>">
                      <input type="hidden" name="data" value=<?php echo $i?>>
                    </form>
                    <button onsubmit="event.preventDefault()" form="formexport<?php echo $i?>" id=<?php echo $i?> type="submit" class="export btn border-white text-white col-auto" style="
                      padding: .5rem .5rem;
                      margin: -.5rem -.5rem -.5rem auto;">Exporter</button>
                    <button type="button" class="btn-close bg-white" onclick= "$('#<?php echo $sites[0]['Libelle']?>').modal('toggle');" ></button>
                </div>
          <div class="modal-body"><ul>
          <?php foreach ($sites as $site) {
            echo '<li class="list-group-item"><a class="listsite" href="/quartiers?trigramme='.$site["Trigramme"].'">' .$site["Trigramme"]. ' - ' .$site["Nom"]. '</a></li>';
          }?>
          </ul></div>
      </div>
    </div>
  </div>
  <?php
}?>




<?php $contenu = ob_get_clean();
$js = "<script src='Ressources/js/accueil.js'></script>";
require('template.php');?>

