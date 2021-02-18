<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// RECEPCION DE POST DESDE JS

$service = (isset($_POST['service'])) ? $_POST['service'] : '';
$manager = (isset($_POST['manager'])) ? $_POST['manager'] : '';
$assistant = (isset($_POST['assistant'])) ? $_POST['assistant'] : '';
$nombreS = (isset($_POST['nombreS'])) ? $_POST['nombreS'] : '';
$descripS = (isset($_POST['descripS'])) ? $_POST['descripS'] : '';
$normS = (isset($_POST['normS'])) ? $_POST['normS'] : '';
$timeS = (isset($_POST['timeS'])) ? $_POST['timeS'] : '';
$accredS = (isset($_POST['accredS'])) ? $_POST['accredS'] : '';
$obsS = (isset($_POST['obsS'])) ? $_POST['obsS'] : '';
$costU = (isset($_POST['costU'])) ? $_POST['costU'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //ALTA
        $consulta = "INSERT INTO services (service, manager, assistant, nombreS, descripS, normS, timeS,accredS, obsS, costU) VALUES('$service', '$manager', '$assistant','$nombreS', '$descripS', '$normS', '$timeS', '$accredS', '$obsS', '$costU') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, service, manager, assistant, nombreS, descripS, normS, timeS,accredS, obsS, costU FROM services ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: //EDICION
        $consulta = "UPDATE services SET service='$service', manager='$manager', assistant='$assistant',nombreS='$nombreS', descripS='$descripS', normS='$normS', timeS='$timeS', accredS='$accredS', obsS='$obsS', costU='$costU' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, service, manager, assistant, nombreS, descripS, normS,timeS,accredS, obsS, costU FROM services WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 3://ELIMINACION
        $consulta = "DELETE FROM services WHERE nombreS='$nombreS' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;

   /*case 4://
        $conslta = "SELECT id, service FROM services WHERE service = "$service"";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        break;*/

}

print json_encode($data, JSON_UNESCAPED_UNICODE); //ENVIAR A JS
$conexion = NULL;
