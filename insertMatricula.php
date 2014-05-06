<?php
session_start();
  if(!isset($_SESSION['idM']))
    {
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

  $idO = $_GET['idO'];

  $sql_ests = "Select e.idE From estudiante As e";
  $ests_result = mysql_query($sql_ests);
  $cantidadEstudiantes = mysql_num_rows($ests_result);

  $desmatricula = mysql_query('Delete From matriculado Where idO='.$idO);

  foreach ($_POST as $key => $value) {
    $matricula = mysql_query('Insert Into matriculado (idE, idO) Values ("'.$key.'", '.$idO.')');
  }
  header("location:secretariaFront.php");
?>