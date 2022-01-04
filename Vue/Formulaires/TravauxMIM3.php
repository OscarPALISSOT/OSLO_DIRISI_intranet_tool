<div class="modal fade" id="travaux_mim_<?php 
        if (isset($_GET["Id8_trv_mim"]) ){
            echo 'edit'.$_GET["Id8_trv_mim"];
            $status = 1;
        } else {
            echo 'add';
            $status = 0;
    }?>" tabindex="-1" aria-labelledby="ModalTrvLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 id="ModalTrvLabel" class="text-center model-title text-info">  Travaux </h5>
                <button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="container">
                            <form class="formTravaux">
							
                            <div class="modal-body">
							<input type="hidden" name="identification" value="0">
							<input type="hidden" name="script" value="<?php echo $status?>">
                            <?php 
                                if($status){
                                        echo '<input name="fIdtrv" type ="hidden" value="'.$_GET["Id8_trv_mim"].'">';
                                } 
                                    ?>
                               
                            <span class="erreurs" id="erreursTrv0"></span>
							
							<br>
                            <div class="row">
                            <label for="fId" class="col-5"><span>Master ID</span></label>
							<?php if(!$status){?>
                            <select class="form_control col"  name="fId">
							<option></option>
								<?php 
								
										foreach($listeTrvMim3 as $liste1){
											echo '<option value="'.$liste1["Id_mim"].'">'.$liste1['Master_ID'].'</option>';
										} 
									
								
								?>
                            </select>
							<?php } else {

                                echo "<select class='form_control col'  name='fId'><option value=".$_GET["Id_mim"].">".$_GET["Master_ID"]."</option></select>";

							}?>
							</div>

							
                                                       
                            <br>
                            <div class="row">
                            <label for="fDate" class="col-5"><span>Date de la demande:</span></label>
                            <input type="date" class="col-4 form_control"  name="fDate" value="<?php
                            if($status){
                                    echo $_GET['Date'];
                            }?>">
                            												
                            </div>

                            

                            <br>
                            <div class="row">
                            <label for="fDebit" class="col-5"><span>Débit:</span></label>
                            <input type=number step=".01" min=0 name="fDebit" class="col-4 form_control" value="<?php
                            if($status){
                                    echo $_GET['Debit'];
                            }?>"><span class="col-auto">Mb/s</span>
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
                            <select class="col form_control" name="fEtat">

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

<script>
	var formTrv = $('.formTravaux');
	    $.each(formTrv, function(){
        var $this = $(this);

        $this.submit(function(event){
            
            var formData = {
                'fId'              : $this.find('select[name=fId]').val(),
                'fIdtrv'              : $this.find('input[name=fIdtrv]').val(),
                'fDate'              : $this.find('input[name=fDate]').val(),
                'fDebit'              : $this.find('input[name=fDebit]').val(),
                'fDebit_futur'              : $this.find('input[name=fDebit_futur]').val(),
                'fEtat'              : $this.find('select[name=fEtat]').val(),
				'identification'              : $this.find('input[name=identification]').val(),
				'script'              : $this.find('input[name=script]').val()
            };
            $('#erreursTrv'+formData['identification']).html('');
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : '../Modèle/scripts/script_Travaux.php', // the url where we want to POST
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true
            })
                // using the done promise callback
                .done(function(data) {
                    console.log(data);       
                    if(data["success"]){
                        window.location.href = data["loadpage"] ;
                    } else {
                        $.each(data["errors"], function(index, value){
                            $this.find('#erreursTrv').append(value);
                        })
                    }
                    
                });
                event.preventDefault();
        })
    })
</script>