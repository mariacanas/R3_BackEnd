



<?php 

// Conexión con la base de datos
$conexion = new mysqli("localhost", "root", "", "Recetas");


//Variable para obtener el id
$id = 0;

if (isset($_GET['id'])) {
    $id = $_GET['id'];  
}

//Consulta a la base de datos
$datos = "SELECT * from recetas WHERE Id = $id";
$resultado_datos = $conexion->query($datos);

//Se comprueba si ha encontrad la receta de la que se pasa el id
if($resultado_datos->num_rows>0){
    //En el caso de que encuentre la receta, se obtiene la información de ella para mostrarla por pantalla
    $receta = $resultado_datos->fetch_assoc();
    //Imprime la información de la receta en formato JSON
    echo json_encode($receta);
}
else{
    echo json_encode(["error" => "Receta no encontrada"]);
}

//Cerrar la conexión con la BD
$conexion->close();

?>