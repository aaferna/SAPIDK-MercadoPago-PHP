<?php 
  session_start();
?>
<script src="./source/controller.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard 
        </h1>
       
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <p>Porfavor, indique las credenciales para poder usar este SDK</p>
        <div class="row">
          <div class="col-lg-12">
              <form id="formCredentials" onsubmit="return false">
                <div class="form-group">
                  <label>Token</label>
                  <input 
                        class="form-control" 
                        autocomplete="off" 
                        name="token" 
                        id="token" 
                        placeholder="<?php if(isset($_SESSION['token'])){ echo $_SESSION['token']; } ?>" >
                </div>
                <div class="form-group">
                  <label>user_id</label>
                  <input 
                        class="form-control" 
                        autocomplete="off" 
                        name="user_id" 
                        id="user_id" 
                        placeholder="<?php if(isset($_SESSION['user_id'])){ echo $_SESSION['user_id']; } ?>">
                </div>
                
                </div>
              </form>
              <br><bR>
            <button id="btnCredentials" class="pull-right btn btn-sm btn-success"> Actualizar </button>
          </div>
        </div>
    </div>
</div>

   