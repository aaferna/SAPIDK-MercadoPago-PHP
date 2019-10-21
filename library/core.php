<?php

function sapidk_mp($dataArray){

	$ipn = "https://api.mercadopago.com/collections/notifications/";
	$qrPost = "https://api.mercadopago.com/mpmobile/instore/qr/";
	$qrPos = "https://api.mercadopago.com/pos";
	$pointActive = "https://mobile.mercadopago.com/point/services/integrations/v1";
	$pointDelete = "https://mobile.mercadopago.com/point/services/integrations/v1/attempt/device/";
	$devicesPoint = "https://mobile.mercadopago.com/point/services/integrations/v1/devices";
	$link = "https://api.mercadopago.com/checkout/preferences/";
	$preapproval_plan = "https://api.mercadopago.com/preapproval_plan/";
	$payment = "https://api.mercadopago.com/v1/payments/";
	$user = "https://api.mercadopago.com/users/";
	$customers = "https://api.mercadopago.com/v1/customers/";
	$stores = "https://api.mercadolibre.com/stores/";


		function responsesimple($uri, $token) {

			$url = $uri."?access_token=".$token;

			$urlneto = @file_get_contents($url, true);

				if ($http_response_header[0] == "HTTP/1.1 301 Moved Permanently") {

					return "400";

				} else {

					return json_decode($urlneto, true);

				}

		}

		function responseXtended($uri, $ext, $token) {

			$url = $uri."?access_token=".$token."&".$ext;

			$urlneto = @file_get_contents($url, true);

				if ($http_response_header[0] == "HTTP/1.1 301 Moved Permanently") {

					return "400";

				} else {

					return json_decode($urlneto, true);

				}

		}

		function getOutarray($uri, $id, $token){

			$url = $uri.$id."?access_token=".$token;

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$result = curl_exec($ch);

	        curl_close($ch);

	        $response = json_decode($result, true);

	        if (isset($response['status'])) {

	        	if ($response['status'] == 400) {

	        		return $response['status']; 

	        	} else {

	        		return $response;
	        		
	        	}

			} else {

				return $response;
				
			}

		}

		function post($uri, $array, $token) {

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

	        $response = json_decode($result, true);

		        if (isset($response['status'])) {

		        	if ($response['status'] == 400) {

		        		return $response['status']; 

		        	} else {

		        		return $response;
		        		
		        	}

				} else {

					return $response;
					

				}

		}

		function delete($uri, $value, $token) {

			$url = $uri.$value."?access_token=".$token;
	        $ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);

			curl_close($ch);

	        $response = json_decode($result, true);

	        return $response;

		}

		function put($uri, $array, $token) {

			$url = $uri."?access_token=".$token;

	        $ch = curl_init($url);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($array));

	        $result = curl_exec($ch);

	        curl_close($ch);

	        $response = json_decode($result, true);

		       
					return $response;
					


		}

		if ((isset($dataArray['accessToken'])) && (isset($dataArray['user_id']))) {

			if (isset($dataArray['get'])) {

				// IPN

					if (isset($dataArray['get']['ipn'])) {

						$response = getOutarray($ipn, $dataArray['get']['id'], $dataArray['accessToken']);

					}

				// Medios de Cobro

					if (isset($dataArray['get']['point'])) {

						$response = responsesimple($devicesPoint, $dataArray['accessToken']);

					}

					if (isset($dataArray['get']['payment'])) {

						$response = getOutarray($payment, $dataArray['get']['id'], $dataArray['accessToken']);

					}

					if (isset($dataArray['get']['preapproval_plan'])) {

						$response = getOutarray($preapproval_plan, $dataArray['get']['id'], $dataArray['accessToken']);

					}
					
				// Usuario


					if (isset($dataArray['get']['user'])) {

						$response = getOutarray($user, $dataArray['get']['id'], $dataArray['accessToken']);
						
					}


					if (isset($dataArray['get']['user']['store'])) {

						$response = getOutarray($stores, $dataArray['get']['user']['id'], $dataArray['accessToken']);
						
					}

				// Clientes

					if (isset($dataArray['get']['customers']['client'])) {

						$response = responsesimple($customers.$dataArray['get']['id'], $dataArray['accessToken']);

					}

				// Busquedas

					if (isset($dataArray['get']['search']['customers'])) {

						$limit = $dataArray['get']['search']['limit'];
						$offset = $dataArray['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response = responseXtended($customers."search", $ext, $dataArray['accessToken']);

					}

					if (isset($dataArray['get']['search']['stores'])) {

						$limit = $dataArray['get']['search']['limit'];
						$offset = $dataArray['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response = responseXtended($user.$dataArray['user_id']."/stores/search", $ext, $dataArray['accessToken']);
						
					}

					if (isset($dataArray['get']['search']['qr'])) {

						$limit = $dataArray['get']['search']['limit'];
						$offset = $dataArray['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response = responseXtended($qrPos, $ext, $dataArray['accessToken']);


					}

					if (isset($dataArray['get']['search']['payment'])) {

						$limit = $dataArray['get']['search']['limit'];
						$offset = $dataArray['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response = responseXtended($payment."search", $ext, $dataArray['accessToken']);


					}

			}

			if (isset($dataArray['post'])) {

				// Devoluciones

					if (isset($dataArray['post']['refunds'])) {

						$array = "";

						$response = post($payment.$dataArray['post']['data']['payment_id']."/refunds", $array, $dataArray['accessToken']);

					}

				// Link

					if (isset($dataArray['post']['link'])) {

						$response = post($link, $dataArray['post']['data'], $dataArray['accessToken']);

					}

				// POINT

					if (isset($dataArray['post']['pointActive'])) {

						$response = post($pointActive, $dataArray['post']['data'], $dataArray['accessToken']);

					}

				// QR

					if (isset($dataArray['post']['qrNuevo'])) {

						$response = post($qrPos, $dataArray['post']['data'], $dataArray['accessToken']);


					}

					if (isset($dataArray['post']['qrPost'])) {

						$response = post($qrPost.$dataArray['user_id']."/".$dataArray['post']['external_id'], $dataArray['post']['data'], $dataArray['accessToken']);

					}

				// Suscripciones

					if (isset($dataArray['post']['preapproval_plan'])) {

						$response = post($preapproval_plan, $dataArray['post']['data'], $dataArray['accessToken']);

					}

				// Clientes


					if (isset($dataArray['post']['customers']['create'])) {

						$response = post($customers, $dataArray['post']['data'], $dataArray['accessToken']);

					}

				// Tiendas

					if (isset($dataArray['post']['stores'])) {

						$response = post($user.$dataArray['user_id']."/stores", $dataArray['post']['data'], $dataArray['accessToken']);

					}

			}

			if (isset($dataArray['delete'])) {

				// POINT

					if (isset($dataArray['delete']['point'])) {

						$response = delete($pointDelete, $dataArray['delete']['point'], $dataArray['accessToken']);

					}

				// Clientes

					if (isset($dataArray['delete']['customers'])) {

						$response = delete($customers, $dataArray['delete']['customers'], $dataArray['accessToken']);

					}

			}

			if (isset($dataArray['put'])) {

				// Suscripcion

					if (isset($dataArray['put']['preapproval_plan'])) {

						$response = put($preapproval_plan.$dataArray['put']['id'], $dataArray['put']['data'], $dataArray['accessToken']);

					}

			}

		}


	if (isset($dataArray['developer'])) {

		if ($dataArray['developer']["log"]["registro"] == 1) {

			if (isset($dataArray['developer']["log"]["directorio"])) {

				$fileDirname = $dataArray['developer']["log"]["directorio"]."sapidkmp_log.txt";

			} else {
				
				$fileDirname = "./sapidkmp_log.txt";

			}

			file_put_contents($fileDirname, print_r($response, true).PHP_EOL, FILE_APPEND | LOCK_EX);

		}

	}
	
	
	return $response;

}	


 ?>
