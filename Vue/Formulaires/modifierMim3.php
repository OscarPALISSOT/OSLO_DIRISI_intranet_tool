<?php parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $query); ?>
<div class="modal fade" id="edit_mim3<?php echo $_GET["Id_mim"]?>" tabindex="-1" aria-labelledby="ModalModifMimLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 id="ModalModifMimLabel" class="text-center model-title text-info"> Modification MIM3 </h5>
<button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="container">
                            <form  method="post" action="Vue/scripts/script_modifiermim.php" autocomplete="off">
                            <div class="modal-body">
                           
                            <input id="fId_mim" name="Id_mim" type ="hidden" class="col" value="<?php echo $_GET["Id_mim"]?>">
                          
                            <br>
                            <div class="row">
                            <label for="fMasterID" class="col-auto"><p>Master ID: </p></label>
                            <input name="fMasterID" class="col" value="<?php echo $_GET['Master_ID']; ?>">
                            </div>


                            <br>
                            <div class="row">
                            <label for="fType" class="col-auto"><p>Type: </p></label>
                            <select class="col" id="fType" name="Type">
                            <?php 
                                switch($_GET["Type"]){
                                    case 'Fibre';
                                    echo '<option selected>Fibre</option>
                                    <option>Cuivre</option>
                                    <option>4G</option>
                                    <option>Autre</option>';
                                    break;

                                    case 'Cuivre';
                                    echo '<option>Fibre</option>
                                    <option selected>Cuivre</option>
                                     <option>4G</option>
                                    <option>Autre</option>';
                                    break;

                                    case '4G';
                                    echo '<option>Fibre</option>
                                    <option>Cuivre</option>
                                    <option selected>4G</option>
                                    <option>Autre</option>';
                                    break;

                                    case 'Autre';
                                    echo '<option>Fibre</option>
                                    <option>Cuivre</option>
                                     <option>4G</option>
                                    <option selected>Autre</option>';
                                    break;

                                    default:
                                    echo '<option selected></option>
                                    <option>Fibre</option>
                                    <option>Cuivre</option>
                                     <option>4G</option>
                                    <option>Autre</option>';
                                    break;
                                }
                            ?>
                            </select>
																		
                            </div>
                            
                          <br>
                            <div class="row">
                            <label for="fDebit" class="col-auto"><p>Débit: </p></label>
                            <input name="fDebit" class="col" value="<?php echo $_GET['Debit']; ?>">
                            </div>
							
                            <br>
                            <div class="row">
                            <label for="fDebitFinale" class="col-auto"><p>Débit Final: </p></label>
                            <input name="fDebitFinale" class="col" value="<?php echo $_GET['Debit_final']; ?>">
                            </div>
							
							<br>
                            <div class="row">
                            <label for="IpPfs" class="col-auto"><p>IP PFS: </p></label>
                            <input name="IpPfs" class="col" value="<?php echo $_GET['IP_PFS']; ?>">
                            </div> 
							
							 <br>
                            <div class="row">
                            <label for="fIpLanSubnet" class="col-auto"><p>ID LAN SUBNET: </p></label>
                            <input name="fIpLanSubnet" class="col" value="<?php echo $_GET['IP_LAN_SUBNET']; ?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fTrigramme" class="col-auto"><p>Trigramme: </p></label>
                            <input name="fTrigramme" class="col" value="<?php echo $_GET['Trigramme']; ?>">
                            </div>

							<br>
                            <div class="row">
                            <label for="fOrganisme" class="col-auto"><p>Organisme: </p></label>
                            <input name="fOrganisme" class="col" value="<?php echo $_GET['Organisme']; ?>">
                            </div>
                            
                            <br>
                            <div class="row">
                            <label for="fDateValidation" class="col-auto"><p>Date de Validation: </p></label>
                            <input name="fDateValidation" class="col" value="<?php echo $_GET['Date_de_validation']; ?>">
                            </div>

							<br>
                            <div class="row">
                            <label for="fEtat" class="col-4"><span>Etat: </span></label>
                            <select class="col form_control" name="fEtat">
                                    <option value="Actif" selected>Active</option>
                                    <option value="Inactif">Commande en cours</option>
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