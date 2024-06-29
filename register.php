<?php
// register.php
require_once 'configuracion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = getDBConnection();

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            echo "Cuenta creada exitosamente.";
        } else {
            echo "Algo salió mal. Por favor, inténtelo de nuevo.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
