

<?php 


// Conexión con la base de datos
$conexion = new mysqli("localhost", "root", "", "Recetas");


//Variable para obtener el numero de pag y paginación
$numPage = 1;
$limitRecetas = 10;
$start = ($numPage - 1) * $limitRecetas;

if (isset($_GET['page'])) {
    $numPage = $_GET['page'];  
}

//Consulta a la base de datos
$datos = "SELECT * from recetas LIMIT $limitRecetas OFFSET $start";
$resultado_datos = $conexion->query($datos);

$recetas = [];

//Se comprueba si ha encontrado resultados
if($resultado_datos->num_rows > 0){
    //Mientras tenga recetas, se van a ir añadiendo al array
    while($row = $resultado_datos->fetch_assoc()){
        $recetas[] = $row;
    }
    //Imprime los resultados de las recetas en formato JSON
    echo json_encode($recetas);
}
else{
    echo json_encode(["Error" => "Error al encontrar las recetas"]);
}


//Cerrar la conexión con la BD
$conexion->close();

?>