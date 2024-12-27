<?php
include 'eventos.php';
include 'inicio_sesion.php';
include 'meses.php';
include 'generarhoras.php';
include 'datos_usuario.php';
include 'eliminar_hora.php';
?>
<!DOCTYPE html>
<html lang="es">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agenda
	 <?php
		//devuelve los datos desde meses.php
		 echo "$dia de $mes_titulo del $anio "
	 ?></title>

<header style="background-color: rgb(27, 77, 124)">
	<div class="d-flex justify-content-between p-2">
    		<div class="me-2 d-flex align-items-center">
       			<h2 style="color:white">
				<i class="bi bi-calendar"></i>
				<?php
					//de nuevo redirige desde meses.php
					 echo "$dia de $mes_titulo del $anio "
				?>
				</h2>
    		</div>
    		<div class="d-flex align-items-center mx-2">
        		<i style="color:white" class="bi bi-person"></i>
        		<a style="color:white" href='pagina_usuario.php?user=$usuario'><?php imprimirNombre(); ?></a>
        		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="borrarsesion">
        			<button class="mx-2 btn btn-outline-light" name="borrar" type="submit">cerrar sesion</button>
        		</form>
    		</div>
	</div>
</header>
<body style="background-color: rgb( 172, 195, 217 ); padding-bottom: 70px;">
	<div class="d-flex flex-row mb-2" >
    		<div class="p-2">
        		<div class="text-center">
            			<h3>Rerservas Mesa 1</h3>
        		</div>
        		<div class="text-center">
            			<?php
					//este php redirige directamente al archivo generarhoras.php
            				imprimirTabla($horas, $actividades, $usuario, $fiestas);
            			?>
        		</div>
    		</div>
    		<div class="p-2">
        		<div class="text-center">
            			<h3>Reservas Mesa 2</h3>
        		</div>
        		<div class="text-center">
            			<?php
            				//redirige al mismo archivo a generarhoras.php
					imprimirTabla2($horas, $actividades2, $usuario, $fiestas);
            			?>
        		</div>
    		</div>
	</div>
	<div class='my-2 mx-2'>
        	<a href='calendario2.php?mes=<?php echo $mes_sistema; ?>&anio=<?php echo $anio_sistema; ?>' class='btn btn-outline-dark'>Volver al calendario</a>
    	</div>
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
