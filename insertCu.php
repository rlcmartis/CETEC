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
  $table_Name = "curso"; 
  $nombre = $_POST['nombreC'];
  $idC = $_POST['idC'];

  $sqlVerifica = 'Select * From curso Where idC ="'.$idC.'"';
  $resultado = mysql_query($sqlVerifica);
  if(mysql_num_rows($resultado) > 0){
    $sql_update =  'Update curso 
          Set idC="'.$idC.'", nombre="'.$nombre.'" 
          Where idC="'.$idC.'"';
    $result = mysql_query($sql_update);
    
    header("location:secretariaFront.php");
	 // echo "El curso que intentas añadir, ya existe.";
  //  echo '<a href="http://ada.uprrp.edu/~jdelacruz/CETEC/secretariaFront.php"> Ir Atras </a>';
  }
  else{
    $sql_insertC = 'Insert Into curso (idC, nombre) 
	    			Values ("'.$idC.'","'.$nombre.'")';
    $result = mysql_query($sql_insertC);
    header("location:secretariaFront.php");
  }
?>