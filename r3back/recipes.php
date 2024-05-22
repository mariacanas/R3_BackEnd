

<?php require 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas</title>
</head>
<body>

<h1>Listado de las Recetas</h1>

<!--Formulario con los filtros-->
<form action="recipes.php" method="get">
    <!--Formulario de ordenación-->
    <label for="ordenTitulo">Ordenar Título:</label>
    <select name="ordenTitulo" id="ordenTitulo">
        <option value="titulo_asc">Título (A-Z)</option>
        <option value="titulo_desc">Título (Z-A)</option>
    </select>

    <label for="ordenTiempo">Ordenar Tiempo:</label>
    <select name="ordenTiempo" id="ordenTiempo">
        <option value="tiempo_asc">Ascendente</option>
        <option value="tiempo_desc">Descendente</option>
    </select>
    <!--Formulario de filtro-->

    <label for="categoria">Categoría:</label>
    <select name="categoria" id="categoria">
        <option value="">Todas</option>
        <option value="Italiano">Italiano</option>
        <option value="Mexicano">Mexicano</option>
        <option value="Español">Español</option>
    </select>

    <label for="dificultad">Nivel de Dificultad:</label>
    <select name="dificultad" id="dificultad">
        <option value="">Todas</option>
        <option value="Alto">Alto</option>
        <option value="Medio">Medio</option>
        <option value="Bajo">Bajo</option>
    </select>

    <input type="submit" value="Aplicar Filtros">
</form>

<?php

// Conexión con la base de datos
$conexion = new mysqli("localhost", "root", "", "Recetas");

// Consulta base
$datos = "SELECT * FROM recetas";

    // Variables para los filtros de búsqueda
    $filtro = [];
    if (isset($_GET['categoria']) && $_GET['categoria'] != "") {
        $categoria = $_GET['categoria'];
        $filtro[] = "categoria = '$categoria'";
    }

    if (isset($_GET['dificultad']) && $_GET['dificultad'] != "") {
        $dificultad = $_GET['dificultad'];
        $filtro[] = "nivelDificultad = '$dificultad'";
    }

    if (count($filtro) > 0) {
        $datos .= " WHERE " . implode(" AND ", $filtro);
    }

    // Añadir ordenación a la consulta
    $orden = [];
    if (isset($_GET['ordenTitulo']) && $_GET['ordenTitulo'] != "") {
        $ordenTitulo = $_GET['ordenTitulo'];
        if ($ordenTitulo == 'titulo_asc') {
            $orden[] = "nombreReceta DESC";
        } elseif ($ordenTitulo == 'titulo_desc') {
            $orden[] = "nombreReceta ASC";
        }
    }

    if (isset($_GET['ordenTiempo']) && $_GET['ordenTiempo'] != "") {
        $ordenTiempo = $_GET['ordenTiempo'];
        if ($ordenTiempo == 'tiempo_asc') {
            $orden[] = "tiempoPreparacion DESC";
        } elseif ($ordenTiempo == 'tiempo_desc') {
            $orden[] = "tiempoPreparacion ASC";
        }
    }

    if (count($orden) > 0) {
        $datos .= " ORDER BY " . implode(", ", $orden);
    }

    // Ejecutar consulta para obtener el total de resultados
    $resultado = $conexion->query($datos);
    $total = $resultado->num_rows;

    // Paginación
    $limiteRecetasPagina = 5;
    $pages = ceil($total / $limiteRecetasPagina);

    // Página actual
    if (isset($_GET['pagina'])) {
        $page = $_GET['pagina'];
    } else {
        $page = 1;
    }

    $start = ($page - 1) * $limiteRecetasPagina;

    // Añadir límites de paginación a la consulta
    $datos .= " LIMIT $start, $limiteRecetasPagina";
    $resultado_recetas = $conexion->query($datos);

    echo "<ul>";
    while ($receta = $resultado_recetas->fetch_assoc()) {
        echo "<li>";
        echo "<h2><a href='post.php?id=" . $receta['Id'] . "'>" . $receta['nombreReceta'] . "</a></h2>";
        echo "<p>Fecha de publicación: " . date('d/m/Y', strtotime($receta['fechaHora'])) . "</p>";
        echo "<p>Categoría: " . $receta['categoria'] . "</p>";
        echo "<p>Tiempo de preparación: " . $receta['tiempoPreparacion'] . " minutos</p>";
        echo "<p>Nivel de dificultad: " . $receta['nivelDificultad'] . "</p>";

        // Límite de palabras en las instrucciones
        $palabras = explode(' ', $receta['instrucciones']);
        $primeras30Palabras = implode(' ', array_slice($palabras, 0, 30));

        echo "<p>Instrucciones: " . $primeras30Palabras . "</p>";
        echo "<img src='" . $receta['imagen'] . "' alt='Imagen de la Receta' width='400' height='300'>";
        echo "</li>";
    }
    echo "</ul>";

    // Mostrar enlaces de las páginas
    echo "<div>";
    for ($i = 1; $i <= $pages; $i++) {
        echo "<a href='?pagina=$i&ordenTitulo=" . (isset($_GET['ordenTitulo']) ? $_GET['ordenTitulo'] : '') .
            "&ordenTiempo=" . (isset($_GET['ordenTiempo']) ? $_GET['ordenTiempo'] : '') .
            "&categoria=" . (isset($_GET['categoria']) ? $_GET['categoria'] : '') .
            "&dificultad=" . (isset($_GET['dificultad']) ? $_GET['dificultad'] : '') . "'>$i</a> ";
    }
    echo "</div>";

    // Cerrar la conexión con la BD
    $conexion->close();
    ?>

</body>
</html>
