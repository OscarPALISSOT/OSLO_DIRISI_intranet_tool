<div class="modal fade" id="<?php echo "edit-bnr".$_GET["ID"]?>" tabindex="-1" aria-labelledby="ModalModifBnrLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 id="ModalModifBnrLabel" class="text-center model-title text-info"> Modification BNR </h5>
<button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
<div class="container modal-body">
                            <form  method="post" action="Vue/scripts/script_modifierbnr.php" autocomplete="off" id="edit-bnr<?php echo $_GET["ID"] ?>">
                            <div class="modal-body">
                            <input  name="fId" type ="hidden" value="<?php echo $_GET["ID"]?>">
                            
                            
                            <!--<br>
                            <div class="row">
                            <label for="fNature" class="col-auto"><span>Nature</span></label>
                            <input class="col form_control"  name="fNature" value="<?php echo $_GET['Nature']?>">													
                            </div>

                            <br>
                            <div class="row">
                            <label for="fZone" class="col-auto"><span>Zone</span></label>
                            <input class="col form_control" name="fZone" value="<?php echo $_GET['Zone']?>">													
                            </div>

                            <br>
                            <div class="row">
                            <label for="fAsap" class="col"><span>N° ASAP</span></label>
                            <input class="col form_control" name="fAsap" value="<?php echo $_GET['N_ASAP']?>">												
                            </div>      
                            
                            <br>
                            <div class="row">
                            <label for="fService" class="col"><span>N° SERVICE du PDC</span></label>
                            <input class="col form_control" name="fService" value="<?php echo $_GET['N_SERVICE_du_PDC']?>">												
                            </div>
                            
                            <br>
                            <div class="row">
                            <label for="fRang" class="col"><span>N° RANG</span></label>
                            <input class="col form_control" name="fRang" value="<?php echo $_GET['N_RANG']?>">												
                            </div>-->

                            <br>
                            <div class="row">
                            <label for="fPriorisation" class="col"><span>Priorisation</span></label>
                            <input class="col form_control" name="fPriorisation" value="<?php echo $_GET['Priorisation']?>">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fBénéficaire" class="col"><span>Bénéficiaire</span></label>
                            <input class="col form_control" name="fBénéficiaire" value="<?php echo $_GET['Bénéficiaire']?>">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fBDDImpliquée" class="col"><span>BDD Impliquée</span></label>
                            <input class="col form_control" name="fBDDImpliquée" value="<?php echo $_GET['BDD_Impliquée']?>">												
                            </div>

                            <!--<br>
                            <div class="row">
                            <label for="fDescription" class="col"><span>Description service</span></label>
                            <input class="col form_control" name="fDescription" value="<?php echo $_GET['Description_Service']?>">												
                            </div>-->

                            <br>
                            <div class="row">
                            <label for="fObjectifs" class="col"><span>Objectifs et description fonctionnelle</span></label>
                            <input class="col form_control" name="fObjectifs" value="<?php echo $_GET['Objectifs_et_description_fonctionnelle']?>">												
                            </div>


                            <br>
                            <div class="row">
                            <label for="fFEB" class="col-auto"><span>Montant FEB:</span></label>
                            <input  type=number min=0 name="fFEB" class="col" value="<?php echo $_GET['Montant_FEB']?>"><span class="col-auto">€</span>
                            </div>

                            <br>
                            <div class="row">
                            <label for="fDemande" class="col"><span>Date de la demande</span></label>
                            <input class="col form_control" name="fDemande" value="<?php echo $_GET['Date_de_la_demande']?>">												
                            </div>


                            <br>
                            <div class="row">
                            <label for="fEcheance" class="col"><span>Echeance Souhaitée</span></label>
                            <input class="col form_control" name="fEcheance" value="<?php echo $_GET['Echeance_souhaitée']?>">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fSituation" class="col"><span>Point de situation</span></label>
                            <textarea rows="3" cols="50" class="form_control" name="fSituation" form="edit_quartier"><?php echo $_GET['Point_de_situation']?></textarea>											
                            </div>

                            <br>
                            <div class="row">
                            <label for="fTrigramme" class="col"><span>Trigramme</span></label>
                            <input class="col form_control" name="fTrigramme" value="<?php echo $_GET['Trigramme']?>">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fOrganisme" class="col"><span>Organisme</span></label>
                            <input class="col form_control" name="fOrganisme" value="<?php echo $_GET['Nom']?>">												
                            </div>

                            <!--<br>
                            <div class="row">
                            <label for="fChef" class="col"><span>Chef de projet</span></label>
                            <input class="col form_control" name="fChef" value="<?php echo $_GET['(J/H)_Chef_de_projet']?>">												
                            </div>

                            <br>
                            <div class="row">
                            <label for="fTechnicien" class="col"><span>Technicien</span></label>
                            <input class="col form_control" name="fTechnicien" value="<?php echo $_GET['(J/H)_Technicien']?>">												
                            </div>-->

                            <br>
                            <div class="row">
                            <label for="fEtat" class="col-auto"><span>Etat: </span></label>
                            <select class="col form_control " name="fEtat">
                                    <option value="Actif" selected>Actif</option>
                                    <option value="Inactif">Inactif</option>
                            </select>
                            </div>

                            <br>
                            </div>
<div class="modal-footer">
        <button type="submit" class="btn btn-primary">Valider</button>
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
                            </form>
                        </div>
                        
                        </div></div></div>
                        

                
                            
           