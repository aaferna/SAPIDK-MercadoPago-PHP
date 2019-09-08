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

SAPI-DK MP Funciona mediante solicitudes cURL a la API de Mercado Pago. Mediante funciones de PHP podemos obtener un jSon como Array y asi trabajar las respuestas y solicitudes de la plataforma de manera más sencilla y entera que el SDK Original.
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

Segun el POST, dependemos de una funcion distinta en la cual ejecutaremos la consulta.

| Funcion | Accion | Elementos |
| ------ | ----------- |----------- |
| `responseid`|Ejecuta una consulta en base a un ID  | `$url, $id, $token`  |
| `responsesimple`|Ejecuta una consulta simple  | `$url, $token`  |
| `post`|Ejecuta un POST con ARRAY  | `$url, $array, $token`  |
| `deletePoint`|Exclusivo de Point, libera device_name para otro pago | `$url, $device_name, $token`  |

Mas explicito, dejare un cuadro para el desgloce de funciones

+ Acción es la referencia que tenemos que usar en la función de PHP

+ POST es el dato que hay o no que enviar

+ Condicionado es aquel elemento que hay que tener en cuenta para la utilización

Todos los casos, actualmente, responden un ___JSON___ pero ya están listos para ser trabajados ya que queda preparados para parsear por Array

| Accion | POST | Funcion | Condicionado | Descripcion |
| ------ | ----------- | ----------- |----------- | ----------- |
| __$ipn__   |id|`responseid($ipn, $_REQUEST['id'], $token)`|| Recibe la notificacion desde MercadoPago o la Consultamos |
| __$category__ ||`responsesimple($category, $token)`|| Obtiene las categorias autorizadas para ventas |
| __$qrlist__||`responsesimple($qrlist, $token)`|| Enlista los QR's disponibles  |
| __$qrnuevo__|array|`post($qrlist, $_REQUEST['array'], $token)`||Crea un nuevo QR'  |
| __$qractiva__|array|`post($qrPost.$user_id."/".$external_id, $_REQUEST['array'], $token)`|Si por URL a tener user_id y external_id| Envia la solicitud de pago al QR indicado  |
| __$devicesPoint__||`responsesimple($devicesPoint, $token)`||Enlista los Points sincronizados a la Cuenta|
| __$pointActive__|array|`post($pointActive, $_REQUEST['array'], $token)`||Envia la solicitud de pago al Point indicado|
| __$pointDelete__ |device_name|`deletePoint($pointDelete, $_REQUEST['device_name'], $token)`||Elimina la solicitud de pago del Point Indicado|
| __$hlink__ |array|`post($link, $_REQUEST['array'], $token)`||Crea link de solicitud de Pago con Checkout de MP|
| __$suscriptionscreate__ |array|`post($suscriptionscreate, $_REQUEST['array'], $token)`||Crea una nueva suscripcion |



# Casos practicos

## IPN

Un caso práctico es el de IPN, donde obtenemos o recibimos el detalle de una venta realizada mediante esta herramienta. En esta oportunidad recibimos el numero de la venta por __*$_REQUEST*__

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

Las respuestas de las funciones se puede trabajar por niveles, inicialmente agarramos  `$response` donde tendremos la respuesta de la consulta (en este caso) para ir filtrando en el array. De esta venta, nos interesa saber si fue paga o no, entonces lo que haremos es buscar _status_ donde sabremos si el resultado fue approved.


```
<?php

  echo $response['collection']['status'];

?>
```

La forma de obtener el dato, es poner entre corchetes el nivel del array y así llegar hasta lo que nos interesa obtener.  

