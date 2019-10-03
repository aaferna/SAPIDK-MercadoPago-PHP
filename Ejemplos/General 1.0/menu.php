            
<script type="text/javascript">
$('#ipn').click(function(){
    $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>Actualizando Tienda</center>');
    $("#menuTag").load('./ipn/index.php');
});
</script>

<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="active">
            <a id="dash">Dashboard</a>
        </li>
        <li>
            <a id="ipn">IPN</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#qr"> QR <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="qr" class="collapse">
                <li>
                    <a id="qrC">Consultar QR</a>
                </li>
                <li>
                    <a id="qrN">Crear QR</a>
                </li>
                <li>
                    <a id="qrR">Cobrar QR</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#point"> Point <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="point" class="collapse">
                <li>
                    <a id="pointL">Listar Point</a>
                </li>
                <li>
                    <a id="pointC">Cobrar Point</a>
                </li>
                <li>
                    <a id="pointA">Anular Pago</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#payment"> Payment <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="payment" class="collapse">
                <li>
                    <a id="pagoConsulta">Consultar un Pago</a>
                </li>
                <li>
                    <a id="pagoDevolucion">Devolucion un Pago</a>
                </li>
            </ul>
        </li>
        <li>
            <a id="hLink">Hyper Link</a>
        </li>
       
    </ul>
</div>

<script type="text/javascript">
    $('#dash').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>Dashboard</center>');
        $("#menuTag").load('./dashboard.php');
    });
    $('#ipn').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>IPN</center>');
        $("#menuTag").load('./ipn/index.php');
    });
    $('#qrC').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>QR</center>');
        $("#menuTag").load('./qr/consultar.php');
    });
    $('#qrN').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>QR</center>');
        $("#menuTag").load('./qr/crear.php');
    });
    $('#qrR').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>QR</center>');
        $("#menuTag").load('./qr/cobrar.php');
    });
    $('#pointL').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>Point</center>');
        $("#menuTag").load('./point/listar.php');
    });
    $('#pointC').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>Point</center>');
        $("#menuTag").load('./point/activar.php');
    });
    $('#pointA').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>Point</center>');
        $("#menuTag").load('./point/anular.php');
    });
    $('#hLink').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>Hyper Link</center>');
        $("#menuTag").load('./hlink/index.php');
    });
    $('#pagoConsulta').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>Consultar un Pago</center>');
        $("#menuTag").load('./payment/payment.php');
    });
    $('#pagoDevolucion').click(function(){
        $('#menuTag').html('</br><center><br><br><div class="loader2"></div><br><br>Devolucion un Pago</center>');
        $("#menuTag").load('./payment/devolucion.php');
    });
</script>