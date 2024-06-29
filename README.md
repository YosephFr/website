# Website

Este proyecto es un sitio web de currículum vitae desarrollado con HTML, CSS, PHP y MySQL. El objetivo es proporcionar una plataforma para que los usuarios puedan registrar y administrar sus perfiles profesionales. El sitio incluye funcionalidades de registro e inicio de sesión, y muestra un currículum vitae en una interfaz moderna y responsiva.

## Índice

1. [Tecnologías Utilizadas](#tecnologías-utilizadas)
2. [Estructura del Proyecto](#estructura-del-proyecto)
3. [Instalación](#instalación)
4. [Descripción de Archivos y Funcionalidades](#descripción-de-archivos-y-funcionalidades)
    - [configuracion.php](#configuracionphp)
    - [index.php](#indexphp)
    - [login.php](#loginphp)
    - [register.php](#registerphp)
    - [logout.php](#logoutphp)
    - [style.css](#stylecss)
    - [main.js](#mainjs)
5. [Uso](#uso)
6. [Contribución](#contribución)
7. [Licencia](#licencia)
8. [Contacto](#contacto)

## Tecnologías Utilizadas

- **HTML**: Estructura del sitio web.
- **CSS**: Estilos y diseño del sitio web.
- **JavaScript**: Interactividad del lado del cliente.
- **PHP**: Lógica del lado del servidor.
- **MySQL**: Base de datos para almacenar usuarios.
- **jQuery**: Biblioteca JavaScript para simplificar la interacción con el DOM.

## Estructura del Proyecto

website/
│
├── css/
│   └── style.css
│
├── img/
│   ├── fb.png
│   ├── twitter.png
│   ├── linkedin.png
│   ├── logo.png
│   └── profile.jpg
│
├── js/
│   └── main.js
│
├── recursos/
│   └── Montserrat-VariableFont_wght.ttf
│
├── configuracion.php
├── index.php
├── login.php
├── register.php
├── logout.php
└── README.md

## Instalación

1. Clona el repositorio a tu máquina local.
2. Configura tu servidor web para que apunte al directorio del proyecto.
3. Asegúrate de tener PHP y MySQL instalados y configurados.
4. Crea una base de datos llamada `mi_cv`.
5. Modifica el archivo `configuracion.php` con los detalles de tu base de datos.
6. Abre el sitio web en tu navegador.

## Descripción de Archivos y Funcionalidades

### configuracion.php

Este archivo contiene la configuración de la base de datos y funciones para conectarse a la misma.

- **getDBConnection()**: Función que establece una conexión a la base de datos usando los parámetros definidos (host, usuario, contraseña, base de datos). Retorna un objeto de conexión MySQLi.

### index.php

Este archivo es la página principal del sitio web. Incluye la lógica para iniciar la sesión y mostrar la interfaz principal.

#### PHP

1. **Sesión y Configuración**

    ```php
    session_start();
    require_once 'configuracion.php';
    $conn = getDBConnection();
    ```

    - **session_start()**: Inicia una nueva sesión o reanuda la sesión existente.
    - **require_once 'configuracion.php'**: Incluye el archivo de configuración necesario para la conexión a la base de datos.
    - **getDBConnection()**: Obtiene la conexión a la base de datos.

2. **Creación de Base de Datos y Tablas**

    ```php
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
    ```

    - **Crear Base de Datos**: Si no existe, se crea la base de datos `mi_cv`.
    - **Seleccionar Base de Datos**: Se selecciona la base de datos `mi_cv`.
    - **Crear Tabla `usuarios`**: Define una tabla para almacenar información de los usuarios si no existe.
    - **Cerrar Conexión**: `conn->close();` cierra la conexión a la base de datos.

#### HTML

1. **Estructura Básica**

    ```html
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
    ```

    - **meta**: Define el conjunto de caracteres y el viewport para la responsividad.
    - **link**: Incluye el archivo CSS principal y una fuente externa.
    - **script**: Incluye jQuery para la interactividad.

2. **Encabezado y Navegación**

    ```html
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
    ```

    - **Redes Sociales**: Iconos de redes sociales en la parte superior.
    - **Logo y Navegación**: Incluye el logo y el menú de navegación.
    - **Botones de Autenticación**: Muestra botones de inicio de sesión o desconexión dependiendo del estado de la sesión.

3. **Contenido Principal**

    ```html
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
    ```

    - **Resumen**: Sección que incluye una foto de perfil y una breve descripción.
    - **Habilidades**: Lista de habilidades con barras de progreso.
    - **Experiencia**: Detalle de la experiencia laboral con títulos y descripciones.

4. **Pie de Página**

    ```html
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
    ```

    - **Secciones del Pie de Página**: Incluye información sobre la empresa, enlaces rápidos, información de contacto y enlaces a redes sociales.

5. **Modales de Autenticación**

    ```html
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
    ```

    - **Modales**: Implementan ventanas modales para inicio de sesión y registro, incluyendo formularios para ingresar datos del usuario.

6. **JavaScript/jQuery para Interactividad**

    ```html
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
    ```

    - **Mostrar y Ocultar Modales**: Usa jQuery para mostrar y ocultar los modales de inicio de sesión y registro.
    - **Manejo de Formularios**: Implementa AJAX para manejar los formularios de inicio de sesión y registro sin recargar la página.
    - **Cerrar Sesión**: Maneja la lógica de cierre de sesión con AJAX.

## login.php

El archivo `login.php` gestiona el proceso de inicio de sesión de los usuarios, validando las credenciales contra la base de datos.

### Funciones y Descripción

- **Recibir Datos del Formulario**: Recibe datos del formulario enviado por AJAX.
- **Validar Credenciales**: Consulta la base de datos para validar las credenciales del usuario.
- **Iniciar Sesión**: Si las credenciales son correctas, inicia una sesión y retorna un mensaje de éxito.

### Código y Explicación

```php
<?php
// login.php
require_once 'configuracion.php';
session_start();

- **require_once 'configuracion.php'**: Incluye el archivo de configuración para conectar a la base de datos.
- **session_start()**: Inicia una nueva sesión o reanuda la sesión existente.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

- **$_SERVER["REQUEST_METHOD"] == "POST"**: Verifica si la solicitud es de tipo POST.
- **$email = $_POST['email']** y **$password = $_POST['password']**: Obtiene los datos del formulario de inicio de sesión.

    $conn = getDBConnection();

- **getDBConnection()**: Establece una conexión con la base de datos usando la función definida en `configuracion.php`.

    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE correo = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);

- **$sql**: Define la consulta SQL para seleccionar el id, nombre y contraseña del usuario cuyo correo coincide con el ingresado.
- **$stmt = $conn->prepare($sql)**: Prepara la consulta SQL.
- **$stmt->bind_param("s", $email)**: Vincula el parámetro del correo electrónico a la consulta preparada.

        if ($stmt->execute()) {
            $stmt->store_result();

- **$stmt->execute()**: Ejecuta la consulta SQL.
- **$stmt->store_result()**: Almacena el resultado de la consulta.

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

- **$stmt->num_rows == 1**: Verifica si se encontró un usuario con el correo electrónico proporcionado.
- **$stmt->bind_result($id, $nombre, $hashed_password)**: Vincula las variables a los resultados de la consulta.
- **$stmt->fetch()**: Recupera los valores de los resultados.
- **password_verify($password, $hashed_password)**: Verifica que la contraseña ingresada coincida con la contraseña hash almacenada.
- **$_SESSION['id'], $_SESSION['email'], $_SESSION['nombre']**: Guarda los datos del usuario en variables de sesión si la contraseña es correcta.
- **Mensajes de error**: Se proporcionan mensajes si la contraseña es incorrecta o si no existe una cuenta con el correo ingresado.

        } else {
            echo "Algo salió mal. Por favor, inténtelo de nuevo.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
```

- **Error de ejecución**: Muestra un mensaje de error si la consulta no se ejecuta correctamente.
- **$stmt->close()**: Cierra la declaración preparada.
- **$conn->close()**: Cierra la conexión a la base de datos.

### Resumen de Funcionalidad

El archivo `login.php` maneja el proceso de inicio de sesión verificando las credenciales del usuario contra la base de datos. Si las credenciales son válidas, se inicia una sesión y se guardan los detalles del usuario en variables de sesión. Los mensajes de éxito o error se devuelven en función del resultado de la verificación de credenciales.

## register.php

El archivo `register.php` maneja el registro de nuevos usuarios, almacenando sus datos en la base de datos `usuarios`.

### Funciones y Descripción

- **Recibir Datos del Formulario**: Recibe datos del formulario enviado por AJAX.
- **Validar Datos**: Verifica que el correo no esté registrado previamente.
- **Guardar Usuario**: Si los datos son válidos, guarda el usuario en la base de datos y retorna un mensaje de éxito.

### Código y Explicación

```php
<?php
// register.php
require_once 'configuracion.php';

- **require_once 'configuracion.php'**: Incluye el archivo de configuración para conectar a la base de datos.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

- **$_SERVER["REQUEST_METHOD"] == "POST"**: Verifica si la solicitud es de tipo POST.
- **$name = $_POST['name']** y **$email = $_POST['email']**: Obtiene los datos del formulario de registro.
- **$password = password_hash($_POST['password'], PASSWORD_DEFAULT)**: Encripta la contraseña utilizando el algoritmo `PASSWORD_DEFAULT`.

    $conn = getDBConnection();

- **getDBConnection()**: Establece una conexión con la base de datos usando la función definida en `configuracion.php`.

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $name, $email, $password);

- **$sql**: Define la consulta SQL para insertar un nuevo usuario en la tabla `usuarios`.
- **$stmt = $conn->prepare($sql)**: Prepara la consulta SQL.
- **$stmt->bind_param("sss", $name, $email, $password)**: Vincula los parámetros del nombre, correo electrónico y contraseña encriptada a la consulta preparada.

        if ($stmt->execute()) {
            echo "Cuenta creada exitosamente.";
        } else {
            echo "Algo salió mal. Por favor, inténtelo de nuevo.";
        }

- **$stmt->execute()**: Ejecuta la consulta SQL.
- **echo "Cuenta creada exitosamente."**: Muestra un mensaje de éxito si la consulta se ejecuta correctamente.
- **echo "Algo salió mal. Por favor, inténtelo de nuevo."**: Muestra un mensaje de error si la consulta no se ejecuta correctamente.

        $stmt->close();
    }

    $conn->close();
}
?>
```

- **$stmt->close()**: Cierra la declaración preparada.
- **$conn->close()**: Cierra la conexión a la base de datos.

### Resumen de Funcionalidad

El archivo `register.php` maneja el proceso de registro de nuevos usuarios. Recibe los datos del formulario de registro, encripta la contraseña del usuario y almacena la información en la base de datos. Se proporcionan mensajes de éxito o error en función del resultado de la operación de inserción en la base de datos.

## logout.php

El archivo `logout.php` finaliza la sesión del usuario actual y redirige a la página de inicio.

### Funciones y Descripción

- **Cerrar Sesión**: Finaliza la sesión actual y limpia todas las variables de sesión.

### Código y Explicación

```php
<?php
// logout.php
session_start();
session_unset();
session_destroy();
echo "Sesión cerrada correctamente.";
?>
```

- **session_start()**: Inicia una nueva sesión o reanuda la sesión existente.
- **session_unset()**: Limpia todas las variables de sesión.
- **session_destroy()**: Destruye la sesión actual.
- **echo "Sesión cerrada correctamente."**: Muestra un mensaje indicando que la sesión se ha cerrado correctamente.

### Resumen de Funcionalidad

El archivo `logout.php` se encarga de finalizar la sesión del usuario actual limpiando todas las variables de sesión y destruyendo la sesión. Un mensaje de confirmación se muestra para indicar que la sesión se ha cerrado correctamente.

---

## configuracion.php

El archivo `configuracion.php` contiene la configuración de la base de datos y funciones para conectarse a la misma.

### Funciones y Descripción

- **Parámetros de Conexión**: Define los parámetros necesarios para conectarse a la base de datos.
- **Función de Conexión**: Establece y retorna una conexión a la base de datos.

### Código y Explicación

```php
<?php
// configuracion.php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mi_cv');
define('DB_PORT', 3306);

- **define('DB_SERVER', 'localhost')**: Define el servidor de la base de datos.
- **define('DB_USERNAME', 'root')**: Define el nombre de usuario de la base de datos.
- **define('DB_PASSWORD', '')**: Define la contraseña de la base de datos.
- **define('DB_NAME', 'mi_cv')**: Define el nombre de la base de datos.
- **define('DB_PORT', 3306)**: Define el puerto de la base de datos.

function getDBConnection() {
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }
    return $mysqli;
}
```

- **getDBConnection()**: Función que establece una conexión a la base de datos usando los parámetros definidos anteriormente.
- **$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT)**: Crea una nueva instancia de la clase `mysqli` para conectarse a la base de datos.
- **$mysqli->connect_error**: Verifica si hay algún error de conexión.
- **die("Error de conexión: " . $mysqli->connect_error)**: Termina el script si hay un error de conexión y muestra el mensaje de error.
- **return $mysqli**: Retorna el objeto de conexión `mysqli`.

### Resumen de Funcionalidad

El archivo `configuracion.php` define los parámetros de conexión a la base de datos y proporciona una función para establecer y retornar una conexión a la misma. Si ocurre un error de conexión, el script se detiene y muestra un mensaje de error.

## style.css

El archivo `style.css` define los estilos y el diseño visual del sitio web, asegurando una apariencia moderna y responsiva.

### Funciones y Descripción

- **Estilos Generales**: Define los estilos base para el cuerpo del documento, incluyendo la fuente, colores y espaciado.
- **Encabezado y Navegación**: Estilos específicos para el encabezado, logo, menú de navegación y botones de autenticación.
- **Secciones Principales**: Estilos para las secciones de resumen, habilidades y experiencia.
- **Pie de Página**: Estilos para el pie de página, incluyendo las secciones de contacto y enlaces rápidos.
- **Modales**: Estilos para los modales de inicio de sesión y registro.
- **Responsividad**: Media queries para asegurar que el diseño sea responsivo y se adapte a diferentes tamaños de pantalla.

## Conclusión y Repaso General

### Tecnologías Utilizadas

Este proyecto de currículum vitae está construido utilizando una combinación de varias tecnologías clave:

- **HTML**: Para la estructura del sitio web.
- **CSS**: Para los estilos y el diseño visual del sitio web, asegurando una apariencia moderna y responsiva.
- **JavaScript (jQuery)**: Para la interactividad del lado del cliente, como la gestión de modales y envío de formularios mediante AJAX.
- **PHP**: Para la lógica del lado del servidor, gestionando la autenticación de usuarios y la interacción con la base de datos.
- **MySQL**: Como sistema de gestión de bases de datos, para almacenar información de los usuarios.

### Funcionalidades Principales

1. **Registro de Usuarios**: Los nuevos usuarios pueden registrarse proporcionando su nombre, correo electrónico y contraseña. La contraseña se encripta antes de almacenarse en la base de datos.
2. **Inicio de Sesión**: Los usuarios pueden iniciar sesión proporcionando sus credenciales. Las credenciales se validan contra los datos almacenados en la base de datos.
3. **Cierre de Sesión**: Los usuarios pueden cerrar sesión, lo que destruye la sesión actual y limpia todas las variables de sesión.
4. **Interfaz de Usuario**: Una interfaz moderna y responsiva que incluye secciones para el resumen, habilidades y experiencia del usuario.
5. **Modales de Autenticación**: Uso de ventanas modales para el inicio de sesión y registro, mejorando la experiencia del usuario.
6. **Diseño Responsivo**: El diseño del sitio se adapta a diferentes tamaños de pantalla, asegurando una buena experiencia en dispositivos móviles y de escritorio.

### Estructura del Código

- **configuracion.php**: Contiene las configuraciones de la base de datos y una función para establecer la conexión.
- **index.php**: La página principal que maneja la creación de la base de datos y la tabla de usuarios, además de incluir la estructura HTML del sitio.
- **login.php**: Maneja el proceso de inicio de sesión de los usuarios, validando las credenciales y gestionando la sesión.
- **register.php**: Gestiona el registro de nuevos usuarios, encriptando la contraseña y almacenando los datos en la base de datos.
- **logout.php**: Finaliza la sesión del usuario actual.
- **style.css**: Define los estilos y el diseño visual del sitio web.
- **main.js**: Contiene el código JavaScript para la interactividad del lado del cliente.

### Forma en la que Está Hecho el Código

El proyecto está organizado de manera que cada archivo tiene una responsabilidad específica. Esta modularidad facilita el mantenimiento y la escalabilidad del proyecto. El uso de PHP y MySQL para la lógica del servidor y la gestión de datos asegura que el sitio pueda manejar múltiples usuarios y sesiones de manera eficiente. El uso de HTML, CSS y JavaScript (jQuery) permite crear una interfaz de usuario atractiva y responsiva.

### Conclusión

Este proyecto demuestra cómo se pueden integrar diferentes tecnologías web para crear una aplicación completa y funcional. Desde la gestión de usuarios hasta la interfaz de usuario, cada parte del proyecto está diseñada para ser eficiente, segura y fácil de usar. La combinación de PHP y MySQL proporciona una base sólida para la lógica del servidor y la gestión de datos, mientras que HTML, CSS y JavaScript aseguran una experiencia de usuario moderna y atractiva.

### Uso

Para usar este sitio web, abre tu navegador y dirígete a la dirección donde está alojado tu proyecto. Regístrate o inicia sesión para acceder a las funcionalidades completas del currículum vitae.

### Contribución

Si deseas contribuir a este proyecto, por favor sigue los pasos a continuación:

1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz commit (`git commit -am 'Agrega nueva funcionalidad'`).
4. Haz push a la rama (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.

### Licencia

Este proyecto está licenciado bajo la Licencia MIT. Para más detalles, consulta el archivo `LICENSE`.

### Contacto

Si tienes alguna pregunta o sugerencia, no dudes en contactarme a través de [contacto@enigmasac.com](mailto:contacto@enigmasac.com).

