<?php
require __DIR__ . '/../../vendor/autoload.php';

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

if (empty($nombre) || empty($ciudad) || empty($deporte) || empty($fechaFundacion)) {
    $log->error("Algunos campos se encuentran vacíos");
    header("Location: ../view/form.php");
    exit();
}

if (strtotime($fechaFundacion) > strtotime(date('Y-m-d'))) {
    $log->error("La fecha de fundación no puede ser superior al día de hoy");
    header("Location: ../view/form.php");
    exit();
}
$equipController = new EquipoController();
$equipController->guardarEquipoEnBaseDeDatos($nombre, $ciudad, $deporte, $fechaFundacion);

header("Location: ../../index.php");
