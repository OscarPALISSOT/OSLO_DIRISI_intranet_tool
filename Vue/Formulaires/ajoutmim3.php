
<div class="modal fade" id="add_mim3" tabindex="-1" aria-labelledby="ModalAddMimLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 id="ModalAddMimLabel" class="text-center model-title text-info"> Ajout MIM3 </h5>
<button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="container">
                            <form  method="post" action="Vue/scripts/script_AjoutMim.php" autocomplete="off">
                            <div class="modal-body">
                         
                            <br>
                            <div class="row">
                            <label for="MasterID" class="col-auto"><p>Master ID: </p></label>
                            <input name="MasterID" class="col form_control">
                            </div>

                            <br>
                            <div class="row">
                            <label for="Type" class="col-auto"><p>Type: </p></label>
                            <select class="col" id="Type" name="Type">
                            <option selected></option>
                                    <option>Fibre</option>
                                    <option>Cuivre</option>
                                     <option>4G</option>
                                    <option>Autre</option>
                            </select>
																		
                            </div>
                            
                            <br>
                            <div class="row">
                            <label for="Debit" class="col-auto"><p>Débit: </p></label>
                            <input name="Debit" class="col form_control">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fDebitFinale" class="col-auto"><p>Débit Final: </p></label>
                            <input name="fDebitFinale" class="col form_control">
                            </div>
							
                            <br>
                            <div class="row">
                            <label for="IpPfs" class="col-auto"><p>IP PFS: </p></label>
                            <input name="IpPfs" class="col form_control">
                            </div>


                            <br>
                            <div class="row">
                            <label for="IpLanSubnet" class="col-auto"><p>ID LAN SUBNET: </p></label>
                            <input name="IpLanSubnet" class="col form_control" >
                            </div>



							 <br>
                            <div class="row">
                            <label for="Trigramme" class="col-auto"><p>Trigramme: </p></label>
                            <input name="Trigramme" class="col form_control">
                            </div>
							

							<br>
                            <div class="row">
                            <label for="fOrganisme" class="col-5"><span>Organisme</span></label>
                            <select class="form_control col"  name="fOrganisme">
							<option></option>
								<?php 
								
										foreach($selorganismes as $liste1){
											echo '<option value="'.$liste1["Id_organisme"].'">'.$liste1['Nom'].'</option>';
										} 
									
								
								?>

                            
							
                            </select>
							</div>
					
							<br>
                            <div class="row">
                            <label for="fDateValidation" class="col-auto"><p>Date de Validation: </p></label>
                            <input name="fDateValidation" class="col form_control">
                            </div>
							
							<br>
                            <div class="row">
                            <label for="etat" class="col-auto"><p>Etat: </p></label>
                            <select class="col form_control" name="etat">
                            <option selected></option>
                                    <option>Actif</option>
                                    <option>Commande en cours</option>
                                     
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
                        
                        </div>
                        

               
 </div>
</div>