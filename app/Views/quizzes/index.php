
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- Page content-->
    <div class="container-fluid main" id="app">
        <h2 class="font-weight-bold mt-5 text-center col-12">
            SCRUD(Search, Create, Update, Read, Delete)
        </h2> 
        <div class="row mb-4 pb-2 mx-1 border-bottom">            
            <p class="p-0 col-2 col-lg-1">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                    Descripción
                </button>
            </p>
            <div style="min-height: 20px;" class="mb-2">
                <div class="collapse" id="collapseWidthExample">
                    <div class="card card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <p class="lead">Listado, detalles, busqueda, eliminación, creación y edición de registros.</p>
                            </li>
                            <li class="list-group-item">
                                <h6 class="lead">Listado:</h6>
                                <ul>
                                    <li>Paginación simple(previo, siguiente) y completa.</li>
                                    <li>Selección del número de registros a ver, 20 por default.</li>
                                    <li>Ordenado por Asc/Desc.</li>
                                    <li>Ocultar/mostrar campo.</li>
                                    <li>Función de refrescar para regresar al inicio del listado después de una búsqueda.</li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <p class="lead">Búsqueda por campo simple o múltiple, paginación incluida.</p>
                            </li>                            
                            <li class="list-group-item">
                                <p class="lead">Creación, edición y eliminación de registros.</p>
                                <ul>
                                    <li>Validación de datos en cada campo.</li>
                                    <li>Seguridad web(XSS, CSRF, inyección SQL).</li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <p class="lead">Diseño front-end con elementos Bootstrap: collapse, cards, tablas, tooltips, modales, iconos, simple sidebar, paginación, grid, SASS.</p>
                            </li>                           
                            <li class="list-group-item">
                                <p class="lead">Diseño y creación backend con herramientas de Codeigniter como:</p>
                                <ul>
                                    <li>Presenter (funcionalidad diseñada para interacción del programador para usarse con el navegador web)  consumo con HTTP o AJAX.</li>
                                    <li>Resource (diseñado como rutas API (endpoints) para ser conmsumido por un API client como cURL, Guzzle, fetch, etc), con o sin JWT.</li>
                                    <li>Migraciones y seeders (con fake) para Base de datos.</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>            
            <!-- <button type="button" class="btn btn-primary col-2 offset-lg-11 col-lg-1 justify-content-end" id="btn-add-action" data-bs-toggle="modal" data-bs-target="#save">
                <div data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="left" title="" data-bs-title="<em>Añadir Acción</em> <u>with</u> <b>HTML</b>">
                    <i class="bi bi-plus-lg"></i>
                </div>
            </button> -->
            <a href="<?= base_url('quizzes/new') ?>" class="btn btn-primary col offset-lg-11 col-lg-1 justify-content-end" id="btn-add-action">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>        
        <div class="card shadow mb-4">
                             
            <div class="card-header py-3">                
                <div class="row controls">        
                    <div class="col-4 col-lg-1 limit">       
                        <select class="form-select" aria-label="Quizzes" id="limit-quizzes" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-title="Selecciona cantidad de registros a mostrar">            
                            <option value="20">20</option>            
                            <option value="50">50</option>            
                            <option value="100">100</option>          
                        </select>       
                    </div>
                    <div class="col-8 col-lg-2 offset-lg-3">
                        <?= $pager->simplelinks('default') ?> 
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
                            <?php foreach ($quizzes as $quiz): ?>
                                <tr>
                                    <td><?= $quiz['quiz_id'] ?></td>
                                    <td><?= $quiz['quiz_name'] ?></td>
                                    <td><?= $quiz['quiz_description'] ?></td>
                                    <td><?= $quiz['created_at'] ?></td>
                                    <td><?= $quiz['updated_at'] ?></td>
                                    
                                    <td class="text-center">
                                        <div class="d-grid gap-2 d-md-block">
                                            <a href="<?= base_url('quizzes/' . $quiz['quiz_id'] . '/edit') ?>" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-action" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-url="<?= base_url('quizzes/' . $quiz['quiz_id']) ?>">
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
                    <?= $pager->links('default') ?>
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
                let url = "<?= base_url('quizzes/search/') ?>" + $('#keywords').val();
                console.log(url);
                window.location.href = url;
            });
            $(document).on('click', '#btn-refresh', function(e){
                let url = "<?= base_url('quizzes/') ?>";
                window.location.href = url;
            });
       });
    </script>
<?= $this->endSection() ?>