<?php
  session_start();
  // if(!isset($_SESSION['idM'])){
  //   header("location:index.php");
  // }
  if (!$_SESSION['is_prof']) {
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
  $usarDB = mysql_Select_db($database);

  // $lastPage = explode('/', $_SERVER['HTTP_REFERER']);
  if(isset($_SESSION['is_admin'])){
  	$idM = $_GET['idM'];
  }
  elseif($_SESSION['is_prof']){
  	$idM = $_SESSION['idM'];
  }
  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";} 

  //sacando las evaluaciones que ha echo el profesor
  $sql_idO = "Select o.idO From ofrece As o Where o.semestre='".$semestreActual."' and o.idM='".$idM."'";
  $sql_eva = "Select e.evaluacion From evaluado As e Where e.idO IN (".$sql_idO.")";
  $sql_eva_Result = mysql_query($sql_eva);
  $evaluaciones = array();
  while($array = mysql_fetch_array($sql_eva_Result)){
    array_push($evaluaciones, $array[0]);
  }

  $evaluacionesNoDupli = (array_unique($evaluaciones)); //elimino las evaluaciones duplicadas
  $newEvaluaciones = array();
  $cantidadDeEvaluaciones = sizeof($evaluacionesNoDupli);
  foreach ($evaluacionesNoDupli as $value) {
    array_push($newEvaluaciones, $value);
  }


  $sql_curso = "Select c.nombre From curso As c natural join ofrece As o2 Where o2.idO In (".$sql_idO.")";
  $sql_curso_result = mysql_query($sql_curso);
  //se supone que si fue verificado antes, el profesor solo ofreca un curso en el actual semestre
  $rowCurso = mysql_fetch_array($sql_curso_result);
  $curso = $rowCurso[0];

  $sql_password = 'Select password From maestro Where idM="'.$idM.'"';
  $resultadoPassword = mysql_query($sql_password);
  $rowPassword = mysql_fetch_row($resultadoPassword);
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

		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	        <p class="navbar-brand">
	          CETEC
	        </p>
	        <?php
	        	// $lastPage = explode('/', $_SERVER['HTTP_REFERER']);
	        	if(isset($_SESSION['is_admin'])){
	        ?>
		        <p class="navbar-text pull-right">
		        	 <a href="logout.php"><button type="button" class="btn btn-danger">
	        				Cerrar Sesión
	      			</button></a>   
		        </p>
		    <?php
	        	}
	        	elseif($_SESSION['is_prof']){
	        ?>
	        <p class="navbar-text pull-right">
	        	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalContra">
                Editar Contraseña
            	</button>
	        	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalNewE">
        				Añadir Evaluación
      			</button>
	        	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalN">
        				Editar Notas
      			</button>
	            <a href="logout.php"><button type="button" class="btn btn-danger">
        				Cerrar Sesión
      			</button></a>   
	        </p>
	        <?php
	        	}
	        ?>
	    </nav>
		<div class="jumbotron" id="nombre-num">
		<!-- 	<div class= "row" id="lineaDeSesion"> 
				<div class="col-md-10 col-md-offset-6">
					<form action = "newEva.php" method = "post">
						<input type = "hidden" name = "idM" = value = <?php //echo '"'.$idM.'"'?>>
						<button type="submit" class="btn btn-info">
        					Añadir Notas
      					</button>
					</form>
					
					&nbsp;&nbsp;&nbsp;| &nbsp;
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalN">
        				Editar Notas
      				</button>
      				&nbsp;&nbsp;&nbsp;| &nbsp;
					<a href="logout.php">Cerrar Sesión</a>				
				</div>
			</div> -->

			<h1>Nombre:  <?php 
				$sql_nombre = "Select nombre From maestro Where idM=".$idM;
  				$resultado = mysql_query($sql_nombre);
  				$rowMaestro = mysql_fetch_row($resultado);
  				echo $rowMaestro[0];
			?></h1>
			<h3 id="h-num">Nombre del curso actual: <?php echo $curso ?></h3>
		</div>

	  <!-- Modal editar notas-->
      <div class="modal fade" id="myModalN" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Editar evaluación</h3>
            </div>
            <div class="modal-body">
              <form class="form-signin" method="post" action="editarEva.php">

<!--                 <div class="navbar">
                  <div class="navbar-inner">
                    <ul class="nav">
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                          Seleccionar evaluaci&oacute;n
                          <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">

                        </ul>
                      </li>
                    </ul>
                  </div>
                </div> -->
                          <select class="selectpicker" name="eval">
                          <?php
                            for ($ev=0; $ev < $cantidadDeEvaluaciones ; $ev++){
                              $editEval = $newEvaluaciones[$ev];
                              echo '<option value="'.$editEval.'">'.$editEval.'</option>';
                            }
                          ?>
                          </select>
                
            </div>
            <div class="modal-footer">
              <input type="hidden" class="form-control" name = "idM" value = <?php echo '"'.$idM.'"' ?>>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            </form>
          </div>
        </div>
      </div>


      <!-- Modal Nueva Evaluacion-->
      <div class="modal fade" id="myModalNewE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Editar evaluación</h3>
            </div>
            <div class="modal-body">
              <form class="form-signin" method="post" action="editarEva.php">
                      <div class="row" id="input-pass">
	                    <input type="text" class="form-control" name="eval" placeholder="Nombre">
	                  </div>

	                  <!-- Fecha de Admision box -->
	                  <div class="row" id="input-pass"> 
	                    <input type="text" class="form-control" name="fechaEva" placeholder="Fecha de Evaluacion">
	                  </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" class="form-control" name = "idM" value = <?php echo '"'.$idM.'"' ?>>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Editar Contra-->
      <div class="modal fade" id="myModalContra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Editar Contraseña</h3>
            </div>
            <div class="modal-body">
              <form class="form-signin" method="post" action="editarCont.php">
                <div class="row" id="input-pass">
                  <input type="text" class="form-control" name="password" value="<?php echo $rowPassword[0]; ?>">
                </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" class="form-control" name = "idM" value = <?php echo '"'.$idM.'"' ?>>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            </form>
          </div>
        </div>
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
						$sqlIDgrupo1 = "Select e.idE From estudiante As e natural join matriculado as m
						                Where e.grupo = 1 and m.idO In (".$sql_idO.")";
						$sqlIDgrupo1Result = mysql_query($sqlIDgrupo1);

						while ($row1 = mysql_fetch_row($sqlIDgrupo1Result)){
							$sqlNombreGrupo1 = "Select e.nombre From estudiante As e Where idE=".$row1[0];
							$sqlNombreGrupo1Result = mysql_query($sqlNombreGrupo1);
							$rowNombre1 = mysql_fetch_row($sqlNombreGrupo1Result);

							$sqlNotasGrupo1 = "Select e1.nota
							                   From evaluado As e1 natural join matriculado As m natural join estudiante As e2
							                   Where e2.idE = '".$row1[0]."' and e2.grupo = 1 and m.idO IN (".$sql_idO.")";

							$sqlNotasGrupo1Result = mysql_query($sqlNotasGrupo1);

							$notasEstudiante1 = array();
							while ($array = mysql_fetch_row($sqlNotasGrupo1Result)) {
								array_push($notasEstudiante1, $array[0]);
							}

							echo "<tr>";
							echo "<td>".$rowNombre1[0]."</td>";
							//este for me despliega las notas 
							for ($i=0; $i < $cantidadDeEvaluaciones; $i++) { 
								$sqlnota1 = "Select e.nota From evaluado As e
											Where e.idE = '".$row1[0]."' and e.evaluacion = '".$newEvaluaciones[$i]."'";
								$sqlnota1Result = mysql_query($sqlnota1);

								if(mysql_num_rows($sqlnota1Result) == 0){ //si sqlnota me devuelve una tabla vacia 
									echo "<td> </td>";					//significa que ese estudiante no tiene nota 
																		//para esa evaluacion y por lo tanto la despliego vacia
								}
								else{
									$arrayNotas1 = mysql_fetch_array($sqlnota1Result);
									echo "<td>".$arrayNotas1[0]."</td>";
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
						$sqlIDgrupo2 = "Select e.idE From estudiante As e natural join matriculado as m
						                Where e.grupo = 2 and m.idO In (".$sql_idO.")";
						$sqlIDgrupo2Result = mysql_query($sqlIDgrupo2);

						while ($row2 = mysql_fetch_row($sqlIDgrupo2Result)){
							$sqlNombreGrupo2 = "Select e.nombre From estudiante As e Where idE=".$row2[0];
							$sqlNombreGrupo2Result = mysql_query($sqlNombreGrupo2);
							$rowNombre2 = mysql_fetch_row($sqlNombreGrupo2Result);
							
							$sqlNotasGrupo2 = "Select e1.nota
							                   From evaluado As e1 natural join matriculado As m natural join estudiante As e2
							                   Where e2.idE = '".$row2[0]."' and e2.grupo = 2 and m.idO IN (".$sql_idO.")";
							$sqlNotasGrupo2Result = mysql_query($sqlNotasGrupo2);

							$notasEstudiante2 = array();
							while ($array2 = mysql_fetch_row($sqlNotasGrupo2Result)) {
								array_push($notasEstudiante2, $array2[0]);
							}

							echo "<tr>";
							echo "<td>".$rowNombre2[0]."</td>";
							for ($i=0; $i < $cantidadDeEvaluaciones; $i++) {
								$sqlnota2 = "Select e.nota From evaluado As e
											Where e.idE = '".$row2[0]."' and e.evaluacion = '".$newEvaluaciones[$i]."'";
								$sqlnota2Result = mysql_query($sqlnota2);

								if(mysql_num_rows($sqlnota2Result) == 0){ //si sqlnota me devuelve una tabla vacia 
									echo "<td> </td>";					//significa que ese estudiante no tiene nota 
																		//para esa evaluacion y por lo tanto la despliego vacia
								}
								else{
									$arrayNotas2 = mysql_fetch_array($sqlnota2Result);
									echo "<td>".$arrayNotas2[0]."</td>";
								}
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
						$sqlIDgrupo3 = "Select e.idE From estudiante As e natural join matriculado as m
						                Where e.grupo = 3 and m.idO In (".$sql_idO.")";
						$sqlIDgrupo3Result = mysql_query($sqlIDgrupo3);

						while ($row3 = mysql_fetch_row($sqlIDgrupo3Result)){
							$sqlNombreGrupo3 = "Select e.nombre From estudiante As e Where idE=".$row3[0];
							$sqlNombreGrupo3Result = mysql_query($sqlNombreGrupo3);
							$rowNombre3 = mysql_fetch_row($sqlNombreGrupo3Result);

							$sqlNotasGrupo3 = "Select e1.nota
							                   From evaluado As e1 natural join matriculado As m natural join estudiante As e2
							                   Where e2.idE = '".$row3[0]."' and e2.grupo = 3 and m.idO IN (".$sql_idO.")";
							$sqlNotasGrupo3Result = mysql_query($sqlNotasGrupo3);

							$notasEstudiante3 = array();
							while ($array = mysql_fetch_row($sqlNotasGrupo3Result)) {
								array_push($notasEstudiante3, $array[0]);
							}
							echo "<tr>";
							echo "<td>".$rowNombre3[0]."</td>";

							//este for me despliega las notas 
							for ($i=0; $i < $cantidadDeEvaluaciones; $i++) { 
								$sqlnota3 = "Select e.nota From evaluado As e
											Where e.idE = '".$row3[0]."' and e.evaluacion = '".$newEvaluaciones[$i]."'";
								$sqlnota3Result = mysql_query($sqlnota3);

								if(mysql_num_rows($sqlnota3Result) == 0){ //si sqlnota me devuelve una tabla vacia 
									echo "<td> </td>";					//significa que ese estudiante no tiene nota 
																		//para esa evaluacion y por lo tanto la despliego vacia
								}
								else{
									$arrayNotas3 = mysql_fetch_array($sqlnota3Result);
									echo "<td>".$arrayNotas3[0]."</td>";
								}
							}
							echo "</tr>";
						}
					?>
	            </table>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
    <script> $(function () {$('#myTab a:first').tab('show')}) </script>
	</body>
</html>
