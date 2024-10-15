<?php
$fecha="$anio-$mes-$dia";
$festivos = [
    '1-1',
    '1-6',
    '2-28',
    '5-1',
    '8-15',
    '10-12',
    '11-1',
    '12-6',
    '12-8',
    '12-25'
];
$fiestas = array_map(function($festivo) use ($anio) {
    return "$anio-$festivo";
}, $festivos);

function generarHoras($tramo1, $tramo2, $intervalo) {
    $horas = [];

    // Generar horas para el primer tramo
    $hora_actual = $tramo1['inicio'];
    while ($hora_actual <= $tramo1['fin']) {
        $horas[] = $hora_actual;
        $hora_actual = date("H:i", strtotime("$hora_actual + $intervalo minutes"));
    }

    // Generar horas para el segundo tramo
    $hora_actual = $tramo2['inicio'];
    while ($hora_actual <= $tramo2['fin']) {
        $horas[] = $hora_actual;
        $hora_actual = date("H:i", strtotime("$hora_actual + $intervalo minutes"));
    }

    return $horas;
}

// Definir los tramos de horas
$tramo1 = ["inicio" => "10:00", "fin" => "13:00"];
$tramo2 = ["inicio" => "16:00", "fin" => "19:00"];
$intervalo = 60; // Intervalo en minutos

// Generar el rango de horas
$horas = generarHoras($tramo1, $tramo2, $intervalo);

