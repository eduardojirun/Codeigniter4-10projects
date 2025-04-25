<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- Page content-->
    <div class="container-fluid" id="app">

        <div class="card p-3 shadow col-lg-10 offset-lg-1">
            <h2 class="text-center p-3">Form Validation</h2>
            <nav>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-employees-tab" data-bs-toggle="tab" data-bs-target="#nav-employees" type="button" role="tab" aria-controls="nav-employees" aria-selected="true">Codeigniter</button>
                    <button class="nav-link" id="nav-products-tab" data-bs-toggle="tab" data-bs-target="#nav-products" type="button" role="tab" aria-controls="nav-products" aria-selected="false">Codeigniter y jQuery Validation</button>
                </div>
            </nav>
            <div class="tab-content p-3 border bg-light" id="nav-tabContent">

                <div class="tab-pane fade active show" id="nav-employees" role="tabpanel" aria-labelledby="nav-employees-tab">
                    <h4 class="mb-4">Registro de Empleado, validación en servidor con Codeigniter y envío de datos con AJAX.</h4>
                    <form id="form-employee" novalidate enctype="multipart/form-data">

                        <div class="row">
                            <div class="form-group col-md-4" id="warn_first_name">
                                <label for="first_name" class="control-label">Nombre(s)</label>                    
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Título">
                                <p class="help-block text-danger ml-2"></p>
                            </div>

                            <div class="form-group col-md-4" id="warn_last_name">
                                <label for="last_name" class="control-label">Apellido(s)</label>                    
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Título">
                                <p class="help-block text-danger ml-2"></p>
                            </div>

                            <div class="form-group col-md-2" id="warn_birthday">
                                <label for="birthday" class="control-label">Fecha de nacimiento</label>                    
                                <input type="date" name="birthday" id="birthday" class="form-control" placeholder="Date">
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                           
                            <div class="form-group col-md-2" id="warn_gender">
                                <label for="gender" class="control-label">Género</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Selecciona...</option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                    <option value="o">Otro</option>
                                </select>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                           
                        </div>
                        <hr>

                        <div class="row">                            
                            <div class="form-group col-md-3" id="warn_phone">
                                <label for="phone" class="control-label">Teléfono</label>                    
                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Título">
                                <p class="help-block text-danger ml-2"></p>
                            </div>

                            <div class="form-group col-md-3" id="warn_email">
                                <label for="email" class="control-label">Email</label>                    
                                <input type="text" name="email" id="email" class="form-control" placeholder="Título">
                                <p class="help-block text-danger ml-2"></p>
                            </div>

                            <div class="form-group col-md-4" id="warn_photo">
                                <label for="photo" class="control-label">Fotografía</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                                <p class="help-block text-danger ml-2"></p>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                           
                            <div class="form-group col-md-3" id="warn_date_admission">
                                <label for="date_admission" class="control-label">Fecha de Ingreso</label>
                                <input type="date" class="form-control" id="date_admission" name="date_admission" required>
                                <p class="help-block text-danger ml-2"></p>
                            </div>

                            <div class="form-group col-md-3" id="warn_job_position">
                                <label for="job_position" class="control-label">Cargo</label>
                                <input type="text" class="form-control" id="job_position" name="job_position" required>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                            
                            <div class="form-group col-md-3" id="warn_department">
                                <label for="department" class="control-label">Departamento</label>
                                <select class="form-select" id="department" name="department" required>
                                    <option value="">Selecciona...</option>
                                    <option value="RRHH">Recursos Humanos</option>
                                    <option value="TI">Tecnología</option>
                                    <option value="Ventas">Ventas</option>
                                    <option value="Finanzas">Finanzas</option>
                                </select>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                       
                            <div class="form-group col-md-3" id="warn_salary">
                                <label for="salary" class="control-label">Salario (USD)</label>
                                <input type="number" class="form-control" id="salary" name="salary" required>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                           
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6" id="warn_comments">
                                <label for="comments" class="control-label">Observaciones</label>
                                <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                        </div>

                        <div class="form-group col-md-6 form-check" id="warn_active">
                            <input class="form-check-input" type="checkbox" checked id="active-checkbox" required>
                            <input type="hidden" id="active" name="active" value="">
                            <label class="form-check-label" for="active">
                                Empleado Activo
                            </label>
                            <p class="help-block text-danger ml-2"></p>
                        </div>

                        <button type="submit" class="btn btn-primary" id="btn-save-employee">Registrar Empleado</button>
                    </form>
                </div>
                
                <div class="tab-pane fade" id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab">
                    <h4>Registro de Empleado, validación en servidor con Codeigniter y cliente con jQuery validate.</h4>
                    <form id="form-employee-jquery" novalidate>
                        <div class="row">
                            <div class="form-group col-md-6" id="warn_first_name">
                                <label for="first_name" class="control-label">Nombre(s)</label>                    
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Título" required>
                                <p class="help-block text-danger ml-2"></p>
                            </div>

                            <div class="form-group col-md-6" id="warn_last_name">
                                <label for="last_name" class="control-label">Apellido(s)</label>                    
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Título" required>
                                <p class="help-block text-danger ml-2"></p>
                            </div>                           
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6" id="warn_email">
                                <label for="email" class="control-label">Email</label>                    
                                <input type="text" name="email" id="email" class="form-control" placeholder="Título" required>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                            <div class="form-group col-md-6" id="warn_phone">
                                <label for="phone" class="control-label">Teléfono</label>                    
                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Título" required>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6" id="warn_birthday">
                                <label for="birthday" class="control-label">Fecha de nacimiento</label>                    
                                <input type="date" name="birthday" id="birthday" class="form-control" placeholder="Date" required>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                           
                            <div class="form-group col-md-6" id="warn_gender">
                                <label for="gender" class="control-label">Género</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Selecciona...</option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                    <option value="o">Otro</option>
                                </select>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6" id="warn_job_position">
                                <label for="job_position" class="control-label">Cargo</label>
                                <input type="text" class="form-control" id="job_position" name="job_position" required>
                            </div>
                            <div class="form-group col-md-6" id="warn_department">
                                <label for="department" class="control-label">Departamento</label>
                                <select class="form-select" id="department" name="department" required>
                                    <option value="">Selecciona...</option>
                                    <option value="RRHH">Recursos Humanos</option>
                                    <option value="TI">Tecnología</option>
                                    <option value="Ventas">Ventas</option>
                                    <option value="Finanzas">Finanzas</option>
                                </select>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6" id="warn_salary">
                                <label for="salary" class="control-label">Salario (USD)</label>
                                <input type="number" class="form-control" id="salary" name="salary" min="0" required>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                            <div class="form-group col-md-6" id="warn_date_admission">
                                <label for="date_admission" class="control-label">Fecha de Ingreso</label>
                                <input type="date" class="form-control" id="date_admission" name="date_admission" required>
                                <p class="help-block text-danger ml-2"></p>
                            </div>
                        </div>

                        <div class="form-group col-md-6" id="warn_comments">
                            <label for="comments" class="control-label">Observaciones</label>
                            <textarea class="form-control" id="comments" name="comments" rows="3" required></textarea>
                            <p class="help-block text-danger ml-2"></p>
                        </div>

                        <div class="form-group col-md-6 form-check" id="warn_active">
                            <input class="form-check-input" type="checkbox" checked id="active-checkbox">
                            <input type="hidden" id="active" name="active" value="">
                            <label class="form-check-label" for="active">
                                Empleado Activo
                            </label>
                            <p class="help-block text-danger ml-2"></p>
                        </div>

                        <div class="form-group col-md-6" id="warn_photo">
                            <label for="photo" class="control-label">Fotografía</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="">
                            <p class="help-block text-danger ml-2"></p>
                        </div>

                        <button type="submit" class="btn btn-primary" id="btn-save-employee-jquery">Registrar Empleado</button>
                    </form>
                </div>
            </div>
        </div>
               
    </div><!-- /.container-fluid -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <!-- <img src="..." class="rounded me-2" alt="..."> -->
                <strong class="me-auto">Codeigniter</strong>
                <small>Ahora mismo</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Los datos se validaron correctamente
            </div>
        </div>
    </div>
    
    <!-- Partial Ci -->
    <?= $this->include('layouts/modals') ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script src="<?= base_url('public/js/app.js') ?>" type="module"></script>
<?= $this->endSection() ?>