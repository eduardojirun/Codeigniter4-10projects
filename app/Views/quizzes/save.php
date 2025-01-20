<?= $this->extend('template') ?>

<?= $this->section('contenido') ?>

<h3 class="my-3">Nueva encuesta</h3>

<?php if (session()->getFlashdata('error') !== null) { ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php } ?>

<form action="<?= base_url('quizzes') ?><?= (isset( $quiz['quiz_id'] ) ) ? '/'.$quiz['quiz_id'] : '' ?>" class="row g-3" method="post" autocomplete="off">

    <?php if ( isset($quiz) ): ?>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="quiz_id" value="<?= $quiz['quiz_id'] ?>">
    <?php endif ?>   

    <div class="col-md-4">
        <label for="quiz_name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="quiz_name" name="quiz_name" value="<?= set_value('quiz_name', (isset($quiz['quiz_name'])) ? $quiz['quiz_name'] : '' ) ?>" required autofocus>
    </div>

    <div class="col-md-8">
        <label for="quiz_description" class="form-label">Descripción</label>
        <input type="text" class="form-control" id="quiz_description" name="quiz_description" value="<?= ( isset($quiz) ) ? $quiz['quiz_description'] : set_value("quiz_description") ?>" required>
    </div>

    <div class="col-12">
        <a href="<?= base_url('quizzes') ?>" class="btn btn-secondary">Regresar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>

<?= $this->endSection() ?>