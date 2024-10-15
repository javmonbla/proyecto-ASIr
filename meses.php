
<?php
include 'eventos.php';
    //---------------------------------------------------------> Obtener el mes y el año actual.
    $mes_sistema = date('n');
    $anio_sistema = date('Y');
    //---------------------------------------------------------> Obtener el mes y el año actual de trabajo.
    if (isset($_GET['mes'])) {
        $mes_actual = intval($_GET['mes']);
    } else {
        $mes_actual = $mes_sistema;
    }
    if (isset($_GET['anio'])) {
        $anio_actual = intval($_GET['anio']);
    } else {
        $anio_actual = $anio_sistema;
    }
    //---------------------------------------------------------> Obtener el mes y el año del mes anterior.
    $mes_anterior = $mes_actual - 1;
    $anio_anterior = $anio_actual;
    if ($mes_anterior == 0) {
        $mes_anterior = 12;
        $anio_anterior--;
    }

    //--------------------------------------------------------> Obtener el mes y el año del mes siguiente.
    $mes_siguiente = $mes_actual + 1;
    $anio_siguiente = $anio_actual;
    if ($mes_siguiente == 13) {
        $mes_siguiente = 1;
        $anio_siguiente++;
    }


    $meses = [
        1 => "Enero",
        2 => "Febrero",
        3 => "Marzo",
        4 => "Abril",
        5 => "Mayo",
        6 => "Junio",
        7 => "Julio",
        8 => "Agosto",
        9 => "Septiembre",
        10 => "Octubre",
        11 => "Noviembre",
        12 => "Diciembre"
    ];
            //-------------------------------------------------------------------------------------------> Se comprueba si el mes de trabajo existe dentro del array $meses  
            //-------------------------------------------------------------------------------------------> y si existe se asigna el nombre del mes a la variable $mes_titulo
            //-------------------------------------------------------------------------------------------> en su defecto se le asigna "Mes no válido".
            
            if (isset($meses[$mes_actual])) {
                $mes_titulo = $meses[$mes_actual];
            } else {
                $mes_titulo = "Mes no válido";
            }

            if (isset($_GET['dia_actual'])) {
                $dia = $_GET['dia_actual'];
            } else {
                $dia = date("d");
            }
            
            if (isset($_GET['mes'])) {
                $mes = $_GET['mes'];
            } else {
                $mes = date("m");
            }
            
            if (isset($_GET['anio'])) {
                $anio = $_GET['anio'];
            } else {
                $anio = date("Y");
            }
            
            if (isset($meses[$mes])) {
                $mes_titulo = $meses[$mes];
            } else {
                $mes_titulo = "Mes no válido";
            }
           
            function generarCalendario($mes, $anio)
            {
                //-----------------------------------------------------> Crear una variable del tipo DateTime para el primer día del mes.
                $primer_dia_mes = new DateTime("$anio-$mes-01");
            
                //-----------------------------------------------------> Obtener el número de días en el mes.
                $num_dias_mes = $primer_dia_mes->format('t');
            
                //-----------------------------------------------------> Obtener el día de la semana del primer día del mes (1 = lunes, 7 = domingo).
                $dia_semana_primer_dia = $primer_dia_mes->format('N');
            
                //-----------------------------------------------------> Crear una tabla para mostrar el calendario.
                $calendario_html = '<div class="table-responsive">';
                $calendario_html .= '<table background-color:rgb( 172, 195, 217) class="table table-bordered table-striped table-hover table-primary">';
                $calendario_html .= '<thead class="text-center"><tr><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th><th>Domingo</th></tr></thead>';
                $calendario_html .= '<tbody>';
            
                $dia_actual = 1;
            
                //------------------------------------------------------> Crear filas para cada semana del mes.
                for ($i = 1; $i <= 8; $i++) {
                    $calendario_html .= '<tr>';
                    //--------------------------------------------------> Crear celdas para cada día de la semana.
                    for ($j = 1; $j <= 7; $j++) {
                        if ($i == 1 && $j < $dia_semana_primer_dia) {
                            //------------------------------------------> Celdas vacías para completar los días de la semana del mes anterior.
                            $calendario_html .= '<td class="text-center"></td>';
                        } elseif ($dia_actual <= $num_dias_mes) {
                            //------------------------------------------> Celdas para mostrar los días del mes actual.
                            $calendario_html .= "<td class='text-center'><a href='agenda.php?dia_actual=$dia_actual&mes=$mes&anio=$anio'>$dia_actual</a></td>";
                            $dia_actual++;
                        } else {
                            //------------------------------------------> Celdas vacías para completar los días de la semana del mes siguiente.
                            $calendario_html .= '<td class="text-center"></td>';
                        }
                    }
                    $calendario_html .= '</tr>';
                    //--------------------------------------------------> Si ya hemos alcanzado el último día del mes, salimos del bucle.
                    if ($dia_actual > $num_dias_mes) {
                        break;
                    }
                }
            
                $calendario_html .= '</tbody></table></div>';
            
                return $calendario_html;
            }
            
// Formatear la fecha para la consulta SQL
$fecha_inicio = "$anio-$mes-$dia 00:00:00";
$fecha_fin = "$anio-$mes-$dia 23:59:59";

// Consulta SQL para obtener los eventos del día seleccionado
$sql = "SELECT * FROM evento WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
$resultado = mysqli_query($enlace_eventos, $sql);

$actividades = array();

$sql2 = "SELECT * FROM evento2 WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
$resultado2 = mysqli_query($enlace_eventos, $sql2);

$actividades2 = array();

// Procesar los resultados de la consulta
if (mysqli_num_rows($resultado) > 0) {
    while($fila = mysqli_fetch_assoc($resultado)) {
        $hora = date("H:i", strtotime($fila['fecha']));
        $actividades[] = array("Hora" => $hora, "Actividad" => $fila['usuario'], "Verificada" => $fila['confirmada'], "mesa" => $fila['mesa']);
    }
}

if (mysqli_num_rows($resultado2) > 0) {
    while($fila2 = mysqli_fetch_assoc($resultado2)) {
        $hora = date("H:i", strtotime($fila2['fecha']));
        $actividades2[] = array("Hora" => $hora, "Actividad" => $fila2['usuario'], "Verificada" => $fila2['confirmada'],"mesa" => $fila2['mesa']);
    }
}

?>