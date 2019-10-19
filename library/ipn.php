<?php

include('./core.php');

    $dataArray = array(

    "accessToken" => "APP_USR-1512413086135942-081220-8b0cb3af04c2567f7bb8d09779aefba5-264344950",
    "user_id" => "264344950",
      "get" => array( 
        'user' => true,
        'id' => "264344950" 
      ),

    );

  $response = sapidk_mp($dataArray);

  // Estado de pago, puede ver los manejadores de estos aqui https://www.mercadopago.com.ar/developers/es/guides/payments/api/handling-responses
  $status = $response['collection']['status'];

  // ID de la Transaccion, misma que se recibe en $_GET['id'];
  $id = $response['collection']['id'];

  // Referencia vinculada a el metodo de pago para identificarlo en nuestro sistema
  $external_reference = $response['collection']['external_reference'];

  // Metodo de Cobro recurring_payment: suscripcion, pos_payment: POINT, regular_payment: QR o Link
  $method = $response['collection']['operation_type'];

  // Fecha Pago Realizado
    $date_created = $response['collection']['date_created'];

  // Pago Realizado
    $transaction_amount = $response['collection']['transaction_amount'];

  // Ultimos 4 Digitos de la Tarjeta de Pago
    $last_four_digits = $response['collection']['last_four_digits'];



if (isset($external_reference)) {

    if ($method == "recurring_payment") {


      if ($status == "approved") {
        


      }

      if ($status == "refunded") {
        

      }

    }

    if (($method == "regular_payment") || ($method == "pos_payment")) {

        if ($status == "approved") {

          if ($reason == "Recurring payment validation") {

                                      
          } else {

             

          }
  
           header("HTTP/1.1 200 OK");

        }
        

        if ($status == "in_process") {

          if ($reason == "Recurring payment validation") {

                                      
          } else {

             

          }
  
           header("HTTP/1.1 200 OK");

        }

        if ($status == "pending") {

          if ($reason == "Recurring payment validation") {

                                      
          } else {

             

          }
  
           header("HTTP/1.1 200 OK");

        }

        if ($status == "rejected") {

          if ($reason == "Recurring payment validation") {

                                      
          } else {

             

          }
  
           header("HTTP/1.1 200 OK");

        }


        if ($status == "refunded") {

          if ($reason == "Recurring payment validation") {

                                      
          } else {

             

          }
  
           header("HTTP/1.1 200 OK");

        }

    }

}

 ?>
