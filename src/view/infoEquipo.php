<?php

use Duacode\Marcosrandulfe\controller\EquipoController;
use Duacode\Marcosrandulfe\controller\JugadorController;

require __DIR__ . '../../../vendor/autoload.php';
$equipoController = new EquipoController();
$idEquipo = $_GET['id'];
$equipo = $equipoController->obtenerEquipoPorId($idEquipo);
$currentUrl = "http://$_SERVER[HTTP_HOST]";
include './templates/header.html';
?>
<main class="container mx-auto p-4">
    <header>
        <div class="flex justify-end">
            <a href="../../index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Volver al inicio
            </a>
        </div>
    </header>
    <section>
        <articel>
    <h1 class="text-3xl font-bold mb-4">Nombre del equipo: <?= $equipo->getNombre() ?></h1>
    <p class="mb-4">Ciudad: <?= $equipo->getCiudad() ?></p>
    <p class="mb-4">Deporte: <?= $equipo->getDeporte() ?></p>
    <p class="mb-4">Fecha de fundación: <?= $equipo->getFechaFundacion() ?></p>
    <p class="mb-4">
        <a href="<?= dirname($currentUrl) ?>/DuacodeMarcosRandulfe/src/view/JugadorView.php?equipo=<?= $equipo->getId() ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Crear jugador
        </a>
    </p>
        </articel>
        <article>
            <p class="mb-4 font-bold">Capitán:</p>
            <?php
            try {
                $capitan = $equipo->obtenerCapitan();
            }catch (Exception $e){
                $capitan = false;
            }
            if ($capitan) {
                $nombreCapitan = $capitan->getNombre();
                echo "<p class='mb-4'>$nombreCapitan</p>";
            } else {
                echo "<p class='mb-4'>No hay capitán</p>";
            }
            ?>
        </article>
    </section>
    <h2 class="text-2xl font-bold mb-4">Jugadores</h2>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                    Nombre
                </th>
                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                    Numero
                </th>
                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                    Eliminar
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $jugadorController = new \Duacode\Marcosrandulfe\controller\JugadorController();
                $jugadores = $jugadorController->obtenerJugadoresPorEquipo($idEquipo);
                foreach ($jugadores as $jugador) {
                        echo '<tr>';
                        echo '<td onclick="window.location.href=\'' . dirname($currentUrl) . '/DuacodeMarcosRandulfe/src/view/JugadorView.php?id=' . $jugador->getId() . '\'" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">' . $jugador->getNombre() . '</td>';
                        echo '<td onclick="window.location.href=\'' . dirname($currentUrl) . '/DuacodeMarcosRandulfe/src/view/JugadorView.php?id=' . $jugador->getId() . '\'" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">' . $jugador->getNumero() . '</td>';
                        echo '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"><button onclick="if(confirm(\'Desea eliminar al jugador?\')){window.location.href=\'' . dirname($currentUrl) . '/DuacodeMarcosRandulfe/src/controller/FormJugadorController.php?delete=' . $jugador->getId() . '&equipo=' . $idEquipo . '\'}"><span class="material-icons">delete</span></button></td>';
                        echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</main>
</body>
</html>