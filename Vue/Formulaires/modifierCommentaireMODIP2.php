<div class="modal fade" id=<?php echo "edit".$val['Id_modip_actifs']?> tabindex="-1" aria-labelledby="ModalModifBnrLabel"  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 id="ModalModifBnrLabel" class="text-center model-title text-info"> Modification Commentaire MODIP ACTIFS </h5>
<button type="button" class="close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
<div class="container modal-body">
                            <form  method="post" action="Vue/scripts/script_commentaireMODIP2.php" autocomplete="off" id="edit<?php echo $val["Id_modip_actifs"] ?>">
                            <div class="modal-body">
                            <input  name="fID" type ="hidden" value="<?php echo $val["Id_modip_actifs"]?>">
                            
                            
                            <br>
                            <div class="row">
                            <label for="fCommentaire" class="col-auto"><span>Commentaire</span></label>
                            <textarea rows="3" cols="50" class="form_control" name="fCommentaire" value="edit"><?php echo $val['Commentaire1']?></textarea>												
                            </div>

                           

                            <br>
                            </div>
<div class="modal-footer">
        <button type="submit" class="btn btn-primary">Valider</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
                            </form>
                        </div>
                        
                        </div></div></div>
                        

                
                            
           