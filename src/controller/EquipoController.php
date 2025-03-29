<?php

namespace Duacode\Marcosrandulfe\controller;
require __DIR__ . '/../../vendor/autoload.php';

use Duacode\Marcosrandulfe\model\Equipo;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class EquipoController
{

    public function crearEquipo($nombre, $ciudad, $deporte, $fechaFundacion)
    {
        // Create a new instance of the Equipo class
        $equipo = new Equipo(null, $nombre, $ciudad, $deporte, $fechaFundacion);

        // Here you can add logic to save the equipo instance to a database or perform other actions

        return $equipo; // Return the created Equipo object
    }


    public function guardarEquipoEnBaseDeDatos($nombre, $ciudad, $deporte, $fechaFundacion)
    {
        // Creamos el objeto Equipo
        // Log at the entry of the method
        $log = new Logger('app_logger');
        $log->info("Entering guardarEquipoEnBaseDeDatos with parameters: nombre=$nombre, ciudad=$ciudad, deporte=$deporte, fechaFundacion=$fechaFundacion");
        error_log("Entering guardarEquipoEnBaseDeDatos with parameters: nombre=$nombre, ciudad=$ciudad, deporte=$deporte, fechaFundacion=$fechaFundacion");

        $equipo = $this->crearEquipo($nombre, $ciudad, $deporte, $fechaFundacion);

        // Log at the start of the method
        error_log("Created Equipo object: " . print_r($equipo, true));
        $bd = new BDController();
        $conexion = $bd->getDatabaseConnection();
        // Prepare and execute the query to create a new equipo
        $consulta = $conexion->prepare("INSERT INTO EQUIPO (NOMBRE, CIUDAD_ID, DEPORTE, FECHA_FUNDACION) VALUES (?, ?, ?, ?)");
        $deporte1 = $equipo->getDeporte();
        $nombre1 = $equipo->getNombre();
        $ciudad1 = $equipo->getCiudad();
        $fechaFundacion1 = $equipo->getFechaFundacion();
        $consulta->bind_param('ssss', $nombre1, $ciudad1, $deporte1, $fechaFundacion1);
        $consulta->execute();
    }

    public function obtenerEquipoPorId($id)
    {
        // Assuming you have a database connection established
        $dbController = new BDController();
        $conexion = $dbController->getDatabaseConnection();

        // Prepare and execute the query to fetch the equipo by id
        $consulta = $conexion->prepare("SELECT * FROM EQUIPO WHERE ID = ?");
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $result = $consulta->get_result();
        $equipo = null;
        if ($row = $result->fetch_assoc()) {
            $equipo = new Equipo($row['ID'], $row['NOMBRE'], $row['CIUDAD_ID'], $row['DEPORTE'], $row['FECHA_FUNDACION']);
        }
        return $equipo;
    }

    public function obtenerEquipos()
    {
        // Assuming you have a database connection established
        $dbController = new BDController();
        $conexion = $dbController->getDatabaseConnection();

        // Prepare and execute the query to fetch all equipos
        $consulta = $conexion->query("SELECT * FROM EQUIPO");

        // Fetch all results as an associative array
        $rows = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
        $equipos = array_map(fn($row) => new Equipo($row['ID'], $row['NOMBRE'], $row['CIUDAD_ID'], $row['DEPORTE'], $row['FECHA_FUNDACION']), $rows);
        $log = new Logger('app_logger');
        $log->pushHandler(new StreamHandler('/var/log/php_log4php.log'));
        //$log->info("Retrieved equipos from the database");
        //$log->info(var_dump($equipos));
        return $equipos; // Return the list of equipos from the database
    }


}