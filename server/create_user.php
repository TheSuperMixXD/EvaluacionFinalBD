<?php

require 'conector.php';
$con = new Conector('localhost', 'create_users', '12345');

$datos['nombre']="Juan Galeano";
$datos['email']="juan@gmail.com";
$datos['password']= password_hash("12345", PASSWORD_DEFAULT);
$datos['fecha_nacimiento']="1998-06-15";



if ($con->initConexion('calendario')=='OK') {
  echo $response['conexion']="OK";
  if ($resultado = $con->insertData('usuarios', $datos)) {
    echo $response['msg']="OK";
    echo "Insercion exitosa";
  }else echo "Error en la insercion";
}else echo "ERROR EN LA CONEXION";

echo json_encode($response);

 ?>
