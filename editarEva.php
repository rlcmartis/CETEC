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
  if (/*$conexion*/!$conexion){
  //   echo "Conexi&oacute;n realizada \n\n\n";
  // }
  // else{
    echo "Fall&oacute; conexi&oacute;n \n\n\n";
  }
  $usarDB = mysql_Select_db($database);

  $idM = $_GET["idM"];

  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";}

  //   //sacando las evaluaciones que ha echo el profesor
  // $sql_idO = "Select o.idO From ofrece As o Where o.semestre='".$semestreActual."' and o.idM='".$idM."'";
  // $sql_eva = "Select e.evaluacion From evaluado As e Where e.idO IN (".$sql_idO.")";
  // $sql_eva_Result = mysql_query($sql_eva);
  // $evaluaciones = array();
  // while($array = mysql_fetch_array($sql_eva_Result)){
  //   array_push($evaluaciones, $array[0]);
  // }

  // $evaluacionesNoDupli = (array_unique($evaluaciones)); //elimino las evaluaciones duplicadas
  // $newEvaluaciones = array();
  // $cantidadDeEvaluaciones = sizeof($evaluacionesNoDupli);
  // foreach ($evaluacionesNoDupli as $value) {
  //   array_push($newEvaluaciones, $value);
  // }


  // $sql_curso = "Select c.nombre From curso As c natural join ofrece As o2 Where o2.idO In (".$sql_idO.")";
  // $sql_curso_result = mysql_query($sql_curso);
  // //se supone que si fue verificado antes, el profesor solo ofreca un curso en el actual semestre
  // $rowCurso = mysql_fetch_array($sql_curso_result);
  // $curso = $rowCurso[0];
?>

<html>
  <body>
		<div class="container">
			<form class="form-signin" method="post" action="insertEva.php">
        <!-- Nombre box -->
        <div class="row" id="input-pass">
          <input type="text" class="form-control" name="nombreEva" placeholder="Nombre">
        </div>

        <!-- Fecha de Admision box -->
        <div class="row" id="input-pass"> 
          <input type="text" class="form-control" name="fechaEva" placeholder="Fecha de Evaluacion">
        </div>

        <a href=<?php echo "maestro.php?idM=$idM"; ?> >
          <button type="button" class="btn btn-danger" >Cancelar</button>
        </a>
	      
        <input type="hidden" name = "idM" value = <?php echo "$idM"; ?> >
	      <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </form>
    </div>
	</body>
</html>