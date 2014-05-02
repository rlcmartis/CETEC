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
	if ($conexion){
	  echo "Coneccion realizada \n\n\n";
	}
	else{
	  echo "Falló coneccion \n";
	}
	$usarDB = mysql_select_db($database);
	$idM = $_POST["idM"];
	$nombreEva = $_POST["nombreEva"];
	$semestreActual = "00A"; 
	$sqlIDO = 'SELECT * from ofrece where idM = "'.$idM.'" and semestre = "'.$semestreActual.'"';
	$sqlIDOResult = mysql_query($sqlIDO);
	$row = mysql_fetch_row($sqlIDOResult);
	print_r($_POST);

	for ($i=0; $i < (sizeof($_POST) - 2)/2; $i++) { 
		$nota = "nota".$i;
		$id = "idE".$i;
		$sqlNota = 'INSERT into evaluado (nota, evaluacion, idO, idE) 
					values ("'.$_POST[$nota].'", "'.$nombreEva.'", '.$row[3].', "'.$_POST[$id].'")';
		$sqlNotaResult = mysql_query($sqlNota);
	}
	header("location:maestro.php?idM=$idM");

?>
