<?php
namespace Duacode\Marcosrandulfe\controller;

require __DIR__ . '/../../vendor/autoload.php';
use Duacode\Marcosrandulfe\model\Equipo;
use Duacode\Marcosrandulfe\model\Jugador;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use mysqli_sql_exception;


class JugadorController
{
    public function __construct()
    {
        $this->log = new Logger('app_logger');
        $this->log->pushHandler(new StreamHandler('/var/log/php_log4php.log'));
    }

    public function crearJugador($nombre, $numero, $esCapitan, $equipo)
    {
        // Create a new instance of the Jugador class
        $jugador = new Jugador(null, $nombre, $numero, $equipo, $esCapitan);

        // Here you can add logic to save the jugador instance to a database or perform other actions

        return $jugador; // Return the created Jugador object
    }


    public function guardarJugadorEnBaseDeDatos($nombre, $numero, $esCapitan, $equipo)
    {
        // Creamos el objeto Jugador
        // Log at the entry of the method
        try {
            $this->log->info("Entering guardarJugadorEnBaseDeDatos with parameters: nombre=$nombre, numero=$numero, esCapitan=$esCapitan, equipo=" . $equipo);

            $jugador = $this->crearJugador($nombre, $numero, $esCapitan, $equipo);

            // Log at the start of the method
            $bd = new BDController();
            $conexion = $bd->getDatabaseConnection();
            // Prepare and execute the query to create a new jugador
            $consulta = $conexion->prepare("INSERT INTO JUGADOR (NOMBRE, NUMERO, ES_CAPITAN, EQUIPO_ID) VALUES (?, ?, ?, ?)");
            $numero1 = $jugador->getNumero();
            $nombre1 = $jugador->getNombre();
            $esCapitan1 = $jugador->isCapitan();
            $equipo1 = $jugador->getEquipo();
            $consulta->bind_param('ssis', $nombre1, $numero1, $esCapitan1, $equipo1);
            $consulta->execute();
        }catch (Exception | mysqli_sql_exception $e) {
            $this->log->error("Error in guardarJugadorEnBaseDeDatos: " . $e->getMessage());
            throw $e;
        }
    }

public function actualizarJugadorPorId($id, $nombre, $numero, $esCapitan, $equipoId)
{
    // Assuming you have a database connection established
    $dbController = new BDController();
    $conexion = $dbController->getDatabaseConnection();
    if($esCapitan){
        $this->desmarcarCapitanesPorEquipo($equipoId);
    }
    // Prepare and execute the query to update the jugador by id
    $consulta = $conexion->prepare("UPDATE JUGADOR SET NOMBRE = ?, NUMERO = ?, ES_CAPITAN = ? WHERE ID = ?");
    $consulta->bind_param('siii', $nombre, $numero, $esCapitan, $id);
    $consulta->execute();
}


    /**
     * Obtiene un objeto Jugador a partir de su id
     * @param int $id El id del jugador a buscar
     * @return Jugador|null El objeto Jugador si se encuentra, null en caso contrario
     */
    public function obtenerJugadorPorId($id): ?Jugador
    {
        // Assuming you have a database connection established
        $dbController = new BDController();
        $conexion = $dbController->getDatabaseConnection();

        // Prepare and execute the query to fetch the jugador by id
        $consulta = $conexion->prepare("SELECT * FROM JUGADOR WHERE ID = ?");
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $result = $consulta->get_result();
        $jugador = null;
        if ($row = $result->fetch_assoc()) {
            $jugador = new Jugador($row['ID'], $row['NOMBRE'], $row['NUMERO'], $row['EQUIPO_ID'], $row['ES_CAPITAN']);
        }
        return $jugador;
    }

    public function obtenerJugadoresPorEquipo($equipoId)
    {
        // Assuming you have a database connection established
        $dbController = new BDController();
        $conexion = $dbController->getDatabaseConnection();

        // Prepare and execute the query to fetch all jugadores of the given equipo
        $consulta = $conexion->prepare("SELECT * FROM JUGADOR WHERE EQUIPO_ID = ?");
        $consulta->bind_param('i', $equipoId);
        $consulta->execute();
        $result = $consulta->get_result();

        // Fetch all results as an associative array
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $jugadores = array_map(fn($row) => new Jugador($row['ID'], $row['NOMBRE'], $row['NUMERO'],$row['EQUIPO_ID'], $row['ES_CAPITAN'] ), $rows);

        return $jugadores;
    }


    public function eliminarJugadorPorId($id)
    {
        // Assuming you have a database connection established
        $dbController = new BDController();
        $conexion = $dbController->getDatabaseConnection();

        // Prepare and execute the query to delete the jugador by id
        $consulta = $conexion->prepare("DELETE FROM JUGADOR WHERE ID = ?");
        $consulta->bind_param('i', $id);
        $consulta->execute();
    }

    public function desmarcarCapitanesPorEquipo($equipoId)
    {
        // Assuming you have a database connection established
        $dbController = new BDController();
        $conexion = $dbController->getDatabaseConnection();

        // Prepare and execute the query to set ES_CAPITAN to false for all players in the given team
        $consulta = $conexion->prepare("UPDATE JUGADOR SET ES_CAPITAN = 0 WHERE EQUIPO_ID = ?");
        $consulta->bind_param('i', $equipoId);
        $consulta->execute();
    }
}