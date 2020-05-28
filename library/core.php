<?php

function sapidk_mp($dataArray){

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
	$storesML = "https://api.mercadolibre.com/stores/";
	$storesMP = "https://api.mercadopago.com/stores/";


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

	$response = array();

		if ((isset($dataArray['accessToken'])) && (isset($dataArray['user_id']))) {

			if (isset($dataArray['get'])) {

				// IPN

					if (isset($dataArray['get']['ipn'])) {

						$response['get'] = getOutarray($payment, $dataArray['get']['id'], $dataArray['accessToken']);

					}

				// Medios de Cobro

					if (isset($dataArray['get']['point'])) {

						$response['get'] = responsesimple($devicesPoint, $dataArray['accessToken']);

					}

					if (isset($dataArray['get']['payment'])) {

						$response['get'] = getOutarray($payment, $dataArray['get']['id'], $dataArray['accessToken']);

					}

					if (isset($dataArray['get']['preapproval_plan'])) {

						$response['get'] = getOutarray($preapproval_plan, $dataArray['get']['id'], $dataArray['accessToken']);

					}
					
				// Usuario


					if (isset($dataArray['get']['user'])) {

						$response['get'] = getOutarray($user, $dataArray['get']['id'], $dataArray['accessToken']);
						
					}


					if (isset($dataArray['get']['store'])) {

						if ($dataArray['get']['method'] == "mp") {
								
							$mLink = $storesMP;

						} 

						if ($dataArray['get']['method'] == "ml") {
								
							$mLink = $storesML;

						} 

						$response['get'] = getOutarray($mLink, $dataArray['get']['store'], $dataArray['accessToken']);
						
					}

				// Clientes

					if (isset($dataArray['get']['customers']['client'])) {

						$response['get'] = responsesimple($customers.$dataArray['get']['id'], $dataArray['accessToken']);

					}

				// Busquedas

					if (isset($dataArray['get']['search']['customers'])) {

						$limit = $dataArray['get']['search']['limit'];
						$offset = $dataArray['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response['get'] = responseXtended($customers."search", $ext, $dataArray['accessToken']);

					}

					if (isset($dataArray['get']['search']['stores'])) {

						$limit = $dataArray['get']['search']['limit'];
						$offset = $dataArray['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response['get'] = responseXtended($user.$dataArray['user_id']."/stores/search", $ext, $dataArray['accessToken']);
						
					}

					if (isset($dataArray['get']['search']['qr'])) {

						$limit = $dataArray['get']['search']['limit'];
						$offset = $dataArray['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response['get'] = responseXtended($qrPos, $ext, $dataArray['accessToken']);


					}

					if (isset($dataArray['get']['search']['payment'])) {

						$limit = $dataArray['get']['search']['limit'];
						$offset = $dataArray['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response['get'] = responseXtended($payment."search", $ext, $dataArray['accessToken']);


					}

			}

			if (isset($dataArray['post'])) {

				// Devoluciones

					if (isset($dataArray['post']['refunds'])) {

						$array = "";

						$response['post'] = post($payment.$dataArray['post']['data']['payment_id']."/refunds", $array, $dataArray['accessToken']);

					}

				// Link

					if (isset($dataArray['post']['link'])) {

						$response['post'] = post($link, $dataArray['post']['data'], $dataArray['accessToken']);

					}

				// POINT

					if (isset($dataArray['post']['pointActive'])) {

						$response['post'] = post($pointActive, $dataArray['post']['data'], $dataArray['accessToken']);

					}

				// QR

					if (isset($dataArray['post']['qrNuevo'])) {

						$response['post'] = post($qrPos, $dataArray['post']['data'], $dataArray['accessToken']);


					}

					if (isset($dataArray['post']['qrPost'])) {

						$response['post'] = post($qrPost.$dataArray['user_id']."/".$dataArray['post']['external_id'], $dataArray['post']['data'], $dataArray['accessToken']);

					}

				// Suscripciones

					if (isset($dataArray['post']['preapproval_plan'])) {

						$response['post'] = post($preapproval_plan, $dataArray['post']['data'], $dataArray['accessToken']);

					}

				// Clientes


					if (isset($dataArray['post']['customers']['create'])) {

						$response['post'] = post($customers, $dataArray['post']['data'], $dataArray['accessToken']);

					}

				// Tiendas

					if (isset($dataArray['post']['stores'])) {

						$response['post'] = post($user.$dataArray['user_id']."/stores", $dataArray['post']['data'], $dataArray['accessToken']);

					}

			}

			if (isset($dataArray['delete'])) {

				// POINT

					if (isset($dataArray['delete']['point'])) {

						$response['delete'] = delete($pointDelete, $dataArray['delete']['point'], $dataArray['accessToken']);

					}

				// Clientes

					if (isset($dataArray['delete']['customers'])) {

						$response['delete'] = delete($customers, $dataArray['delete']['customers'], $dataArray['accessToken']);

					}

				// Tiendas

					if (isset($dataArray['delete']['stores'])) {

						$response['delete'] = delete($user.$dataArray['user_id']."/stores/", $dataArray['delete']['id'], $dataArray['accessToken']);

					}

					if (isset($dataArray['delete']['qr'])) {

						$response['delete'] = delete($qrPost.$dataArray['user_id']."/", $dataArray['delete']['qr'], $dataArray['accessToken']);

					}

					
			}

			if (isset($dataArray['put'])) {

				// Suscripcion

					if (isset($dataArray['put']['preapproval_plan'])) {

						$response['put'] = put($preapproval_plan.$dataArray['put']['id'], $dataArray['put']['data'], $dataArray['accessToken']);

					}

			}

			if (isset($dataArray['forWhile'])) {
				
				$totalArray = count($dataArray['forWhile']);

				for ($n=0; $n < $totalArray; $n++) { 

									// IPN

					if (isset($dataArray['forWhile'][$n]['get']['ipn'])) {

						$response['forWhile'][$n] = getOutarray($payment, $dataArray['forWhile'][$n]['get']['id'], $dataArray['accessToken']);

					}

				// Medios de Cobro

					if (isset($dataArray['forWhile'][$n]['get']['point'])) {

						$response['forWhile'][$n] = responsesimple($devicesPoint, $dataArray['accessToken']);

					}

					if (isset($dataArray['forWhile'][$n]['get']['payment'])) {

						$response['forWhile'][$n] = getOutarray($payment, $dataArray['forWhile'][$n]['get']['id'], $dataArray['accessToken']);

					}

					if (isset($dataArray['forWhile'][$n]['get']['preapproval_plan'])) {

						$response['forWhile'][$n] = getOutarray($preapproval_plan, $dataArray['forWhile'][$n]['get']['id'], $dataArray['accessToken']);

					}
					
				// Usuario


					if (isset($dataArray['forWhile'][$n]['get']['user'])) {

						$response['forWhile'][$n] = getOutarray($user, $dataArray['forWhile'][$n]['get']['id'], $dataArray['accessToken']);
						
					}


					if (isset($dataArray['forWhile'][$n]['get']['store'])) {

						if ($dataArray['forWhile'][$n]['get']['method'] == "mp") {
								
							$mLink = $storesMP;

						} 

						if ($dataArray['forWhile'][$n]['get']['method'] == "ml") {
								
							$mLink = $storesML;

						} 

						$response['forWhile'][$n] = getOutarray($mLink, $dataArray['forWhile'][$n]['get']['store'], $dataArray['accessToken']);
						
					}

				// Clientes

					if (isset($dataArray['forWhile'][$n]['get']['customers']['client'])) {

						$response['forWhile'][$n] = responsesimple($customers.$dataArray['forWhile'][$n]['get']['id'], $dataArray['accessToken']);

					}

				// Busquedas

					if (isset($dataArray['forWhile'][$n]['get']['search']['customers'])) {

						$limit = $dataArray['forWhile'][$n]['get']['search']['limit'];
						$offset = $dataArray['forWhile'][$n]['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response['forWhile'][$n] = responseXtended($customers."search", $ext, $dataArray['accessToken']);

					}

					if (isset($dataArray['forWhile'][$n]['get']['search']['stores'])) {

						$limit = $dataArray['forWhile'][$n]['get']['search']['limit'];
						$offset = $dataArray['forWhile'][$n]['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response['forWhile'][$n] = responseXtended($user.$dataArray['user_id']."/stores/search", $ext, $dataArray['accessToken']);
						
					}

					if (isset($dataArray['forWhile'][$n]['get']['search']['qr'])) {

						$limit = $dataArray['forWhile'][$n]['get']['search']['limit'];
						$offset = $dataArray['forWhile'][$n]['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response['forWhile'][$n] = responseXtended($qrPos, $ext, $dataArray['accessToken']);


					}

					if (isset($dataArray['forWhile'][$n]['get']['search']['payment'])) {

						$limit = $dataArray['forWhile'][$n]['get']['search']['limit'];
						$offset = $dataArray['forWhile'][$n]['get']['search']['offset'];

						$ext = "limit=".$limit."&offset=".$offset;

						$response['forWhile'][$n] = responseXtended($payment."search", $ext, $dataArray['accessToken']);


					}

				// Devoluciones

					if (isset($dataArray['forWhile'][$n]['post']['refunds'])) {

						$array = "";

						$response['forWhile'][$n] = post($payment.$dataArray['forWhile'][$n]['post']['data']['payment_id']."/refunds", $array, $dataArray['accessToken']);

					}

				// Link

					if (isset($dataArray['forWhile'][$n]['post']['link'])) {

						$response['forWhile'][$n] = post($link, $dataArray['forWhile'][$n]['post']['data'], $dataArray['accessToken']);

					}

				// POINT

					if (isset($dataArray['forWhile'][$n]['post']['pointActive'])) {

						$response['forWhile'][$n] = post($pointActive, $dataArray['forWhile'][$n]['post']['data'], $dataArray['accessToken']);

					}

				// QR

					if (isset($dataArray['forWhile'][$n]['post']['qrNuevo'])) {

						$response['forWhile'][$n] = post($qrPos, $dataArray['forWhile'][$n]['post']['data'], $dataArray['accessToken']);


					}

					if (isset($dataArray['forWhile'][$n]['post']['qrPost'])) {

						$response['forWhile'][$n] = post($qrPost.$dataArray['user_id']."/".$dataArray['forWhile'][$n]['post']['external_id'], $dataArray['forWhile'][$n]['post']['data'], $dataArray['accessToken']);

					}

				// Suscripciones

					if (isset($dataArray['forWhile'][$n]['post']['preapproval_plan'])) {

						$response['forWhile'][$n] = post($preapproval_plan, $dataArray['forWhile'][$n]['post']['data'], $dataArray['accessToken']);

					}

				// Clientes


					if (isset($dataArray['forWhile'][$n]['post']['customers']['create'])) {

						$response['forWhile'][$n] = post($customers, $dataArray['forWhile'][$n]['post']['data'], $dataArray['accessToken']);

					}

				// Tiendas

					if (isset($dataArray['forWhile'][$n]['post']['stores'])) {

						$response['forWhile'][$n] = post($user.$dataArray['user_id']."/stores", $dataArray['forWhile'][$n]['post']['data'], $dataArray['accessToken']);

					}


				// POINT

					if (isset($dataArray['forWhile'][$n]['delete']['point'])) {

						$response['forWhile'][$n] = delete($pointDelete, $dataArray['forWhile'][$n]['delete']['point'], $dataArray['accessToken']);

					}

				// Clientes

					if (isset($dataArray['forWhile'][$n]['delete']['customers'])) {

						$response['forWhile'][$n] = delete($customers, $dataArray['forWhile'][$n]['delete']['customers'], $dataArray['accessToken']);

					}

				// Tiendas

					if (isset($dataArray['forWhile'][$n]['delete']['stores'])) {

						$response['forWhile'][$n] = delete($user.$dataArray['user_id']."/stores/", $dataArray['forWhile'][$n]['delete']['id'], $dataArray['accessToken']);

					}

					if (isset($dataArray['forWhile'][$n]['delete']['qr'])) {

						$response['forWhile'][$n] = delete($qrPost.$dataArray['user_id']."/", $dataArray['forWhile'][$n]['delete']['qr'], $dataArray['accessToken']);

					}

					if (isset($dataArray['forWhile'][$n]['put']['preapproval_plan'])) {

						$response['forWhile'][$n] = put($preapproval_plan.$dataArray['forWhile'][$n]['put']['id'], $dataArray['forWhile'][$n]['put']['data'], $dataArray['accessToken']);

					}


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
