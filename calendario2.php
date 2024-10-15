<?php
include 'inicio_sesion.php';
include 'eventos.php';
include 'usuarios.php';
include 'meses.php';
include 'eliminar_usuario.php';   
include 'eliminar_reserva.php';
include 'tabla_eventos.php';
include 'tabla_usuarios.php';
 
?>
<!DOCTYPE html>
<html lang="es">
<!--.................................Los estilos y los iconos se trabajan con bootstrap.................................-->                                              

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> 

<?php
                //----------------------------------------> Se comprueba si el usuario esta verificado 
if( $confirma['confirmada'] == 1 ){  
?>
 <header style="background-color: rgb(27, 77, 124)">
   
<!--.........................................Empezamos un div con dos columnas..........................................-->
    <div class="d-flex justify-content-between p-2">
<!--.............................La primira columna contiene un segundo div con un formulario............................-->         
        <div class="d-flex align-items-center">
            <form action="" method="get" class="d-flex align-items-center">
                <div class="me-2 d-flex align-items-center">
                    <label for="mes" class="col-form-label me-2"><strong>Mes:</strong></label>
                    <input style="background-color: rgb(27, 77, 124); border-color: rgb(33, 37, 41); font-weight: bold " type="number" class="form-control" placeholder="<?php echo $mes_actual ?>" id="mes" name="mes" min="1" max="12" required>
                </div>
                <div class="me-2 d-flex align-items-center">
                    <label for="anio" class="col-form-label me-2"><strong>Año:</strong></label>
                    <input style="background-color: rgb(27, 77, 124); border-color: rgb(33, 37, 41); font-weight: bold" type="number" class="form-control" placeholder="<?php echo $anio_actual ?>" id="anio" name="anio" min="1900" max="2100" required>
                </div>
                <div class="me-2">
                    <button class="btn btn-outline-dark" type="submit"><strong>Ir al mes</strong></button>
                </div>
<!--..............................Este boton del formulario solo aparece si el mes de trabajo..............................
...........................................no coincide con el mes del sistema...........................................-->                
                <?php
                if ($mes_actual != $mes_sistema or $anio_actual != $anio_sistema) {
                    echo "
                    <div class='me-2'>
                        <a href='?mes=$mes_sistema&anio=$anio_sistema' class='btn btn-outline-dark'><strong>Volver al mes actual</strong></a>
                    </div>";
                }
                ?>
            </form>
<!--......................La segunda columna del primer div contiene un enlace a otra página...............................
........................y un botón que cierra sesión y reenvía a la página de inicio de sesión..........................-->  
        </div>
        <div class="d-flex align-items-center mx-2">
        <i class="bi bi-person"></i>
            <a href='pagina_usuario.php?user=$usuario'><?php echo $usuario; ?></a>    
            
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="borrarsesion">
                <button class="mx-2 btn btn-outline-dark" name="borrar" type="submit"><strong>Cerrar sesión</strong></button>
            </form>
        </div>
    </div>
<!--......................Justo debajo de la primera columna del primer div aparecen dos botones..........................
.........................un botón que cambia el mes de trabajo al mes siguiente y otro al anterior.....................-->
    <div class="pb-2">
    <a  class="mx-2 btn btn-outline-dark" href="?mes=<?php echo $mes_anterior ?>&anio=<?php echo $anio_anterior ?>"><strong>Mes Anterior</strong></a>
    <a  class="btn btn-outline-dark" href="?mes=<?php echo $mes_siguiente ?>&anio=<?php echo $anio_siguiente ?>"><strong>Mes Siguiente</strong></a>
    </div>
    
    </header>
    <body style="background-color: rgb( 172, 195, 217 ); padding-bottom: 60px;"> 
    <h2 class="mx-2">Calendario Mensual</h2>

    <?php
                //--------------------------------------------------> Las dos siguientes líneas hacen referencia al archivo meses 
                //--------------------------------------------------> La primera escribe el nombre del mes que se representa en el calendario que dibuja la segunda
     echo "<h5 class='mx-2'>$mes_titulo de $anio_actual</h5>";
     echo generarCalendario($mes_actual, $anio_actual);
    
    if ($usuario == 'admin') { 
                //--------------------------------------------------> La siguiente línea impreme la tabla de usuarios con los botones de verificacion y eliminacion de los usuarios
    imprimirTabla($usuarios);
                //--------------------------------------------------> La siguiente línea impreme la tabla de reservas con los botones de verificacion y eliminacion de las reservas     
    imprimirTabla2($eventos);
                //--------------------------------------------------> Finalmente si la comprobación que hacíamos de si el usuario está verificado, 
                //--------------------------------------------------> resulta que no lo está, se escribe el siguiente mensaje y un botón para volver a la pagina de inicio de sesión
    }}else {
        echo "<h2 class='text-center mx-2 mt-5'>El usuario no esta verificado, espere a que verifiquen su usuario gracias.</h2>";
        echo "<div class='text-center my-2 m-2'>
                 <a href='iniciar_sesion.php' class='btn btn-outline-dark'>Volver</a>
             </div>";
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