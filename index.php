<?php
include './src/view/templates/header.html';

require __DIR__ . '/vendor/autoload.php';

use Duacode\Marcosrandulfe\controller\EquipoController;

$equipController = new EquipoController();
$equipos = $equipController->obtenerEquipos();

?>
<main class="container mx-auto p-4">
    <div class="flex justify-between items-center">
        <p class="text-lg">Página principal</p>
<?php
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
        <a href="<?php echo dirname($currentUrl); ?>/src/view/form.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Crear Equipo
        </a>
    </div>
<table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr>
            <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                Nombre
            </th>
            <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                Ciudad
            </th>
            <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                Deporte
            </th>
            <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                Fecha de Fundación
            </th>
        </tr>
    </thead>

    <tbody>
        <!-- Aquí irían las filas de los equipos, por ejemplo: -->
    <?php
        foreach ($equipos as $equipo) {
            $id = $equipo->getId();
            echo <<<EOD
            <tr onclick="window.location.href='src/view/infoEquipo.php?id=$id'">
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                {$equipo->getNombre()}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                {$equipo->getCiudad()}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                {$equipo->getDeporte()}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                {$equipo->getFechaFundacion()}
            </td>
        </tr>
EOD;
        }
    ?>


        <!-- Agrega más filas según sea necesario -->
    </tbody>
</table>
</main>
<?php
include './src/view/templates/footer.html';
