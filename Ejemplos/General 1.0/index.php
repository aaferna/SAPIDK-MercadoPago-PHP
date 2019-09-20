<?php 

    session_start();
    
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SAPI-DK Mercado Pago | Agustin A. Fernandez</title>

    <link href="./source/sbadmin/css/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="./source/sbadmin/css/sb-admin.css" rel="stylesheet" media="all">
    <link href="./source/general.css" rel="stylesheet" type="text/css" media="all">

    <link href="./source/sbadmin/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" media="all">
    <link href="./source/animate.css" rel="stylesheet">
    <script src="./source/sbadmin/js/jquery.js"></script>
    <script src="./source/sbadmin/js/bootstrap.min.js"></script>
    <script src="./source/bootstrap-notify.min.js"></script>
    
    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SAPI-DK MP</a>
            </div>
            <!-- Top Menu Items -->
            <?php include "menu.php" ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid" id="menuTag">

            
          
            </div>
        </div>
    </div>

</body>

</html>
    
<script type="text/javascript"> $("#menuTag").load('./dashboard.php'); </script>
