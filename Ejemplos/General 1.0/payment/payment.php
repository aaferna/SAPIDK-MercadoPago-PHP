<?php 
  session_start();
?>

<script src="./source/controller.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Consultar un pago 
            <div class="btn-group pull-right">  
              <button id="btnCheqkPaymnt"  type="button" class="btn btn-sm btn-success"> <i class="fa fa-search" aria-hidden="true"></i> </button>
            </div>
        </h1>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
  <p>Ingrese el ID de la Venta de Mercado Pago para ver el detalle</p>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>ID de Venta</label>
            <input 
            class="form-control" 
            autocomplete="off" 
            name="idpayment" 
            id="idpayment" >
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


   