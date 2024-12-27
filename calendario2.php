<?php
include 'inicio_sesion.php';
include 'meses.php';
include 'tabla_eventos.php';
include 'datos_usuario.php';
include 'eliminar_reserva.php';
?>
<!DOCTYPE html>
<html lang="es">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

 <header style="background-color: rgb(27, 77, 124)">
    <div class="d-flex justify-content-between p-2">
        <div class="d-flex align-items-center">
            <form action=""  method="get" class="d-flex align-items-center">
                <div class="me-2 d-flex align-items-center">
                    <label style="color:white" for="mes" class="col-form-label me-2"><strong>Mes:</strong></label>
                    <input style="color:white; background-color: rgb(27, 77, 124); border-color:white; font-weight: bold" type="number" class="form-control" id="mes" name="mes" min="1" max="12" required>
                </div>
                <div class="me-2 d-flex align-items-center">
                    <label style="color:white" for="anio" class="col-form-label me-2"><strong>Año:</strong></label>
                    <input style="color:white;background-color: rgb(27,77,124); border-color: white; font-weight: bold" type="number" class="form-control" id="anio" name="anio" min="1900" max="2100" required>
                </div>
                <div class="me-2">
                    	<!-- esto hace referencia al archivo meses.php-->
			<button class="btn btn-outline-light" type="submit"><strong>Ir al mes</strong></button>
                </div>
		<?php
//Este fragmento de php hace referencia al archivo meses.php, y solo aparece si el mes del calendario no coincide con el mes actual
                if ($mes_actual != $mes_sistema or $anio_actual != $anio_sistema) {
                    echo "
                    <div class='me-2'>
                        <a href='?mes=$mes_sistema&anio=$anio_sistema' class='btn btn-outline-light'><strong>Volver al mes actual</strong></a>
                    </div>";
                }
                ?>
            </form>
        </div>
        <div class="d-flex align-items-center mx-2">
            <i style="color:white"  class="bi bi-person"></i>
            <a style="color:white" href='pagina_usuario.php?user=$usuario'><?php imprimirNombre(); ?></a>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="borrarsesion">
		 <button class="mx-2 btn btn-outline-light" name="borrar" type="submit"><strong>Cerrar sesión</strong></button>
            </form>
        </div>
    </div>
    <div class="pb-2">
    	<a  class="mx-2 btn btn-outline-light" href="?mes=<?php echo $mes_anterior ?>&anio=<?php echo $anio_anterior ?>"><strong>Mes Anterior</strong></a>
    	<a  class="btn btn-outline-light" href="?mes=<?php echo $mes_siguiente ?>&anio=<?php echo $anio_siguiente ?>"><strong>Mes Siguiente</strong></a>
    </div>
</header>
<body style="background-color: rgb( 172, 195, 217 ); padding-bottom: 60px;"> 
    <h2 class="mx-2">Calendario Mensual</h2>
    <?php
//de nuevo hace referencia al archivo meses.php
        echo "<h5 class='mx-2'>$mes_titulo de $anio_actual</h5>";
        echo generarCalendario($mes_actual, $anio_actual);
//aqui cambia y hace refencia al archivo tabla_eventos.php
        if ($usuario == 'admin') {
           imprimirTabla2($eventos);
    }
    ?>
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
