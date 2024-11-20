<?php
function imprimirDatosUsuario() {
    $host = "localhost";                                                                                        
    $user = "admin";
    $pwd = "iier]9*7P>;Ye?+";
    $bdd_usuarios = "usuarios";
    $enlace_usuarios = mysqli_connect($host, $user, $pwd, $bdd_usuarios);
    if (!$enlace_usuarios) {
        die("No se pudo realizar la conexión: " . mysqli_connect_error());
    }

    $usuario = $_SESSION["user"];

    $stmt = $enlace_usuarios->prepare("SELECT nombre, apellidos, nacimiento, movil, ciudad, provincia FROM `user` WHERE `user` = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $res_u = $stmt->get_result();
    $c = $res_u->fetch_assoc();
    $fechaFormateada = DateTime::createFromFormat('Y-m-d', $c['nacimiento'])->format('d-m-Y');

    echo "
        <div class='container mt-5'>
            <h2 class='mb-4 text-center'>Datos Personales</h2>
            <div class='card bg-transparent'>
                <div class='card-body'>
                    <div class='row mb-3'>
                        <div class='col-md-4'>
                            <strong>Nombre:</strong>
                            <p>" . htmlspecialchars($c['nombre']) . "</p>
                        </div>
                        <div class='col-md-4'>
                            <strong>Apellidos:</strong>
                            <p>" . htmlspecialchars($c['apellidos']) . "</p>
                        </div>
                        <div class='col-md-4'>
                            <strong>Fecha de Nacimiento:</strong>
                            <p>" . htmlspecialchars($fechaFormateada) . "</p>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-md-4'>
                            <strong>Móvil:</strong>
                            <p>" . htmlspecialchars($c['movil']) . "</p>
                        </div>
                        <div class='col-md-4'>
                            <strong>Ciudad:</strong>
                            <p>" . htmlspecialchars($c['ciudad']) . "</p>
                        </div>
                        <div class='col-md-4'>
                            <strong>Provincia:</strong>
                            <p>" . htmlspecialchars($c['provincia']) . "</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
}
?>