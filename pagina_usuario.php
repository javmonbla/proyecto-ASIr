<!DOCTYPE html>
<?php
include 'inicio_sesion.php';
include 'tabla_reservas.php';
include 'eliminar_reserva.php';

$mes_sistema = date('n');
$anio_sistema = date('Y');
?>
<html lang="es">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda completa de <?php echo $usuario; ?></title>

    <header style="background-color: rgb(27, 77, 124)">
    <div class="d-flex justify-content-between p-2">
        <div class="me-2 d-flex align-items-center">
            <h2> <i class="bi bi-calendar"></i> Agenda de <?php echo $usuario ?></h2>
        </div>
        <div class="d-flex align-items-center mx-2">
            <i class="bi bi-person"></i>
            <label for="usuario"><?php echo $usuario; ?></label>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="borrarsesion">
                <button class="mx-2 btn btn-outline-dark" name="borrar" type="submit">Cerrar sesión</button>
            </form>
        </div>
    </div>
    </header>
    <body style="background-color: rgb( 172, 195, 217 ); padding-bottom: 70px;">
<?php
    imprimirTabla($actividades, $usuario);
?>

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
                <h4>Grupo JMB</h4>
            </div>
            <div class="col d-flex flex-grow-1 justify-content-between align-items-start m-3" style="margin-left: 20px;">
                <h4 style=" margin: 0;">Proyecto ASIR - IES Aguadulce 24/25</h4>
                <h4 style=" margin: 0;">Javier Montoro Blasco</h4>
            </div>
        </div>
    </div>
</footer>
</html>

