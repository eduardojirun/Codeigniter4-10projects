<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API REST CRUD de Libros</title>

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="public/css/styles.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
</head>
<body>

<!-- Contenedor principal -->
<div class="container mt-5">
  <h1 class="text-center">CRUD de Libros</h1>

  <!-- Formulario para Agregar o Editar un Libro -->
  <form id="book-form">
    <div class="mb-3">
      <label for="title" class="form-label">Título</label>
      <input type="text" class="form-control" id="title" placeholder="Ingrese el título">
    </div>
    <div class="mb-3">
      <label for="author" class="form-label">Autor</label>
      <input type="text" class="form-control" id="author" placeholder="Ingrese el autor">
    </div>
    <div class="mb-3">
      <label for="genre" class="form-label">Género</label>
      <input type="text" class="form-control" id="genre" placeholder="Ingrese el género">
    </div>
    <button type="submit" class="btn btn-primary">Agregar Libro</button>
  </form>

  <hr>

  <!-- Tabla para Mostrar los Libros -->
  <table class="table table-bordered mt-3">
    <thead>
      <tr>
        <th>#</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Autores</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="list-books">
      <!-- Aquí se mostrarán los libros -->
    </tbody>
  </table>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // URL de la API REST de libros (reemplaza con la URL correcta)
    const apiUrl = 'http://localhost/ci4/Codeigniter4-10projects/api-resource/curl-client'; // Cambia esta URL según tu API

    // Obtener y mostrar los libros
    function loadBooks()
    {
        $.ajax({
            url: apiUrl,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
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
            tr += `<td class="book-authors">${authors}</td>`;  
            
            tr += `<td class="text-center">
                        <div class="d-grid gap-2 d-md-block">
                            <button type="button" class="btn btn-outline-primary edit-book" value="${book.book_id}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger delete-book" value="${book.book_id}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>                        
                    </td>`;

                      

            $("#list-books").append( tr );            
        });
    }

    loadBooks();
});




</script>

</body>
</html>
