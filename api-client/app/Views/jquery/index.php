
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- Page content-->
    <div class="container-fluid main" id="app">
        <h3 class="font-weight-bold mt-5 text-center col-12">
           API con Codeigniter 4 y consumida con jQuery
        </h3>
        <ul class="list-group mb-4 col-4 offset-4">
            <li class="list-group-item"><b>GET: </b>list, id, query params: search, sort, limit, order_by, start</li>
            <li class="list-group-item"><b>POST:</b> creación de recurso</li>
            <li class="list-group-item"><b>PUT:</b> edición completa de recurso</li>
            <li class="list-group-item"><b>PATCH:</b> edición de recurso, cambiar status</li>
            <li class="list-group-item"><b>DELETE:</b> eliminar recurso</li>
        </ul>
        <div class="row mb-4 pb-2 mx-1 border-bottom">
            <button type="button" class="btn btn-primary col offset-lg-11 col-lg-1 justify-content-end" data-bs-toggle="modal" data-bs-target="#save-book" id="btn-show-modal">
                <i class="bi bi-plus-lg"></i>
            </button>
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
                                <th scope="col">Estatus</th>
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
        const apiUrl = 'http://localhost/ci4/Codeigniter4-10projects/api-resource/api/books'; // Cambia esta URL según tu API

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
                // console.log( response );
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

        // Render
        function render( data, pager, total, limit )
        {
            $("#list-books").empty();
            let tr = '';
            $.each( data, function( index, book ) {  
                let status = '';
                let status_text = 'agotado';
                if ( parseInt(book.book_status) === 1 ) {
                    status = 'checked';
                    status_text = 'disponible';
                }
                tr += `<tr>
                        <td class="book-id" id="${book.book_id}">${book.book_id}</td>
                        <td class="book-name">${book.book_name}</td>
                        <td class="book-status">
                            <div class="form-check form-switch">
                                <input class="change-status-book form-check-input" type="checkbox" role="switch" id="status-switch" ${status} value="${book.book_id}">
                                <label class="form-check-label" for="status-switch">${status_text}</label>
                            </div>
                        </td>
                        <td class="book-description">${book.book_description}</td>`;
                let authors = '<ul>';
                $.each( book.authors, function( index, author ) {
                    // console.log(author);
                    authors += `<li>${author.author_name}, </li>`;
                });
                authors += '</ul>';

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
            });
            $("#list-books").append( tr );
        }

        // delete book
        $('#list-books').on('click', '.btn-delete', function() {
            const bookId = $(this).data('book_id');
            // Confirmación antes de eliminar
            if (confirm('¿Estás seguro de que deseas eliminar este book?')) {
                $.ajax({
                    url: `${apiUrl}/${bookId}`,
                    method: 'DELETE',
                    success: function() {
                        alert('book eliminado correctamente');
                        loadBooks();
                    },
                    error: function() {
                        alert('Error al eliminar el book');
                    }
                });
            }
        });

        $(document).on('click', '#btn-show-modal', function () {
            $('#save-book #form-book #_method').val('POST');
            $('#section-authors').show();
        });

        // post book
        $(document).on('click', '#btn-save-book', function() {
            let form = $('#form-book');
            let names_form = [];
            // You need to use standard javascript object here
            var form_data = new FormData( form[0] );            
            //form_data.append('photo', $('input[type=file]')[0].files[0]);

            $( $(form).serializeArray() ).each(function(index, value) {                
                names_form.push( value.name );
            });
            //names_form.push( 'photo' );
            console.log( 'names form', names_form );
            console.log(form_data);
            let method = $('#save-book #form-book #_method').val();
            let id = '';
            let headersjquery;
            let contentTypeJquery = false;
            let processDataJquery = false;
            if (method === 'PUT') {
                id = '/' + $('#save-book #form-book #book_id').val();
                headersjquery = {
                    'Content-type': 'application/x-www-form-urlencoded',
                    'Content-Type': 'application/json'
                };
                contentTypeJquery = 'application/x-www-form-urlencoded; charset=utf-8';
                form_data = {
                    'book_name': $('#save-book #form-book #book_name').val(),
                    'book_description': $('#save-book #form-book #book_description').val(),
                };
                processDataJquery = true;
            }
            $.ajax({
                url: apiUrl + id,
                type: method,
                dataType: 'json',
                data: form_data,
                processData: processDataJquery,
                contentType: contentTypeJquery,
                headers: headersjquery 
            })
            .done(function(response, textStatus, jqXH) {
                console.log( 'success' );
                console.log( 'response', response ); 
                console.log( 'textStatus', textStatus); 
                console.log( 'jqXH', jqXH);                
                if ( textStatus === 'success' ) {
                    // Toast
                    const toastLiveExample = document.getElementById('liveToast')
                    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                    toastBootstrap.show()

                    $('#form-book').trigger( 'reset' );
                    $( '#save-book' ).modal( 'hide' );
                    loadBooks();
                }            
            })
            .fail(function(response) {
                console.log("error");
                console.log( response.responseJSON );
                if ( response.status == 422 ) {
                    let messages = response.responseJSON.messages;
                    for ( let i = 0; i < names_form.length; i++ ) {
                        if ( messages ) {                        
                            /* $( '#warn_'+names_form[i] ).removeClass('has-success').addClass('has-error');
                            $( '#warn_'+names_form[i]+' p' ).removeClass('d-none').text( messages[names_form[i]] ); */

                            let msgString = '';
                            $.each(messages, function (indexInArray, valueOfElement) { 
                                msgString += `<p class="help-block text-danger"> ${valueOfElement} </p>`;
                            });

                            $( '#warns' ).removeClass('d-none').html( msgString );
                        } else {
                            $( '#warn_'+names_form[i] ).removeClass('has-error').addClass('has-success');
                            $( '#warn_'+messages[i]+' p' ).text('');
                        }
                    }
                }
            })
            .always(function() {
                console.log("complete");
            });            
        });

        // put book
        $(document).on('click', '.edit-book', function() {
            let bookId = $(this).val();
            $('#save-book #form-book #_method').val('PUT');
            $.ajax({
                url: `${apiUrl}/${bookId}`,
                type: 'GET'
            })
            .done(function(response) {
                console.log( 'success' );
                console.log( response );
                if ( response.status && response.data ) {                    
                    $('#section-authors').hide();
                    let book = response.data;
                    let item = 'book';
                    modal = '#save-' + item;
                    form = '#form-' + item;
                    $( form, modal ).trigger( 'reset' );
                    $( '.form-group' ).removeClass('has-success has-error');
                    $( 'p.help-block' ).text('').addClass('d-none');
                    $( modal + ' .modal-header h3' ).html( 'Editar book id:<b>' + bookId + '</b>' );
                    $.each(book, function (indexInArray, valueOfElement) { 
                        console.log(modal + ' ' + form + ' #' + indexInArray );
                        $( modal + ' ' + form + ' #' + indexInArray ).val(valueOfElement);
                        console.log(indexInArray, ':', valueOfElement);
                    });
                    const myModal = new bootstrap.Modal(document.getElementById('save-book')).show();
                }            
            })
            .fail(function(response) {
                console.log("error");
                
            })
            .always(function() {
                console.log("complete");
            });
            
        });

        // patch book
        $(document).on('click', '.change-status-book', function() {
            let bookId = $(this).val();
            let status_val = 0;
            if( $(this).prop('checked') ) {
                status_val = 1;
            } else {
                status_val = 0;
            }

            let headersjquery = {
                'Content-type': 'application/x-www-form-urlencoded',
                'Content-Type': 'application/json'
            };
            let contentTypeJquery = 'application/x-www-form-urlencoded; charset=utf-8';
            let form_data = {
                'book_status' : status_val
            };
            let processDataJquery = true;

            $.ajax({
                url: `${apiUrl}/${bookId}`,
                type: 'PATCH',
                dataType: 'json',
                data: form_data,
                processData: processDataJquery,
                contentType: contentTypeJquery,
                headers: headersjquery 
            })
            .done(function(response, textStatus, jqXH) {
                console.log( 'success' );
                console.log( 'response', response ); 
                console.log( 'textStatus', textStatus); 
                console.log( 'jqXH', jqXH);                
                if ( textStatus === 'success' ) {
                    loadBooks();
                }            
            })
            .fail(function(response) {
                console.log("error");                
            })
            .always(function() {
                console.log("complete");
            });            
        });

        loadBooks();
    });
</script>
<?= $this->endSection() ?>