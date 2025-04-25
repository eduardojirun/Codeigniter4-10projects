
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- Page content-->
    <div class="container-fluid main" id="app">
        <h2 class="font-weight-bold mt-5 text-center col-12">
            SCRUD(Search, Create, Update, Read, Delete)
        </h2> 
        <div class="row mb-4 pb-2 mx-1 border-bottom">
            <a href="<?= base_url('books/new') ?>" class="btn btn-primary col offset-lg-11 col-lg-1 justify-content-end" id="btn-add-action">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>        
        <div class="card shadow mb-4">
                             
            <div class="card-header py-3">                
                <div class="row controls">        
                    <div class="col-4 col-lg-1 limit">       
                        <select class="form-select" aria-label="books" id="limit-books" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-title="Selecciona cantidad de registros a mostrar" onChange="window.location.href=this.value">
                            <option value="<?= base_url('books?limit=20') ?>" <?= ( isset($_GET['limit']) && $_GET['limit'] == '20' ) ? 'selected' : '' ?> >20</option>
                            <option value="<?= base_url('books?limit=50') ?>" <?= ( isset($_GET['limit']) && $_GET['limit'] == '50' ) ? 'selected' : '' ?> >50</option>            
                            <option value="<?= base_url('books?limit=100') ?>" <?= ( isset($_GET['limit']) && $_GET['limit'] == '100' ) ? 'selected' : '' ?>>100</option>          
                        </select>       
                    </div>
                    <div class="col-8 col-lg-2 offset-lg-3">
                        <?= $pager->only(['search', 'sort', 'limit', 'order_by', 'start'])->simplelinks('default') ?> 
                    </div>    
                    <div class="col-2 col-lg-1 offset-lg-2 buttons">              
                        <button type="button" class="btn btn-primary btn-md btn-refresh" id="btn-refresh" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-title="Refrescar">        
                            <i class="bi bi-arrow-clockwise"></i>       
                        </button>        
                    </div>        
                    <div class="col-10 col-lg-3 search">         
                        <div class="input-group mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="" id="search" data-bs-title="Buscará por nombre y descripción">
                            <input type="text" id="keywords" name="keywords" class="form-control" placeholder="Buscar" value="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="bi bi-search" id="btn-search"></i>
                                </div>        
                            </div>          
                        </div>      
                    </div>       
                </div><!-- /.controls -->            
            </div><!-- /.card-header -->

            <div class="card-body">         
                <div class="table-responsive">              
                    <table class="table table-bordered table-hover table-striped" id="table-actions">                              
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">creación</th>
                                <th scope="col">actualización</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>                                
                        <tbody>
                            <?php foreach ($books as $book): ?>
                                <tr>
                                    <td><?= $book['book_id'] ?></td>
                                    <td>
                                        <a href="<?= base_url('books/show/'.$book['book_id']) ?>">
                                            <?= $book['book_name'] ?>
                                        </a>
                                    </td>
                                    <td><?= $book['book_description'] ?></td>
                                    <td><?= $book['created_at'] ?></td>
                                    <td><?= $book['updated_at'] ?></td>
                                    
                                    <td class="text-center">
                                        <div class="d-grid gap-2 d-md-block">
                                            <a href="<?= base_url('books/edit/' . $book['book_id'] . '') ?>" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-action" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-url="<?= base_url('books/delete/' . $book['book_id']) ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>                                    
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>                 
                            <tr></tr>                                     
                        </tfoot>
                    </table>            
                </div> <!-- /.table-responsive -->         
            </div><!-- /.card-body -->        
                    
            <div class="card-footer">           
                <div class="row">
                    <div class="col description-pagination">
                        <p id="total-actions">
                            Mostrando <b>0</b> a <b><?= $limit ?></b> de un total de <b><?= $total ?></b> registros
                        </p>
                    </div>
                    <div id="actions-pagination" class="col items-pagination">
                    <?php // = $pager->links('default') ?>
                    <?= $pager->only(['search', 'sort', 'limit', 'order_by', 'start'])->links('default') ?>
                    </div>                           
                </div>   
            </div><!-- /.card-footer -->

        </div><!-- /.card -->

    </div><!-- /.container-fluid -->
    
    <!-- Partial Ci -->
    <?= $this->include('layouts/modals') ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script>
        const deleteModal = document.getElementById('deleteModal')
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const url = button.getAttribute('data-bs-url')

                // Update the modal's content.
                const form = deleteModal.querySelector('#form-delete')
                form.setAttribute('action', url)
            })
        }
    </script>
    <script>
       $(document).ready(function () {
            $('.pagination li').addClass('page-item');
            $('.pagination li a').addClass('page-link');

            $('.pager').addClass('pagination');
            $('.pager li').addClass('page-item');
            $('.pager li a').addClass('page-link');

            $('.pagination').addClass('justify-content-end');

            // Apopende keywiord t uurl
            $(document).on('click', '#btn-search', function(e){
                let url = "<?= base_url('books?search=') ?>" + $('#keywords').val();                
                window.location.href = url;
            });
            $(document).on('click', '#btn-refresh', function(e){
                let url = "<?= base_url('books/') ?>";
                window.location.href = url;
            });
       });
    </script>
<?= $this->endSection() ?>