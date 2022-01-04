<div class="modal fade" id="travaux_opera_<?php 
        if (isset($_GET["Id_trv_opera"])){
            echo 'edit'.$_GET["Id_trv_opera"];
            $status = 1;
        } else {
            echo 'add';
            $status = 0;
        }
?>" tabindex="-1" aria-labelledby="ModalTrvLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 id="ModalTrvLabel" class="text-center model-title text-info">  Travaux </h5>
                <button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="container">
                            <form class="formTravaux">
							
                            <div class="modal-body">
							<input type="hidden" name="identification" value="1">
							<input type="hidden" name="script" value="<?php echo $status?>">
                            <?php 
                                if($status){
                                        echo '<input name="fIdtrv" type ="hidden" value="'.$_GET["Id_trv_opera"].'">';
                                } 
                                    ?>
                               
                                   

                            <span class="erreurs" id="erreursTrv1"></span>
							
							<br>
                            <div class="row">
                            <label for="fId" class="col-5"><span>Numero Access</span></label>
							<?php if(!$status){?>
                            <select class="form_control col"  name="fId">
								<?php 
									
										foreach($listeTrvOpera as $liste2){
											echo '<option value="'.$liste2["Id_opera"].'">'.$liste2['Id_access'].'</option>';
										} 
									
								
								?>
                            </select>
							<?php } else {
								
                               echo "<select type='hidden' class='form_control col'  name='fId'><option>".$_GET["Id_access"]."</option></select>";
							}?>
							</div>
							
                                                       
                            <br>
                            <div class="row">
                            <label for="fDate" class="col-5"><span>Date de la demande:</span></label>
                            <input type="date" class="col form_control"  name="fDate" value="<?php if($status){
                                    echo $_GET['Date'];
                            }?>">  											
                            </div>

                            

                            <br>
                            <div class="row">
                            <label for="fDebit" class="col-5"><span>Débit:</span></label>
                            <input type=number step=".01" min=0 name="fDebit" class="col form_control" value="<?php
                            if($status){
                                    echo $_GET['Debit'];
                            }?>"><span class="col-auto">Mb/s</span>
                            </div>

                            <br>
                            <div class="row">
                            <label for="fTrigramme" class="col-5"><span>Trigramme:</span></label>
                            <input class="col form_control"  name="fTrigramme" value="<?php if($status){
                                    echo $_GET['Trigramme'];
                            }?>">  											
                            </div>

                            <br>
                            <div class="row">
                            <label for="fDebit_futur" class="col-5"><span>Débit futur:</span></label>
                            <input  type=number step=".01" min=0 name="fDebit_futur" class="col form_control" value="<?php
                            if($status){
                                    echo $_GET['Debit_futur'];
                            } ?>"><span class="col-auto">Mb/s</span>
                            </div>

                            <br>
                            <div class="row">
                            <label for="fEtat" class="col-5"><span>Etat: </span></label>
                            <select class="col" name="fEtat">

                            <?php if($status){
                               switch($_GET["Etat"]){
                                case 0;
                                echo '<option value="Prévu">Prévu</option>
                                <option selected value="Fini">Fini</option>';
                                break;

                                case 1;
                                echo '<option selected value="Prévu">Prévu</option>
                                <option value="Fini">Fini</option>';
                                break;

                                default:
                                echo '<option value="Prévu">Prévu</option>
                                <option value="Fini">Fini</option>';
                                break;
                            }
                            } else {echo '
                                <option selected value=""></option>
                                <option value="Prévu">Prévu</option>
                                <option value="Fini">Fini</option>';}?>
                                  
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