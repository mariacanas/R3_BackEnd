

<?php
require 'menu.php';

//Conexion con la base de datos
$conexion = new mysqli("localhost","root","","Recetas");

//Variable donde se guarda el id de la receta que recibimos por la url
$idReceta = $_GET['id'];

//Consulta para obtener los datos de esa receta
$datos_receta = "SELECT * from Recetas where Id = $idReceta";
$resultado = $conexion->query($datos_receta);

//Comprobación de si tenemos la receta con ese id
if($resultado->num_rows>0){
    $receta = $resultado->fetch_assoc();
    echo "<h2>" . "Nombre " .$receta['nombreReceta'] . "</a></h2>";
    echo "<p>"  . "Fecha de publicación " . date('d/m/Y', strtotime($receta['fechaHora'])) . "</p>";
    echo "<p>"  ."Categoria ".$receta['categoria'] . "</p>";
    echo "<p>" . "Tiempo de preparación " .$receta['tiempoPreparacion'] . " minutos" ."</p>";
    echo "<p>" . "Nivel de dificultad ".$receta['nivelDificultad'] . "</p>";
       
    echo "<p>" . "Instrucciones " .$receta['instrucciones'] . "</p>";
    echo "<img src='" .$receta['imagen'] . "' alt='Imagen de la Receta' width='400' height='300'>";
}
else{
    echo "No se ha encontrado esa receta";
}

//Cerramos la conexión con la BD
$conexion->close();
?>