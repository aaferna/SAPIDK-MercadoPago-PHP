<?php 
  session_start();
?>
<script src="./source/controller.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Point - Cobrar 
             <div class="btn-group pull-right">  
              <button id="btncobrarPoint"  type="button" class="btn btn-sm btn-success"> <i class="fa fa-save" aria-hidden="true"></i> </button>
            </div>
        </h1>
       
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <p>Porfavor, indique cual Point y Monto</p>
        <div class="row">
          <div class="col-lg-12">
              <form id="pointForm" onsubmit="return false">


              <div class="form-group">
              <label>Nombre de Point</label>
              <input class="form-control"  type="text" name="device_name"  >
              </div>


              <div class="form-group">
              <label>amount</label>
              <input class="form-control"  type="text" name="amount" placeholder="Precio">
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

   