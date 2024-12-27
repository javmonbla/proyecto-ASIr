<?php
include 'usuarios.php';
if (session_status() === PHP_SESSION_NONE) {
session_start();
}
$usuario = $_SESSION["user"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar_datos'])) {
        // Recoger datos del formulario
        $campos = [
            'nombre' => $_POST['nombre'] ?? null,
            'apellidos' => $_POST['apellidos'] ?? null,
            'nacimiento' => $_POST['birthday'] ?? null,
            'movil' => $_POST['telefono'] ?? null,
            'ciudad' => $_POST['ciudad'] ?? null,
            'provincia' => $_POST['provincia'] ?? null,
        ];

        // Preparar y ejecutar las actualizaciones
        foreach ($campos as $campo => $valor) {
            if (!empty($valor)) { // Solo actualiza si el valor no est� vac�o
                $stmt = $enlace_usuarios->prepare("UPDATE `user` SET `$campo` = ? WHERE `user` = ?");
                $stmt->bind_param("ss", $valor, $usuario);
                $stmt->execute();
            }
        }
    }
}

    if (isset($_POST['cambiar'])) {
        $pass_anterior = $_POST['pass_anterior'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        $stmt = $enlace_usuarios->prepare("SELECT pass FROM user WHERE user = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $res = $fila['pass'];

        if(password_verify($pass_anterior, $res)) {
            if ($pass1 === $pass2) {
                if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/', $pass1)) {
                    $stmt = $enlace_usuarios->prepare("UPDATE user SET pass = ?, confirmada = 1 WHERE user = ?");
			$password_hash = password_hash($pass1, PASSWORD_DEFAULT);
                    $stmt->bind_param("ss", $password_hash, $usuario);
                    if ($stmt->execute()) {
                        header("Location: calendario2.php");
                    } else {
                        echo "Error al actualizar la contrase�a.";
                    }
                } else {
                    echo "La nueva contrase�a debe tener al menos 6 caracteres, incluir una min�scula, una may�scula y un n�mero.";
                }
            } else {
                echo "Las contrase�as nuevas no coinciden.";
            }
        } else {
            echo "La contrase�a anterior es incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>
