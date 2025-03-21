<!-- Modal add -->    
<div class="modal fade" id="save" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="saveModalLabel">Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-action" class="form" autocomplete="off">              
                    <input type="hidden" name="action_id" value="" id="action_id">                            
                    <div class="form-group" id="warn_action_name">                
                        <label for="action_name">Nombre de acción</label>                
                        <input type="text" name="action_name" class="form-control" id="action_name">                
                        <p class="help-block text-danger"></p>              
                    </div>                
                    <div class="form-group" id="warn_action_description">                
                        <label for="action_description">Descripción</label>                
                        <textarea name="action_description" id="action_description" class="form-control" rows="5"></textarea>                
                        <p class="help-block text-danger"></p>              
                    </div>                          
                    <div class="form-group" id="warn_kpi_id">                
                        <label for="kpi_id">KPI</label>                
                        <select name="kpi_id" class="form-control kpi_id" id="kpi_id">                                    
                        </select>                
                        <p class="help-block text-danger"></p>              
                    </div>                
                    <div class="row">                  
                        <div class="form-group col" id="warn_action_max">                  
                            <label for="action_max">Máximo</label>                  
                            <input type="number" name="action_max" class="form-control" id="action_max" min="1" step="1">                  
                            <p class="help-block text-danger"></p>                
                        </div>                  
                        <div class="form-group col" id="warn_action_frequency">                  
                            <label for="action_frequency">Frecuencia</label>                  
                            <select name="action_frequency" class="form-control" id="action_frequency">                    
                                <option value="day" selected="">Día</option>                    
                                <option value="week">Semana</option>                    
                                <option value="month">Mes</option>                  
                            </select>                  
                            <p class="help-block text-danger"></p>                
                        </div>                  
                        <div class="form-group col" id="warn_action_exceed">                  
                            <label for="action_exceed">Excedente</label>                  
                            <input type="number" name="action_exceed" class="form-control" id="action_exceed" min="1" step="1">                  
                            <p class="help-block text-danger"></p>                
                        </div>                  
                        <div class="form-group col-12 col-lg-6" id="warn_action_start_date">                  
                            <label for="action_start_date" class="control-label col-sm-12">Fecha inicio</label>                  
                            <div class="input-group">                    
                                <div class="input-group-prepend">                      
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>                    
                                </div>                    
                                <input type="text" name="action_start_date" id="action_start_date" class="form-control">                    
                                <div class="input-group-append">                      
                                    <button type="button" class="btn btn-default input-group-text input-clear">clear</button>                    
                                </div>                  
                            </div>                  
                            <p class="help-block text-danger ml-2"></p>                
                        </div>                  
                        <div class="form-group col-12 col-lg-6" id="warn_action_end_date">                  
                            <label for="action_end_date" class="control-label col-sm-12">Fecha final</label>                  
                            <div class="input-group">                    
                                <div class="input-group-prepend">                      
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>                    
                                </div>                    
                                <input type="text" name="action_end_date" id="action_end_date" class="form-control">                    
                                <div class="input-group-append">                      
                                    <button type="button" class="btn btn-default input-group-text input-clear">clear</button>                    
                                </div>                  
                            </div>                  
                            <p class="help-block text-danger ml-2"></p>                
                        </div>                              
                    </div>                              
                </form> 
            </div>
            <div class="modal-footer">
                <form id="form-delete" action="" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <form id="form-delete" action="" method="post">
                    <!-- <input type="hidden" name="_method" value="DELETE"> -->
                    <?= csrf_field() ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>