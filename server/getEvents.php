<?php
session_start();
if($_SESSION['isLogin']){
	require ('conector.php');

	$con = new Conector('localhost', 'root', '');
	$response['conexion'] = $con -> initConexion('calendario');

	if ($response['conexion'] == 'OK') {
		$resultado = $con -> consultar(['evento'], ['*'], ' WHERE usuario="' . $_SESSION['userLogin'] . '"');

		if ($resultado->num_rows != 0) {
			$i=0;
			while ($fila = $resultado->fetch_assoc()) {
				$evento['id'] = $fila['id'];
				$evento['title'] = $fila['titulo'];
				if($fila['dia_completo'] == 1){
					$evento['start'] = $fila['fecha_inicio'];
					$evento['allDay'] = true;
				} else {
					$evento['start'] = $fila['fecha_inicio'].'T'.$fila['hora_ini'];
					$evento['end'] = $fila['fecha_fin'].'T'.$fila['hora_fin'];
					$evento['allDay'] = false;
				}
				$evento['color'] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
				$response['eventos'][$i] = $evento;
				$i++;
			}
			$response['msg'] = 'OK';

		}
	} else
		$response['msg'] = 'Problemas con la conexión a la base de datos';
} else
	$response['msg'] = 'Debe iniciar sesión';

echo json_encode($response);
?>
