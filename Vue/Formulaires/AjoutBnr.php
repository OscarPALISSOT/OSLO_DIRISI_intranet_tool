<div class="modal fade" id="add_bnr" tabindex="-1" aria-labelledby="ModalAjoutBnrLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 id="ModalAjoutBnrLabel" class="text-center model-title text-info"> Ajout BNR </h5>
<button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="container">

                            <form  id="addbnr" method="post" action="Vue/scripts/script_ajoutbnr.php" autocomplete="off">
                            <div class="modal-body">
							
                           <br>
                             <div class="row">
                            <label for="fEtat" class="col-4"><span>Etat: </span></label>
                            <select class="col form_control" name="fEtat">
                                    <option value="Prevus">Prévu</option>
                                    <option value="Finis">Fini</option>
                            </select>
                            </div>
							
							
							              <br>
                            <div class="row">
                            <label for="fNature" class="col-auto"><span>Nature</span></label>
                            <input class="col form_control"  name="fNature">													
                            </div>

                            <br>
                            <div class="row">
                            <label for="fZone" class="col-auto"><span>Zone</span></label>
                            <input class="col form_control" name="fZone">													
                            </div>

                            <br>
                            <div class="row">
                            <label for="fAsap" class="col"><span>N° ASAP</span></label>
                            <input class="col form_control" name="fAsap">												
                            </div>
                            
                            <br>
                            <div class="row">
                            <label for="fService" class="col"><span>N° SERVICE du PDC</span></label>
                            <input class="col form_control" name="fService">												
                            </div>
                            
                            <br>
                            <div class="row">
                            <label for="fRang" class="col"><span>N° RANG</span></label>
                            <input class="col form_control" name="fRang">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fPriorisation" class="col"><span>Priorisation</span></label>
                            <input class="col form_control" name="fPriorisation">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fBénéficaire" class="col"><span>Bénéficiaire</span></label>
                            <input class="col form_control" name="fBénéficiaire">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fBDDImpliquée" class="col"><span>BDD Impliquée</span></label>
                            <input class="col form_control" name="fBDDImpliquée">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fDescription" class="col"><span>Description service</span></label>
                            <input class="col form_control" name="fDescription">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fObjectifs" class="col"><span>Objectifs et description fonctionnelle</span></label>
                            <input class="col form_control" name="fObjectifs">												
                            </div>


                            <br>
                            <div class="row">
                            <label for="fFEB" class="col-auto"><span>Montant FEB:</span></label>
                            <input  type=number min=0 name="fFEB" class="col"><span class="col-auto">€</span>
                            </div>

                            <br>
                            <div class="row">
                            <label for="fDTS" class="col-auto"><span>Date retour DTS</span></label>
                            <input class="col"  name="fDTS">													
                            </div>

                            <br>
                            <div class="row">
                            <label for="fSituation" class="col"><span>Point de situation</span></label>
                            <input class="col form_control" name="fSituation">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fChef" class="col"><span>Chef de projet</span></label>
                            <input class="col form_control" name="fChef">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fTechnicien" class="col"><span>Technicien</span></label>
                            <input class="col form_control" name="fTechnicien">												
                            </div>

                            <br>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Valider</button>
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
                            </form>
                        </div>
                        
                        </div>
                        

               
 </div>
</div>

<script>
	var x = $(".disp1");
	var y = $(".disp2");
	$("select[name='fEtat']").change(function(){
		if(x.is(":visible")) {
			y.css("display", "inline");
			x.css("display", "none");
		} else {
			x.css("display", "inline");
			y.css("display", "none");
		}
	})
</script>