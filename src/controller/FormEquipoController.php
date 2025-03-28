<?php
require __DIR__ . '/../vendor/autoload.php';

use Duacode\Marcosrandulfe\controller\EquipoController;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$log = new Logger('app_logger');
$log->pushHandler(new StreamHandler('/var/log/php_log4php.log'));
$log->info("Entrando en FormEquipoController.php");
$nombre = $_POST["nombre"];
$ciudad = $_POST["ciudad"];
$deporte = $_POST["deporte"];
$fechaFundacion = $_POST["fechaFundacion"];

$equipController = new EquipoController();
$equipController->guardarEquipoEnBaseDeDatos($nombre, $ciudad, $deporte, $fechaFundacion);
