<?php
  session_start(); 
  $host = "localhost";
  $usuario = "jdelacruz";
  $password = "jjdl_cn@hotmail.com";
  $database = "CETEC";
  $conexion = mysql_connect($host, $usuario, $password);
  if (/*$conexion*/!$conexion){
  //   echo "Conexi&oacute;n realizada \n\n\n";
  // }
  // else{
    echo "Fall&oacute; conexi&oacute;n \n\n\n";
  }
  $usarDB = mysql_select_db($database);

  print_r($_POST);
  $postStuff = array();
  foreach ($_POST as $key => $value) {
    array_push($postStuff, $key);
  }
  
  if($postStuff[1] == 'idE'){
    $idE = $_POST['idE'];
    $password = $_POST['password'];
    $sql_update =  'UPDATE estudiante SET password = "'.$password.'" WHERE idE="'.$idE.'"';
    $result = mysql_query($sql_update);
    header("location:estudiante.php?".$idE);
  }
  elseif ($postStuff[1] == 'idM') {
    $idM = $_POST['idM'];
    $password = $_POST['password'];
    $sql_update =  'UPDATE maestro SET password = "'.$password.'" WHERE idM="'.$idM.'"';
    $result = mysql_query($sql_update);
    header('location:maestro.php?'.$idM);
  }
?>