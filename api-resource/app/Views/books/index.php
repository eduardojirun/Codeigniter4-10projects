
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
                            <option value="">20</option>
                            <option value="">50</option>            
                            <option value="">100</option>          
                        </select>       
                    </div>
                    <div class="col-8 col-lg-2 offset-lg-3">
                        <!-- <?php // = $pager->only(['search', 'sort', 'limit', 'order_by', 'start'])->simplelinks('default') ?>  -->
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
                                <th scope="col">Titulo</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Autores</th>
                                <th scope="col">creación</th>
                                <th scope="col">actualización</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>                                
                        <tbody id="list-books">
                           
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
                            Mostrando <b>0</b> a <b><?php //= $limit ?></b> de un total de <b><?php // = $total ?></b> registros
                        </p>
                    </div>
                    <div id="actions-pagination" class="col items-pagination">
                    <?php // = $pager->links('default') ?>
                    <?php // = $pager->only(['search', 'sort', 'limit', 'order_by', 'start'])->links('default') ?>
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
       $(document).ready(function() {
    // URL de la API REST de libros (reemplaza con la URL correcta)
    const apiUrl = 'http://localhost/ci4/Codeigniter4-10projects/api-resource/api/books/'; // Cambia esta URL según tu API

    // Obtener y mostrar los libros
    function loadBooks()
    {
        $.ajax({
            url: apiUrl,
            type: 'GET',
            dataType: 'json',
        })
        .done(function( response ) {
            console.log('success');
            console.log( response );
            render( 
                response.books,
                response.pager,
                response.total,
                response.limit
            );
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }

    function render( data, pager, total, limit )
    {
        $("#list-books").empty();
        let tr = '';
        $.each( data, function( index, book ) {

            tr += `<tr>
                    <td class="book-id" id="${book.book_id}">${book.book_id}</td>
                    <td class="book-name">${book.book_name}</td>
                    <td class="book-description">${book.book_description}</td>`;

            let authors = '<ul>';
            $.each( book.authors, function( index, author ) {
                console.log(author);
                authors += `<li>${author.author_name}, </li>`;
            });
            authors += '<ul>';
            tr += `<td class="book-authors">${authors}</td>
            <td class="book-created_at">${book.created_at}</td>
            <td class="book-updated_at">${book.updated_at}</td>`;  
            
            tr += `<td class="text-center">
                        <div class="d-grid gap-2 d-md-block">
                            <button type="button" class="btn btn-outline-primary edit-book" value="${book.book_id}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <button type="button" class="btn btn-outline-danger btn-sm btn-delete" data-book_id="${book.book_id}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>                        
                    </td>`;
            $("#list-books").append( tr );            
        });
    }

    loadBooks();

     // Eliminar libro
    $('#list-books').on('click', '.btn-delete', function() {
        const bookId = $(this).data('book_id');
        // Confirmación antes de eliminar
        if (confirm('¿Estás seguro de que deseas eliminar este libro?')) {
            $.ajax({
                url: `${apiUrl}/${bookId}`,
                method: 'DELETE',
                success: function() {
                    alert('Libro eliminado correctamente');
                    loadBooks();
                },
                error: function() {
                    alert('Error al eliminar el libro');
                }
            });

            $.ajax({
                url: `${apiUrl}/${bookId}`,
                method: 'DELETE'
            })
            .done(function( response ) {
                console.log("success");
                console.log(response);
                if ( response.status === 'success' ) {
                    csrf['csrf_hdi'] = response.hash;
                    Swal.fire({
                      position: 'center',
                      type: 'success',
                      title: 'El registro ha sido eliminado',
                      showConfirmButton: false,
                      timer: 1000,
                    });
                    keywords = $('#keywords-actions').val();
                    if ( keywords != '' ) {
                        load_table_search( params );
                    } else {                        
                        console.log(params);
                        load_table(params);
                    }
                                     
                }                
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        }
    });

});


    </script>
<?= $this->endSection() ?>