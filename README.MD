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

En el file core.php tenemos las líneas iniciales en el orden qué deben ser cargadas secuencialmente, estas son genius.php y credentials.php

En _genius.php_ encontraras los Links a la API de Mercado Pago y sus Funciones en PHP para poder ejecutar las consultas.  

En _credentials.php_ se cargará el Access Token para la utilización de la herramienta, brindada por Mercado Pago en https://www.mercadopago.com/mla/account/credentials una vez que nosotros tengamos creada una aplicación base en https://applications.mercadopago.com/
