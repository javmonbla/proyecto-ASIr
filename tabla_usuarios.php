
<?php
   include 'usuarios.php';

       $stmt = $enlace_usuarios->prepare ("SELECT confirmada FROM user where user = '$usuario'");
       $stmt->execute();
       $resultado_confirma = $stmt->get_result();
       $confirma = $resultado_confirma->fetch_assoc();     
 
       $sql = "SELECT * FROM user";
       $resultado = mysqli_query($enlace_usuarios, $sql);
       $usuarios = array();
        // Procesar los resultados de la consulta
      if (mysqli_num_rows($resultado) > 0) {
        while($fila = mysqli_fetch_assoc($resultado)) {
          $usuarios[] = array("usuario" => $fila['user'], "verificado" => $fila['confirmada']);
        }
    }
      
    function imprimirTabla($usuarios) {
        echo "<h2 class='mx-2'>Gestión de usuarios</h2>";
        echo "<table class='table table-bordered table-striped table-hover table-primary mx-2' style='width: 20%; border-collapse: collapse'>";
        echo "<thead class='text-center'><tr><th>usuario</th><th>verificado</th><th>Acción</th></tr></thead>";
        echo "<tbody class='text-center'>";
        foreach ($usuarios as $usuario) {
            echo "<tr>";
            if ( $usuario['verificado'] == 0) {
            echo "<td>" . $usuario['usuario'] . "</td>"; 
            echo "<td>";      
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='verificar_usuario' value='" . $usuario['usuario'] . "'>";
            echo "<button type='submit' class='btn btn-success btn-sm'>Verificar</button>";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='eliminar_usuario' value='" . $usuario['usuario'] . "'>";
            echo "<button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>";
            echo "</form>";
            echo "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
?>