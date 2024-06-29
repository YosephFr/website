<?php
// login.php
require_once 'configuracion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = getDBConnection();

    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE correo = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $nombre, $hashed_password);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        $_SESSION['id'] = $id;
                        $_SESSION['email'] = $email;
                        $_SESSION['nombre'] = $nombre;
                        echo "Has iniciado sesión correctamente.";
                    } else {
                        echo "La contraseña es incorrecta.";
                    }
                }
            } else {
                echo "No existe una cuenta con ese correo.";
            }
        } else {
            echo "Algo salió mal. Por favor, inténtelo de nuevo.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
