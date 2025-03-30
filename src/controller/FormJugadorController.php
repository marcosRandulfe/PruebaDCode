<?php

namespace Duacode\Marcosrandulfe\controller;
require __DIR__ . '/../../vendor/autoload.php';
use Duacode\Marcosrandulfe\controller\JugadorController;
use Duacode\Marcosrandulfe\model\Equipo;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


$log = new Logger('app_logger');
    $log->pushHandler(new StreamHandler('/var/log/php_log4php.log'));
    $jugadorController = new JugadorController();

    if (isset($_GET['delete'])) {
        $jugadorController->eliminarJugadorPorId($_GET['delete']);
        $log->info("Borrado del jugador con ID: " . $_GET['delete']);
        $equipoId = $_GET['equipo'] ?? null;
        $log->info("ID EQUIPO AL QUE PERTENECE" . $_GET['equipo']);
        if ($equipoId) {
            header("Location: ../view/infoEquipo.php?id=$equipoId");
            exit;
        }
    }


    $nombre = $_POST['nombre'] ?? null;
    $numero = $_POST['numero'] ?? null;
    $log->info("Nombre jugador: " . $nombre);
    $esCapitan = isset($_POST['esCapitan']) ? true: false;
    $log->info("Es capitán: " . $esCapitan);
    $equipo = $_POST['equipo'] ?? null;
    $jugadorId = $_POST['jugadorId'] ?? null;
    $log->info("var dump: " . var_dump($_POST));
    if ($nombre && $numero) {
        try{
            $bd = new BDController();
            $conexion = $bd->getDatabaseConnection();
            $checkQuery = $conexion->prepare("SELECT COUNT(*) FROM JUGADOR WHERE NUMERO = ? AND EQUIPO_ID = ?");
            $checkQuery->bind_param("ii", $numero, $equipo);
            $checkQuery->execute();
            $checkQuery->bind_result($count);
            $checkQuery->fetch();
            $checkQuery->close();

            if ($count > 0) {
                echo "<script>alert('Ya existe un jugador con el número $numero en el equipo $equipo.');</script>";
                echo "Error: Ya existe un jugador con el número $numero en el equipo $equipo.";
                header("Location: ../view/infoEquipo.php?id=$equipo");
                exit;
            }

            if ($jugadorId) {
            // Modify existing player
            $jugador = $jugadorController->obtenerJugadorPorId($jugadorId);
            if ($jugador) {
                $jugador->setNombre($nombre);
                $jugador->setNumero($numero);
                $jugador->setCapitan($esCapitan);
                // Here you should add logic to update the jugador in the database
                $log->info("Jugador modificado: " . $jugador->getId());
                $jugadorController->actualizarJugadorPorId($jugador->getId(), $jugador->getNombre(), $jugador->getNumero(), $jugador->isCapitan(),$equipo);
            } else {
                $log->error("Jugador no encontrado: ID $jugadorId");
            }
        } else {
            // Create new player
            $jugadorController->guardarJugadorEnBaseDeDatos($nombre, $numero, $esCapitan, $equipo);
            $log->info("Nuevo jugador creado: nombre=$nombre, numero=$numero, equipo=$equipo");
        }}catch (Exception $e) {
        // Check if the number is already used by another player in the same team
        $existingJugador = $jugadorController->obtenerJugadoresPorEquipo($equipo);
        foreach ($existingJugador as $j) {
            if ($j->getNumero() == $numero && $j->getId() != $jugadorId) {
                echo "<script>alert('Número repetido para este equipo');</script>";
                exit;
            }
        }
        }
    } else {
        $log->error("Datos incompletos para crear/modificar jugador");
    }
    header("Location: ../view/infoEquipo.php?id=$equipo");