<?php 
session_start();

include('../../library/core.php');


$token = $_SESSION['token'];
$user_id = $_SESSION['user_id'];

if (isset($_GET['credentialsSession'])) {

	$_SESSION['token'] = $_REQUEST['token'];

	$_SESSION['user_id'] = $_REQUEST['user_id'];

	echo "1";

}



if (isset($_GET['btnCheqkIPN'])) {

	print_r(responseid($ipn, $_REQUEST['id'], $token));

}

if (isset($_GET['btnCheqkPaymnt'])) {

	print_r(responseid($payment, $_REQUEST['id'], $token));

}


if (isset($_GET['btnCheqkQR'])) {

	print_r(responsesimple($qrlist, $token));

}


if (isset($_GET['nuevoQR'])) {
	

	$dataArray = array(
        'name' => $_REQUEST['nombreqr'],
        'fixed_amount' => true, // puede elejir true para que sea modificable precio o false si no
        'external_id' => $_REQUEST['external_id'],
    );


	print_r(post($qrlist, $dataArray, $token));


}


if (isset($_GET['cobrarQR'])) {

	$external_id = $_REQUEST['external_id'];

	$dataArray = array (
		// 'external_reference' => "REFERENCIA PARA IDENFICAR LA VENTA CUANDO IPN",
		// 'notification_url' => "URL A IPN",
		'items' =>
			array (
			    0 =>
			    array (
			      'title' => 'Pago Presencial NVI: ',
			      'currency_id' => 'ARS',
			      'unit_price' => $_REQUEST['unit_price'], // NO STRING
			      'quantity' => 1,
			    ),
			),

		);

	$url = $qrPost.$user_id."/".$external_id;

	print_r( post($url, $dataArray, $token));
}


if (isset($_GET['listarPoint'])) {
	
	print_r(responsesimple($devicesPoint, $token));
	
}


if (isset($_GET['activarPoint'])) {

	$int = (int)$_REQUEST['amount']; // convierte valor string a numeric

	$dataArray = array(
		'device_name' => $_REQUEST['device_name'],
		'amount' => $int,
		'description' => 'Pago Presencial NVI',
		'cc_type' => 'debit_card'
	);

	print_r(post($pointActive, $dataArray, $token));


}

if (isset($_GET['anularPoint'])) {
	

	print_r(deletePoint($pointDelete, $_REQUEST['device_name'], $token));


}


if (isset($_GET['cHlink'])) {


$dataArray = array (

	'additional_info' => '',
	'auto_return' => '',
	'back_urls' => 

		array (
			'failure' => '',
			'pending' => '',
			'success' => '',
		),

	'binary_mode' => true,
	'expiration_date_from' => NULL,
	'expiration_date_to' => NULL,
	'expires' => false,
	'external_reference' => '',
	'items' => 
		array (
			0 => 
			array (
				'id' => '',
				'currency_id' => 'ARS',
				'title' => $_REQUEST['title'],
				'picture_url' => '',
				'description' => '',
				'category_id' => 'services',
				'quantity' => (int)$_REQUEST['quantity'],
				'unit_price' => (int)$_REQUEST['unit_price'],
			),
		),
	'notification_url' => NULL,
	'payer' => 
		array (
			'phone' => 
				array (
					'area_code' => '',
					'number' => '',
				),
			'address' => 
				array (
					'zip_code' => '',
					'street_name' => '',
					'street_number' => NULL,
				),
			'email' => $_REQUEST['email'],
			'identification' => 
				array (
					'number' => '',
					'type' => '',
				),
		'name' => $_REQUEST['name'],
      	'surname' => $_REQUEST['surname'],
			      
		),
		'shipments' => 
			array (
				'receiver_address' => 
					array (
						'floor' => '',
						'zip_code' => '',
						'street_name' => '',
						'apartment' => '',
						'street_number' => NULL,
					),
			),
);
	print_r(post($link, $dataArray, $token));

}




if (isset($_GET['btndevPaymnt'])) {

	$payment_id = $_REQUEST['id'];

	$dataArray = array(
		'payment_id' => $payment_id
	);


	print_r(post($payment."/".$payment_id."/refunds", $array, $token));
	
}



?>
