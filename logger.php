<?php
require_once __DIR__ . '/vendor/autoload.php'; // Carga todas las librerías de Composer


use Monolog\Logger;
use Monolog\Handler\StreamHandler;
// Crear un logger
$log = new Logger('app_logger');

// Agregar un manejador que guarda logs en un archivo
$log->pushHandler(new StreamHandler('/var/log/php_log4php.log'));