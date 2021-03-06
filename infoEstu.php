<html>
	<head>
  	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/cetec.css" rel="stylesheet">

		<title>InfoEstu</title>
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
					<a href="nada">Cerrar Sesión</a>				
				</div>
			</div>
			<h1>Información del Estudiante</h1>
		</div>
		<div class="container">
      <div class="row">
        <div class="col-md-6 text-right">
          <h3>Nombre del estudiante: </h3>
          <h3>Fecha de Admisión:</h3>
          <h3>Fecha de Graduación</h3>
          <h3>Identificación del Estudiante: </h3>
          <h3>Pago Efectuado: </h3>
        </div>
        <div class="col-md-6 text-left" id="mia">
          <h4>Nombre del estudiante: </h4>
          <br>
          <h4>Fecha de Admisión:</h4>
          <br>
          <h4>Fecha de Graduación</h4>
          <br>
          <h4>Identificación del Estudiante: </h4>
          <br>
          <h4>Pago Efectuado: </h4>
        </div>
      </div>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="../../dist/js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
  <script> $(function () {$('#myTab a:first').tab('show')})</script>
	</body>
</html>