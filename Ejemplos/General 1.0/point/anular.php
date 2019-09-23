<?php 
  session_start();
?>

<script src="./source/controller.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Point Anular 
            <div class="btn-group pull-right">  
              <button id="btnpointAnular"  type="button" class="btn btn-sm btn-success"> <i class="fa fa-save" aria-hidden="true"></i> </button>
            </div>
        </h1>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
  <p>Ingrese el device_name de la Venta para anular el pago y liberar el dispositivo</p>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>device_name</label>
            <input 
            class="form-control" 
            autocomplete="off" 
            name="device_name" 
            id="device_name">
        </div>

        <div class="row">
          <div class="col-md-12" >
              <div id="response"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


   