<?php 
  session_start();
?>

<script src="./source/controller.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            User 
            <div class="btn-group pull-right">  
              <button id="btndevUser"  type="button" class="btn btn-sm btn-success"> <i class="fa fa-search" aria-hidden="true"></i> </button>
            </div>
        </h1>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
  <p>Ingrese el ID del Usuario de Mercado Pago para ver la respuesta </p>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>ID de Usuario</label>
            <input 
            class="form-control" 
            autocomplete="off" 
            name="iduser" 
            id="iduser" 
            value="<?php if(isset($_SESSION['user_id'])){ echo $_SESSION['user_id']; } ?>">
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


   