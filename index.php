<?php
// index.php
session_start();
require_once 'configuracion.php';

$conn = getDBConnection();

// Crear la base de datos y la tabla si no existen
$sql = "CREATE DATABASE IF NOT EXISTS mi_cv";
$conn->query($sql);

$sql = "USE mi_cv";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    correo VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi CV</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="top-header">
        <div class="container">
            <div class="redes-sociales2">
                <a href="#"><img src="img/fb.png" alt="Facebook" width="18" height="18"></a>
                <a href="#"><img src="img/twitter.png" alt="Twitter" width="18" height="18"></a>
                <a href="#"><img src="img/linkedin.png" alt="LinkedIn" width="18" height="18"></a>
            </div>
        </div>
    </div>
    <header>
        <div class="container header-container">
            <div class="logo">
                <img src="img/logo.png" alt="Logo">
            </div>
            <nav>
                <ul class="menu">
                    <li><a href="#resumen">Resumen</a></li>
                    <li><a href="#habilidades">Habilidades</a></li>
                    <li><a href="#experiencia">Experiencia</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <?php if (isset($_SESSION['email'])): ?>
                    <span>Hola, <?php echo $_SESSION['nombre']; ?> (<?php echo $_SESSION['email']; ?>)</span>
                    <button id="logoutBtn">Desconectar</button>
                <?php else: ?>
                    <button id="loginBtn">Iniciar Sesión</button>
                    <button id="registerBtn">Registrarse</button>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main>
        <section id="resumen">
            <h2>Resumen</h2>
            <div class="profile">
                <img src="img/profile.jpg" alt="Foto de perfil" class="profile-pic">
                <p>Descripción breve sobre ti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada.</p>
            </div>
        </section>
        <section id="habilidades">
            <h2>Habilidades</h2>
            <div class="skills">
                <div class="skill">
                    <h3>HTML</h3>
                    <div class="skill-bar">
                        <div class="skill-level" style="width: 90%;">90%</div>
                    </div>
                </div>
                <div class="skill">
                    <h3>CSS</h3>
                    <div class="skill-bar">
                        <div class="skill-level" style="width: 85%;">85%</div>
                    </div>
                </div>
                <div class="skill">
                    <h3>JavaScript</h3>
                    <div class="skill-bar">
                        <div class="skill-level" style="width: 75%;">75%</div>
                    </div>
                </div>
            </div>
        </section>
        <section id="experiencia">
            <h2>Experiencia</h2>
            <div class="experience">
                <div class="trabajo">
                    <h3>Desarrollador Web</h3>
                    <p>Empresa XYZ - Enero 2020 - Presente</p>
                    <p>Desarrollador web especializado en frontend y backend. Implementación de sitios web responsivos y dinámicos.</p>
                </div>
                <div class="trabajo">
                    <h3>Diseñador UI/UX</h3>
                    <p>Empresa ABC - Junio 2018 - Diciembre 2019</p>
                    <p>Diseñador de interfaces de usuario y experiencias de usuario, con enfoque en la mejora de la usabilidad y la experiencia del cliente.</p>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-contenido">
            <div class="footer-section">
                <h4>Sobre Nosotros</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.</p>
            </div>
            <div class="footer-section">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Servicios</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contacto</h4>
                <p>Teléfono: 123-456-7890</p>
                <p>Email: info@ejemplo.com</p>
            </div>
            <div class="footer-section">
                <h4>Síguenos</h4>
                <div class="redes-sociales">
                    <a href="#"><img src="img/fb.png" alt="Facebook" width="24" height="24"></a>
                    <a href="#"><img src="img/twitter.png" alt="Twitter" width="24" height="24"></a>
                    <a href="#"><img src="img/linkedin.png" alt="LinkedIn" width="24" height="24"></a>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2024 Nombre Completo</p>
        </div>
    </footer>
    
    <!-- Modal de Iniciar Sesión -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="loginForm" method="post">
                <h2>Iniciar Sesión</h2>
                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Iniciar Sesión</button>
                <div id="loginMessage"></div>
            </form>
        </div>
    </div>
    
    <!-- Modal de Registrarse -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registerForm" method="post">
                <h2>Registrarse</h2>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Registrarse</button>
                <div id="registerMessage"></div>
            </form>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            var loginModal = $('#loginModal');
            var registerModal = $('#registerModal');

            $('#loginBtn').click(function() {
                loginModal.show();
            });

            $('#registerBtn').click(function() {
                registerModal.show();
            });

            $('.close').click(function() {
                $('.modal').hide();
            });

            $(window).click(function(event) {
                if ($(event.target).is('.modal')) {
                    $('.modal').hide();
                }
            });

            $('#loginForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'login.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#loginMessage').html(response);
                        if (response.includes('correctamente')) {
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    }
                });
            });

            $('#registerForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'register.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#registerMessage').html(response);
                        if (response.includes('creada')) {
                            setTimeout(function() {
                                registerModal.hide();
                            }, 2000);
                        }
                    }
                });
            });

            $('#logoutBtn').click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'logout.php',
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>
