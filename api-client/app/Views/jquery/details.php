<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- Page content-->
    <div class="container-fluid main" id="app">
        <h2 class="text-center mt-5">Detalles de Libro</h2>
        <ul class="list-group row">
            <li class="list-group-item col-lg-4 offset-lg-4"><span class="fw-bold">Id:</span> <?= $book['book_id'] ?></li>
            <li class="list-group-item col-lg-4 offset-lg-4"><span class="fw-bold">Título:</span> <?= $book['book_name'] ?></li>
            <li class="list-group-item col-lg-4 offset-lg-4"><span class="fw-bold">Descripción:</span> <?= $book['book_description'] ?></li>
            <li class="list-group-item col-lg-4 offset-lg-4"><span class="fw-bold">Fecha de registro:</span> <?= $book['created_at'] ?></li>
            <li class="list-group-item col-lg-4 offset-lg-4"><span class="fw-bold">Fechas de actualización:</span> <?= $book['updated_at'] ?></li>
        </ul>
        <div class="row mt-3">
            <a href="<?= base_url('books') ?>" class="btn btn-secondary col-4 col-lg-2 offset-lg-4">Regresar</a>
        </div>
    </div>
        <!-- Partial Ci -->
    <?= $this->include('layouts/modals') ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script>
       
    </script>
<?= $this->endSection() ?>