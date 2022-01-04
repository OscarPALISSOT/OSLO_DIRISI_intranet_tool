<?php parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $query); ?>
<div class="modal fade" id="edit_mim3<?php echo $donnees["Id_mim"]?>" tabindex="-1" aria-labelledby="ModalModifMimLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 id="ModalModifMimLabel" class="text-center model-title text-info"> Modification MIM3 </h5>
<button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="container">
                            <form  method="post" action="Vue/scripts/script_modifiermim.php" autocomplete="off">
                            <div class="modal-body">
                            <input id="Id_organisme" name="Id_organisme" type ="hidden" class="col" value="<?php echo $organisme?>">
                            <input id="Id_mim" name="Id_mim" type ="hidden" class="col" value="<?php echo $donnees["Id_mim"]?>">
                            <input id="fquery" name="fquery" type ="hidden" value="<?php echo $query['trigramme']?>">
                            
                            <br>
                            <div class="row">
                            <label for="Type" class="col-auto"><p>Type: </p></label>
                            <select class="col" id="Type" name="Type">
                            <?php 
                                switch($donnees["Type"]){
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
                            <label for="Debit" class="col-auto"><p>Débit: </p></label>
                            <input id="Debit" name="Debit" class="col" value="<?php echo $donnees['Debit']?>">
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