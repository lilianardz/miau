<?php

$conexion= new mysqli('localhost', 'liliana', '1234', 'Inventario');
$acentos=  $conexion->query("SET NAMES 'utf8'");
if($conexion -> connect_error){
    die('error de la conexion: '.$conexion->connect_error);
    }
?>