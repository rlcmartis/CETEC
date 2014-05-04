<?php
  session_start();
  if(!isset($_SESSION['idM'])){
    header("location:index.php");
  }
  //DATABASE CONECTION
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
  $idM = $_POST["idM"];
  $nombreEva = $_POST["nombreEva"];
  
  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";}

  $sqlIDO = 'Select * From ofrece Where idM = "'.$idM.'" and semestre = "'.$semestreActual.'"';
  $sqlIDOResult = mysql_query($sqlIDO);
  $row = mysql_fetch_row($sqlIDOResult);
  print_r($_POST);

  for ($i=0; $i < (sizeof($_POST) - 2)/2; $i++) { 
    $nota = "nota".$i;
    $id = "idE".$i;
    $sqlNota = 'Insert Into evaluado (nota, evaluacion, idO, idE) 
				Values ("'.$_POST[$nota].'", "'.$nombreEva.'", '.$row[3].', "'.$_POST[$id].'")';
    $sqlNotaResult = mysql_query($sqlNota);
  }
  header("location:maestro.php?idM=$idM");
?>
