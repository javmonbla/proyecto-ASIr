
<?php
include 'eventos.php';
include 'eliminar_reserva.php';

 if ($usuario == 'admin') {
  $stmt = $enlace_eventos->prepare("SELECT * FROM evento UNION ALL SELECT * FROM evento2");
} else {
  $stmt = $enlace_eventos->prepare("SELECT * FROM evento WHERE usuario = '$usuario' UNION ALL SELECT * FROM evento2 WHERE usuario = '$usuario'");
}

  $stmt->execute();
  $resultado = $stmt->get_result();
  $actividades = array();
  if ($resultado->num_rows > 0) {
     while ($fila = $resultado->fetch_assoc()) {
         $actividades[] = array("fecha" => $fila['fecha'], "Actividad" => $fila['usuario'], "verifica" => $fila['confirmada'],"mesa" => $fila['mesa']);
     }
 }

 function imprimirTabla($actividades, $usuario) {
     echo "<table class='table table-bordered table-striped table-hover table-primary mx-2 mt-2' style='width: 20%; border-collapse: collapse'>";
     echo "<thead class='text-center'><tr><th>Fecha</th><th>Reserva</th><th>Mesa</th><th>Acción</th></tr></thead>";
     echo "<tbody class='text-center'>";
     foreach ($actividades as $actividad) {
         echo "<tr>";
         echo "<td>" . $actividad['fecha'] . "</td>";
         echo "<td>" . $actividad['Actividad'] . "</td>";
         echo "<td>" . $actividad['mesa'] . "</td>";
         echo "<td>";
         echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
         echo "<input type='hidden' name='eliminar_reserva' value='" . $actividad['fecha'] . "'>";
	 echo "<input type='hidden' name='eliminar_reserva_mesa' value='" . $actividad['mesa'] . "'>";
         echo "<button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>";
         echo "</form>";
         if ($actividad['verifica'] == 0 && $usuario == 'admin') {
             echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "' margin-left: 5px;'>";
             echo "<input type='hidden' name='verificar_reserva' value='" . $actividad['fecha'] . "'>";
	     echo "<input type='hidden' name='verificar_reserva_mesa' value='" . $actividad['mesa'] . "'>";
             echo "<button type='submit' class='btn btn-success btn-sm'>Verificar</button>";
             echo "</form>";
         }
         echo "</td>";
         echo "</tr>";
     }
     echo "</tbody></table>";
 }
?>
