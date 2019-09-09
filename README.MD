
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/gusgeek/SAPIDK-MercadoPago)
![GitHub issues](https://img.shields.io/github/issues/gusgeek/SAPIDK-MercadoPago)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/gusgeek/SAPIDK-MercadoPago)

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

## Wiki y Manual
Desde la [Wiki](https://github.com/gusgeek/SAPIDK-MercadoPago/wiki) podran acceder a toda la informacion sobre el uso y como integrarlo de manera eficiente

## Tengo una idea o sugerencia ##

Crea un issue y usa el Tag (idea) para que pueda ser asignado y atendido.

## Autores

* **Agustin Fernandez** - aaferna@cheprogramadora.com

## Ya termino

A quien le corresponda, le interese, puede contactarse conmigo mediante mi correo aaferna@cheprogramadora.com

:pencil2: con :heart:
