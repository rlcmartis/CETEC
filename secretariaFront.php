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
  
  $sql_nombres = "Select * From estudiante";
  $resultado = mysql_query($sql_nombres);

  $sql_cursos = "SELECT * FROM curso";
  $resultado_cursos = mysql_query($sql_cursos);

  $sql_maestros = "SELECT * FROM maestro";
  $resultado_maestros = mysql_query($sql_maestros);
?>

<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/cetec.css" rel="stylesheet">

    <title>SecretariaFront</title>
  </head>
  <body>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <p class="navbar-brand">
          CETEC
        </p>
        <p class="navbar-text pull-right">
            <a href="logout.php">Cerrar Sesión</a>   
        </p>
    </nav>
    <!-- Modal Estudiantes-->
      <div class="modal fade" id="myModalE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Añadir Estudiante</h3>
            </div>
            <div class="modal-body">
               <form class="form-signin" method="post" action="insertStu.php">
                  <!-- Nombre box -->
                  <div class="row" id="input-pass">
                    <input type="text" class="form-control" placeholder="Nombre de Estudiante" name="nombreE">
                  </div>

                  <!-- Fecha de Admision box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Fecha de Admisión" name="fechaA">
                  </div>

                  <!-- Fecha de Graduación box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Fecha de Graduación" name="fechaG">
                  </div>

                  <!-- Fecha de Graduación box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Identificación de Estudiante" name="idE">
                  </div>


                  <!-- checkbox row -->
                  <div class="row" id="input-pass">
                    <label id="Pago">
                      <input type="checkbox" name="pago"> Pagó
                    </label>
                    &nbsp;
                     <select class="selectpicker" name="grupo">
                      <option>Grupo 1</option>
                      <option>Grupo 2</option>
                      <option>Grupo 3</option>
                    </select>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Cursos -->
      <div class="modal fade" id="myModalC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Añadir Curso</h3>
            </div>
            <div class="modal-body">
               <form class="form-signin" method="post" action="insertCu.php">
                  <!-- Nombre box -->
                  <div class="row" id="input-pass">
                    <input type="text" class="form-control" placeholder="Nombre del Curso" name="nombreC">
                  </div>

                  <!-- Fecha de Graduación box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Codigo del Curso" name="idC">
                  </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            </form>
          </div>
        </div>
      </div>


      <!-- modal Maestros -->

      <div class="modal fade" id="myModalM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Añadir Maestro</h3>
            </div>
            <div class="modal-body">
               <form class="form-signin" method="post" action="insertMae.php">
                  <!-- Nombre box -->
                  <div class="row" id="input-pass">
                    <input type="text" class="form-control" placeholder="Nombre del Maestro" name="nombreM">
                  </div>

                  <!-- Fecha de Graduación box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Identificación del Maestro" name="idM">
                  </div>

                  <div class="row" id="input-pass"> 
                    <select class="selectpicker" name="curso">
                        <?php 
                          $sql_Cursos_sinM = "SELECT idC FROM curso WHERE idC NOT IN (SELECT idC FROM ofrece)";
                          $sql_Cursos_sinM_result = mysql_query($sql_Cursos_sinM);
                          while ($rowCursos = mysql_fetch_row($sql_Cursos_sinM_result)) {
                            $sqlBuscaNombre = 'SELECT nombre FROM curso WHERE idC="'.$rowCursos[0].'"';
                            $sqlBuscaNombre_result = mysql_query($sqlBuscaNombre);
                            $sqlBuscaNombre_result_row = mysql_fetch_row($sqlBuscaNombre_result);
                            echo '<option value="'.$rowCursos[0].'">'.$sqlBuscaNombre_result_row[0].'</option>';
                          }
                        ?>
                    </select>
                  </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            </form>
          </div>
        </div>
      </div>

    <div class="jumbotron" id="nombre-num">
      <h1>Registros</h1>
    </div>
    
    <ul class="nav nav-tabs nav-justified" id="myTab">
      <li class="active"><a href="#estudiantes" data-toggle="tab">Estudiantes</a></li>
      <li><a href="#cursos" data-toggle="tab">Cursos</a></li>
      <li><a href="#maestros" data-toggle="tab">Maestros</a></li>
    </ul>

    <!-- Tab Panes -->
    <!-- Tab Estudiantes -->
    <div class="tab-content">
      <div class="tab-pane active" id ="estudiantes">
        <div class="row">
          <div class="col-md-8">
            <table class = "table table-hover table-condensed">
              <tr>
                <th>Nombre</th>
                <th>Pagó</th>
                <th style="text-align: center">Entró</th>
                <th style="text-align: center">Sale</th>
                <th style="text-align: center">IdE</th>
                <th>Grupo<th>
              </tr>
              <?php
               while($row = mysql_fetch_row($resultado)){
                    echo '<tr href="http://google.com">'; // NO QUITAR XQ SE DANA TODO
                    // echo '<a href="http://ada.uprrp.edu/~jdelacruz/CETEC/estudiante.php?idE='.$row[4].'">';
                    // echo $row[4];
                    echo "<td>".'<a href="http://ada.uprrp.edu/~jdelacruz/CETEC/estudiante.php?idE='.$row[4].'">'.$row[0]."</a>"."</td>";
                    if($row[1] == 1){
                      echo "<td> Sí </td>";
                    }
                    else{
                      echo "<td> No </td>";
                    }
                    // echo "<td>".$row[1]."</td>";
                    echo "<td>".$row[2]."</td>";
                    echo "<td>".$row[3]."</td>";
                    echo "<td>".$row[4]."</td>";
                    echo '<td style="text-align: center">'.$row[6]."</td>";
                    // echo "</a>";
                    // foreach ($row as $key => $value) {
                    //   echo "<td>".$value."</td>";
                    // }
                    // echo "<td>".$row[0].$row[1]."</td>";
                    // echo "</tr>";
                    echo "<td>";
                    ?>
                    <form action="editarStu.php" method="post">
                      <input type="hidden" name="idE" value="<?php echo $row[4]; ?>">
                      <button type="submit" class="btn btn-info"> Editar </button>
                    </form>
                    <?php
                      echo "</td>";
                      echo "<td>";
                    ?>
                    <form action='deleteStu.php' method="post">
                      <input type="hidden" name="idE" value="<?php echo $row[4]; ?>">
                      <button type="submit" class="btn btn-danger"> Borrar </button>
                    </form>
                    

              <?php
              echo "</td>";
                }
              ?>
            </table>
    
            <!-- <table class="table">
            <thead colspan="3">Tabla de curso 1</thead>
            <tbody>
              <tr>
                <?php
                  // for ($colu = 0; $colu < 3; $colu++) {echo "<td>";}
                ?>
                Listo
                <?php
                  // for ($colu = 0; $colu < 3; $colu++) {echo "</td>";}
                ?>
              </tr>
              <tr></tr>
            </tbody>
            </table> -->
          </div>
          <div class="col-md-2 col-md-offset-2">
            <div class="btn-group" id="botonE">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalE">
                Añadir Estudiante
              </button>
            </div>
          </div>
        </div>
      </div>
    <!-- Tab cursos -->
    <div class="tab-pane" id="cursos">
      <div class="row">
          <div class="col-md-8">
           <table class = "table table-hover table-condensed">
              <tr>
                <th>Codigo</th>
                <th>Nombre</th>
              </tr>
              <?php
               while($row = mysql_fetch_row($resultado_cursos)){
                    echo '<tr href="http://google.com">'; // NO QUITAR XQ SE DANA TODO
                    // echo '<a href="http://ada.uprrp.edu/~jdelacruz/CETEC/estudiante.php?idE='.$row[4].'">';
                    // echo $row[4];
                    echo "<td>".'<a href="http://ada.uprrp.edu/~jdelacruz/CETEC/curso.php?idC='.$row[0].'">'.$row[0]."</a>"."</td>";
                    
                    echo "<td>".$row[1]."</td>";
                    echo "<td>";
                    ?>
                    <form action="editarCu.php" method="post">
                      <input type="hidden" name="idC" value="<?php echo $row[0]; ?>">
                      <button type="submit" class="btn btn-info"> Editar </button>
                    </form>
                    <?php
                      echo "</td>";
                      echo "<td>";
                    ?>
                    <form action='deleteCu.php' method="post">
                      <input type="hidden" name="idC" value="<?php echo $row[0]; ?>">
                      <button type="submit" class="btn btn-danger"> Borrar </button>
                    </form>
              <?php
              echo "</td>";
                }
              ?>
            </table>
          </div>

          <div class="col-md-2 col-md-offset-2">
            <div class="btn-group" id="botonC">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalC">
                Añadir Curso
              </button>
            </div>
          </div>

        <!-- <div class="col-md-2 col-md-offset-2">

          <div class="btn-group" id="botonC">
            <a data-toggle="modal" href="#myModalC" class="btn btn-info">Añadir Curso</a>
            <button type="button" class="btn btn-info" data-target="#myModalC">Añadir Curso</button>
          </div>
        </div> -->
      </div>
    </div>
    <!-- Tab Maestros -->
    <div class="tab-pane" id="maestros">
      <div class="row">
        <div class="col-md-8">
          <table class = "table table-hover table-condensed">
              <tr>
                <th>Id</th>
                <th>Nombre</th>
              </tr>
              <?php
               while($row = mysql_fetch_row($resultado_maestros)){
                    echo '<tr href="http://google.com">'; // NO QUITAR XQ SE DANA TODO
                    // echo '<a href="http://ada.uprrp.edu/~jdelacruz/CETEC/estudiante.php?idE='.$row[4].'">';
                    // echo $row[4];
                    echo "<td>".'<a href="http://ada.uprrp.edu/~jdelacruz/CETEC/maestro.php?idM='.$row[0].'">'.$row[0]."</a>"."</td>";
                    
                    echo "<td>".$row[1]."</td>";
                    echo "<td>";
                    ?>
                    <form action="editarMae.php" method="post">
                      <input type="hidden" name="idM" value="<?php echo $row[0]; ?>">
                      <button type="submit" class="btn btn-info"> Editar </button>
                    </form>
                    <?php
                      echo "</td>";
                      echo "<td>";
                    ?>
                    <form action='deleteMae.php' method="post">
                      <input type="hidden" name="idM" value="<?php echo $row[0]; ?>">
                      <button type="submit" class="btn btn-danger"> Borrar </button>
                    </form>
              <?php
              echo "</td>";
                }
              ?>
            </table>
        </div>
        <div class="col-md-2 col-md-offset-2">
          <div class="btn-group" id="botonM">
            <a data-toggle="modal" href="#myModalM" class="btn btn-info">Añadir Maestro</a>
            <!-- <button type="button" class="btn btn-info" data-target="#myModalM">Añadir Maestro</button> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  <script src="js/bootstrap.js"></script>
    <script>
      $(function () {
        $('#myTab a:first').tab('show')
      })
    </script>
  </body>

<!-- Closing the Database -->
<?php
mysql_close($conexion);
?>


</html>