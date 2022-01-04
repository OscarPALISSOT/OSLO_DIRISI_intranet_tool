<div class="modal fade" id="<?php echo "edit".$query["Cirisi"] .$query["Enseigne"]?>"  tabindex="-1" aria-labelledby="ModalModifQuartiersLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 id="ModalModifQuartiersLabel" class="text-center model-title text-info"> Modification des infos des contacts </h5>
<button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="container">
                            <form  method="post" action="Vue/scripts/script_modifiercontactLille.php" autocomplete="off" id="edit_contact">
                            <div class="modal-body">
                            
                            
                            <input id="fID" name="fID" type="hidden" value="<?php echo $donnees['ID']?>">

                            <div class="row">
                            <label for="fNom" class="col-auto"><span>Nom:</span></label>
                            <input id="fNom" name="fNom" class="col " value="<?php echo $donnees['Nom']?>">
                            </div>

                            <div class="row">
                            <label for="fPrénom" class="col-auto"><span>Prénom:</span></label>
                            <input id="fPrénom" name="fPrénom" class="col " value="<?php echo $donnees['Prénom']?>">
                            </div>

                            <div class="row">
                            <label for="fEmail" class="col-auto"><span>Email:</span></label>
                            <input id="fEmail" name="fEmail" class="col " value="<?php echo $donnees['Email']?>">
                            </div>

                            <div class="row">
                            <label for="fTPH" class="col-auto"><span>Téléphone:</span></label>
                            <input id="fTPH" name="fTPH" class="col " value="<?php echo $donnees['TPH']?>">
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