<div class="modal fade" id="opera_<?php if(isset($_GET["Id_opera"])){echo $_GET["Id_opera"];}?>" tabindex="-1" aria-labelledby="OperaLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">

<div class="modal-header">
<h5 id="OperaLabel" class="text-center model-title text-info"> OPERA </h5>
<button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="container">
                            <form class="formOpera">
                            <div class="modal-body">
                            
                            <?php if(isset($_GET["Id_opera"])){
                                echo '<input  name="fId_opera" type ="hidden" value="'.$_GET["Id_opera"].'">';
                            }?>
                            
                            <span class="erreurs" id="erreurs"></span>

                            <br>
                            <div class="row">
                            <label for="faccess" class="col-5"><span>N°ACCESS:</span></label>
                            <input name="faccess" class="col form_control" value="<?php if(isset($_GET['Id_access'])){ echo $_GET['Id_access'];}?>">
                            </div>
                            
                            <br>
                            <div class="row">
                            <label for="fTrigramme" class="col-5"><span>Trigramme:</span></label>
                            <input name="fTrigramme" class="col form_control" value="<?php if(isset($_GET["Trigramme"])){echo $_GET["Trigramme"];}?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fOrganisme" class="col-5"><span>Nom quartier:</span></label>
                            <input name="fOrganisme" class="col form_control" value="<?php if(isset($_GET["Nom_Quartier"])){echo $_GET["Nom_Quartier"];}?>">
                            </div>

                            <br>
                            <div class="row">
                            <label for="fType" class="col-5"><span>Type:</span></label>
                            <select class="col form_control" name="fType">
                            <?php if(isset($_GET["Type"])){
                                switch($_GET["Type"]){
                                    case 'Fibre';
                                    echo '<option selected value="Fibre">Fibre</option>
                                    <option value="Cuivre">Cuivre</option>';
                                    break;

                                    case 'Cuivre';
                                    echo '<option value="Fibre">Fibre</option>
                                    <option selected value="Cuivre">Cuivre</option>';
                                    break;

                                    default:
                                    echo '<option value="Fibre">Fibre</option>
                                    <option value="Cuivre">Cuivre</option>';
                                    break;
                                }
                            } else {
                                echo '<option selected value=""></option>
                                <option value="Fibre">Fibre</option>
                                <option value="Cuivre">Cuivre</option>';
                            }
                            ?>
                            </select>
																		
                            </div>
                            
                            <br>
                            <div class="row">
                            <label for="fDebit" class="col-5"><span>Débit:</span></label>
                            <input min=0 type="number" name="fDebit" class="col form_control" value="<?php if(isset($_GET['Debit'])){ echo $_GET['Debit'];}?>"><span class="col-auto">Mb/s</span>
                            </div>

                            <br>
                            <div class="row">
                            <label for="fEtat" class="col-5"><span>Etat: </span></label>
                            <select class="col form_control" name="fEtat">
                                    <option value="Actif" selected>Actif</option>
                                    <option value="Inactif">Inactif</option>
                            </select>
                            </div>

                            <br>
                            </div>
<div class="modal-footer">
        <button type="submit" href="" class="btn btn-primary">Valider</button>
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
      </div>
                            </form>
                        </div>
                        
                        </div>
                        

               
 </div>
</div>