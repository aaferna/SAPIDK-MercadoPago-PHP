# SAPI-DK Mercado Pago
SDK no oficial de Mercado Pago, para la integración de sistemas PHP


## Resumen
Este software, nacido como proyecto interno, está pensado para simplificar algunas de las integraciones más buscadas o conocidas de Mercado Pago.

Si bien, Mercado Pago presenta su propio SDK, no todas las bondades de la plataforma están integradas en el propio SDK, o si están, son un poco confusas en en el momento de integrarlas.

Como autodidacta curioso, que soy, sumado que con el afán de aprender, desarme el SDK original y junto a algunas herramientas que ya tenía armadas de antaño cree este SDK que lo nombre SAPI-DK no por nada.

Mi intención, no es más que la de colaborar con una nueva herramienta sin ánimos de generar daños ni por el estilo. Es por eso que decidí usar Github, para mostrar mi experimento al mundo, y quién sabe?, mejorarlo.

## ¿Porque SAPI-DK?
El lenguaje español, es increíble. Sus formas y características de poder hacer que una palabra tenga más de un sentido. A estas, las suelo llamar Palabras Maleta.  

SAPI-DK nace como un juego de combinación de API y SDK, si bien el SDK de Mercado Pago invoca a la API propietaria, este hace exactamente lo mism, pero para poder calificar este proyecto, diferenciado en su totalidad del original, decidí llamarlo de una forma peculiar llevando un poco del juego que hace el español: Software Application Programming Interface, Development Kit, que en español sería algo como Software para la Interfaz de programación de aplicaciones, kit de desarrollo.

## ¿Como Funciona?

Acá viene la parte divertida, y espero poder explicarme lo mejor posible.

SAPI-DK MP Funciona mediante solicitudes cURL a la API de Mercado Pago. Mediante funciones de PHP podemos obtener un jSon como Array, donde manejar las variables que nos responde, se nos haga facil y su utilizacion sea sin ningún problema.  

## ¿Como Empiezo?

Como indicamos anteriormente, SAPI-DK MP está escrito en PHP, por lo cual necesitamos un documento en tal formato con un include a core.php


```
<?php

	include('./library/core.php');

?>
```

En el file _core.php_ tenemos las líneas iniciales en el orden qué deben ser cargadas secuencialmente, estas son genius.php y credentials.php

En _genius.php_ encontraras los Links a la API de Mercado Pago y sus Funciones en PHP para poder ejecutar las consultas.  

En _credentials.php_ se cargará el Access Token y el user_id para la utilización de la herramienta, brindada por Mercado Pago en https://www.mercadopago.com/mla/account/credentials una vez que nosotros tengamos creada una aplicación base en https://applications.mercadopago.com/

_Una pista:_ El `user_id` son los ultimos numeros del Token


## ¿Como lo hago funcionar?
Bien, acá dependemos de cada proyecto, pero detallare las opciones que tenemos actualmente.

__Antes de continuar:__ Si nosotros miramos index.php y actions.php tendremos funciones basdas en formularios con __*$_GET*__ ya estipuladas para ejemplo.

+ Acción es la referencia que tenemos que usar en la función de PHP

+ POST es el dato que hay o no que enviar

+ Condicionado es aquel elemento que hay que tener en cuenta para la utilización

Todos los casos, actualmente, responden un ___JSON___ pero ya están listos para ser trabajados ya que queda preparados para parsear por Array

| Accion | POST | Condicionado | Descripcion |
| ------ | ----------- | ----------- | ----------- |
| __$ipn__   |id|| Recibe la notificacion desde MercadoPago o la Consultamos |
| __$category__ ||| Obtiene las categorias autorizadas para ventas |
| __$qrlist__||| Enlista los QR's disponibles  |
| __$qrnuevo__|array|| Crea un nuevo QR'  |
| __$qractiva__|array|Si por URL a tener user_id| Envia la solicitud de pago al QR indicado  |
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
| `post`|Ejecuta un POST con ARRAY  | `$url, $array, $token`  |
| `deletePoint`|Exclusivo de Point, libera device_name para otro pago | `$url, $device_name, $token`  |



Un caso práctico es el siguiente, donde obtenemos el detalle de una venta realizada mediante IPN, en esta oportunidad recibimos el numero de la venta por __*$_REQUEST*__

```
<?php

  include('./library/core.php');
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

Las respuestas de las funciones se puede trabajar por niveles, inicialmente agarramos  `$response` donde tendremos la respuesta de la consulta (en este caso) para ir filtrando en el array por niveles. De esta venta, nos interesa saber si fue paga o no, entonces lo que haremos es buscar _status_ donde sabremos si el resultado fue approved.


```
<?php

  echo $response['collection']['status'];

