<?php
  include 'eventos.php';
    $stmt = $enlace_eventos->prepare("SELECT * FROM evento UNION ALL SELECT * FROM evento2");
    $stmt->execute();
    $resultado2 = $stmt->get_result();
    $eventos = array();
        if ($resultado2->num_rows > 0) {
        while($fila = $resultado2->fetch_assoc()) {
          $eventos[] = array("usuario" => $fila['usuario'], "verificado" => $fila['confirmada'], "fecha" => $fila['fecha'], "mesa" => $fila['mesa']);
        }}

        function imprimirTabla2($eventos) {
            echo "<h2 class='mx-2'>Gestión de reservas</h2>";
            echo "<table class='table table-bordered table-striped table-hover table-primary mx-2' style='width: 20%; border-collapse: collapse;'>";
            echo "<thead class='text-center'><tr><th>fecha</th><th>usuario</th><th>mesa</th><th>verificado</th><th>Acción</th></tr></thead>";
            echo "<tbody class='text-center'>";
            foreach ($eventos as $event) {
                echo "<tr>";
                if ( $event['verificado'] == 0) {
	                echo "<td>" . $event['fecha'] . "</td>"; 
	                echo "<td>" . $event['usuario'] . "</td>";
        	        echo "<td>" . $event['mesa'] . "</td>";
                	echo "<td>";      
          	        echo "<form method='post' action=''>";
  	                echo "<input type='hidden' name='verificar_reserva' value='" . $event['fecha'] . "'>";
  	                echo "<input type='hidden' name='verificar_reserva_mesa' value='" . $event['mesa'] . "'>";
          	        echo "<button type='submit' class='btn btn-success btn-sm'>Verificar</button>";
       	    	        echo "</form>";
        	        echo "</td>";
      	       	        echo "<td>";
      	          echo "<form method='post' action=''>";
     	           echo "<input type='hidden' name='eliminar_reserva' value='" . $event['fecha'] . "'>";
   	             echo "<input type='hidden' name='eliminar_reserva_mesa' value='" . $event['mesa'] . "'>";
                 echo "<button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>";
                echo "</form>";
                echo "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
        }
?>
