<?php

	// Instant Pay Notification

		$ipn = "https://api.mercadopago.com/collections/notifications/";

	// QR

		// Post a el QR
		$qrPost = "https://api.mercadopago.com/mpmobile/instore/qr/";

		// Creacion o Consulta de QR's
		$qrlist = "https://api.mercadopago.com/pos";

	// POINT

		// Post a PointDevices
		$pointActive = "https://mobile.mercadopago.com/point/services/integrations/v1";

		// Delete post a PointDevices
		$pointDelete = "https://mobile.mercadopago.com/point/services/integrations/v1/attempt/device/";

		// Listar Points Disponibles
		$devicesPoint = "https://mobile.mercadopago.com/point/services/integrations/v1/devices";

	// Crea Links
	$link = "https://api.mercadopago.com/checkout/preferences/";

	// Categorias
	$category = "https://api.mercadopago.com/item_categories";


	// Suscripciones

		// Crear suscripciones
		$suscriptionscreate = "https://api.mercadopago.com/preapproval_plan/";



		function responseid($uri,$id,$token) {

			$url = $uri.$id."?access_token=".$token;

			$urlneto = file_get_contents($url, true);

			return json_decode($urlneto, true);

		}

		function responsesimple($uri,$token) {

			$url = $uri."?access_token=".$token;

			$urlneto = file_get_contents($url, true);

			return json_decode($urlneto, true);

		}

		function post($uri,$array,$token) {

			$url = $uri."?access_token=".$token;

	        $ch = curl_init($url);

	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	        curl_setopt($ch, CURLOPT_POST, true);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));

	        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            'Content-Type: application/json',
	            'Content-Length: ' . strlen(json_encode($array)))
	        );

	        $result = curl_exec($ch);

	        curl_close($ch);

	        return json_decode($result, true);

		}

		function deletePoint($uri,$value,$token) {

			$url = $uri.$value."?access_token=".$token;
	        $ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');


			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);

	        return json_decode($result, true);

		}

 ?>
