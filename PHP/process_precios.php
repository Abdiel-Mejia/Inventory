<?php
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root"; // Tu nombre de usuario de la base de datos
$password = ""; // Tu contraseña de la base de datos
$dbname = "gestion_precios"; // Nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar Precios
if (isset($_GET['consultar'])) {
    $orden = isset($_GET['orden']) ? $_GET['orden'] : '';
    $genero = isset($_GET['genero']) ? $_GET['genero'] : 'todos';
    $sql = "SELECT descripcion, precio, fecha_creacion, imagen, genero FROM precios WHERE 1=1";

    // Filtro por género
    if ($genero != 'todos') {
        $sql .= " AND genero = '$genero'";
    }

    // Ordenar
    switch ($orden) {
        case 'precio_asc':
            $sql .= " ORDER BY precio ASC";
            break;
        case 'precio_desc':
            $sql .= " ORDER BY precio DESC";
            break;
        case 'fecha_asc':
            $sql .= " ORDER BY fecha_creacion ASC";
            break;
        case 'fecha_desc':
            $sql .= " ORDER BY fecha_creacion DESC";
            break;
    }

    $result = $conn->query($sql);


     echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aceme Sneaker Outlet</title>
        <link href="../imagenes/logo.png" rel="shortcut icon">
        <style>
        /* Estilos CSS aquí */
        video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 50%;
            min-height: 50%;
            transform: translateX(calc((100% - 100vw) / 2));
            z-index: -2;
        }
        .adj {
            text-align: right;/*Alinea a la derecha el contenido elegido*/
        }
        .nada {
            text-decoration: none;/* Quita el decorado por default del control s*/
            color: black; /*Pone el texto de color negro*/
        }
        .nad {
            text-decoration: none;/* Quita el decorado por default del control s*/
            color: rgb(255, 255, 255); /*Pone el texto de color negro*/
        }
        .amp {
            width: 100%;
        }
        table {
            width: 100%; /* Ancho de la tabla ajustado */
            margin: 20px auto; /* Margen superior e inferior, centrado horizontalmente */
            border-collapse: collapse; /* Colapsa los bordes de la tabla */
            background-color: transparent;
        }
        table, th, td {
            border: none; /* Elimina todos los bordes de las celdas */
            padding: 8px; /* Añade espacio interno a las celdas */
            text-align: center; /* Centra el texto dentro de las celdas */
            background-color: transparent;
            color: rgb(243, 255, 254);
            text-shadow: 4px 4px 8px rgb(0, 0, 0); 
        }
        th {
            background-color: rgba(255, 255, 255, 0.39); /* Color de fondo para las celdas de encabezado */
        }
        .logo {
            height: 80px;
            margin-right: 10px;
        }
        .nombre {
            text-shadow: 4px 4px 8px rgb(0, 0, 0); 
            color: azure;
        }
        /*************************************boton***********************************************/
        .bt {
            background-color: #ffffff00;
            color: #fff;
            width: 8.5em;
            height: 1.9em;
            border: #ffffff 0.2em solid;
            border-radius: 11px;
            transition: all 0.6s ease;
        }
        
        .bt:hover {
            background-color: #000000;
            cursor: pointer;
        }
        .boton {
            background-color: transparent;
            color: rgb(0, 0, 0);
            border-top: 1px azure solid;
            border-left:  azure ;
            border-right: black;
        }
        .fot {
            color: orangered;
        }
        </style>
    </head>
    <body>';

    echo '<video src="../VIDEO/FONDO.mp4" autoplay="true" muted="true" loop="true" ></video> ';
    echo '<div style="display: flex; align-items: center;text-align: center;">
            <a href="../index.html"><img src="../imagenes/logo.png" class="logo"></a>
            <a href="../index.html" class="nada"><h2 class="nombre">Aceme Sneaker Outlet</h2></a>
        </div>';
    echo '<form action="process_precios.php" method="get" class="adj">
            <label for="orden" class="nombre">Ordenar por:</label>
            <select name="orden" id="orden" class="boton">
                <option value="precio_asc" ' . ($orden == 'precio_asc' ? 'selected' : '') . '>De menor a mayor</option>
                <option value="precio_desc" ' . ($orden == 'precio_desc' ? 'selected' : '') . '>De mayor a menor</option>
                <option value="fecha_asc" ' . ($orden == 'fecha_asc' ? 'selected' : '') . '>Antiguos</option>
                <option value="fecha_desc" ' . ($orden == 'fecha_desc' ? 'selected' : '') . '>Nuevos</option>
            </select>
            <label for="genero" class="nombre">Género:</label>
            <select name="genero" id="genero" class="boton">
                <option value="todos" ' . ($genero == 'todos' ? 'selected' : '') . '>Todos</option>
                <option value="Hombre" ' . ($genero == 'Hombre' ? 'selected' : '') . '>Para caballero</option>
                <option value="Mujer" ' . ($genero == 'Mujer' ? 'selected' : '') . '>Para dama</option>
                <option value="Unisex" ' . ($genero == 'Unisex' ? 'selected' : '') . '>Unisex</option>
            </select>
            <input class="bt" type="submit" name="consultar" value="Buscar">
          </form>';

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Género</th>
                    <th>Precio</th>
                    <th>Fecha de Creación</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td><img src='" . $row["imagen"] . "' alt='" . $row["descripcion"] . "' class='img-producto'></td>
                    <td><strong>" . $row["descripcion"] . "</strong></td>
                    <td><strong>" . $row["genero"] . "</strong></td>
                    <td><strong>$" . $row["precio"] . "</strong></td>
                    <td><strong>" . $row["fecha_creacion"] . "</strong></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "0 resultados";
    }

    echo '<center>
            <footer>
                <p class="fot"><strong>© 2024 Aceme Sneaker Outlet. Todos los derechos reservados</strong></p>
                <p><strong class="fot">Correo: </strong><a class="nad" href="mailto:zeus_ab@hotmail.com">zeus_ab@outlook.com</a>
                | <strong class="fot">Perfil de </strong><a class="nad" href="https://github.com/Abdiel-Mejia">Github</a></p>
            </footer>
          </center>';
}

$conn->close();
?>
