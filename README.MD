# SAPI-DK Mercado Pago
SDK no oficial de Mercado Pago, para la integración de sistemas PHP


## Resumen
Este software, nacido como proyecto interno, está pensado para simplificar algunas de las integraciones más buscadas o conocidas de Mercado Pago.

Si bien, Mercado Pago presenta su propio SDK, actualmente carece de información y presenta algunos inconvenientes de integración ya que no todas las bondades de la plataforma están integradas en el propio SDK, o si están, fallan o presenta errores aleatorios.  

Como autodidacta, curioso, que soy sumado con el afán de aprender, desarme el SDK Original y junto a algunas herramientas que ya tenía armadas de antaño cree este SDK, que lo nombre SAPI-DK no por nada.  

Mi intención, no es más que la de colaborar con una nueva herramienta sin ánimos de generar daños ni por el estilo. Es por eso que decidí usar Github, para mostrar mi experimento al mundo, ¿y quién sabe?, mejorarlo.

## ¿Porque SAPI-DK?
El lenguaje español, es increíble. Sus formas y características de poder combinar una misma palabra en más de un sentido. A estas, las suelo llamar Palabras Maleta.  

SAPI-DK nace como un juego de combinación de API y SDK, si bien, el SDK de Mercado Pago invoca al API de ellos, este hace exactamente lo mismo. Pero para poder calificar este proyecto diferenciado en su totalidad del original decidí llamarlo de una forma peculiar, llevando un poco del juego del español, Software Application Programming Interface, Development Kit, que en español sería algo como Interfaz de programación de aplicaciones de software, kit de desarrollo.


## ¿Como Funciona?

Acá viene la parte divertida, y espero poder explicarme lo mejor posible.

SAPI-DK MP Funciona mediante solicitudes cURL a la API de Mercado Pago. Mediante funciones de PHP podemos obtener un ARRAY jSoneado donde manejar las variables que nos responde sin ningún problema.  

## ¿Como Empiezo?

Como indicamos anteriormente, SAPI-DK MP está escrito en PHP, por lo cual necesitamos un documento en tal formato con un include a core.php


```
<?php

	include('./core.php');

?>
```

En el file _core.php_ tenemos las líneas iniciales en el orden qué deben ser cargadas secuencialmente, estas son genius.php y credentials.php

En _genius.php_ encontraras los Links a la API de Mercado Pago y sus Funciones en PHP para poder ejecutar las consultas.  

En _credentials.php_ se cargará el Access Token para la utilización de la herramienta, brindada por Mercado Pago en https://www.mercadopago.com/mla/account/credentials una vez que nosotros tengamos creada una aplicación base en https://applications.mercadopago.com/



## ¿Como lo hago funcionar?
Bien, acá dependemos de cada proyecto, pero detallare las opciones que tenemos actualmente.

*Antes de continuar: Si nosotros miramos index.php y actions.php tendremos funciones basdas en formularios con __$_GET__ ya estipuladas para ejemplo.*

+ Acción es la referencia que tenemos que usar en la función de PHP

+ POST es el dato que hay o no que enviar

+ Condicionado es aquel elemento que hay que tener en cuenta para la utilización

Todos los casos, actualmente, responden un ___jSon___

| Accion | POST | Condicionado | Descripcion |
| ------ | ----------- | ----------- | ----------- |
| __$ipn__   |id|| Recibe la notificacion desde MercadoPago o la Consultamos |
| __$category__ ||| Obtiene las categorias autorizadas para ventas |
| __$qrlist__||| Enlista los QR's disponibles  |
| __$qrnuevo__|array|| Crea un nuevo QR'  |
| __$qractiva__|array|Si por URL| Envia la solicitud de pago al QR indicado  |
| __$devicesPoint__|||Enlista los Points sincronizados a la Cuenta|
| __$pointActive__|array||Envia la solicitud de pago al Point indicado|
| __$pointDelete__ |device_name||Elimina la solicitud de pago del Point Indicado|
| __$hlink__ |array||Crea link de solicitud de Pago con Checkout de MP|
| __$suscriptionscreate__ |array||Crea una nueva suscripcion |


Segun el POST, dependemos de una funcion distinta en la cual ejecutaremos la consulta.

| Funcion | Accion | Elementos |
| ------ | ----------- |----------- |
| `responseid`|Ejecuta una consulta en base a un ID  | `$url, $id, $token`  |
| `responsesimple`|Ejecuta una consulta simple  | `$url, $token`  |
| `post`|Ejecuta un POST con ARRAY  | `$url, $token`  |
| `deletePoint`|Exclusivo de Point, libera device_name para otro pago | `$url, $device_name, $token`  |



Un caso práctico es el siguiente, donde obtenemos el detalle de una venta realizada con mediante IPN, en esta oportunidad enviamos el numero de la venta por __*$_GET*__

```
<?php

  include('./core.php');
  $response = responseid($ipn, $_REQUEST['id'], $token);

  print_r($response);

?>
```

Esto, nos responde lo siguiente


```
Array
(
    [collection] => Array
        (
            [id] => 5157151402
            [site_id] => MLA
            [date_created] => 2019-09-04T10:36:36.000-04:00
            [date_approved] => 2019-09-04T10:36:38.000-04:00
            [money_release_date] => 2019-09-04T10:36:38.000-04:00
            [last_modified] => 2019-09-04T10:36:53.000-04:00
            [payer] => Array
                (
                    [id] => 147688640
                    [first_name] => Cobro recibido
                    [last_name] => en persona
                    [phone] => Array
                        (
                            [area_code] =>
                            [number] => 00000
                            [extension] =>
                        )

                    [identification] => Array
                        (
                            ...
                        )

                    [email] => ventapresencial@mercadopago.com
                    [nickname] => VENTASPRESENCIAL
                )

            [order_id] => Venta presencial
            [external_reference] => Venta presencial
            [merchant_order_id] =>
            [reason] => Venta presencial
            [currency_id] => ARS
            [transaction_amount] => 2300
            [net_received_amount] => 2133.25
            [total_paid_amount] => 2300
            [shipping_cost] => 0
            [coupon_amount] => 0
            [coupon_fee] => 0
            [finance_fee] => 0
            [discount_fee] => 0
            [coupon_id] =>
            [status] => approved
            [status_detail] => accredited
            [installments] => 1
            [issuer_id] => 688
            [installment_amount] => 2300
            [deferred_period] =>
            [payment_type] => credit_card
            [payment_method_id] => cabal
            [marketplace] => NONE
            [operation_type] => pos_payment
            [transaction_order_id] =>
            [statement_descriptor] => WWW.MERCADOPAGO.COM
            [cardholder] => Array
                (
                ...
                )

            [authorization_code] => 825136
            [marketplace_fee] => 0
            [last_four_digits] => 2589
            [deduction_schema] =>
            [refunds] => Array
                (
                )

            [amount_refunded] => 0
            [last_modified_by_admin] =>
            [api_version] => 2
            [concept_id] =>
            [concept_amount] => 0
            [collector] => Array
                (
                ...
                )

        )

)
```

Estas respuestas, en su forma, la podremos manejar de la siguiente forma

```
<?php

  echo $response['collection']['status'];

?>
```

La forma de obtener el dato, es poner entre corchetes el nivel del array y así llegar hasta el dato.  

El ejemplo de IPN, es el más sencillo. En los casos que requieren un post más elaborado como es un Array, lleva según lo que buscamos un árbol distinto.
