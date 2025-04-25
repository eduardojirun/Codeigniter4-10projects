<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- Page content-->
    <div class="container-fluid main" id="app">
        <h2 class="font-weight-bold mt-5 text-center col-12">
            Form Validation
        </h2> 
               
        <div class="card shadow mb-4 row">
                             
            <div class="card-header py-3">                
                <div class="row controls">        
                    
                              
                </div><!-- /.controls -->            
            </div><!-- /.card-header -->

            <div class="card-body">                      
                <h3>¡Formulario fue enviado exitosamente!</h3>
                <h4>Datos validados correctamente</h4>
                <ul>
                    <?php foreach ($validData as $key => $value) : ?>
                        <li><b><?= $key ?>:</b> <?= $value ?></li>
                    <?php endforeach ?>
                </ul>
                <p><?= anchor('form', '¡Inténtalo otra vez!') ?></p>            
            </div><!-- /.card-body -->        
                    
            <div class="card-footer">           
                <div class="row">
                                            
                </div>   
            </div><!-- /.card-footer -->

        </div><!-- /.card -->

    </div><!-- /.container-fluid -->
    
    <!-- Partial Ci -->
    <?= $this->include('layouts/modals') ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script>
       
    </script>
    <script>
       $(document).ready(function () {
           
       });
    </script>
<?= $this->endSection() ?>