
<?php 

require 'menu.php';

//Conexion con la base de datos
$conexion = new mysqli("localhost","root","","Recetas");

//Consulta para obtener los datos de una Receta 
    //(Vamos a obtener los datos de la receta con id 1)
$datos = "SELECT * FROM recetas where id=1";
$resultado = $conexion->query($datos);

//Mostrar la información de la receta seleccionada
$receta = $resultado->fetch_assoc();

echo "<h1>" . $receta['nombreReceta'] . "</h1>";
echo "<p>" . $receta['fechaHora'] . "</p>";
echo "<p>" . $receta['categoria'] . "</p>";
echo "<p>" . $receta['ingredientes'] . "</p>";
echo "<p>" . $receta['tiempoPreparacion'] . "</p>";
echo "<p>" . $receta['nivelDificultad'] . "</p>";
echo "<p>" . $receta['instrucciones'] . "</p>";
echo "<img src='" . $receta['imagen'] . "' alt='Imagen de la Receta' width='400' height='300'>";


//Cerramos la conexión con la BD
$conexion->close();
?>