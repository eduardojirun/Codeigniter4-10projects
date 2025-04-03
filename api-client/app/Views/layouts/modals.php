<!-- Modal add -->    
<div class="modal fade" id="save-book" tabindex="-1" aria-labelledby="save-book" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="save-book">Guardar Book</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-book" class="form" autocomplete="off">                    
                    <div id="warns"></div>
                    <input type="hidden" name="_method" value="" id="_method">
                    <input type="hidden" name="book_id" value="" id="book_id">                            
                    <div class="form-group" id="warn_book_name">                
                        <label for="book_name">Nombre libro</label>                
                        <input type="text" name="book_name" class="form-control" id="book_name">                
                        <p class="help-block text-danger"></p>              
                    </div>                
                    <div class="form-group" id="warn_book_description">                
                        <label for="book_description">Descripción libro</label>                
                        <textarea name="book_description" id="book_description" class="form-control" rows="5"></textarea>                
                        <p class="help-block text-danger"></p>              
                    </div>
                    <div id="section-authors">
                        <div class="form-group" id="warn_authors.0.author_name">                
                            <label for="authors.0.author_name">Nombre author</label>                
                            <input type="text" name="authors[0][author_name]" class="form-control" id="authors.0.author_name">                
                            <p class="help-block text-danger"></p>              
                        </div>                
                        <div class="form-group" id="warn_author_bio">                
                            <label for="author_bio">Biografía</label>                
                            <textarea name="authors[0][author_bio]" class="form-control" rows="5"></textarea>                
                            <p class="help-block text-danger"></p>              
                        </div> 
                    </div>
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="btn-save-book">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <form id="form-delete" book="" method="post">
                    <!-- <input type="hidden" name="_method" value="DELETE"> -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <!-- <img src="..." class="rounded me-2" alt="..."> -->
      <strong class="me-auto">Api Book</strong>
      <small>Ahora mismo</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Los datos se guardaron correctamente
    </div>
  </div>
</div>