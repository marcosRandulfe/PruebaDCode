<?php

use Duacode\Marcosrandulfe\controller\EquipoController;

require __DIR__ . '../../../vendor/autoload.php';
$equipoController = new EquipoController();
$equipo = $equipoController->obtenerEquipoPorId($_GET['id']);
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info del equipo</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<main class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4"><?= $equipo->getNombre() ?></h1>
    <p class="mb-4">Ciudad: <?= $equipo->getCiudad() ?></p>
    <p class="mb-4">Deporte: <?= $equipo->getDeporte() ?></p>
    <p class="mb-4">Fecha de fundación: <?= $equipo->getFechaFundacion() ?></p>
    <p class="mb-4">
        <a href="../../index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Volver al inicio
        </a>
    </p>
</main>
</body>
</html>