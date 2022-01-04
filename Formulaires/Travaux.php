<?php $identification=null; // 0 mim 1 opera
$status = null; //0 ajout 1 modification

if(isset($_GET["Master_ID"])){
    $identification=0;
} else if (isset($_GET["Id_access"])){
    $identification=1;
}?>  

<div class="modal fade" id="travaux_<?php 
    if(isset($identification) && $identification){
        if (isset($_GET["Id_trv_opera"])){
            echo 'edit'.$_GET["Id_trv_opera"];
            $status = 1;
        } else {
            echo 'opera_add';
            $status = 0;
        }
    } else if (isset($identification) && !$identification) {
        if (isset($_GET["Id8_trv_mim"]) && $_GET["Id_mim"]==$_GET["Id_mim"]){
            echo 'edit'.$_GET["Id8_trv_mim"];
            $status = 1;
        } else {
            echo 'mim_add';
            $status = 0;
        } 
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
                            <?php 
                                if(isset($identification) && $identification){
                                    $fId = $_GET["Id_opera"];
                                    echo '<input name="fId" type ="hidden" value="'.$_GET["Id_opera"].'">';
                                    if ($status && $_GET["Id_opera"] == $fId){
                                        echo '<input name="fIdtrv" type ="hidden" value="'.$_GET["Id_trv_opera"].'">';
                                    }
                                } else if(isset($identification) && !$identification){
                                    $fId = $_GET["Id_mim"];
                                    echo '<input name="fId" type ="hidden" value="'.$_GET["Id_mim"].'">
                                          <input name="forganisme" type ="hidden" value="'.$_GET["Id_organisme"].'">';
                                    if ($status && $_GET["Id_mim"] == $fId){
                                        echo '<input name="fIdtrv" type ="hidden" value="'.$_GET["Id8_trv_mim"].'">';
                                    }
                                } else {
                                    ?>
                                <br>
                            <div class="row">
                            <label for="fId" class="col-5"><span>N°ACCESS:</span></label>
                            <input name="fId" class="col form_control" value="">
                            </div>
                                    <?php
                                }
                            ?>

                            <span class="erreurs" id="erreursTrv"></span>

                            <br>
                            <div class="row">
                            <label for="fTrigramme" class="col-5"><span>Trigramme:</span></label>
                            <input class="col form_control"  name="fTrigramme" value="<?php
                            if($status && isset($identification) && $identification){
                                if($_GET["Id_opera"] == $_GET["Id_opera"]){
                                    echo $_GET['Trigramme'];
                                }
                            } else if($status && isset($identification) && !$identification){
                                if($_GET["Id_mim"] == $_GET["Id_mim"]){
                                    echo $_GET['Trigramme'];
                                }
                            }?>">
                            												
                            </div>
                                                       
                            <br>
                            <div class="row">
                            <label for="fDate" class="col-5"><span>Date de la demande:</span></label>
                            <input type="date" class="col form_control"  name="fDate" value="<?php
                            if($status && isset($identification) && $identification){
                                if($_GET["Id_opera"] == $_GET["Id_opera"]){
                                    echo $_GET['Date'];
                                }
                            } else if($status && isset($identification) && !$identification){
                                if($_GET["Id_mim"] == $_GET["Id_mim"]){
                                    echo $_GET['Date'];
                                }
                            }?>">
                            												
                            </div>

                            

                            <br>
                            <div class="row">
                            <label for="fDebit" class="col-5"><span>Débit:</span></label>
                            <input type=number step=".01" min=0 name="fDebit" class="col form_control" value="<?php
                            if($status && isset($identification)){
                                    echo $_GET['Debit'];
                            }?>"><span class="col-auto">Mb/s</span>
                            </div>

                            <br>
                            <div class="row">
                            <label for="fDebit_futur" class="col-5"><span>Débit futur:</span></label>
                            <input  type=number step=".01" min=0 name="fDebit_futur" class="col form_control" value="<?php
                            if($status && isset($identification)){
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