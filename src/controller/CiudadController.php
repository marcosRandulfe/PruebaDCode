<?php

namespace Duacode\Marcosrandulfe\controller;
use Duacode\Marcosrandulfe\model\Ciudad;
use Duacode\Marcosrandulfe\model\Equipo;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require __DIR__ . '/../../vendor/autoload.php';
class CiudadController{

    public function obtenerCiudades()
    {
        // Assuming you have a database connection established
        $dbController = new BDController();
        $conexion = $dbController->getDatabaseConnection();

        // Prepare and execute the query to fetch all ciudades
        $consulta = $conexion->query("SELECT * FROM CIUDAD");

        // Fetch all results as an associative array
        $rows = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
        $ciudades = array_map(fn($row) => new Ciudad($row['ID'], $row['NOMBRE']), $rows);
        $log = new Logger('app_logger');
        $log->pushHandler(new StreamHandler('/var/log/php_log4php.log'));
        //$log->info("Retrieved ciudades from the database");
        //$log->info(var_dump($ciudades));
        return $ciudades; // Return the list of ciudades from the database
    }
}