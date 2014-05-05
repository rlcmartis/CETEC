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
 
  $nombre = $_POST['nombreM'];
  $idM = $_POST['idM'];
  $idC = $_POST['curso'];

  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";}

  $sqlVerifica = 'Select * From maestro Where idM ="'.$idM.'"';
  $resultado = mysql_query($sqlVerifica);

  if(mysql_num_rows($resultado) > 0){
    $password = $_POST['password'];
    $sql_update =  'Update maestro 
          Set idM="'.$idM.'", nombre="'.$nombre.'", password="'.$password.'" 
          Where idM="'.$idM.'"';
    $result = mysql_query($sql_update);
    
    header("location:secretariaFront.php");
	 // echo "El maestro que intentas añadir, ya existe.";
  //  echo '<a href="http://ada.uprrp.edu/~jdelacruz/CETEC/secretariaFront.php"> Ir Atras </a>';
  }
  else{
    $sql_insertM = 'Insert Into maestro (idM, nombre, password) 
	    			Values ("'.$idM.'","'.$nombre.'","'.$idM.'")';
    mysql_query($sql_insertM);
    // echo $sql_insertM;
    // echo "<br>";
    $sql_maestro_ofrece_C = 'Insert Into ofrece (semestre, idM, idC)
            Values ("'.$semestreActual.'", "'.$idM.'", "'.$idC.'")';
    mysql_query($sql_maestro_ofrece_C);
     // echo $sql_maestro_ofrece_C;
    header("location:secretariaFront.php");
  }
?>