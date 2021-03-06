<?php 

namespace SAPIDK_MP;

	class CURL {

		public static function CURL_POST($uri, $array, $token) {

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

			return $result;

		}

		public static function CURL_GET_OA($uri, $token) {

			$url = $uri."?access_token=".$token;

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$result = curl_exec($ch);

			curl_close($ch);

			return $result;

		}

		public static function CURL_GET_OT($url) {

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$result = curl_exec($ch);

			curl_close($ch);

			return $result;

		}

		public static function CURL_GET_AB($uri, $token) {

			$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => $uri,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			"Authorization: Bearer ".$token
			),
			));

			$result = curl_exec($curl);

			curl_close($curl);

			return $result;

		}


		public static function CURL_DELETE_AB($uri, $token) {

			$url = $uri."?access_token=".$token;
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

	}

	class Action {

		public static function Categories() { return CURL::CURL_GET_OT("https://api.mercadopago.com/item_categories"); }
		public static function Currencies() { return CURL::CURL_GET_OT("https://api.mercadopago.com/currencies"); }
		public static function IDTypes($token) { return CURL::CURL_GET_OA("https://api.mercadopago.com/v1/identification_types", $token); }
		public static function MethodTypes($token) { return CURL::CURL_GET_OA("https://api.mercadopago.com/v1/payment_methods", $token); }

		public static function NewBox($data, $token) { return CURL::CURL_POST("https://api.mercadopago.com/pos", $data, $token); }
		public static function GetBox($token) { return CURL::CURL_GET_AB("https://api.mercadopago.com/pos", $token); }

		public static function Link($data, $token) { return CURL::CURL_POST("https://api.mercadopago.com/checkout/preferences", $data, $token); }
		public static function QRActive($data, $cred, $token) { return CURL::CURL_POST("https://api.mercadopago.com/mpmobile/instore/qr/".$cred['user_id']."/".$cred['external_id'], $data, $token); }

		public static function PointList($token) { return CURL::CURL_GET_OA("https://mobile.mercadopago.com/point/services/integrations/v1/devices", $token); }
		public static function PointActive($data, $token) { return CURL::CURL_POST("https://mobile.mercadopago.com/point/services/integrations/v1", $data, $token); }
		public static function PointDelete($device, $token) { return CURL::CURL_DELETE_AB("https://mobile.mercadopago.com/point/services/integrations/v1/attempt/device/".$device, $token); }

		public static function IPN($id, $token) { return CURL::CURL_GET_OA("https://api.mercadopago.com/collections/notifications/".$id, $token); }

		public static function PaymentView($id, $token) { return CURL::CURL_GET_OA("https://api.mercadopago.com/v1/payments/".$id, $token); }
		public static function PaymentRefound($id, $token) { return CURL::CURL_POST("https://api.mercadopago.com/v1/payments/".$id."/refunds", "", $token); }
		public static function PaymentList($limit, $offset, $token) { 

		 	$ext = "limit=".$limit."&offset=".$offset;
			return CURL::CURL_GET_OA("https://api.mercadopago.com/v1/payments/search", $token."&".$ext); 

		}

		public static function UserView($id, $token) { return CURL::CURL_GET_OA("https://api.mercadopago.com/users/".$id, $token); }


		public static function StoreID($id, $token) { return CURL::CURL_GET_OA("https://api.mercadopago.com/stores/".$id, $token); }
		public static function StoreNew($data, $id, $token) { return CURL::CURL_POST("https://api.mercadopago.com/users/".$id."/stores", $data, $token); }
		public static function StoreDelete($idsucursal, $id, $token) { return CURL::CURL_DELETE_AB("https://api.mercadopago.com/users/".$id."/stores/".$idsucursal, $token); }
		public static function StoreList($id, $limit, $offset, $token) { 

			$ext = "limit=".$limit."&offset=".$offset;
			return CURL::CURL_GET_OA("https://api.mercadopago.com/users/".$id."/stores/search", $token."&".$ext); 

		}
		
		public static function RecurrentCreator($data, $token) { return CURL::CURL_POST("https://api.mercadopago.com/preapproval", $data, $token); }






	}



?>