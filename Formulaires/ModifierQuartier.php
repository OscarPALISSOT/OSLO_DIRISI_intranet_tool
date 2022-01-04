<div class="modal fade" id="<?php echo "edit".$donnees1["Trigramme"]?>"  tabindex="-1" aria-labelledby="ModalModifQuartiersLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 id="ModalModifQuartiersLabel" class="text-center model-title text-info"> Modification des infos du quartier </h5>
<button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="container">
                            <form  method="post" action="Vue/scripts/script_modifquartier.php" autocomplete="off" id="edit_quartier">
                            <div class="modal-body">
                            <input id="fTrigramme" name="fTrigramme" type ="hidden" value="<?php echo $donnees1["Trigramme"]?>">
                            

                            <div class="row">
                            <label for="fNom" class="col-auto"><span>Nom:</span></label>
                            <input id="fNom" name="fNom" class="col " value="<?php echo $donnees1['Nom']?>">
                            </div>
                            
                            <br>
                            <div class="row">
                            <label for="fAdresse" class="col-auto"><span>Description:</span></label>
                            <textarea rows="3" cols="50" class="form_control" name="fAdresse" form="edit_quartier"><?php echo $donnees1['Adresse']?></textarea>
                            </div>

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