<?php
include './templates/header.html';
require __DIR__ . '../../../vendor/autoload.php';
        $ciudadController = new \Duacode\Marcosrandulfe\controller\CiudadController();
        $ciudades = $ciudadController->obtenerCiudades();
?>
    <main class="container mx-auto p-4">
    <div class="flex justify-between items-center">
    </div>
    <h3 class="text-xl font-bold mb-4">Crear Equipo</h3>
        <?php
        $currentUrl = "http://$_SERVER[HTTP_HOST]";
        ?>
    <form action="<?php echo $currentUrl; ?>/DuacodeMarcosRandulfe/src/controller/FormEquipoController.php" action="form.php" method="post" class="space-y-4" onsubmit="return validarFormulario()">
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        </div>
        <div>
            <label for="ciudad" class="block text-sm font-medium text-gray-700">Ciudad</label>
            <select name="ciudad" id="ciudad" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                <option value="">Seleccione una ciudad</option>
                <?php foreach ($ciudades as $ciudad) {
                    echo "<option value='" . $ciudad->getId() . "'>" . $ciudad->getNombre() . "</option>";
                } ?>
            </select>
        </div>
        <div>
            <label for="deporte" class="block text-sm font-medium text-gray-700">Deporte</label>
            <input type="text" name="deporte" id="deporte" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        </div>
        <div>
            <label for="fechaFundacion" class="block text-sm font-medium text-gray-700">Fecha de Fundación</label>
            <input type="date" name="fechaFundacion" id="fechaFundacion" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required
            max="<?php echo date('Y-m-d'); ?>">
        </div>
        <button type="submit" class="mt-4 w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Crear
        </button>
    </form>
    <div id="mensajeError" class="hidden mt-4 text-red-600 text-sm"></div>
</main>
<?php
include './templates/footer.html';
?>
<script>
    function validarFormulario(){
        var nombre = document.getElementById("nombre").value;
        var ciudad = document.getElementById("ciudad").value;
        var deporte = document.getElementById("deporte").value;
        var fechaFundacion = document.getElementById("fechaFundacion").value;

        if(nombre.trim() === "" || ciudad.trim() === "" || deporte.trim() === "" || fechaFundacion.trim() === ""){
            document.getElementById("mensajeError").innerHTML = "Debes completar todos los campos";
            document.getElementById("mensajeError").classList.remove("hidden");
            return false;
        }

        return true;
    }
</script>