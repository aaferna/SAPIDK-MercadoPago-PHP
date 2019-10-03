

$('#btnCredentials').click(function(){
  
      var ajaxUrl = './post.php?credentialsSession';
      var formData = new FormData($("#formCredentials").get(0));

      $.ajax({

        url : ajaxUrl,
        type : "POST",
        data : formData,
        contentType : false,
        processData : false

      }).done(function(response){

        if (response == 1) {

          $.notify({

            message: '<small>Las credenciales estan cargadas</small>'

          },{

            type: 'success'

          });
          $('#menuTag').html('</br><center><br><br><div class="loader2"></div></center>');
          $("#menuTag").load('./dashboard.php');
        }


      }).fail(function(){
          alert("Hubo un problema con la carga el gasto, porfavor reintente");
      }).always(function(){

      });

});

$('#btnCheqkIPN').click(function(){

    idIpn = document.getElementById("idIpn").value;
    var ajaxUrl = './post.php?btnCheqkIPN&id='+idIpn;
       

      $.ajax({

        url : ajaxUrl
       

      }).done(function(response){


          document.getElementById('response').innerHTML = "<h4> Respuesta al ID "+idIpn+"</h4><pre>"+response+"</pre>";


      }).fail(function(){
          alert("Hubo un problema con la carga el gasto, porfavor reintente");
      }).always(function(){

      });

});

$('#btnCheqkQR').click(function(){

    var ajaxUrl = './post.php?btnCheqkQR';
       

      $.ajax({

        url : ajaxUrl
       

      }).done(function(response){

          document.getElementById('response').innerHTML = "<h4> Busqueda de QR`s </h4><pre>"+response+"</pre>";

      }).fail(function(){
          alert("Hubo un problema con la carga el gasto, porfavor reintente");
      }).always(function(){

      });

});


$('#btnnewQR').click(function(){
  
      var ajaxUrl = './post.php?nuevoQR';
      var formData = new FormData($("#formQR").get(0));

      $.ajax({

        url : ajaxUrl,
        type : "POST",
        data : formData,
        contentType : false,
        processData : false

      }).done(function(response){


          $.notify({

            message: '<small>Nuevo QR Creado</small>'

          },{

            type: 'success'

          });

          document.getElementById('response').innerHTML = "<h4> Detalles del Nuevo QR </h4><pre>"+response+"</pre>";


      }).fail(function(){

          alert("Hubo un problema con la carga el gasto, porfavor reintente");

      }).always(function(){

      });

});




$('#btnCobrarQR').click(function(){
  
      var ajaxUrl = './post.php?cobrarQR';
      var formData = new FormData($("#cobrarQR").get(0));

      $.ajax({

        url : ajaxUrl,
        type : "POST",
        data : formData,
        contentType : false,
        processData : false

      }).done(function(response){

          document.getElementById('response').innerHTML = "<h4> Detalles del nuevo Cobro QR </h4><pre>"+response+"</pre>";

      }).fail(function(){
        
          alert("Hubo un problema con la carga el gasto, porfavor reintente");

      }).always(function(){

      });

});

$('#btnlistPoint').click(function(){

    var ajaxUrl = './post.php?listarPoint';
       

      $.ajax({

        url : ajaxUrl
       

      }).done(function(response){

      


          document.getElementById('response').innerHTML = "<h4> Busqueda de Points`s </h4><pre>"+response+"</pre>";

      

      }).fail(function(){
          alert("Hubo un problema con la carga el gasto, porfavor reintente");
      }).always(function(){

      });

});


$('#btncobrarPoint').click(function(){
  
      var ajaxUrl = './post.php?activarPoint';
      var formData = new FormData($("#pointForm").get(0));

      $.ajax({

        url : ajaxUrl,
        type : "POST",
        data : formData,
        contentType : false,
        processData : false

      }).done(function(response){

          document.getElementById('response').innerHTML = "<h4> Detalles del nuevo Cobro QR </h4><pre>"+response+"</pre>";

      }).fail(function(){
        
          alert("Hubo un problema con la carga el gasto, porfavor reintente");

      }).always(function(){

      });

});


$('#btnpointAnular').click(function(){

    device_name = document.getElementById("device_name").value;
    var ajaxUrl = './post.php?anularPoint&device_name='+device_name;
       

      $.ajax({

        url : ajaxUrl
       
      }).done(function(response){


          document.getElementById('response').innerHTML = "<h4> Respuesta al anular "+device_name+"</h4><pre>"+response+"</pre>";


      }).fail(function(){
          alert("Hubo un problema con la carga el gasto, porfavor reintente");
      }).always(function(){

      });

});




$('#btnLink').click(function(){
  
      var ajaxUrl = './post.php?cHlink';
      var formData = new FormData($("#formLink").get(0));

      $.ajax({

        url : ajaxUrl,
        type : "POST",
        data : formData,
        contentType : false,
        processData : false

      }).done(function(response){

          document.getElementById('response').innerHTML = "<h4> Detalles del nuevo Cobro QR </h4><pre>"+response+"</pre>";

      }).fail(function(){
        
          alert("Hubo un problema con la carga el gasto, porfavor reintente");

      }).always(function(){

      });

});


$('#btnCheqkPaymnt').click(function(){

    idpayment = document.getElementById("idpayment").value;
    var ajaxUrl = './post.php?btnCheqkPaymnt&id='+idpayment;
       

      $.ajax({

        url : ajaxUrl
       

      }).done(function(response){


          document.getElementById('response').innerHTML = "<h4> Respuesta al ID "+idpayment+"</h4><pre>"+response+"</pre>";


      }).fail(function(){
          alert("Hubo un problema con la carga el gasto, porfavor reintente");
      }).always(function(){

      });

});

$('#btndevPaymnt').click(function(){

    idpayment = document.getElementById("idpayment").value;
    var ajaxUrl = './post.php?btndevPaymnt&id='+idpayment;
       

      $.ajax({

        url : ajaxUrl
       

      }).done(function(response){


          document.getElementById('response').innerHTML = "<h4> Respuesta al ID "+idpayment+"</h4><pre>"+response+"</pre>";


      }).fail(function(){
          alert("Hubo un problema con la carga el gasto, porfavor reintente");
      }).always(function(){

      });

});