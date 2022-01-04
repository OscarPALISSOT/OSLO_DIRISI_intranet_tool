<div class="modal fade" id="<?php echo "edit_modipfini".$_GET["ID"]?>"  tabindex="-1" aria-labelledby="ModalModifModipLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header">
<h5 id="ModalModifModipLabel" class="text-center model-title text-info"> Modification MODIP finis</h5>
<button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="container">
                            <form  method="post" action="Vue/scripts/script_modifierModipFini.php" autocomplete="off" id="modip_edit<?php echo $_GET["ID"]; ?>">
                            <div class="modal-body">
                            <input name="fTrigramme" type ="hidden" value="<?php echo $_GET["Trigramme"]?>">
                            <input name="fID" type ="hidden" value="<?php echo $_GET["ID"]?>">
                            

                            <br>
                            <div class="row">
                            <label for="fnumerodeclic" class="col-6"><span>Numéro DECLIC:</span></label>
                            <input name="fnumerodeclic" class="col-6 form_control" value="<?php echo $_GET['Numero_DECLIC']?>">
                            </div>

                            <div class="invisible1">
                            <br>
                            <div class="row">
                            <label for="fDL" class="col-6"><span>Classement DL</span></label>
                            <input name="fDL" class="col-6 form_control" value="<?php echo $_GET["Classement_DL"]?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fPrioriteDeclic" class="col-6"><span>Priorité DECLIC</span></label>
                            <input name="fPrioriteDeclic" class="col-6 form_control" value="<?php echo $_GET["Priorite_DECLIC"]?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fSite" class="col-6"><span>Site:</span></label>
                            <input name="fSite" class="col-6 form_control" value="<?php echo $_GET['Site']?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fTrigramme" class="col-6"><span>Trigramme:</span></label>
                            <input name="fTrigramme" class="col-6 form_control" value="<?php echo $_GET['Trigramme']?>">
                            </div>


                            <br>
                            <div class="row">
                            <label for="fClassificationSite" class="col-6"><span>Classification site</span></label>
                            <input name="fClassificationSite" class="col-6 form_control" value="<?php echo $_GET['Classification_Site']?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fclients" class="col-6"><span> Clients</span></label>
                            <input name="fclients" class="col-6 form_control" value="<?php echo $_GET['clients']?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fClassificationOperation" class="col-6"><span>Classification opération</span></label>
                            <input name="fClassificationOperation" class="col-6 form_control" value="<?php echo $_GET['Classification_Operation']?>">
                            </div>


                            <br>
                            <div class="row">
                            <label for="fCout" class="col-6"><span>Coût: </span></label>
                            <input type="number" step="0.01" name="fCout" class="col form_control" value="<?php echo $_GET['Cout']?>"><span class="col-auto">€</span>
                            </div>

                            <br>
                            <div class="row">
                            <label for="fDescription" class="col-6"><span>Description:</span></label>
                            <textarea rows="4" cols="50" class="form_control" name="fDescription" form="modip_add"><?php echo $_GET['Description']?></textarea>
                            </div>

                            <br>
                            <div class="row">
                            <label for="fCategorie" class="col-6"><span>Catégorie</span></label>
                            <input name="fCategorie" class="col-6 form_control" value="<?php echo $_GET['Categorie']?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fType" class="col-4"><span>Type </span></label>
                            <select class="col form_control" name="fType">
                            <?php 
                                switch($_GET["Type"]){
                                    case 'CS';
                                    echo '<option></option>
                                    <option selected>CS</option>
                                    <option>ND</option>
                                    <option>UG</option>';
                                    break;

                                  
                                     case 'ND';
                                    echo '<option></option>
                                    <option>CS</option>
                                    <<option selected>ND</option>
                                    <option>UG</option>
                                    ';
                                    break;

                                    case 'UG';
                                    echo '<option></option>
                                    <option>CS</option>
                                    <<option>ND</option>
                                    <option selected>UG</option>
                                    ';
                                    break;

                                  
                                    default:
                                    echo '<option selected></option>
                                    <option value="CS">CS</option>
                                    <option value="ND">ND</option>
                                    <option value="UG">UG</option>';
                                    break;
                                }
                            ?>

                            <br>
                            <div class="row">
                            <label for="fRenoAvant" class="col-6"><span>Reno Avant</span></label>
                            <input name="fRenoAvant" class="col-6 form_control" value="<?php echo $_GET['reno_avant']?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fRenoApres" class="col-6"><span>Catégorie</span></label>
                            <input name="fRenoApres" class="col-6 form_control" value="<?php echo $_GET['reno_apres']?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fCoeurAvant" class="col-6"><span>Annee Coeur Avant Travaux</span></label>
                            <input name="fCoeurAvant" class="col-6 form_control" value="<?php echo $_GET['Annee_Coeur_av_tvx']?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fAnneeCoeur" class="col-6"><span>Annee Reno Coeur</span></label>
                            <input name="fAnneeCoeur" class="col-6 form_control" value="<?php echo $_GET['Annee_reno_coeur']?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fAnnee" class="col-6"><span>Année</span></label>
                            <input name="fAnnee" class="col-6 form_control" value="<?php echo $_GET['Annee']?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fSemestre" class="col-6"><span>Semestre</span></label>
                            <input name="fSemestre" class="col-6 form_control" value="<?php echo $_GET['Semestre']?>">
                            </div>
                            <br>
                            </select>
                            </div>
                            <br>
                
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