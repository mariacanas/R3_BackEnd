


<?php require 'menu.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar datos usuario</title>
</head>
<body>
    
    <?php

        $username = $_SESSION['username'];

        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "Recetas");


       
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $new_nombre = $_POST['nombre'];
            $new_apellidos = $_POST['apellidos'];
            $new_password = $_POST['password'];

            // Cifrado de la nueva contraseña si se proporciona
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                $datos_update = $conexion->prepare("UPDATE users_pec3 SET nombre = ?, apellidos = ?, password = ? WHERE username = ?");
                $datos_update->bind_param("ssss",  $new_nombre, $new_apellidos, $hashed_password, $_SESSION['username']);
            } else {
                $datos_update = $conexion->prepare("UPDATE users_pec3 SET nombre = ?, apellidos = ? WHERE username = ?");
                $datos_update->bind_param("sss", $new_nombre, $new_apellidos, $_SESSION['username']);
            }
            
            if ($datos_update->execute()) {
                echo "<p>Datos actualizados</p>";
            } else {
                echo "Error: " . $datos_update->error;
            }

            $datos_update->close();
        }
        
         // Obtener la información del usuario
         $datos = $conexion->prepare("SELECT nombre, apellidos FROM users_pec3 WHERE username = ?");
         $datos->bind_param("s", $username);
         $datos->execute();
         $datos->bind_result($nombre, $apellidos);
         $datos->fetch();
         $datos->close();
    
        
        $conexion->close();
    ?>

    <h2>Editar datos usuario</h2>
    <form action="edit.php" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre);; ?>" required>
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($apellidos); ?>" required>
        <label for="password">Nueva contrasena</label>
        <input type="password" id="password" name="password">
        <button type="submit">Actualizar datos</button>
    </form>


</body>
</html>
