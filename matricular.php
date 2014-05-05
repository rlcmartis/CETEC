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
  $usarDB = mysql_select_db($database);
  
  $idM = $_POST["idM"];
  $evaluacion = $_POST["eval"];
  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";} 

  $sql_idO = "Select o.idO From ofrece As o Where o.semestre='".$semestreActual."' and o.idM='".$idM."'";
  $sql_ests = "Select e.idE, e.nombre From estudiante As e Natural Join matriculado As m Where m.idO In (".$sql_idO.")";
  $ests_result = mysql_query($sql_ests);

  $evalUrl = str_replace(" ", "_", $evaluacion);
?>

<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/cetec.css" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="../../dist/js/bootstrap.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script> $(function () {$('#myTab a:first').tab('show')}) </script>

    <title>Editar Evaluaci&oacute;n</title>
  </head>
  <body>
    <table>
      <form class="form-signin" method="post" action= "insertEva.php" >
        <?php
          $id=0;
          while ($est = mysql_fetch_row($ests_result)) {
            $sql_nota = "Select e.nota From evaluado As e Where e.idE='".$est[0]."'
                         and e.evaluacion='".$evaluacion."' and e.idO In (".$sql_idO.")";
            $notaResult = mysql_query($sql_nota);
            $nota = mysql_fetch_row($notaResult);
            echo "<tr><td>".$est[1]."</td><td>"; ?>

            <div class="row" id="input-pass">
              <input type="text" class="form-control" name="<?php echo $id; ?>" value="<?php echo $nota[0]; ?>">
            </div>

            <?php
            echo "</td></tr>";
            $id++;
          }
          echo "</table>";
        ?>

        <a href=<?php echo "maestro.php?idM=".$idM ?>><button type="button" class="btn btn-danger">Cancelar</button></a>
        <input type="hidden" class="form-control" name = "idM" value = <?php echo '"'.$idM.'"' ?> >
        <input type="hidden" class="form-control" name = "eval" value = <?php echo '"'.$evalUrl.'"' ?> >
        <button type="submit" class="btn btn-primary">Guardar cambios</button>

      </form>
      <form action= "deleteEva.php" method="post">
        <input type="hidden" class="form-control" name = "idM" value = <?php echo '"'.$idM.'"' ?> >
        <input type="hidden" class="form-control" name = "eval" value = <?php echo '"'.$evalUrl.'"' ?> >
        <button type="submit" class="btn btn-danger"> Borrar </button>
      </form>
    </table>
  </body>
</html>