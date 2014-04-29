<?php

 session_start();
	if(!isset($_SESSION['idE']))
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
  $idE = $_GET["idE"];
?>

<html>
	<head>
  		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link href="css/bootstrap.css" rel="stylesheet">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
     	<link href="css/cetec.css" rel="stylesheet">

		<title>Estudiante</title>
	</head>
	<body>
		<div class="jumbotron" id="nombre-num">
			<div class= "row" id="lineaDeSesion"> 
				<div class="col-md-11 col-md-offset-6">
					<a href="logout.php">Cerrar Sesión</a>				
				</div>
			</div>
			<h1>Nombre: <?php 
				$sql_nombre = "Select nombre From estudiante Where idE=".$idE;
  				$resultado = mysql_query($sql_nombre);
  				$row = mysql_fetch_row($resultado);
  				echo $row[0];
			?></h1>
			<h3 id="h-num">Numero de estudiante: <?php echo $idE; ?></h3>
		</div>
		
		<ul class="nav nav-tabs nav-justified" id="myTab">
		  <li class="active"><a href="#curso1" data-toggle="tab">Curso 1</a></li>
		  <li><a href="#curso2" data-toggle="tab">Curso 2</a></li>
		  <li><a href="#curso3" data-toggle="tab">Curso 3</a></li>
		</ul>

		<!-- Tab Panes -->
		<div class="tab-content">
			<div class="tab-pane active" id ="curso1">
				<table class="table">
				<thead colspan="3">Tabla de curso 1</thead>
				<tbody>
					<tr>
						<?php
							for ($colu = 0; $colu < 3; $colu++) {echo "<td>";}
						?>
						Listo
						<?php
							for ($colu = 0; $colu < 3; $colu++) {echo "</td>";}
						?>
					</tr>
					<tr></tr>
				</tbody>
				</table>
			</div>



		<div class="tab-pane" id="curso2">
			Hellooooooooo
		</div>

		<div class="tab-pane" id="curso3">
			HOLAAAAAAAA
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
    <script>
  $(function () {
    $('#myTab a:first').tab('show')
  })
	</body>
</html>
