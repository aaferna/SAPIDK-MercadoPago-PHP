<?php 

	if (isset($_GET['action'])) {

		if ($_GET['action'] == "ipn") {
			
			$response = responsearray($ipn, $_REQUEST['id'], $token);

		}

		if ($_GET['action'] == "categorias") {
			
			$response = responsesimple($category, $token);

		}

		if ($_GET['action'] == "qrlistado") {
			
			$response = responsesimple($qrlist, $token);

		}

		if ($_GET['action'] == "qrnuevo") {
			
			$response = post($qrlist, $_REQUEST['array'], $token);

		}

		if ($_GET['action'] == "qractiva") {

			$url = $qrPost.$user_id."/".$external_id;

			$response = post($url, $_REQUEST['array'], $token);

		}

		if ($_GET['action'] == "pointlist") {
			
			$response = responsesimple($devicesPoint, $token);

		}

		if ($_GET['action'] == "pointactive") {
			
			$response = post($pointActive, $_REQUEST['array'], $token);

		}

		if ($_GET['action'] == "pointdelete") {
			
			$response = deletePoint($pointDelete, $_REQUEST['device_name'], $token);

		}

		if ($_GET['action'] == "hlink") {
			
			$response = post($link, $_REQUEST['array'], $token);

		}

		if ($_GET['action'] == "nplan") {
			
			$response = post($suscriptionscreate, $_REQUEST['array'], $token);

		}
	}
	
 ?>