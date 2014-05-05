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

  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";}

  $idM = $_GET['idM'];
  $evaluacionUrl = $_GET["eval"];
  $evaluacion = str_replace("_", " ", $evaluacionUrl);
  
  $sql_idO = "Select o.idO From ofrece As o Where o.semestre='".$semestreActual."' and o.idM='".$idM."'";
  $sql_deleteE = 'Delete From evaluado Where evaluacion="'.$evaluacion.'" and idO In ('.$sql_idO.')';
  $result = mysql_query($sql_deleteE);
  header("location:maestro.php?idM=".$idM);
?>