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
	  $idM = $_GET["idM"];
?>

<html>
	<head>
  		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link href="css/bootstrap.css" rel="stylesheet">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
     	<link href="css/cetec.css" rel="stylesheet">

		<title>Maestro</title>
	</head>
	<body>

		<div class="jumbotron" id="nombre-num">
			<div class= "row" id="lineaDeSesion"> 
				<div class="col-md-10 col-md-offset-6">
					<a href="nada">Añadir Notas</a>	
					&nbsp;&nbsp;&nbsp;| &nbsp;
					<a href="logout.php">Cerrar Sesión</a>				
				</div>
			</div>

			<h1>Nombre:  <?php 
				$sql_nombre = "SELECT nombre From maestro Where idM=".$idM;
  				$resultado = mysql_query($sql_nombre);
  				$row = mysql_fetch_row($resultado);
  				echo $row[0];
			?></h1>
			<h3 id="h-num">Nombre del curso actual: UnNombre</h3>
		</div>

		<ul class="nav nav-tabs nav-justified" id="myTab">
		  <li class="active"><a href="#grupo1" data-toggle="tab">Grupo 1</a></li>
		  <li><a href="#grupo2" data-toggle="tab">Grupo 2</a></li>
		  <li><a href="#grupo3" data-toggle="tab">Grupo 3</a></li>
		</ul>

		<!-- Tab Panes -->
		<div class="tab-content">
			<div class="tab-pane active" id ="grupo1">
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

		<div class="tab-pane" id="grupo2">
			Hellooooooooo
		</div>

		<div class="tab-pane" id="grupo3">
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
