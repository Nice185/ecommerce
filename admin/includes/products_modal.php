<!-- Description -->
<div class="modal fade" id="description">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body">
                <p id="desc"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Ajouter nouvel article</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="products_add.php" enctype="multipart/form-data">
                <div class="form-group">

                <label for="codeArt" class="col-sm-1 control-label">Code Article</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="codeArt" name="codeArt" required>
                  </div>

                  <label for="libelArt" class="col-sm-1 control-label">Libellé</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="libelArt" name="libelArt" required>
                  </div>
                  </div>
                  <div class="form-group">
                  <label for="sous_famille" class="col-sm-1 control-label">Categorie</label>
                  
                  <div class="col-sm-5">
                    <select class="form-control" id="sous_famille" name="sous_famille" required>
                      <option value="" selected>- Selectionner -</option>
                    </select>
                    </div>
                 <label for="price" class="col-sm-1 control-label">Prix</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="price" name="price" required>
                   </div>
                   </div>

                  <div class="form-group">
                      <label for="photo" class="col-sm-1 control-label">Photo</label>

                   <div class="col-sm-5">
                    <input type="file" id="photo" name="photo">
                   </div>
                 
                 <label for="description" class="col-sm-1 control-label">Description</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="description" name="description" required>
                  </div>
                  </div>  
                   </div>
                   <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Enregistrer</button>
              
              
                  </div>
           
              
            </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="products_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="prodid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Mise à jour</button>
              </form>
            </div>
        </div>
    </div>
</div>