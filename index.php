<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "feb22mar03AR.";
$dbname = "guía php hosting";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<div style='font-family: Arial; margin: 20px;'>";

    // Ejercicio 4 - Generar número aleatorio
    if (isset($_POST['ejercicio4'])) {
        $numeroAleatorio = rand(1, 100);
        echo "<h3>Ejercicio 4: Generación de un Número Aleatorio</h3>";
        echo "<p>Número aleatorio generado: <strong>$numeroAleatorio</strong></p>";
    }

    // Ejercicio 5 - Tipos de variables
    if (isset($_POST['ejercicio5'])) {
        $integer = 42;
        $double = 3.14;
        $string = "Hola Mundo";
        $boolean = true;
        echo "<h3>Ejercicio 5: Tipos de Variables</h3>";
        echo "<p><strong>Integer:</strong> $integer<br><strong>Double:</strong> $double<br><strong>String:</strong> $string<br><strong>Boolean:</strong> $boolean</p>";
    }

    // Ejercicio 6 - Variables de tipo string
    if (isset($_POST['ejercicio6'])) {
        $precio = 90;
        $cantidad = 5;
        $total = $precio * $cantidad;
        echo "<h3>Ejercicio 6: Cálculo de Total con Variables String</h3>";
        echo "<p>La computadora tiene un precio de <strong>$$precio</strong> y la cantidad es <strong>$cantidad</strong>. El total es: <strong>$$total</strong></p>";
    }

    // Ejercicio 7 - Estructura condicional (if)
    if (isset($_POST['ejercicio7'])) {
        $valor = rand(1, 3);
        $resultado = ($valor == 1) ? "uno" : (($valor == 2) ? "dos" : "tres");
        echo "<h3>Ejercicio 7: Estructura Condicional</h3>";
        echo "<p>El valor es: <strong>$resultado</strong></p>";
    }

    // Ejercicio 8 - Estructuras repetitivas (for)
    if (isset($_POST['ejercicio8'])) {
        echo "<h3>Ejercicio 8: Tabla de Multiplicación</h3>";
        for ($i = 2; $i <= 10; $i++) {
            echo "<p>2 x $i = " . (2 * $i) . "</p>";
        }
    }

    // Ejercicio 9 - Envío de datos de un formulario (text y submit)
    if (isset($_POST['ejercicio9'])) {
        $nombre = htmlspecialchars($_POST['nombre']);
        $edad = (int)$_POST['edad'];
        $mayoriaEdad = ($edad >= 18) ? "es mayor de edad" : "es menor de edad";
        echo "<h3>Ejercicio 9: Edad y Condición</h3>";
        echo "<p>$nombre <strong>$mayoriaEdad</strong>.</p>";
    }

    // Ejercicio 10 - Formulario (control radio)
    if (isset($_POST['ejercicio10'])) {
        $nombre = htmlspecialchars($_POST['nombre']);
        $estudios = htmlspecialchars($_POST['estudios']);
        echo "<h3>Ejercicio 10: Nivel de Estudios</h3>";
        echo "<p>$nombre tiene estudios: <strong>$estudios</strong></p>";
    }

    // Ejercicio 11 - Formulario (control checkbox)
    if (isset($_POST['ejercicio11'])) {
        $nombre = htmlspecialchars($_POST['nombre']);
        $deportes = isset($_POST['deportes']) ? $_POST['deportes'] : [];
        $cantidadDeportes = count($deportes);
        echo "<h3>Ejercicio 11: Deportes Practicados</h3>";
        echo "<p>$nombre practica <strong>$cantidadDeportes deporte(s)</strong>.</p>";
    }

    // Ejercicio 12 - Formulario (control select)
    if (isset($_POST['ejercicio12'])) {
        $nombre = htmlspecialchars($_POST['nombre']);
        $ingresos = $_POST['ingresos'];
        $pagoImpuestos = ($ingresos == '>3000') ? "debe pagar" : "no debe pagar";
        echo "<h3>Ejercicio 12: Ingresos y Obligación de Pago</h3>";
        echo "<p>$nombre <strong>$pagoImpuestos impuestos</strong> a las ganancias.</p>";
    }

    // Ejercicio 13 - Formulario (control textarea)
    if (isset($_POST['ejercicio13'])) {
        $contrato = htmlspecialchars($_POST['contrato']);
        echo "<h3>Ejercicio 13: Contrato Modificado</h3>";
        echo "<p>" . nl2br($contrato) . "</p>";
    }

    // Ejercicio 14 - Vectores (tradicionales)
    if (isset($_POST['ejercicio14'])) {
        $dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        echo "<h3>Ejercicio 14: Días de la Semana</h3>";
        echo "<p>Primer día de la semana: <strong>" . $dias[0] . "</strong><br>Último día de la semana: <strong>" . $dias[count($dias) - 1] . "</strong></p>";
    }

    // Ejercicio 15 - Creación de un pedido de pizza
    if (isset($_POST['ejercicio15'])) {
        $nombre = htmlspecialchars($_POST['nombre']);
        $direccion = htmlspecialchars($_POST['direccion']);
        $pizzas = isset($_POST['pizza']) ? $_POST['pizza'] : [];
        $cantidad = (int)$_POST['cantidad'];
        $pizzas_str = implode(", ", $pizzas);

        // Consulta para insertar el pedido en la base de datos
        $sql = "INSERT INTO pedidos (nombre, direccion, pizzas, cantidad)
                VALUES ('$nombre', '$direccion', '$pizzas_str', $cantidad)";

        echo "<h3>Ejercicio 15: Pedido de Pizza</h3>";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Pedido guardado en la base de datos.</p>";

            // Guardar el pedido en un archivo de texto
            $pedido = "Nombre: $nombre, Dirección: $direccion, Pizzas: $pizzas_str, Cantidad: $cantidad\n";
            file_put_contents("pedidos.txt", $pedido, FILE_APPEND);
            echo "<p>Pedido guardado en el archivo <strong>pedidos.txt</strong>.</p>";
        } else {
            echo "<p>Error al guardar el pedido: " . $conn->error . "</p>";
        }
    }

    // Ejercicio 16 - Lectura de un archivo de texto
    if (isset($_POST['ejercicio16'])) {
        echo "<h3>Ejercicio 16: Lectura de Pedidos</h3>";
        $file_path = "pedidos.txt";

        if (file_exists($file_path)) {
            $file = fopen($file_path, "r");
            echo "<pre>";
            while ($line = fgets($file)) {
                echo htmlspecialchars($line);
            }
            echo "</pre>";
            fclose($file);
        } else {
            echo "<p>El archivo <strong>pedidos.txt</strong> no existe.</p>";
        }
    }

    // Ejercicio 17 - Vectores (asociativos)
    if (isset($_POST['ejercicio17'])) {
        $usuarios = array("user1" => "pass1", "user2" => "pass2", "user3" => "pass3");
        echo "<h3>Ejercicio 17: Claves de Usuarios</h3>";
        echo "<p>Clave del usuario <strong>user1</strong>: " . $usuarios['user1'] . "</p>";
    }

    // Ejercicio 18 - Funciones en PHP
    if (isset($_POST['ejercicio18'])) {
        $usuario = htmlspecialchars($_POST['usuario']);
        $clave = $_POST['clave'];
        $clave2 = $_POST['clave2'];

        function validar_claves($clave, $clave2) {
            return $clave === $clave2 ? "Las claves coinciden." : "Las claves no coinciden.";
        }

        echo "<h3>Ejercicio 18: Validación de Claves</h3>";
        echo "<p>" . validar_claves($clave, $clave2) . "</p>";
    }

    echo "</div>";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guía PHP con Ejercicios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Guía Completa de Ejercicios en PHP</h1>
    <form method="POST" action="index.php">
    <!-- Ejercicio 4 - Generar Número Aleatorio -->
    <section>
        <h2>Ejercicio 4 - Generar Número Aleatorio</h2>
        <input type="submit" name="ejercicio4" value="Ejecutar Ejercicio 4">
    </section>

    <!-- Ejercicio 5 - Tipos de Variables -->
    <section>
        <h2>Ejercicio 5 - Tipos de Variables</h2>
        <input type="submit" name="ejercicio5" value="Ejecutar Ejercicio 5">
    </section>

    <!-- Ejercicio 6 - Variables de Tipo String -->
    <section>
        <h2>Ejercicio 6 - Variables de Tipo String</h2>
        <input type="submit" name="ejercicio6" value="Ejecutar Ejercicio 6">
    </section>

    <!-- Ejercicio 7 - Estructura Condicional -->
    <section>
        <h2>Ejercicio 7 - Estructura Condicional</h2>
        <input type="submit" name="ejercicio7" value="Ejecutar Ejercicio 7">
    </section>

    <!-- Ejercicio 8 - Estructura Repetitiva (For) -->
    <section>
        <h2>Ejercicio 8 - Tabla de Multiplicación</h2>
        <input type="submit" name="ejercicio8" value="Ejecutar Ejercicio 8">
    </section>

    <!-- Ejercicio 9 - Envío de Datos de un Formulario -->
    <section>
        <h2>Ejercicio 9 - Envío de Datos de un Formulario</h2>
        <label>Nombre:</label>
        <input type="text" name="nombre"><br>
        <label>Edad:</label>
        <input type="number" name="edad"><br>
        <input type="submit" name="ejercicio9" value="Ejecutar Ejercicio 9">
    </section>

    <!-- Ejercicio 10 - Control Radio -->
    <section>
        <h2>Ejercicio 10 - Control Radio</h2>
        <label>Nombre:</label>
        <input type="text" name="nombre"><br>
        <label>Nivel de Estudios:</label><br>
        <input type="radio" name="estudios" value="Primarios"> Primarios<br>
        <input type="radio" name="estudios" value="Secundarios"> Secundarios<br>
        <input type="radio" name="estudios" value="Universitarios"> Universitarios<br>
        <input type="submit" name="ejercicio10" value="Ejecutar Ejercicio 10">
    </section>

    <!-- Ejercicio 11 - Control Checkbox -->
    <section>
        <h2>Ejercicio 11 - Control Checkbox</h2>
        <label>Nombre:</label>
        <input type="text" name="nombre"><br>
        <label>Deportes que Practica:</label><br>
        <input type="checkbox" name="deportes[]" value="Fútbol"> Fútbol<br>
        <input type="checkbox" name="deportes[]" value="Tenis"> Tenis<br>
        <input type="checkbox" name="deportes[]" value="Natación"> Natación<br>
        <input type="submit" name="ejercicio11" value="Ejecutar Ejercicio 11">
    </section>

    <!-- Ejercicio 12 - Control Select -->
    <section>
        <h2>Ejercicio 12 - Control Select</h2>
        <label>Nombre:</label>
        <input type="text" name="nombre"><br>
        <label>Ingresos Mensuales:</label>
        <select name="ingresos">
            <option value="<1000">Menos de $1000</option>
            <option value="1000-3000">$1000 - $3000</option>
            <option value=">3000">Más de $3000</option>
        </select><br>
        <input type="submit" name="ejercicio12" value="Ejecutar Ejercicio 12">
    </section>

    <!-- Ejercicio 13 - Control Textarea -->
    <section>
        <h2>Ejercicio 13 - Control Textarea</h2>
        <label>Contrato Modificado:</label><br>
        <textarea name="contrato" rows="5" cols="40">Ingrese el contrato aquí...</textarea><br>
        <input type="submit" name="ejercicio13" value="Ejecutar Ejercicio 13">
    </section>

    <!-- Ejercicio 14 - Vectores Tradicionales -->
    <section>
        <h2>Ejercicio 14 - Vectores Tradicionales</h2>
        <input type="submit" name="ejercicio14" value="Ejecutar Ejercicio 14">
    </section>

    <!-- Ejercicio 15 - Pedido de Pizza -->
    <section>
        <h2>Ejercicio 15 - Pedido de Pizza</h2>
        <label>Nombre:</label>
        <input type="text" name="nombre"><br>
        <label>Dirección:</label>
        <input type="text" name="direccion"><br>
        <label>Tipo de Pizza:</label><br>
        <input type="checkbox" name="pizza[]" value="Muzza"> Muzza<br>
        <input type="checkbox" name="pizza[]" value="Especial"> Especial<br>
        <input type="checkbox" name="pizza[]" value="Calabresa"> Calabresa<br>
        <label>Cantidad:</label>
        <input type="number" name="cantidad"><br>
        <input type="submit" name="ejercicio15" value="Ejecutar Ejercicio 15">
    </section>

    <!-- Ejercicio 16 - Lectura de Archivo de Texto -->
    <section>
        <h2>Ejercicio 16 - Lectura de Archivo de Texto</h2>
        <input type="submit" name="ejercicio16" value="Ejecutar Ejercicio 16">
    </section>

    <!-- Ejercicio 17 - Vectores Asociativos -->
    <section>
        <h2>Ejercicio 17 - Vectores Asociativos</h2>
        <input type="submit" name="ejercicio17" value="Ejecutar Ejercicio 17">
    </section>

    <!-- Ejercicio 18 - Funciones en PHP -->
    <section>
        <h2>Ejercicio 18 - Validación de Claves</h2>
        <label>Usuario:</label>
        <input type="text" name="usuario"><br>
        <label>Clave:</label>
        <input type="password" name="clave"><br>
        <label>Confirmar Clave:</label>
        <input type="password" name="clave2"><br>
        <input type="submit" name="ejercicio18" value="Ejecutar Ejercicio 18">
    </section>
</form>
</body>
</html>


