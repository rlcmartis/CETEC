<?php
  echo "Hello World";
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
  $sql_nombres = "Select * From estudiante";
  $resultado = mysql_query($sql_nombres);
  // while($row = mysql_fetch_row($resultado)){
  // echo $row[0];
  // echo "<br>";
  // }
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

		<!-- Modal Estudiantes-->
      <div class="modal fade" id="myModalE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Añadir Estudiante</h3>
            </div>
            <div class="modal-body">
               <form class="form-signin">
                  <!-- Nombre box -->
                  <div class="row" id="input-pass" >
                    <input type="text" class="form-control" placeholder="Nombre de Estudiante">
                  </div>

                  <!-- Fecha de Admision box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Fecha de Admisión">
                  </div>

                  <!-- Fecha de Graduación box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Fecha de Graduación">
                  </div>

                  <!-- Fecha de Graduación box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Identificación de Estudiante">
                  </div>


                  <!-- checkbox row -->
                  <div class="row" id="input-pass">
                    <label id="Pago">
                      <input type="checkbox" name="pago"> Pagó
                    </label>
                    &nbsp;
                     <select class="selectpicker">
					    <option>Grupo 1</option>
					    <option>Grupo 2</option>
					    <option>Grupo 3</option>
					 </select>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Aceptar</button>
            </div>
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
               <form class="form-signin">
                  <!-- Nombre box -->
                  <div class="row" id="input-pass" >
                    <input type="text" class="form-control" placeholder="Nombre del Curso">
                  </div>

                  <!-- Fecha de Admision box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Código del Curso">
                  </div>
               </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Aceptar</button>
            </div>
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
               <form class="form-signin">
                  <!-- Nombre box -->
                  <div class="row" id="input-pass" >
                    <input type="text" class="form-control" placeholder="Nombre del Maestro">
                  </div>

                  <!-- Fecha de Admision box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Curso Actual">
                  </div>

                  <!-- Fecha de Graduación box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Identificación del Maestro">
                  </div>
               </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Aceptar</button>
            </div>
          </div>
        </div>
      </div>


		<div class="jumbotron" id="nombre-num">
			<div class= "row" id="lineaDeSesion"> 
				<div class="col-md-11 col-md-offset-6">
					<a href="index.html">Cerrar Sesión</a>				
				</div>
			</div>
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
            <table style="width:700px">
              <tr>
                <th>Nombre</th>
                <th>Pagó</th>
                <th>Entró</th>
                <th>Sale</th>
                <th>IdE</th>
              </tr>
              <?php
               while($row = mysql_fetch_row($resultado)){
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                      echo "<td>".$value."</td>";
                    }
                    // echo "<td>".$row[0].$row[1]."</td>";
                    // echo "</tr>";
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
						Hellooooooooo
					</div>
				<div class="col-md-2 col-md-offset-2">

					<div class="btn-group" id="botonC">
						<a data-toggle="modal" href="#myModalC" class="btn btn-info">Añadir Curso</a>
				 		<!-- <button type="button" class="btn btn-info" data-target="#myModalC">Añadir Curso</button> -->
					</div>
				</div>
			</div>
		</div>
    <!-- Tab Maestros -->
		<div class="tab-pane" id="maestros">
			<div class="row">
				<div class="col-md-8">
					HOLAAAAAAAA
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
