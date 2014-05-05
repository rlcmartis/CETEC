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
	$idM = $_POST["idM"];
  $evaluacionUrl = $_GET["eval"];
  $evaluacion = str_replace("_", " ", $evaluacionUrl);
  
  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";}

  $sql_idO = "Select o.idO From ofrece As o Where o.semestre='".$semestreActual."' and o.idM='".$idM."'";
  $idOResult = mysql_query($sql_idO);
  $idO = mysql_fetch_row($idOResult);

  $sql_ests = "Select e.idE From estudiante As e Natural Join matriculado As m Where m.idO In (".$sql_idO.")";
  $ests_result = mysql_query($sql_ests);
  $cantidadEstudiantes = mysql_num_rows($ests_result);

  for ($id=0; $id < $cantidadEstudiantes ; $id++) { 
    $casilla = $_POST[$id];
    $row = mysql_fetch_row($ests_result);
    $idE = $row[0];

    $sql_verifica = "Select * From evaluado Where idE='".$idE."' and evaluacion='".$evaluacion."' and idO In (".$sql_idO.")";
    $veriResult = mysql_query($sql_verifica);
    echo($veriResult);
    if(mysql_num_rows($veriResult) > 0){
      $sql_update =  "Update evaluado Set nota='".$casilla."'
                      Where idE='".$idE."' and evaluacion='".$evaluacion."' and idO In (".$sql_idO.")";
      echo $sql_update;
      $result = mysql_query($sql_update);
    }
    else{
      $sql_insert =  "Insert Into evaluado (nota, idE, evaluacion, idO)
                      Values ('".$casilla."', '".$idE."', '".$evaluacion."', ".$idO[0].")";
      echo $sql_insert;
      $resulta = mysql_query($sql_insert);
    }
  }
  header("location:maestro.php?idM=".$idM);
?>