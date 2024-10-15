
<?php
    include 'eventos.php';
       
    if (isset($_POST['reservar_hora']) && isset($_POST['mesa'])) {
        $hora_reservada = $_POST['reservar_hora'];
        $mesa = $_POST['mesa'];
        $fecha_reserva = "$anio-$mes-$dia $hora_reservada:00";
        if ($mesa == 1) {
        // Insertar la nueva reserva en la base de datos
        $sql_insert = "INSERT INTO evento (fecha, usuario) VALUES ('$fecha_reserva', '$usuario')";
        if (mysqli_query($enlace_eventos, $sql_insert)) {
            echo "<div class='alert alert-success mx-2'>Reserva realizada para la hora $hora_reservada.</div>";
        } else {
            echo "<div class='alert alert-danger mx-2'>Error al realizar la reserva: " . mysqli_error($enlace_eventos) . "</div>";
        }
        }elseif ($mesa == 2) {
        $sql_insert = "INSERT INTO evento2 (fecha, usuario) VALUES ('$fecha_reserva', '$usuario')";
        if (mysqli_query($enlace_eventos, $sql_insert)) {
            echo "<div class='alert alert-success mx-2'>Reserva realizada para la hora $hora_reservada.</div>";
        } else {
            echo "<div class='alert alert-danger mx-2'>Error al realizar la reserva: " . mysqli_error($enlace_eventos) . "</div>";
        }
        }else {
            echo "<div class='alert alert-danger mx-2'>Error al eliminar la reserva de la mesa 2 (evento2): " . mysqli_error($enlace_eventos) . "</div>";
        }
        
        // Recargar la página para actualizar las reservas
        header("Location: ".$_SERVER['PHP_SELF']."?dia_actual=$dia&mes=$mes&anio=$anio");
        exit();
    }
    
    // Comprobar si se ha solicitado la eliminación de una reserva
    if (isset($_POST['eliminar_hora']) && isset($_POST['mesa'])) {
        $hora_eliminada = $_POST['eliminar_hora'];
        $mesa = $_POST['mesa'];
        $fecha_eliminar = "$anio-$mes-$dia $hora_eliminada:00";
    
        // Eliminar la reserva de la base de datos
        if ($mesa == 1) {
            // Eliminar de la tabla 'evento' (mesa = 1)
            $sql_delete = "DELETE FROM evento WHERE fecha = '$fecha_eliminar'";
            if (mysqli_query($enlace_eventos, $sql_delete)) {
                echo "<div class='alert alert-success mx-2'>Reserva eliminada de la mesa 1 (evento) para la hora $hora_eliminada.</div>";
            } else {
                echo "<div class='alert alert-danger mx-2'>Error al eliminar la reserva de la mesa 1 (evento): " . mysqli_error($enlace_eventos) . "</div>";
            }
        } elseif ($mesa == 2) {
            // Eliminar de la tabla 'evento2' (mesa = 2)
            $sql_delete = "DELETE FROM evento2 WHERE fecha = '$fecha_eliminar'";
            if (mysqli_query($enlace_eventos, $sql_delete)) {
                echo "<div class='alert alert-success mx-2'>Reserva eliminada de la mesa 2 (evento2) para la hora $hora_eliminada.</div>";
            } else {
                echo "<div class='alert alert-danger mx-2'>Error al eliminar la reserva de la mesa 2 (evento2): " . mysqli_error($enlace_eventos) . "</div>";
            }
        } else {
            echo "<div class='alert alert-warning mx-2'>No se pudo eliminar la reserva, mesa desconocida.</div>";
        }
    
        // Recargar la página para actualizar las reservas
        header("Location: ".$_SERVER['PHP_SELF']."?dia_actual=$dia&mes=$mes&anio=$anio");
        exit();
    }
    
    if (isset($_POST['verificar_hora']) && isset($_POST['mesa'])) {
        $hora_verifica = $_POST['verificar_hora'];
        $mesa = $_POST['mesa'];
        $fecha_verifica = "$anio-$mes-$dia $hora_verifica:00";
    
        if ($mesa == 1) {
            // Consulta SQL para la tabla 'evento' (mesa 1)
            $sql_update = "UPDATE evento SET confirmada = '1' WHERE fecha = '$fecha_verifica'";
        } elseif ($mesa == 2) {
            // Consulta SQL para la tabla 'evento2' (mesa 2)
            $sql_update = "UPDATE evento2 SET confirmada = '1' WHERE fecha = '$fecha_verifica'";
        }
    
        // Ejecutar la consulta SQL
        if (mysqli_query($enlace_eventos, $sql_update)) {
            // Mensaje de éxito
            echo "<div class='alert alert-success mx-2'>Reserva verificada correctamente para la mesa $mesa.</div>";
        } else {
            // Mensaje de error
            echo "<div class='alert alert-danger mx-2'>Error al verificar la reserva: " . mysqli_error($enlace_eventos) . "</div>";
        }
    
        // Recargar la página para actualizar las reservas
        header("Location: ".$_SERVER['PHP_SELF']."?dia_actual=$dia&mes=$mes&anio=$anio");
        exit();
    }
    
            
?>