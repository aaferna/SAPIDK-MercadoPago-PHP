<?php 
header("HTTP/1.1 200 OK");
include('../../framework/db.php'); 
include('core.php'); 
    
	$array = explode(",", $configDB['opMercadopago']);
	$token = $array[2];



	$response = responsearray($ipn, $_REQUEST['id'], $token);

  	// Estado de pago, puede ver los manejadores de estos aqui https://www.mercadopago.com.ar/developers/es/guides/payments/api/handling-responses
    	$status = $response['collection']['status']; 

    // ID de la Transaccion, misma que se recibe en $_GET['id'];
    	$id = $response['collection']['id'];

    // Referencia vinculada a el metodo de pago para identificarlo en nuestro sistema
    	$external_reference = $response['collection']['external_reference'];

    // Metodo de Cobro recurring_payment: suscripcion, pos_payment: POINT, regular_payment: QR o Link
    	$method = $response['collection']['operation_type'];


if (isset($external_reference)) {

    if ($method == "recurring_payment") {
    	
    }

    if ($method == "pos_payment") {
    	
    }

    if ($method == "regular_payment") {

     	if ($status == "approved") {

            $nvidb = mysqli_query($db, "SELECT * FROM ".$nombredb.".sqlventas 
                                    	WHERE (idventa = '".$external_reference."' and mediodepago = '3') or
                                    	(idventa = '".$external_reference."' and mediodepago = '6') 
                                   	");

            $dbnvi = mysqli_num_rows($nvidb);

            if ($dbnvi != 0 ) {

                mysqli_query($db, "UPDATE ".$nombredb.".sqlventas 
                                    SET referenciapagodigital = '".$id."', 
                                        estado = '1' WHERE idventa = '".$external_reference."'");
            }      

            echo "approved";
        }

        if ($status == "in_process") {

            $nvidb = mysqli_query($db, "SELECT * FROM ".$nombredb.".sqlventas 
                                    	WHERE (idventa = '".$external_reference."' and mediodepago = '3') or
                                    	(idventa = '".$external_reference."' and mediodepago = '6') 
                                   	");

            $dbnvi = mysqli_num_rows($nvidb);

            if ($dbnvi != 0 ) {

                mysqli_query($db, "UPDATE ".$nombredb.".sqlventas 
                                    SET referenciapagodigital = '".$id."', 
                                        estado = '6' WHERE idventa = '".$external_reference."'");
            }  

            echo "in_process";

        }

        if ($status == "pending") {

            $nvidb = mysqli_query($db, "SELECT * FROM ".$nombredb.".sqlventas 
                                    	WHERE (idventa = '".$external_reference."' and mediodepago = '3') or
                                    	(idventa = '".$external_reference."' and mediodepago = '6') 
                                   	");

            $dbnvi = mysqli_num_rows($nvidb);

            if ($dbnvi != 0 ) {

                mysqli_query($db, "UPDATE ".$nombredb.".sqlventas 
                                    SET referenciapagodigital = '".$id."', 
                                        estado = '3' WHERE idventa = '".$external_reference."'");
            } 

            echo "pending";


        }

        if ($status == "rejected") {

            $nvidb = mysqli_query($db, "SELECT * FROM ".$nombredb.".sqlventas 
                                    	WHERE (idventa = '".$external_reference."' and mediodepago = '3') or
                                    	(idventa = '".$external_reference."' and mediodepago = '6') 
                                   	");

            $dbnvi = mysqli_num_rows($nvidb);

            if ($dbnvi != 0 ) {

                mysqli_query($db, "UPDATE ".$nombredb.".sqlventas 
                                    SET referenciapagodigital = '".$id."', 
                                        estado = '5' WHERE idventa = '".$external_reference."'");
            } 

            echo "rejected";
            
        }

        if ($status == "refunded") {

            $nvidb = mysqli_query($db, "SELECT * FROM ".$nombredb.".sqlventas 
                                    	WHERE (idventa = '".$external_reference."' and mediodepago = '3') or
                                    	(idventa = '".$external_reference."' and mediodepago = '6') 
                                   	");

            $dbnvi = mysqli_num_rows($nvidb);

            if ($dbnvi != 0 ) {

                mysqli_query($db, "UPDATE ".$nombredb.".sqlventas 
                                    SET referenciapagodigital = '".$id."', 
                                        estado = '7' WHERE idventa = '".$external_reference."'");
            } 

            echo "refunded";
            
        }
    }

}
	
//	file_put_contents('filename.txt', print_r($response, true).PHP_EOL, FILE_APPEND | LOCK_EX);

// echo "<pre>";
// print_r($response);

 ?>