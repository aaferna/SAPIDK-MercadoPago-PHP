<?php

function sapidk_mp($dataArray){

	$ipn = "https://api.mercadopago.com/collections/notifications/";
	$qrPost = "https://api.mercadopago.com/mpmobile/instore/qr/";
	$qrPos = "https://api.mercadopago.com/pos";
	$pointActive = "https://mobile.mercadopago.com/point/services/integrations/v1";
	$pointDelete = "https://mobile.mercadopago.com/point/services/integrations/v1/attempt/device/";
	$devicesPoint = "https://mobile.mercadopago.com/point/services/integrations/v1/devices";
	$link = "https://api.mercadopago.com/checkout/preferences/";
	$plan = "https://api.mercadopago.com/preapproval_plan/";
	$payment = "https://api.mercadopago.com/v1/payments/";
	$user = "https://api.mercadopago.com/users/";
	$customers = "https://api.mercadopago.com/v1/customers/";

	function responseid($uri,$id,$token) {

			$url = $uri.$id."?access_token=".$token;

			$urlneto = @file_get_contents($url, true);

			if ($http_response_header[0] == "HTTP/1.1 301 Moved Permanently") {

				return "400";

			} else {

				return json_decode($urlneto, true);

			}
		}

		function responsesimple($uri,$token) {

			$url = $uri."?access_token=".$token;

			$urlneto = file_get_contents($url, true);

			if ($http_response_header[0] == "HTTP/1.1 301 Moved Permanently") {

				return "400";

			} else {

				return json_decode($urlneto, true);

			}

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

			curl_close($ch);

	        $response = json_decode($result, true);

	        return $response;

		}


		if ((isset($dataArray['accessToken'])) && (isset($dataArray['user_id']))) {

			if (isset($dataArray['get'])) {

				if (isset($dataArray['get']['ipn'])) {

					return responseid($ipn, $dataArray['get']['id'], $dataArray['accessToken']);

				}

				if (isset($dataArray['get']['point'])) {

					return responsesimple($devicesPoint, $dataArray['accessToken']);

				}

				if (isset($dataArray['get']['qr'])) {

					return responsesimple($qrPos, $dataArray['accessToken']);

				}

				if (isset($dataArray['get']['user'])) {

					return responseid($user, $dataArray['get']['user'], $dataArray['accessToken']);

				}

				if (isset($dataArray['get']['payment'])) {

					return responseid($payment, $dataArray['get']['id'], $dataArray['accessToken']);

				}
				
				if (isset($dataArray['get']['customers']['search'])) {

					return responsesimple($customers."/search", $dataArray['accessToken']);

				}

				if (isset($dataArray['get']['customers']['client'])) {

					return responsesimple($customers."/".$dataArray['get']['id'], $dataArray['accessToken']);

				}

				if (isset($dataArray['get']['customers']['cards'])) {

					return responsesimple($customers."/".$dataArray['get']['id']."/cards", $dataArray['accessToken']);

				}

			}

			if (isset($dataArray['post'])) {

				if (isset($dataArray['post']['refunds'])) {

					$array = "";

					return post($payment.$dataArray['post']['data']['payment_id']."/refunds", $array, $dataArray['accessToken']);

				}

				if (isset($dataArray['post']['link'])) {

					return post($link, $dataArray['post']['data'], $dataArray['accessToken']);

				}

				if (isset($dataArray['post']['pointActive'])) {

					return post($pointActive, $dataArray['post']['data'], $dataArray['accessToken']);

				}

				if (isset($dataArray['post']['qrNuevo'])) {

					return post($qrPos, $dataArray['post']['data'], $dataArray['accessToken']);

				}

				if (isset($dataArray['post']['qrPost'])) {

					return post($qrPost.$dataArray['user_id']."/".$dataArray['post']['external_id'], $dataArray['post']['data'], $dataArray['accessToken']);

				}

				if (isset($dataArray['post']['plan'])) {

					return post($plan, $dataArray['post']['data'], $dataArray['accessToken']);

				}

				if (isset($dataArray['post']['customers']['create'])) {

					return post($customers, $dataArray['post']['data'], $dataArray['accessToken']);

				}

			}

			if (isset($dataArray['delete'])) {

				if (isset($dataArray['delete']['point'])) {

					return deletePoint($pointDelete, $dataArray['delete']['point'], $dataArray['accessToken']);

				}

			}

		}


		

}	


 ?>
