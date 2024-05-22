

<?php
require 'menu.php';

//Conexion con la base de datos
$conexion = new mysqli("localhost","root","","Recetas");

if(isset($_SESSION['username'])):echo "<p>Bienvenida a la pagina " . $_SESSION['username'] . "</p>"; endif;

//Consulta a la base de datos para conseguir las últimas 5 recetas
$datos = "SELECT * from recetas ORDER BY fechaHora DESC LIMIT 5";
$resultado = $conexion->query($datos);

//Bucle para mostrar la información de las recetas en formato de lista
echo "<ul>";
while($receta = $resultado->fetch_assoc()){
    echo "<li>";
    echo "<h2><a href='post.php?id=" . $receta['Id'] . "'>" . "Nombre " .$receta['nombreReceta'] . "</a></h2>";
    echo "<p>"  . "Fecha de publicación " . date('d/m/Y', strtotime($receta['fechaHora'])) . "</p>";
    echo "<p>"  ."Categoria ".$receta['categoria'] . "</p>";
    echo "<p>" . "Tiempo de preparación " .$receta['tiempoPreparacion'] . " minutos" ."</p>";
    echo "<p>" . "Nivel de dificultad ".$receta['nivelDificultad'] . "</p>";
    
    //Limite de caracteres en las instrucciones
        //Para ajustar el limite de las palabras, voy a deividir el texto de las instrucciones en palabras
        //y seleccionar las 30 primeras
    $palabras = explode(' ', $receta['instrucciones']);
    $primeras30Palabras = implode(' ', array_slice($palabras, 0,30));
    
    echo "<p>" . "Instrucciones " .$primeras30Palabras . "</p>";
    echo "<img src='" .$receta['imagen'] . "' alt='Imagen de la Receta' width='400' height='300'>";
    echo "</li>";
}
echo "</ul>";

//Cerramos la conexión con la BD
$conexion->close();
?>