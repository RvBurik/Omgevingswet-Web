# Omgevingswet-Web
Webapplicatie betreft de opdracht Omgevingswet

## Ontwikkelaars
* Michiel Bos
* Ricardo van Burik
* Johan Heij
* Duncan Luiten
* Tristan de Roo

## Vereisten

Om het project uit te voeren of te bouwen zijn er enkele tools nodig. Deze tools staan hieronder genoteerd:

* PHP version 7.0.*
* SQLSRV driver 4.0
* SQLSRV ODBC Driver version 11
* Laravel

## Laravel
Laravel maakt gebruik van Composer, installeer deze via `composer global require "laravel/installer`
Voor meer informatie over het installeren van Laravel: `https://laravel.com/docs/5.4/installation`

## Installatie
Kloon het project via de volgende url `https://github.com/RvBurik/Omgevingswet-Web`
Zorg dat binnen `php.ini`de volgende extensions beschikbaar zijn:
* extension=openssl.dll
* extension=curl.dll
* extension=php_mbstring.dll

Wanneer het project gekloond is, ga in de command line naar de folder waar het project in staat. 
Binnen de map redirect naar `Laravel`, om vervolgens `php artisan key:generate` uit te voeren voor een nieuwe application key.
Om het project lokaal te runnen voer`php artisan serve` uit. De webapplicatie is te vinden in je browser op `127.0.0.1:8000` of `localhost:8000`.

## Database Config
Binnen het Laravel project, rename het `.env.example` naar `.env`. Hierin worden je database credentials opgeslagen, `.env` is opgenomen in de `.gitignore`. 
