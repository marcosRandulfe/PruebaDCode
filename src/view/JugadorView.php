<?php include __DIR__ . '/templates/header.html';
require_once __DIR__ . '/../../vendor/autoload.php';
use Duacode\Marcosrandulfe\controller\JugadorController;
?>
    <main class="container mx-auto p-4">

    <header>
        <h1 class="text-3xl font-bold mb-4">Crear/Editar Jugador</h1>
    </header>
    <?php
    $jugador = null;
    $equipoId = null;
    if (isset($_GET['id'])) {
        $jugadorController = new JugadorController();
        $jugador = $jugadorController->obtenerJugadorPorId($_GET['id']);
        $equipoId = $jugador->getEquipo();
    }else{
        $equipoId = $_GET['equipo'] ?? null;
    }
$currentUrl = "http://$_SERVER[HTTP_HOST]";
    ?>
    <form action="<?php echo $currentUrl; ?>/DuacodeMarcosRandulfe/src/controller/FormJugadorController.php" method="post" class="space-y-4 mx-4 md:mx-0 mt-4 md:mt-0">
        <input type="hidden" name="jugadorId" value="<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>">
        <input type="hidden" name="equipo" value="<?=$equipoId;?>">
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= isset($jugador) ? $jugador->getNombre() : ''; ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        </div>
        <div>
            <label for="numero" class="block text-sm font-medium text-gray-700">Numero</label>
            <input type="number" name="numero" id="numero" value="<?= isset($jugador) ? $jugador->getNumero() : ''; ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        </div>
        <div class="flex items-center">
            <input type="checkbox" name="esCapitan" id="esCapitan" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" <?= isset($jugador) && $jugador->isCapitan() ? 'checked' : ''; ?>>
            <label for="esCapitan" class="ml-2 block text-sm font-medium text-gray-700">Es Capitan</label>
        </div>
        <button type="submit" class="mt-4 w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Guardar</button>
    </form>
    </main>
<?php
    $currentDir = dirname(__FILE__);
    include $currentDir . '/templates/footer.html';