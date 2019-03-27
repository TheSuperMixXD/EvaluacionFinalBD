<?php
session_start();
if($_SESSION['isLogin']){




require 'conector.php';
$con = new Conector('localhost', 'root', '');

$data['titulo'] = $_POST['titulo'];
$data['fecha_inicio'] = $_POST['start_date'];
$data['dia_completo'] = $_POST['allDay'];
$data['fecha_fin']= $_POST['end_date'];
$data['hora_fin'] = $_POST['end_hour'];
$data['hora_ini'] = $_POST['start_hour'];
$data['usuario'] = $_SESSION['userLogin'];

$titulo = $_POST['titulo'];




if ($con->initConexion('calendario')=='OK') {
  $response['conexion']="OK";
  if ($resultado = $con->insertData('evento', $data)) {
    $response['msg']="OK";
  }else  $response['msg']="Error en la insercion";
}else  $response['msg']="ERROR EN LA CONEXION";


echo json_encode($response);
}else {
 $response['msg']="ERROR EN LA SESION";
}

 ?>
