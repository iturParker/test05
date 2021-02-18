<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// RECEPCION DE POST DESDE JS

$nombreDelCliente = (isset($_POST['nombreDelCliente'])) ? $_POST['nombreDelCliente'] : '';
$rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';
$dirFis = (isset($_POST['dirFis'])) ? $_POST['dirFis'] : '';
$dirFi = (isset($_POST['dirFi'])) ? $_POST['dirFi'] : '';
$nCon1 = (isset($_POST['nCon1'])) ? $_POST['nCon1'] : '';
$nCon2 = (isset($_POST['nCon2'])) ? $_POST['nCon2'] : '';
$pCon1 = (isset($_POST['pCon1'])) ? $_POST['pCon1'] : '';
$pCon2 = (isset($_POST['pCon2'])) ? $_POST['pCon2'] : '';
$tCon1 = (isset($_POST['tCon1'])) ? $_POST['tCon1'] : '';
$tCon2 = (isset($_POST['tCon2'])) ? $_POST['tCon2'] : '';
$mCon1 = (isset($_POST['mCon1'])) ? $_POST['mCon1'] : '';
$mCon2 = (isset($_POST['mCon2'])) ? $_POST['mCon2'] : '';
$tPago = (isset($_POST['tPago'])) ? $_POST['tPago'] : '';
$pPago = (isset($_POST['pPago'])) ? $_POST['pPago'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //ALTA
        $consulta = "INSERT INTO client (nombreDelCliente, rfc, dirFis, dirFi, nCon1, nCon2, pCon1, pCon2, tCon1, tCon2, mCon1, mCon2,tPago,pPago)
        VALUES('$nombreDelCliente', '$rfc', '$dirFis', '$dirFi', '$nCon1', '$nCon2', '$pCon1', '$pCon2', '$tCon1', '$tCon2', '$mCon1', '$mCon2', '$tPago', '$pPago') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombreDelCliente, rfc, dirFis, dirFi, nCon1, nCon2, pCon1, pCon2, tCon1, tCon2, mCon1, mCon2,tPago,pPago FROM client ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: //EDICION
        $consulta = "UPDATE client SET nombreDelCliente='$nombreDelCliente', rfc='$rfc', dirFis='$dirFis', dirFi='$dirFi',
        nCon1='$nCon1', nCon2='$nCon2', pCon1='$pCon1', pCon2='$pCon2', tCon1='$tCon1', tCon2='$tCon2', mCon1='$mCon1', mCon2='$mCon2', tPago='$tPago', pPago='$pPago' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombreDelCliente, rfc, dirFis, dirFi, nCon1, nCon2, pCon1, pCon2,, tCon1, tCon2, mCon1, mCon2, tPago, pPago FROM client WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 3://ELIMINACION
        $consulta = "DELETE FROM client WHERE nombreDelCliente='$nombreDelCliente' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;

   /*case 4://
        $conslta = "SELECT id, nombreDelCliente FROM client WHERE nombreDelCliente = "$nombreDelCliente"";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        break;*/

}

print json_encode($data, JSON_UNESCAPED_UNICODE); //ENVIAR A JS
$conexion = NULL;
