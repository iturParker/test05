<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS

$nameClient = (isset($_POST['nameClient'])) ? $_POST['nameClient'] : '';
$noClient = (isset($_POST['noClient'])) ? $_POST['noClient'] : '';
$nameS = (isset($_POST['nameS'])) ? $_POST['nameS'] : '';
$area = (isset($_POST['area'])) ? $_POST['area'] : '';
$descripS = (isset($_POST['descripS'])) ? $_POST['descripS'] : '';
$normS = (isset($_POST['normS'])) ? $_POST['normS'] : '';
$timeS = (isset($_POST['timeS'])) ? $_POST['timeS'] : '';
$accredS = (isset($_POST['accredS'])) ? $_POST['accredS'] : '';
$obsS = (isset($_POST['obsS'])) ? $_POST['obsS'] : '';
$costU = (isset($_POST['costU'])) ? $_POST['costU'] : '';
$cant = (isset($_POST['cant'])) ? $_POST['cant'] : '';
$costT = (isset($_POST['costT'])) ? $_POST['costT'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO coti (nameClient, noClient, nameS, area, descripS, normS, timeS, accredS, obsS, costU, cant, costT)
        VALUES('$nameClient', '$noClient', '$nameS', '$area', '$descripS', '$normS', '$timeS', '$accredS', '$obsS', '$costU', '$cant', '$costT') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM coti ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE coti SET nameClient='$nameClient', noClient='$noClient', nameS='$nameS', area='$area', descripS='$descripS', normS='$normS', timeS='$timeS', accredS='$accredS', obsS='$obsS', costU='$costU', cant='$cant', costT='$costT' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM coti WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://baja
        $consulta = "DELETE FROM coti WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
