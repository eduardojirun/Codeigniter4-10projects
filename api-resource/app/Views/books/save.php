<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- Page content-->
    <div class="container-fluid main" id="app">
        <h3 class="my-3 text-center">Nuevo Libro</h3>
        <?php if (session()->getFlashdata('error') !== null) { ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php } ?>

        <form action="<?= base_url('books') ?><?= isset( $book['book_id'] ) ? '/update/'.$book['book_id'] : '' ?>" class="row g-3" method="post" autocomplete="off">

            <?php if ( isset($book) ): ?>
                <!-- <input type="hidden" name="_method" value="PUT"> -->
                <input type="hidden" name="quiz_id" value="">
            <?php endif ?>   

            <div class="col-md-4 offset-md-4">
                <label for="book_name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="book_name" name="book_name" value="<?= set_value('book_name', (isset($book['book_name'])) ? $book['book_name'] : '' ) ?>" required autofocus>
            </div>

            <div class="col-md-6 offset-3">
                <label for="book_description" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="book_description" name="book_description" value="<?= set_value('book_description', (isset($book['book_description'])) ? $book['book_description'] : '' ) ?>" required>
            </div>

            <div class="col-2 offset-7">
                <a href="<?= base_url('books') ?>" class="btn btn-secondary">Regresar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>    
    </div>
        <!-- Partial Ci -->
    <?= $this->include('layouts/modals') ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->endSection() ?>