<?php 
  session_start();
?>
<script src="./source/controller.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            QR - Crear 
             <div class="btn-group pull-right">  
              <button id="btnnewQR"  type="button" class="btn btn-sm btn-success"> <i class="fa fa-save" aria-hidden="true"></i> </button>
            </div>
        </h1>
       
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <p>Porfavor, Nombre al QR o Confirme Fixed_Amount para crearlo</p>
        <div class="row">
          <div class="col-lg-12">
              <form id="formQR" onsubmit="return false">


              <div class="form-group">
              <label>Nombre de QR</label>
              <input class="form-control"  type="text" name="nombreqr" value="name">
              </div>


              <div class="form-group">
              <label>fixed_amount (true/false) <small>Viene por defecto en true, en todo caso modigicar post.php</small></label>
              <input class="form-control"  type="text"  value="true" disabled>
              </div>

              <div class="form-group">
              <label>external_id</label>
              <input class="form-control"  type="text" name="external_id" value="<?php echo mt_rand(3,20000); ?>">
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

   