?>
```

La forma de obtener el dato, es poner entre corchetes el nivel del array y así llegar hasta lo que nos interesa obtener.  

El ejemplo de IPN, es el más sencillo, pero pueden aparecer distintos escenarios en el que será necesario manejar alguna que otra variable, aca los invito a que miren [IPN Manager](https://github.com/gusgeek/SAPIDK-MercadoPago/blob/master/Ejemplos/IPN%20Manager/ipnManager.php) para que vean los tres escenarios posibles _(recurring_payment, pos_payment, regular_payment)_ y sus variables.

En los casos que requieren un post más elaborado como es un Array, lleva según lo que buscamos un Array distinto, ire agregando mas informacion a medida que al tenga verificada.


## Situacion con QR

La opción de pago por QR resulta algo muy bueno para la interacción con el cliente y los pagos digitales, la experiencia resulta practica y segura.

### Crear uno nuevo

Uno puede crear QR's desde el panel de usuario pero no se le puede ubicar `external_id`, lo que nos hace que el QR pueda interactuar con nuestra integracion. Mas tarde, si uno se fija en el panel de Sucursales o Negocios les mostrara que los QR's creados quedaaran pendientes para vincular.

![qr](https://github.com/gusgeek/SAPIDK-MercadoPago/blob/master/Ejemplos/Imagenes/qr1.png?raw=true)

Para que esto este organizado, nosotros recomendamos que los QRs se edifiquen como "Cajas", ya que MP lo idéntica así y no como accesorios como lo es con Points 

```
<?php

include('./library/core.php');

	$dataArray = array(
		'name' => $_REQUEST['nombreqr'], // Nombre del QR / Caja
		'fixed_amount' => false, // Elegir si el cliente puede modificar o poner el precio  
		'external_id' => $_REQUEST['external_id'], // ID por el cual va a identificarlo internamente, le recomendamos usar mt_rand(3,20000)
	);

	$response = post($qrlist, $array, $token);

?>
```

### Activando un QR

```
<?php

include('./library/core.php');

	$external_id = $_GET['external_id'];

	$dataArray = array (
		// 'external_reference' => "REFERENCIA PARA IDENFICAR LA VENTA CUANDO IPN",
		// 'notification_url' => "URL A IPN",
		'items' =>
			array (
					0 =>
					array (
						'title' => 'Pago Presencial',
						'currency_id' => 'ARS',
						'unit_price' => $_GET['unit_price'], // NO STRING Precio de la venta
						'quantity' => 1,
					),
			),
	);

	$url = $qrPost.$user_id."/".$external_id; // Condicionado por user_id y external_id

	$response = post($qrlist, $dataArray, $token);

?>
```

### Listando QR's

```
<?php

include('./library/core.php');

	$response = responsesimple($qrlist, $token);

?>
```
## Situacion con Point

Para poder usar Mercado Pago Point es obligatorio que nos activen la posibilidad de sincronizar los dispositivos donde lo usaremos con MercadoPago, para esto hay que comunicarse con soporte mediante Ayuda.

Una vez que los dispositivos los nombremos y los sincronicemos mediante Configuración de la App de Mercado Pago, solo queda enlistarlos.

### Listar Point's

```
<?php

include('./library/core.php');

	$response = responsesimple($devicesPoint, $token);

?>
```
### Activando un Point

Tanto como los QR's se activan mediante la función POST con un Array, lo primero es tener reconocido a que dispositivo vamos a realizarle la solicitud de pago. Una vez que este identificado, y ejecutemos la función, se iniciara la App de MercadoPago lista para pasar la tarjeta.

```
<?php

include('./library/core.php');

	$int = (int)$_GET['amount']; // convierte valor string a numeric

	$dataArray = array(
		'device_name' => $_GET['device_name'], // Nombre del Dispositivo
		'amount' => $int, // Valor a Cobrar
		'description' => 'Pago Presencial', // Descripcion
		'external_reference' => $_GET['nvi'], // REFERENCIA PARA IDENFICAR LA VENTA CUANDO IPN
		'cc_type' => 'debit_card' // tipo de tarjeta, puede ser tambien credit_card
	);


	$response = post($pointActive, $dataArray, $token);


?>
```
### Desactivar pago en Point

Algo molesto de trabajar con SDK y Point es que el pago no se vence si es que no fue efectuado si quiera visto, como si pasa con QR. El dispositivo queda en estado BUSSY y nos toca cancelar la orden de pago.

```
<?php

include('./library/core.php');

	$response = deletePoint($pointDelete, $_REQUEST['device_name'], $token);

?>
```
