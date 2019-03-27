<?php

class Conector
{
  private $host;
  private $user;
  private $password;
  private $conexion;

  function __construct($host, $user, $password){
    $this->host = $host;
    $this->user = $user;
    $this->password = $password;
  }

  function initConexion($baseDatos) {
		$this ->conexion = new mysqli($this ->host, $this ->user, $this ->password, $baseDatos);
		if ($this->conexion->connect_error) {
			return "Error:" . $this->conexion->connect_error;
		} else {
			return "OK";
		}
	}

    function ejecutarQuery($query){
      return $this->conexion->query($query);
    }

    function cerrarConexion(){
      $this->conexion->close();
    }


    function consultar($tablas, $campos, $condicion = ""){
      $sql = "SELECT ";
      $a = array_keys($campos);
      $ultima_key = end($a);
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }

      $b = array_keys($tablas);
      $ultima_key = end($b);
      foreach ($tablas as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= " ";
      }

      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }
      return $this->ejecutarQuery($sql);
    }




    function insertData($tabla, $campos){
      $sql = 'INSERT INTO '.$tabla.' (';
      $i=1;
      foreach ($campos as $key => $value) {
        $sql .=$key;
        if ($i<count($campos)) {
          $sql.=', ';
        }else
          $sql.=') VALUES (';
          $i++;
      }
      $i=1;
      foreach ($campos as $key => $value) {
        $sql.="'".$value."'";
        if ($i<count($campos)) {
          $sql.=', ';
        }else
          $sql.=');';
          $i++;
      }
      return $this->ejecutarQuery($sql);
    }

    function actualizarRegistro($tabla, $data, $condicion) {
  $sql = 'UPDATE ' . $tabla . ' SET ';
  $i = 1;
  foreach ($data as $key => $value) {
    $sql .= $key . '="' . $value. '"';
    if ($i < sizeof($data)) {
      $sql .= ', ';
    } else
      $sql .= ' WHERE ' . $condicion . ';';
    $i++;
  }
  return $this -> ejecutarQuery($sql);
}


  function deleteReg($tabla, $condicion){
    $sql= 'DELETE FROM '.$tabla.' WHERE '.$condicion;
    return $this->ejecutarQuery($sql);
  }




}

 ?>