El ejemplo de IPN, es el más sencillo, pero pueden aparecer distintos escenarios en el que será necesario manejar alguna que otra variable, aca los invito a que miren [IPN Manager](https://github.com/gusgeek/SAPIDK-MercadoPago/blob/master/Ejemplos/IPN%20Manager/ipnManager.php) para que vean los tres escenarios posibles _(recurring_payment, pos_payment, regular_payment)_ y sus variables.

## QR

La opción de pago por QR resulta algo muy bueno para la interacción con el cliente y los pagos digitales, la experiencia resulta practica y segura.

### Crear uno nuevo

Uno puede crear QR's desde el panel de usuario pero no se le puede ubicar `external_id`, lo que nos hace que el QR pueda interactuar con nuestra integracion. Mas tarde, si uno se fija en el panel de Locales o Negocios les mostrara que los QR's creados quedaran pendientes para vincular a alguna sucursal.

![qr](https://github.com/gusgeek/SAPIDK-MercadoPago/blob/master/Ejemplos/Imagenes/qr1.png?raw=true)

Para que esto este organizado, recomindo que los QRs se edifiquen como "Cajas", ya que MP lo idéntica así y no como accesorios como lo es con Points

Esto se logra de la siguiente forma

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
Enviamos la solicitud de pago al QR (Caja)

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
Obtenemos todos los QR's (Cajas, por sucursal o global) asociados a nuestra cuenta

```
<?php

include('./library/core.php');

	$response = responsesimple($qrlist, $token);

?>
```
## Point

Para poder usar Mercado Pago Point es obligatorio que nos activen la posibilidad de sincronizar los dispositivos donde lo usaremos con MercadoPago, para esto hay que comunicarse con soporte mediante Ayuda.

Una vez que los dispositivos los nombremos y los sincronicemos mediante Configuración de la App de Mercado Pago, solo queda enlistarlos.

### Listar Point's
Obtenemos los Points sincronizados con nuestra cuenta

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
## Hyper Links

La mas antigua, comoda y practica herramienta que tiene Mercado Pago son los Links de Pago. Podremos crear los nuestros desde nuestro SDK si necesidad de tocar el Panel de Mercado Pago y asi como con POINT y QR recibir notificacion por IPN

### Crear uno nuevo Link

En este ejemplo, estamos creando un Link con vencimiento a 30 Minutos, si uno lo desea puede evitar esta condicion eliminando las lineas expires, expiration_date_from y expiration_date_to.

```
<?php

include('./library/core.php');

$datetime = new DateTime(date("Y-m-d H:i:s.uP"));

$dataArray = array (

	'binary_mode' => true, // El pago sera approved o rejected no in_progress

	// vence a loas 30 minutos
		'expires' => true,
		'expiration_date_from' => date("Y-m-d\TH:i:s") . substr((string)microtime(), 1, 4).date('P'),
		'expiration_date_to' =>  date("Y-m-d\TH:i:s", +strtotime("+30 minutes")) . substr((string)microtime(), 1, 4).date('P'),
	// vence a loas 30 minutos

	'items' =>  array (
			0 =>
				array (
					'id' => 202030, // ID Articulo
					'title' => "Peras", // Titulo del articulo, (siempre son peras...)
					'category_id' => "services", // Usando la funcion de Categorias podremos saber cuales son compatibles aquí
					'quantity' => 1, // cantidad
					'currency_id' => "ARS", // moneda en la que se cobra ARS, USD, MEX
					'unit_price' => 12 // Precio del articulo, (si uno vende cantidad y pone el total, MP lo multiplicara)
				),
			),
	'payer' =>
		array (
					'name' => "test ", // nombre del pagador
					'surname' => 'user', // apellido del pagador
					'email' => "test@user.com" // email del pagador
				),
);

	$response = post($link, $dataArray, $token);


?>
```
## Suscripciones

Un metodo excelente para fidelizar clientes a servicios que dispongamos, este metodo segun comentan quedara deprecate pero, mientras podramos utilizarlo aca les explicare como sera.

### Crear un nuevo Plan

Muy similar a Hyper Link, con la diferencia de que elegiremos cuando se cobra, nos devolverá una URL (que se puede ver en el Panel de Mercado Pago), con el que podremos asociar nuestros clientes a el plan de suscripción que crearemos

```
<?php

include('./library/core.php');

	$dataArray = array (

		'reason' => 'reason',
		'back_url' => 'https://www.suscripcion.noexiste/',
		'external_reference' => 1212, // referencia interna
		'auto_recurring' => array(
			'frequency' => 30, // frecuencia de cobro
			'frequency_type' => "days", // se cobraria cada dia o mes segun frequency
			'transaction_amount' => 10, // monto a cobrar
			'currency_id' => "ARS", // moneda con la que se cobrar
			'debit_date' => 1, // que dia del mes se cobra

			),
	);

	$response = post($suscriptionscreate, $dataArray, $token);


?>
```


## Aclaraciones

1. En los Ejemplos [Creando un nuevo Link](#crear-uno-nuevo-link) y [Activando un QR](#activando-un-qr), el array items puede tener mas de un elemento, solo quedaría buclearlo de alguna forma según cada proyecto. Además, si se agrega un valor en quantity mayor a 1, MercadoPago multiplicara el valor de unit_price por quantity.

2. Cada uno puede manejar el core.php de la forma que mejor le convenga, con que solo este el include de genius.php y declarado $token y $user_id sera suficiente el uso de este SDK

3. Comprendo la diferencia entre el SDK original y este proyecto, pero en pocos Kb tenemos resueltas 4 herramienta de pago por ahora. Agradeceria criticas constructivas y la colaboracion en el debug o lo que fuere.


## Ya termino

A quien le corresponda, le interese, puede contactarse conmigo mediante mi correo aaferna@cheprogramadora.com
