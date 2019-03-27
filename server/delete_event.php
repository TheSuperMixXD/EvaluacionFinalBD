<?php
session_start();
if (isset($_SESSION['isLogin'])) {
  require 'conector.php';
  $con = new Conector('localhost', 'root', '');

  $evento = $_POST['id'];


  if ($con->initConexion('calendario')=='OK') {
    $response['conexion']="OK";
    if ($resultado = $con->deleteReg('evento', 'id='.$evento)) {
      $response['msg']='OK';
    }else $response['msg']='ERROR AL ELIMINAR EL EVENTO';
  }else $response['conexion']='ERROR AL CONECTAR A LA BD';
}else $response['conexion']='Debe iniciar sesion';

echo json_encode($response);


 ?>
