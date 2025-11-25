<?php
namespace TECWEB\MyApi;

abstract class DataBase {
    protected $conexion;

    public function __construct($db, $user = 'root', $pass = 'straykids8_') {
        $this->conexion = @mysqli_connect(
            'localhost',
            $user,
            $pass,
            $db
        );
    
        if(!$this->conexion) {
            die('¡Base de datos NO conectada!');
        }
    }
}
?>