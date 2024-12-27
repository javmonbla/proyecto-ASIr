<!DOCTYPE html>
<?php
include 'inicio_sesion.php';
include 'tabla_reservas.php';
include 'datos_usuario.php';
include 'cambiar_datos.php';

$mes_sistema = date('n');
$anio_sistema = date('Y');
?>
<html lang="es">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de usuario de <?php echo $usuario; ?></title>

    <header style="background-color: rgb(27, 77, 124)">
    <div class="d-flex justify-content-between p-2">
        <div class="me-2 d-flex align-items-center">
            <h2 style="color:white"> <i class="bi bi-calendar"></i> Página de usuario de <?php echo $usuario; ?></h2>
        </div>
        <div class="d-flex align-items-center mx-2">
            <i style="color:white" class="bi bi-person"></i>
            <label style="color:white" for="usuario"><?php imprimirNombre(); ?></label>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="borrarsesion">
                <button class="mx-2 btn btn-outline-light" name="borrar" type="submit">Cerrar sesión</button>
            </form>
        </div>
    </div>
    </header>
    <body style="background-color: rgb( 172, 195, 217 ); padding-bottom: 70px;">
	 <div class="d-flex justify-content-between p-2">
   		 <div class="col-5">
       			<h2>Reservas de <?php echo $usuario?></h2>
        		<?php
				//esto redirige a tabla_reservas.php
            			imprimirTabla($actividades, $usuario);
       			?>
    		</div>
   		<div class="col">
 			<?php
				//esto redirige a datos_usuario.php
				imprimirDatosUsuario();
			?>
    		</div>
	</div>
	<div class='my-2 mx-2'>
        	<a href='calendario2.php?mes=<?php echo $mes_sistema; ?>&anio=<?php echo $anio_sistema; ?>' class='btn btn-outline-dark'>Volver al calendario</a>
    	</div>
	<div class="container mt-5">
        	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="formulario">
            		<h2>Modificar datos personales</h2>
            		<div class="row mb-3 align-items-center">
                		<div class="col-md-2">
                    			<label for="nombre" class="form-label">Nombre</label>
                		</div>
                		<div class="col-md-6">
                    			<input type="text" class="form-control" id="nombre" name="nombre">
                		</div>
            		</div>
            		<div class="row mb-3 align-items-center">
                		<div class="col-md-2">
                    			<label for="apellidos" class="form-label">Apellidos</label>
                		</div>
                		<div class="col-md-6">
                    			<input type="text" class="form-control" id="apellidos" name="apellidos">
                		</div>
            		</div>
            		<div class="row mb-3 align-items-center">
                		<div class="col-md-2">
                    			<label for="birthday" class="form-label">Fecha de nacimiento</label>
                		</div>
                		<div class="col-md-6">
                    			<input type="date" lang="es" class="form-control" id="birthday" name="birthday">
                		</div>
            		</div>
            		<div class="row mb-3 align-items-center">
                		<div class="col-md-2">
                    			<label for="telefono" class="form-label">Teléfono</label>
                		</div>
                		<div class="col-md-6">
                    			<input type="number" class="form-control" id="telefono" name="telefono" min="600000000" max="799999999">
                		</div>
            		</div>
            		<div class="row mb-3 align-items-center">
                		<div class="col-md-2">
                    			<label for="ciudad" class="form-label">Ciudad</label>
                		</div>
                		<div class="col-md-6">
                    			<input type="text" class="form-control" id="ciudad" name="ciudad">
                		</div>
            		</div>
            		<div class="row mb-3 align-items-center">
                		<div class="col-md-2">
                    			<label for="provincia" class="form-label">Provincia</label>
                		</div>
                		<div class="col-md-6">
                    			<input type="text" class="form-control" id="provincia" name="provincia">
                		</div>
            		</div>
            		<div class="row">
                		<div class="col-md-6 offset-md-2">
                    			<button class="btn btn-outline-dark w-100" name="guardar_datos" type="submit">Guardar</button>
                		</div>
            		</div>
        	</form>
    	</div>
    	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="pass">
    		<div class="container mt-5">
        		<h2 class="mb-4 text-center">Cambiar Contraseña</h2>
        		<div class="card bg-transparent border-0">
            			<div class="card-body">
                			<div class="row mb-3">
                    				<div class="col-md-4">
                        				<label for="pass_anterior" class="form-label"><strong>Contraseña Anterior</strong></label>
                       					<input type="password" class="form-control" id="pass_anterior" name="pass_anterior" required>
                    				</div>
                    				<div class="col-md-4">
                        				<label for="pass1" class="form-label"><strong>Nueva Contraseña</strong></label>
                        				<input type="password" class="form-control" id="pass1" name="pass1" required>
                    				</div>
                    				<div class="col-md-4">
                        				<label for="pass2" class="form-label"><strong>Repita la Nueva Contraseña</strong></label>
                        				<input type="password" class="form-control" id="pass2" name="pass2" required>
                    				</div>
                			</div>
                			<div class="row justify-content-center">
                    				<div class="col-md-4">
                        				<button class="btn btn-outline-dark w-100" type="submit" name="cambiar"><strong>Cambiar Contraseña</strong></button>
                    				</div>
                			</div>
            			</div>
        		</div>
    		</div>
	</form>
</body>
<footer style="background-color: rgb(27, 77, 124);  width: 100%; position: fixed; bottom:0; left:0">
    <div>
        <div class="row align-items-center ">
            <div class="col-1 d-flex align-items-start ">
                <img class="img-fluid " width=70 src="JMB2.jpg">
            </div>
            <div class="col-2 d-flex align-items-start">
                <h4 style="color:white">Grupo JMB</h4>
            </div>
            <div class="col d-flex flex-grow-1 justify-content-between align-items-start m-3" style="margin-left: 20px;">
                <h4 style="color:white; margin: 0;">Proyecto ASIR - IES Aguadulce 24/25</h4>
                <h4 style="color:white; margin: 0;">Javier Montoro Blasco</h4>
            </div>
        </div>
    </div>
</footer>
</html>

