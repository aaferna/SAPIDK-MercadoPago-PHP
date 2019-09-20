<?php 
  session_start();
?>
<script src="./source/controller.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Link - Crear 
             <div class="btn-group pull-right">  
              <button id="btnLink"  type="button" class="btn btn-sm btn-success"> <i class="fa fa-save" aria-hidden="true"></i> </button>
            </div>
        </h1>
       
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <p>Porfavor, complete el Formulario</p>
        <div class="row">
          <div class="col-lg-12">
              <form id="formLink" onsubmit="return false">

              	<h3>Datos de la venta</h3>
				<div class="form-group">
				<label>titulo de la venta</label>
				<input class="form-control" type="text" name="title">
				</div>

				<div class="form-group">
				<label>cantidad</label>
				<input class="form-control" type="text" name="quantity">
				</div>

				<div class="form-group">
				<label>precio</label>
				<input class="form-control" type="text" name="unit_price">
				</div>
              	<h3>Datos del Comprador</h3>
        		<div class="form-group">
				<label>Nombre</label>
				<input class="form-control" type="text" name="name">
				</div>

				<div class="form-group">
				<label>Apellido</label>
				<input class="form-control" type="text" name="surname">
				</div>

				<div class="form-group">
				<label>email</label>
				<input class="form-control" type="text" name="email">
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

   