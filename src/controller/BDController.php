<?php
namespace Duacode\Marcosrandulfe\controller;
require __DIR__ . '/../../vendor/autoload.php';
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class BDController
{
    public function getDatabaseConnection()
    {
        $log = new Logger('app_logger');
        $log->pushHandler(new StreamHandler('/var/log/php_log4php.log'));

        $host = '127.0.0.1';
        $dbname = 'mydatabase';
        $username = 'root'; // replace with actual username
        $password = 'myrootpassword'; // replace with actual password

        try {
            $log->debug("creando error en la aplicacion");
            $conexion = new \mysqli($host, $username, $password, $dbname);
            if ($conexion->connect_error){
                $log->error("Error en la base de datos");
                $log->error($conexion->connect_error);
                echo 'Connection failed: ' . $conexion->connect_error;
            }
            return $conexion;
        } catch (Exception $e) {
            $log->error("Error en la base de datos");
            $log->error($e->getMessage());
            echo 'Error: ' . $e->getMessage();
        }
    }
}