<?php

session_start();
if (isset($_SESSION['isLogin'])) {
  require 'conector.php';
  $con = new Conector('localhost', 'root', '');


  if ($con->initConexion('calendario')=='OK') {
  $datos['fecha_inicio'] = $_POST['start_date'];
  $datos['hora_ini'] = $_POST['start_hour'];
  $datos['fecha_fin'] = $_POST['end_date'];
  $datos['hora_fin'] = $_POST['end_hour'];

if ($con->actualizarRegistro('evento', $datos, 'id= '.$_POST['id'])) {
  $response['msg'] = 'OK';
}else
  $response['msg'] = 'Error al actualizar el evento';

}else
$response['msg'] = 'Error al conectar con la BD';

}else
$response['msg']="Debe iniciar sesión";


echo json_encode($response);