// Función para imprimir la tabla HTML
function imprimirTabla($horas, $datos, $usuario_sesion, $fiestas) {
    echo "<table class='table table-bordered table-primary mx-2' style='width: 20%; border-collapse: collapse;'>";
    echo "<thead class='text-center'><tr><th>Hora</th><th>Reserva</th><th>Acción</th></tr></thead>";
    echo "<tbody class='text-center'>";

    foreach ($horas as $hora) {
         
$fecha= date($GLOBALS['fecha']);

$fiestas = $GLOBALS['fiestas'];
        // Verificar si la fecha actual es un festivo
        $fecha_actual = date('Y-m-d');
        $es_anterior = strtotime($fecha) < strtotime($fecha_actual);

        $es_festivo = in_array($fecha, $fiestas) || date('N', strtotime($fecha)) >= 6; // 6 y 7 son sábado y domingo

        echo "<tr>";
        echo "<td>" . htmlspecialchars($hora) . "</td>";

        if ($es_anterior) { 
            $actividad = "Esta día ya ha pasado";
        } elseif ($es_festivo) {
            $actividad = "Día festivo";
        } else {
            $actividad = "Libre";
            foreach ($datos as $fila) {
                if ($fila['Hora'] == $hora) {
                    if (($fila['Actividad'] == $usuario_sesion && $fila['Verificada'] == 1) || $usuario_sesion == 'admin') {
                        $actividad = $fila['Actividad'];
                    } elseif ($fila['Actividad'] == $usuario_sesion && $fila['Verificada'] == 0) {
                        $actividad = 'Pendiente de confirmación';
                    } else {
                        $actividad = "Ocupado";
                    }
                }
            }
        }
        
        
        echo "<td>" . htmlspecialchars($actividad) . "</td>";
        echo "<td>";

        if ($actividad == "Libre") {
            echo "<form method='post' action=''>
                    <input type='hidden' name='reservar_hora' value='" . htmlspecialchars($hora) . "'>
                    <input type='hidden' name='mesa' value='" . 1 . "'>
                    <button type='submit' class='btn btn-success btn-sm'>Reservar</button>
                  </form>";
        } elseif ($actividad = "Esta día ya ha pasado" || $actividad = "Día festivo"){
            echo "-";
                
        } elseif (($actividad == $usuario_sesion && $fila['Verificada'] == 1) || ($usuario_sesion == 'admin'&& $fila['Verificada'] == 1)) {
            echo "<form method='post' action=''>
                    <input type='hidden' name='eliminar_hora' value='" . htmlspecialchars($hora) . "'>
                    <input type='hidden' name='mesa' value='" . 1 . "'>
                    <button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>
                  </form>";
        } elseif ($usuario_sesion == 'admin' && $fila['Verificada'] == 0) {
            echo "<form method='post' action=''>
                    <input type='hidden' name='eliminar_hora' value='" . htmlspecialchars($hora) . "'>
                    <input type='hidden' name='mesa' value='" . 1 . "'>
                    <button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>
                  </form>";
            echo "<form method='post' action=''>
                    <input type='hidden' name='verificar_hora' value='" . htmlspecialchars($hora) . "'>
                    <input type='hidden' name='mesa' value='" . 1 . "'>
                    <button type='submit' class='btn btn-success btn-sm'>Verificar</button>
                  </form>";
        } else {
            echo "-";
        }

        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
}
function imprimirTabla2($horas, $datos2, $usuario_sesion, $fiestas) {
    echo "<table class='table table-bordered table-primary mx-2' style='width: 20%; border-collapse: collapse;'>";
    echo "<thead class='text-center'><tr><th>Hora</th><th>Reserva</th><th>Acción</th></tr></thead>";
    echo "<tbody class='text-center'>";

    foreach ($horas as $hora) {
         
$fecha= date($GLOBALS['fecha']);

$fiestas = $GLOBALS['fiestas'];
        // Verificar si la fecha actual es un festivo
        $fecha_actual = date('Y-m-d');
        $es_anterior = strtotime($fecha) < strtotime($fecha_actual);

        $es_festivo = in_array($fecha, $fiestas) || date('N', strtotime($fecha)) >= 6; // 6 y 7 son sábado y domingo

        echo "<tr>";
        echo "<td>" . htmlspecialchars($hora) . "</td>";

        
        if ($es_anterior) { 
            $actividad2 = "Esta día ya ha pasado";
        } elseif ($es_festivo) {
            $actividad2 = "Día festivo";
        } else {
            $actividad2 = "Libre";
            foreach ($datos2 as $fila2) {
                if ($fila2['Hora'] == $hora) {                    
                    if (($fila2['Actividad'] == $usuario_sesion && $fila2['Verificada'] == 1) || $usuario_sesion == 'admin') {
                        $actividad2 = $fila2['Actividad'];
                    } elseif ($fila2['Actividad'] == $usuario_sesion && $fila2['Verificada'] == 0) {
                        $actividad2 = 'Pendiente de confirmación';
                    } else {
                        $actividad2 = "Ocupado";
                    }
                }
            }
        }
        
        
        echo "<td>" . htmlspecialchars($actividad2) . "</td>";
        echo "<td>";

        if ($actividad2 == "Libre") {
            echo "<form method='post' action=''>
                    <input type='hidden' name='reservar_hora' value='" . htmlspecialchars($hora) . "'>
                    <input type='hidden' name='mesa' value='" . 2 . "'>                    
                    <button type='submit' class='btn btn-success btn-sm'>Reservar</button>
                  </form>";
                } elseif ($actividad = "Esta día ya ha pasado" || $actividad = "Día festivo"){
                    echo "-";
                        
                } elseif (($actividad2 == $usuario_sesion && $fila2['Verificada'] == 1) || ($usuario_sesion == 'admin'&& $fila2['Verificada'] == 1)) {
            echo "<form method='post' action=''>
                    <input type='hidden' name='eliminar_hora' value='" . htmlspecialchars($hora) . "'>
                    <input type='hidden' name='mesa' value='" . 2 . "'>
                    <button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>
                  </form>";
                } elseif ($usuario_sesion == 'admin' && $fila2['Verificada'] == 0) {
            echo "<form method='post' action=''>
                    <input type='hidden' name='eliminar_hora' value='" . htmlspecialchars($hora) . "'>
                    <input type='hidden' name='mesa' value='" . 2 . "'>
                    <button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>
                  </form>";
            echo "<form method='post' action=''>
                    <input type='hidden' name='verificar_hora' value='" . htmlspecialchars($hora) . "'>
                    <input type='hidden' name='mesa' value='" . 2 . "'>
                    <button type='submit' class='btn btn-success btn-sm'>Verificar</button>
                  </form>";
        } else {
            echo "-";
        }

        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
}
?>
