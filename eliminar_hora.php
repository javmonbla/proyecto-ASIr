<?php
include 'eventos.php';

    if (isset($_POST['reservar_hora']) && isset($_POST['mesa'])) {
        $hora_reservada = $_POST['reservar_hora'];
        $mesa = $_POST['mesa'];
        $fecha_reserva = "$anio-$mes-$dia $hora_reservada:00";
        if ($mesa == 1) {
		$tabla="evento";
	}else{
	$tabla="evento2";
	}
	$stmt = $enlace_eventos->prepare("INSERT INTO $tabla (fecha, usuario) VALUES (?, ?)");
	$stmt->bind_param("ss", $fecha_reserva, $usuario);
	$stmt->execute();
        header("Location: ".$_SERVER['PHP_SELF']."?dia_actual=$dia&mes=$mes&anio=$anio");
        exit();
	}


    if (isset($_POST['eliminar_hora']) && isset($_POST['mesa'])) {
        $hora_eliminada = $_POST['eliminar_hora'];
        $mesa = $_POST['mesa'];
        $fecha_eliminar = "$anio-$mes-$dia $hora_eliminada:00";
        if ($mesa == 1) {
		$tabla="evento";
	}else{
	$tabla="evento2";
	}
	$stmt = $enlace_eventos->prepare("DELETE FROM $tabla WHERE fecha = (?)");
	$stmt->bind_param("s", $fecha_eliminar);
	$stmt->execute();
        header("Location: ".$_SERVER['PHP_SELF']."?dia_actual=$dia&mes=$mes&anio=$anio");
        exit();
	}

?>
