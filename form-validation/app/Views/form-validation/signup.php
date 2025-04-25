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

            <div class="card-body row">                      
                <?= validation_list_errors() ?>

                <div class="col-lg-4 offset-4">
                    <?= form_open('form') ?>
                        <h5>Username</h5>
                        <input type="text" name="username" value="<?= set_value('username') ?>" size="50">

                        <h5>Password</h5>
                        <input type="text" name="password" value="<?= set_value('password') ?>" size="50">

                        <h5>Password Confirm</h5>
                        <input type="text" name="passconf" value="<?= set_value('passconf') ?>" size="50">

                        <h5>Email Address</h5>
                        <input type="text" name="email" value="<?= set_value('email') ?>" size="50">

                        <div><input type="submit" value="Submit"></div>
                    <?= form_close() ?>
                </div>                    
            
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