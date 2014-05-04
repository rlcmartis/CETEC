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
  $table_Name = "estudiante"; 

  $idE = $_POST['idE'];
  
  $sql_deleteE = 'Delete From estudiante Where idE="'.$idE.'"';
  $result = mysql_query($sql_deleteE);
  header("location:secretariaFront.php")
?>