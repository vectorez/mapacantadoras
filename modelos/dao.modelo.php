<?php
require_once "conexion.php";

class ModeloDAO{
  static public function mdlMostrar($campo,$tabla,$condicion){
   if($condicion==""){
  				//si no tiene condicion
    $stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }else{
  				//si tiene condicion
    $stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  $stmt->close();
  $stmt = null;

}

static function mdlEnviarSMS($telefono, $strMensaje){
  $response='';
  $err='';
  $validaCreditos=ModeloDAO::mdlMostrarUnitario("proyectos_creditos_sms_i as cantidad", "sys_proyectos", "proyectos_id_i=".$_SESSION['proyectos']);
  if ($validaCreditos['cantidad']<=0) {
    $arrRespuesta = array('respuesta' => 'sin_saldo', 'resp' => $response, 'error' => $err);
    return $arrRespuesta;
  }else{
    $curl = curl_init();
    $query = http_build_query(array(
      'key'          => 'a8c2439de2f47deda7a6a817607df5718d9cbe8a5ea27b4fcba8b',
      'client'       => '1158',
      'phone'        => $telefono,
      'sms'          => $strMensaje,
      'country-code' => 'CO',
    ));

    curl_setopt_array($curl, array(
      CURLOPT_URL            => "https://www.onurix.com/api/v1/send-sms",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING       => "",
      CURLOPT_MAXREDIRS      => 10,
      CURLOPT_TIMEOUT        => 30,
      CURLOPT_POST           => 1,
      CURLOPT_POSTFIELDS     => $query,
      CURLOPT_HTTPHEADER     => array(
        "content-type: application/x-www-form-urlencoded",
      ),
    ));

    $response = curl_exec($curl);
    $err      = curl_error($curl);

    curl_close($curl);

    if ($err) {
      $respuesta = "error";
    } else {
      $respuesta = "ok";
      ModeloDAO::mdlEditar("sys_proyectos", "proyectos_creditos_sms_i=proyectos_creditos_sms_i-1", "proyectos_id_i=".$_SESSION['proyectos']);
    }

    $arrRespuesta = array('respuesta' => $respuesta, 'resp' => $response, 'error' => $err);
    return $arrRespuesta;
  }
}

static public function mdlMostrarGroupAndOrder($campo, $tabla, $condicion, $groupBy = null, $orderBy = null, $limit = null){
 if($condicion==""){
  				//si no tiene condicion
  $stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla $groupBy $orderBy $limit");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
  				//si tiene condicion
  $stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion $groupBy $orderBy $limit");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$stmt->close();
$stmt = null;

}

static public function mdlMostrarGroupAndOrderUnico($campo, $tabla, $condicion, $groupBy = null, $orderBy = null, $limit = null){
 if($condicion==""){
  				//si no tiene condicion
  $stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla $groupBy $orderBy $limit");
  $stmt->execute();
  return $stmt->fetch();
}else{
  				//si tiene condicion
  $stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion $groupBy $orderBy $limit");
  $stmt->execute();
  return $stmt->fetch();
}

$stmt->close();
$stmt = null;

}


static public function mdlMostrarUnitario($campo,$tabla,$condicion){
 if($condicion==""){
  				//si no tiene condicion
  $stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla");
  $stmt->execute();
  return $stmt->fetch();
}else{
  				//si tiene condicion
  $stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion");
  $stmt->execute();
  return $stmt->fetch();
}

$stmt->close();
$stmt = null;

}

static public function mdlCrear($tabla, $campos, $valores){
 $pdo  = Conexion::conectar();
 if ($valores=="") {
  $stmt = $pdo->prepare("INSERT INTO $tabla $campos");
}else{
  $stmt = $pdo->prepare("INSERT INTO $tabla ($campos) VALUES($valores)");
}
if($stmt->execute()){
  return $pdo->lastInsertId();
}else{
  return $stmt->errorInfo();
}
$stmt->close();
$stmt = null;
}


static public function mdlEditar($tabla, $datos, $condicion){
 $pdo  = Conexion::conectar();
 $stmt = $pdo->prepare("UPDATE $tabla SET $datos WHERE $condicion");
 if($stmt->execute()){
  return $stmt->rowCount();
}else{
  				//return $stmt->errorInfo();
  return 'error';
}
$stmt->close();
$stmt = null;
}

static public function mdlBorrar($tabla, $condicion){
 if($condicion==""){
  $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla");
}else{
  $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $condicion");
}
if($stmt -> execute()){
  return "ok";
}else{
  return $stmt->errorInfo();	
}
$stmt->close();
$stmt = null;
}

static public function mdlAlter($tabla,$opciones){

  			//si no tiene condicion
 $stmt = Conexion::conectar()->prepare("ALTER TABLE $tabla $opciones");
 if($stmt -> execute()){
  return 'ok';
}else{
  return $stmt->errorInfo();	
}
$stmt->close();
$stmt = null;

}

static public function mdlCreateIf($tabla,$opciones){

  			//si no tiene condicion
 $stmt = Conexion::conectar()->prepare("CREATE TABLE IF NOT EXISTS $tabla ($opciones)");
 if($stmt -> execute()){
  return 'ok';
}else{
  return $stmt->errorInfo();	
}
$stmt->close();
$stmt = null;

}

static public function mdlDrop($tabla){

  			//si no tiene condicion
 $stmt = Conexion::conectar()->prepare("DROP TABLE IF EXISTS $tabla");
 if($stmt -> execute()){
  return 'ok';
}else{
  return $stmt->errorInfo();	
}
$stmt->close();
$stmt = null;

}

static public function mdlGetNumrows($tabla, $condicion){
 if($condicion==""){
  $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
}else{
  $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $condicion");
}

$stmt -> execute();
$data_exists = ($stmt->fetchColumn() > 0) ? true : false;
return $data_exists;
$stmt -> close();
$stmt = null;
}

static public function mdlGeneraTokrn($longitud)
{
  if ($longitud < 4) {
    $longitud = 4;
  }
  return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
}

}