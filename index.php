
<!DOCTYPE html>
<html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<head>
	<title>Pruebas de mercado pago</title>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="./test.php">
        SAPI-DK
      </a>
    </div>
  </div>
</nav>
<?php
  	date_default_timezone_set('America/Argentina/Buenos_Aires');

	if (isset($_GET['action'])) {

		if ($_GET['action'] == "qrnuevo") {

				$dataArray = array(
			        'name' => $_REQUEST['nombreqr'],
			        'fixed_amount' => false, // puede elejir true para que sea modificable precio o false si no
			        'external_id' => $_REQUEST['external_id'],
			    );

		}

		if ($_GET['action'] == "qractiva") {

			$external_id = $_GET['external_id'];

				$dataArray = array (
				  // 'external_reference' => "REFERENCIA PARA IDENFICAR LA VENTA CUANDO IPN",
				  // 'notification_url' => "URL A IPN",
				  'items' =>
					array (
					    0 =>
					    array (
					      'title' => 'Pago Presencial NVI: ',
					      'currency_id' => 'ARS',
					      'unit_price' => $_GET['unit_price'], // NO STRING
					      'quantity' => 1,
					    ),
					),
				);
		}
		if ($_GET['action'] == "pointactive") {

			$int = (int)$_GET['amount']; // convierte valor string a numeric

			$dataArray = array(
				'device_name' => $_GET['device_name'],
				'amount' => $int,
				'description' => 'Pago Presencial NVI',
				'cc_type' => 'debit_card'
			);

		}

		if ($_GET['action'] == "pointdelete") {

			$device = $_GET['device_name'];

		}


		if (isset($dataArray)) {
			$_REQUEST['array'] = $dataArray;
		}

		if ($_GET['action'] == "hlink") {
			$datetime = new DateTime(date("Y-m-d H:i:s.uP"));

			$dataArray = array (

				'binary_mode' => true,
				// vence a loas 30 minutos
				'expires' => true,
				'expiration_date_from' => date("Y-m-d\TH:i:s") . substr((string)microtime(), 1, 4).date('P'),
				'expiration_date_to' =>  date("Y-m-d\TH:i:s", +strtotime("+30 minutes")) . substr((string)microtime(), 1, 4).date('P'),
				'items' =>  array (

					0 =>
						array (
							'id' => 202030,
							'title' => 30,
							'category_id' => "services",
							'quantity' => 1,
							'currency_id' => "ARS",
							'unit_price' => 12
						),
					1 =>
						array (
							'id' => 202031,
							'title' => 30,
							'category_id' => "services",
							'quantity' => 1,
							'currency_id' => "ARS",
							'unit_price' => 12
						),
				    ),
				'payer' =>
					array (
					      'name' => "test ",
					      'surname' => 'user',
					      'email' => "test@user.com"
					    ),
			);
			echo "<pre>";
			print_r($dataArray);
			$_REQUEST['array'] = $dataArray;

		}

		if ($_GET['action'] == "nplan") {

			$dataArray = array (

				'reason' => 'reason',
				'back_url' => 'https://www.tiendacomputacion.com/',
				'external_reference' => "reference",
				'auto_recurring' => array(
					'frequency' => 30,
					'frequency_type' => "days",
					'transaction_amount' => 10,
					'currency_id' => "ARS",
					'debit_date' => 1,

					),


			);

			$_REQUEST['array'] = $dataArray;

		}

		include ("./library/core.php");

		if (isset($response)) {

			echo '<div class="container"><div class="row"><div class="col-md-12"><h3>Respuesta en json</h3>';
			echo "<pre>";
			print_r($response);
			echo "</pre";

			echo '</body></html>';
		}

	} else {

?>


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="" method="GET" >
				<h3>Consutla de IPN</h3>
				<input type="hidden" name="action" value="ipn">
				<input class="form-control"  type="text" name="id" placeholder="ID DE VENTA">
				<br>
				<button class="btn btn-sm btn-success" type="submite">Enviar</button>
			</form>
			<form action="" method="GET">
				<h3>Consulta de QR's</h3>
				<input type="hidden" name="action" value="qrlistado">
				<br>
				<button class="btn btn-sm btn-success" type="submite">Enviar</button>
			</form>
			<form action="" method="GET">
				<h3>Creacion de QR's</h3>
				<input class="form-control"  type="hidden" name="action" value="qrnuevo">
				<input class="form-control"  type="text" name="nombreqr" value="name">
				<input class="form-control"  type="text" name="fixed_amount" value="true">
				<input class="form-control"  type="text" name="external_id" value="<?php echo mt_rand(3,20000); ?>">
				<br>
				<button class="btn btn-sm btn-success" type="submite">Enviar</button>
			</form>
			<form action="" method="GET">
				<h3>Post a QR's</h3>
				<input class="form-control"  type="hidden" name="action" value="qractiva">
				<input class="form-control"  type="text" name="unit_price" placeholder="precio" >
				<input class="form-control"  type="text" name="external_id" placeholder="ID ASOCIADO CUANDO CREO QR">
				<br>
				<button class="btn btn-sm btn-success" type="submite">Enviar</button>
			</form>
			<form action="" method="GET">
				<h3>Obtener Point's</h3>
				<input class="form-control"  type="hidden" name="action" value="pointlist">
				<br>
				<button class="btn btn-sm btn-success" type="submite">Enviar</button>
			</form>
			<form action="" method="GET">
				<h3>Post a Point's</h3>
				<input class="form-control"  type="hidden" name="action" value="pointactive">
				<input class="form-control"  type="text" name="device_name" placeholder="device_name" >
				<input class="form-control"  type="text" name="amount" placeholder="amount">
				<br>
				<button class="btn btn-sm btn-success" type="submite">Enviar</button>
			</form>
			<form action="" method="GET">
				<h3>Cancelar post de point</h3>
				<input  class="form-control" type="hidden" name="action" value="pointdelete">
				<input  class="form-control" type="text" name="device_name" placeholder="device_name" >
				<br>
				<button class="btn btn-sm btn-success" type="submite">Enviar</button>
			</form>
			<form action="" method="GET">
				<h3>Crear hLINK</h3>
				<input class="form-control" type="hidden" name="action" value="hlink">
				<br>
				<button class="btn btn-sm btn-success" type="submite">Enviar</button>
			</form>
			<form action="" method="GET">
				<h3>Crear nuevo plan de suscripcion</h3>
				<input class="form-control" type="hidden" name="action" value="nplan">
				<br>
				<button class="btn btn-sm btn-success" type="submite">Enviar</button>
			</form>

		</div>
	</div>
</div>



<?php } ?>


</body>
</html>
