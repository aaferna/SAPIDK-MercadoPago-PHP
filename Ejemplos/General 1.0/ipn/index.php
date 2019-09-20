<?php 
  session_start();
?>
<script src="./source/controller.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            IPN 
            <div class="btn-group pull-right">  
              <button id="btnCheqkIPN"  type="button" class="btn btn-sm btn-success"> <i class="fa fa-search" aria-hidden="true"></i> </button>
            </div>
        </h1>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
  <p>Ingrese el ID de la Venta de Mercado Pago para ver la respuesta del IPN</p>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>ID de Venta</label>
            <input 
            class="form-control" 
            autocomplete="off" 
            name="idIpn" 
            id="idIpn" >
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


   