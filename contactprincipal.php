<?php $titre= "Contact";?>
<?php $css ="<style>body{overflow:hidden}</style>";?>
<?php ob_start(); ?>
<STYLE type="text/css">
.brc{position: absolute; top: 100px; left: 600px;}
.mim3{position: absolute; top: 100px; left: 140px;}
.accueil{color:grey};
ul.div{display: inline;  color:grey; position:absolute; top:108px; }
.tab-content{position: absolute; top: 150px; left: 350px;}
</STYLE>

  
<div class="d-flex align-items-start ">
<!-- Nav tabs -->
<ul class="sidenav nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="bnrprevus-tab" data-bs-toggle="tab" href="#bnrprevus" role="tab" aria-controls="fbnrprevus" aria-selected="true">CONTACT OPERA ET MIM3</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link " id="bnrfinis-tab" data-bs-toggle="tab" href="#bnrfinis" role="tab" aria-controls="fbnrfinis" aria-selected="true">CONTACT BRC</a>
  </li>
  
</ul>
<div id="filAriane" class="vingt" itemscope="" itemtype="">
				<ul>
						<a class="accueil" href="/contactprincipal" itemprop=""> Contact </a>
			  	</ul>
			</div>
<div class="tab-content col-lg" style="overflow-y:auto">

<div class="tab-pane active" id="bnrprevus" role="tabpanel" aria-labelledby="bnrprevus-tab">
    <div class="mx-auto flex-column col-form-label-lg">
             <div class="btn-group-vertical" role="group" aria-label="Groupe de boutons en colonne"><strong>CIRISI</strong>
                <a class="btn btn-secondary" href="/contactLille?Cirisi=Lille" role="button">CIRISI LILLE</a><br>
                <a class="btn btn-secondary" href="/contactMetz?Cirisi=Montigny-les-Metz"  role="button">CIRISI MONTIGNY</a><br>
                <a class="btn btn-secondary" href="/contactNancy?Cirisi=Nancy" role="button">CIRISI NANCY</a><br>
                <a class="btn btn-secondary" href="/contactStrasbourg?Cirisi=Strasbourg" role="button">CIRISI STRASBOURG</a><br>
                <a class="btn btn-secondary" href="/contactBesancon?Cirisi=Besançon" role="button">CIRISI BESANCON</a><br>
                <a class="btn btn-secondary" href="/contactMourmelon?Cirisi=Mourmelon" role="button">CIRISI MOURMELON</a><br>
                <a class="btn btn-secondary" href="/contactDizier?Cirisi=Saint-Dizier" role="button">CIRISI ST DIZIER</a><br>
                <a class="btn btn-secondary" href="/contactMetzDirisi?Cirisi=Metz" role="button">DIRISI METZ</a><br>
    </div>
    
      
<br>
<br>
      </div>      
      
      </div>

<div class="tab-pane" id="bnrfinis" role="tabpanel" aria-labelledby="bnrfinis-tab">
    <div class="btn-group-vertical" role="group" aria-label="Groupe de boutons en colonne"><strong>BdD</strong>
                <a class="btn btn-secondary" href="/BelfortBdD?BdD=Belfort" role="button">BELFORT</a><br>
                <a class="btn btn-secondary" href="/BesanconBdD?BdD=Besançon"  role="button">BESANCON</a><br>
                <a class="btn btn-secondary" href="/CharlevilleBdD?BdD=Charleville" role="button">CHARLEVILLE</a><br>
                <a class="btn btn-secondary" href="/LilleBdD?BdD=Lille" role="button">LILLE</a><br>
                <a class="btn btn-secondary" href="/LuxeuilBdD?BdD=Luxeuil" role="button">LUXEUIL</a><br>
                <a class="btn btn-secondary" href="/MetzBdD?BdD=Metz" role="button">METZ</a><br>
                <a class="btn btn-secondary" href="/MourmelonBdD?BdD=Mourmelon" role="button">MOURMELON</a><br>
                <a class="btn btn-secondary" href="/NancyBdD?BdD=Nancy" role="button">NANCY</a><br>
                <a class="btn btn-secondary" href="/PhalsbourgBdD?BdD=Phalsbourg" role="button">PHALSBOURG</a><br>
                <a class="btn btn-secondary" href="/StrasbourgBdD?BdD=Strabsourg" role="button">STRASBOURG</a><br>
                <a class="btn btn-secondary" href="/DizierBdD?BdD=Saint-Dizier" role="button">SAINT DIZIER</a><br>
                <a class="btn btn-secondary" href="/VerdunBdD?BdD=Verdun" role="button">VERDUN</a>
    </div>
    <div class="btn-group-vertical" role="group" aria-label="Groupe de boutons en colonne"><strong>CIRISI</strong>
                <a class="btn btn-primary" href="/LilleBNR?Cirisi=Lille" role="button">CIRISI LILLE</a>
                <br>
                <br>
                <a class="btn btn-primary" href="/MetzBNR?Cirisi=Metz"  role="button">CIRISI METZ</a>
                <br>
                <br>
                <a class="btn btn-primary" href="/NancyBNR?Cirisi=Nancy" role="button">CIRISI NANCY</a>
                <br>
                <br>
                <a class="btn btn-primary" href="/StrasbourgBNR?Cirisi=Strasbourg" role="button">CIRISI STRASBOURG</a>
                <br>
                <br>
                <a class="btn btn-primary" href="/BesanconBNR?Cirisi=Besançon" role="button">CIRISI BESANCON</a>
                <br>
                <br>
                <a class="btn btn-primary" href="/MourmelonBNR?Cirisi=Mourmelon" role="button">CIRISI MOURMELON</a>
                <br>
                <br>
                <a class="btn btn-primary" href="/DizierBNR?Cirisi=Saint-Dizier" role="button">CIRISI SAINT-DIZIER</a>
    </div>
    <div class="btn-group-vertical"role="group" aria-label="Groupe de boutons en colonne"><strong>ADS</strong>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=DIRISI" role="button">DIRISI</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=Marine"  role="button">MARINE</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=DGA" role="button">DGA</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=OIA" role="button">OIA</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=Rattaché SGA" role="button">RATTACHE SGA</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=EMA" role="button">EMA</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=SEA/DRSD" role="button">SEA/DRSD</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=AAE" role="button">AAE</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=SCA/CICoS/DGGN" role="button">SCA/CICoS/DGGN</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=SSA" role="button">SSA</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=SGA" role="button">SGA</a><br>
                <a class="btn btn-danger" href="/contactADS?Enseigne=CHARGE_DE_COMPTE&ADS=Terre/DGSE/CRRE" role="button">Terre/DGSE/CRRE</a><br>
    </div>
    </div>
<br>
<br>

      </div>
      
</div>




</div>
<br>
<br>

<?php $contenu = ob_get_clean(); ?>
<?php $js ="";
 require('template.php'); ?>
