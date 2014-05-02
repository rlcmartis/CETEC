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
  if ($conexion){
    echo "Conexi&oacute;n realizada \n\n\n";
  }
  else{
    echo "Fall&oacute; conexi&oacute;n \n\n\n";
  }
  $usarDB = mysql_select_db($database);

  $idM = $_GET["idM"];
  $semestreActual = "00A"; 
  //sacando las evaluaciones que ha echo el profesor
  $sqleva = 'Select evaluacion from evaluado where idO IN (Select idO from ofrece where idM ='.$idM.')'; 
  $sqleva_Result = mysql_query($sqleva);
  $evaluaciones = array();
  while($array = mysql_fetch_array($sqleva_Result)){
    array_push($evaluaciones, $array[0]);
  }

  $evaluacionesNoDupli = (array_unique($evaluaciones)); //elimino las evaluaciones duplicadas
  $newEvaluaciones = array();
  $cantidadDeEvaluaciones = sizeof($evaluacionesNoDupli);
  foreach ($evaluacionesNoDupli as $value) {
    array_push($newEvaluaciones, $value);
  }
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
					<a href= <?php echo "newEva.php?idM=$idM"; ?>>Añadir Notas</a>	
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
				<table style="width:1000px">
					<?php
						echo "<th> Nombre de estudiante </th>";
						for ($i=0; $i < sizeof($newEvaluaciones); $i++) { 
							echo "<th>".$newEvaluaciones[$i]."</th>";
						}
						$sqlIDgrupo1 = 	'SELECT idE 
										from estudiante 
									   	where Grupo = 1 and idE in 
									   	(	SELECT idE 
									   		FROM matriculado 
									   		WHERE idO IN (	SELECT idO 
									   						FROM ofrece 
									   						WHERE idM = "'.$idM.'" and semestre = "'.$semestreActual.'"))';
						$sqlIDgrupo1Result = mysql_query($sqlIDgrupo1);

						while ($row = mysql_fetch_row($sqlIDgrupo1Result)){
							$sqlNombreGrupo1 = "SELECT nombre from estudiante where idE=$row[0]";
							$sqlNombreGrupo1Result = mysql_query($sqlNombreGrupo1);
							$rowNombre = mysql_fetch_row($sqlNombreGrupo1Result);
							$sqlNotasGrupo1 = 'SELECT nota from evaluado where idE = "'.$row[0].'" and idE IN(
												SELECT idE 
												from estudiante 
											   	where Grupo = 1 and idE in 
											   	(	SELECT idE 
											   		FROM matriculado 
											   		WHERE idO IN (	SELECT idO 
											   						FROM ofrece 
											   						WHERE idM = "'.$idM.'" and semestre = "'.$semestreActual.'"))
												)';

							$sqlNotasGrupo1Result = mysql_query($sqlNotasGrupo1);

							$notasEstudiante = array();

							while ($array = mysql_fetch_row($sqlNotasGrupo1Result)) {
								array_push($notasEstudiante, $array[0]);
							}
							echo "<tr>";
							echo "<td>".$rowNombre[0]."</td>";

							//este for me despliega las notas 
							for ($i=0; $i < $cantidadDeEvaluaciones; $i++) { 
								$sqlnota = 'SELECT nota from evaluado 
											where idE = "'.$row[0].'" and evaluacion = "'.$newEvaluaciones[$i].'"';
								$sqlnotaResult = mysql_query($sqlnota);
								if(mysql_num_rows($sqlnotaResult) == 0){ //si sqlnota me devuelve una tabla vacia 
									echo "<td> </td>";					//significa que ese estudiante no tiene nota 
																		//para esa evaluacion y por lo tanto la despliego vacia
									
								}
								else{
									$arrayNotas = mysql_fetch_array($sqlnotaResult);
									echo "<td>".$arrayNotas[0]."</td>";
								}
							}
							echo "</tr>";

						}
					?>

	            </table>
			</div>

		<div class="tab-pane" id="grupo2">
			<table style="width:1000px">
					<?php
						echo "<th> Nombre de estudiante </th>";
						for ($i=0; $i < sizeof($newEvaluaciones); $i++) { 
							echo "<th>".$newEvaluaciones[$i]."</th>";
						}
						$sqlIDgrupo2 = 	'SELECT idE 
										from estudiante 
									   	where Grupo = 2 and idE in 
									   	(	SELECT idE 
									   		FROM matriculado 
									   		WHERE idO IN (	SELECT idO 
									   						FROM ofrece 
									   						WHERE idM = "'.$idM.'" and semestre = "'.$semestreActual.'"))';
						$sqlIDgrupo2Result = mysql_query($sqlIDgrupo2);
						while ($row2 = mysql_fetch_row($sqlIDgrupo2Result)){
							$sqlNombreGrupo2 = "SELECT nombre from estudiante where idE=$row2[0]";
							$sqlNombreGrupo2Result = mysql_query($sqlNombreGrupo2);
							$rowNombre2 = mysql_fetch_row($sqlNombreGrupo2Result);
							$sqlNotasGrupo2 = 'SELECT nota from evaluado where idE = "'.$row2[0].'" and idE IN(
												SELECT idE 
												from estudiante 
											   	where Grupo = 2 and idE in 
											   	(	SELECT idE 
											   		FROM matriculado 
											   		WHERE idO IN (	SELECT idO 
											   						FROM ofrece 
											   						WHERE idM = "'.$idM.'" and semestre = "'.$semestreActual.'"))
												)';

							$sqlNotasGrupo2Result = mysql_query($sqlNotasGrupo2);

							$notasEstudiante2 = array();

							while ($array2 = mysql_fetch_row($sqlNotasGrupo2Result)) {
								array_push($notasEstudiante2, $array2[0]);
							}
							echo "<tr>";
							echo "<td>".$rowNombre2[0]."</td>";
							for ($i=0; $i < $cantidadDeEvaluaciones; $i++) { 
								echo "<td>".$notasEstudiante2[$i]."</td>";
							}
							echo "</tr>";

						}

					?>

	            </table>
		</div>

		<div class="tab-pane" id="grupo3">
			<table style="width:1000px">
					<?php
						echo "<th> Nombre de estudiante </th>";
						for ($i=0; $i < sizeof($newEvaluaciones); $i++) { 
							echo "<th>".$newEvaluaciones[$i]."</th>";
						}
						$sqlIDgrupo3 = 	'SELECT idE 
										from estudiante 
									   	where Grupo = 3 and idE in 
									   	(	SELECT idE 
									   		FROM matriculado 
									   		WHERE idO IN (	SELECT idO 
									   						FROM ofrece 
									   						WHERE idM = "'.$idM.'" and semestre = "'.$semestreActual.'"))';
						$sqlIDgrupo3Result = mysql_query($sqlIDgrupo3);
						while ($row3 = mysql_fetch_row($sqlIDgrupo3Result)){
							$sqlNombreGrupo3 = "SELECT nombre from estudiante where idE=$row3[0]";
							$sqlNombreGrupo3Result = mysql_query($sqlNombreGrupo3);
							$rowNombre3 = mysql_fetch_row($sqlNombreGrupo3Result);
							$sqlNotasGrupo3 = 'SELECT nota from evaluado where idE = "'.$row3[0].'" and idE IN(
												SELECT idE 
												from estudiante 
											   	where Grupo = 2 and idE in 
											   	(	SELECT idE 
											   		FROM matriculado 
											   		WHERE idO IN (	SELECT idO 
											   						FROM ofrece 
											   						WHERE idM = "'.$idM.'" and semestre = "'.$semestreActual.'"))
												)';

							$sqlNotasGrupo3Result = mysql_query($sqlNotasGrupo3);

							$notasEstudiante3 = array();
							
							while ($array3 = mysql_fetch_row($sqlNotasGrupo3Result)) {
								array_push($notasEstudiante3, $array3[0]);
							}
							echo "<tr>";
							echo "<td>".$rowNombre3[0]."</td>";
							
							if(sizeof($notasEstudiante3) -1 > 0){
								for ($i=0; $i < $cantidadDeEvaluaciones; $i++) { 
									echo "<td>".$notasEstudiante3[$i]."</td>";
								}
								echo "</tr>";
							}

						}
					?>
	            </table>
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
