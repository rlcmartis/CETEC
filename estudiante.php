<?php
  session_start();
  if(!isset($_SESSION['idE'])){
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

  $idE = $_SESSION['idE'];
  
  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";}

  $sql_nombre = "Select nombre From estudiante Where idE=".$idE;
  $resultadoNombre = mysql_query($sql_nombre);
  $rowNombre = mysql_fetch_row($resultadoNombre);
  $estuNombre = $rowNombre[0];


  $sql_idO = "Select o1.idO From ofrece As o1 natural join matriculado As m1
  	          Where o1.semestre='".$semestreActual."' and m1.idE='".$idE."'";

  $sql_nombresyId = "Select c1.nombre, o2.idO From curso As c1 natural join ofrece As o2 Where o2.idO In (".$sql_idO.")";

  $cursosResult = mysql_query($sql_nombresyId);

  if (mysql_num_rows($cursosResult) == 3){
    $rowCurso1 = mysql_fetch_row($cursosResult);
    $rowCurso2 = mysql_fetch_row($cursosResult);
    $rowCurso3 = mysql_fetch_row($cursosResult);

    $curso1 = $rowCurso1[0];
    $curso2 = $rowCurso2[0];
    $curso3 = $rowCurso3[0];

    //sacando las evaluaciones del idO 1
    $sql_evaluaC1 = "Select evaluacion, nota From evaluado Where idO = ".$rowCurso1[1];
    $sql_evaluaC1_Result = mysql_query($sql_evaluaC1);
    $evaluacionesC1Dupli = array();
    $notasC1 = array();
    while($array = mysql_fetch_array($sql_evaluaC1_Result)){
       array_push($evaluacionesC1Dupli, $array[0]);
       array_push($notasC1, $array[1]);
    }
    $evaluacionesC1a = (array_unique($evaluacionesC1Dupli)); //elimino las evaluacionesC1 duplicadas
    $evaluacionesC1b = array();
    foreach ($evaluacionesC1a as $value){
      array_push($evaluacionesC1b, $value); //resuelve indices raros
    }

    //sacando las evaluaciones del idO 2
    $sql_evaluaC2 = "Select evaluacion, nota From evaluado Where idO = ".$rowCurso2[1];
    $sql_evaluaC2_Result = mysql_query($sql_evaluaC2);
    $evaluacionesC2Dupli = array();
    $notasC2 = array();
    while($array = mysql_fetch_array($sql_evaluaC2_Result)){
       array_push($evaluacionesC2Dupli, $array[0]);
       array_push($notasC2, $array[1]);
    }
    $evaluacionesC2a = (array_unique($evaluacionesC2Dupli)); //elimino las evaluacionesC2 duplicadas
    $evaluacionesC2b = array();
    foreach ($evaluacionesC2a as $value){
      array_push($evaluacionesC2b, $value); //resuelve indices raros
    }

    //sacando las evaluaciones del idO 3
    $sql_evaluaC3 = "Select evaluacion, nota From evaluado Where idO = ".$rowCurso3[1];
    $sql_evaluaC3_Result = mysql_query($sql_evaluaC3);
    $evaluacionesC3Dupli = array();
    $notasC3 = array();
    while($array = mysql_fetch_array($sql_evaluaC3_Result)){
       array_push($evaluacionesC3Dupli, $array[0]);
       array_push($notasC3, $array[1]);
    }
    $evaluacionesC3a = (array_unique($evaluacionesC3Dupli)); //elimino las evaluacionesC3 duplicadas
    $evaluacionesC3b = array();
    foreach ($evaluacionesC3a as $value){
      array_push($evaluacionesC3b, $value); //resuelve indices raros
    }

  }
  elseif (mysql_num_rows($cursosResult) == 2){

  }
  elseif (mysql_num_rows($cursosResult) == 1){

  }
  else{
  	$curso1 = "Error: No est&acute;";
    $curso2 = "Error: Student without exactly three courses.";
    $curso3 = "Error: Student without exactly three courses.";
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

		<title>Estudiante</title>
	</head>
	<body>
		<div class="jumbotron" id="nombre-num">
			<div class= "row" id="lineaDeSesion"> 
				<div class="col-md-11 col-md-offset-6">
					<a href="logout.php">Cerrar Sesión</a>				
				</div>
			</div>
			<h1>Nombre: <?php echo $estuNombre ?></h1>
			<h3 id="h-num">Numero de estudiante: <?php echo $idE; ?></h3>
		</div>
		
		<ul class="nav nav-tabs nav-justified" id="myTab">
		  <li class="active"><a href="#curso1" data-toggle="tab"> <?php echo $curso1 ?> </a></li>
		  <li><a href="#curso2" data-toggle="tab"> <?php echo $curso2 ?> </a></li>
		  <li><a href="#curso3" data-toggle="tab"> <?php echo $curso3 ?> </a></li>
		</ul>

		<!-- Tab Panes -->
		<div class="tab-content" >
			<div class="tab-pane active" id ="curso1">
				<table class="table">
				<thead colspan="3" >Evaluaciones</thead>
				<tbody>
            <?php
              for ($i=0; $i < sizeof($evaluacionesC1b)-1; $i++) { 
                echo "<th>".$evaluacionesC1b[$i]."</th>";
              }
              echo "<tr>";
              for ($i=0; $i < sizeof($evaluacionesC1b)-1; $i++) { 
                echo "<td>".$notasC1[$i]."</td>";
              }
              echo "</tr>";
            ?>
				</tbody>
				</table>
			</div>

		  <div class="tab-pane" id="curso2">
        <table class="table">
          <thead colspan="3" >Evaluaciones</thead>
          <tbody>
            <?php
              for ($i=0; $i < sizeof($evaluacionesC2b)-1; $i++) { 
                echo "<th>".$evaluacionesC2b[$i]."</th>";
              }
              echo "<tr>";
              for ($i=0; $i < sizeof($evaluacionesC2b)-1; $i++) { 
                echo "<td>".$notasC2[$i]."</td>";
              }
              echo "</tr>";
            ?>
          </tbody>
        </table>
		  </div>

		  <div class="tab-pane" id="curso3">
        <table class="table">
          <thead colspan="3">Evaluaciones</thead>
          <tbody>
            <?php
              for ($i=0; $i < sizeof($evaluacionesC3b)-1; $i++) { 
                echo "<th>".$evaluacionesC3b[$i]."</th>";
              }
              echo "<tr>";
              for ($i=0; $i < sizeof($evaluacionesC3b)-3; $i++) { 
                echo "<td>".$notasC3[$i]."</td>";
              }
              echo "</tr>";
            ?>
          </tbody>
        </table>
		  </div>
	  </div>
	  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
	  <script src="js/bootstrap.js"></script>
    <script> $(function () {$('#myTab a:first').tab('show')})</script>
	</body>
</html>
