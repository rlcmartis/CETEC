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
 
  $nombre = $_POST['nombreE'];
  $fechaA = $_POST['fechaA'];
  $fechaG = $_POST['fechaG'];
  $idE = $_POST['idE'];

  if(isset($_POST['grupo'])){
	  if ($_POST['grupo'] == "Grupo 1") {
      $grupo = 1;
    }
	  elseif ($_POST['grupo'] == "Grupo 2") {
	    $grupo = 2;
	  }
	  else{
	    $grupo = 3;
	  }

	  if (isset($_POST['pago'])) {
	    $pago = 1;
	  }
	  else {
      $pago = 0;
  	}
  }
  else{
    $grupo = 0;
  }
  
  $sqlVerifica = 'Select * From estudiante Where idE ="'.$idE.'"';
  $resultado = mysql_query($sqlVerifica);

  if(mysql_num_rows($resultado) > 0){
	$password = $_POST['password'];
  $sql_update =  'Update estudiante 
  Set nombre="'.$nombre.'", pago='.$pago.', entro="'.$fechaA.'", 
     sale="'.$fechaG.'", idE="'.$idE.'", password = "'.$password.'" Grupo = '.$grupo.'
  Where idE='.$idE;
  $result = mysql_query($sql_update);
  header("location:secretariaFront.php”);
  }
  else{
    $sql_insertE = 'Insert Into estudiante (nombre, pago, entro, sale, idE, password) 
	    			Values ("'.$nombre.'",'.$pago.',"'.$fechaA.'","'.$fechaG.'","'.$idE.'","'.$idE.'")';
    $result = mysql_query($sql_insertE);
    header("location:secretariaFront.php");
  }
?>