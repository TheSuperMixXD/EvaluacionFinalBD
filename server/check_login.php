<?php

session_start();

require 'conector.php';

$pass=$_POST['password'];
$email= $_POST['username'];
$con = new Conector('localhost', 'root', '');
$response['conexion'] = $con->initConexion('calendario');

if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($pass)) {
    if ($response['conexion'] == 'OK') {
        $resultado_consulta = $con->consultar(['usuarios'], ['*'], 'WHERE email="'.$email.'"');

        if ($resultado_consulta ->num_rows != 0) {
    			while ($fila = $resultado_consulta -> fetch_assoc()) {
    				$hashpass = $fila['password'];
    				$userResult = $fila['id'];
    			}
    			if (password_verify($pass, $hashpass)) {
    				$_SESSION['isLogin'] = true;
    				$_SESSION['userLogin'] = $userResult;
    				$response['msg'] = 'OK';
    			} else {
                    $response['msg'] = 'Contraseña incorrecta';
                }
		} else {
          $response['msg'] = 'El usuario no existe ';
        }
    } else {
        $response['msg'] = 'Problemas con la conexión a la base de datos';
    }
} else {
    $response['msg'] = 'Datos incorrectos';
}
  echo json_encode($response);
	$con->cerrarConexion();

?>
