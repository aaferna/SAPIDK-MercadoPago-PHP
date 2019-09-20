<?php 
  session_start();
?>
<script src="./source/controller.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            QR - Cobrar 
             <div class="btn-group pull-right">  
              <button id="btnCobrarQR"  type="button" class="btn btn-sm btn-success"> <i class="fa fa-save" aria-hidden="true"></i> </button>
            </div>
        </h1>
       
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <p>Porfavor, indique cual QR y Monto</p>
        <div class="row">
          <div class="col-lg-12">
              <form id="cobrarQR" onsubmit="return false">


              <div class="form-group">
              <label>Nombre de QR</label>
              <input class="form-control"  type="text" name="unit_price" placeholder="Precio" >
              </div>


              <div class="form-group">
              <label>external_id</label>
              <input class="form-control"  type="text" name="external_id" >
              </div>
        
                
              </form>
              <br>
               <div class="col-md-12" >
                    <div id="response"></div>
                </div>
          </div>
        </div>
    </div>
</div>

   