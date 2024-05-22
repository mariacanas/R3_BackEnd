

<?php require 'menu.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
</head>
<body>
    <h2>Crear usuario</h2>
    <form action="signup.php" method="post">
        <label for="username">Nombre usuario</label>
        <input type="text" id="username" name="username" required>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" required>
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
        <label for="password">Confirmar Contraseña</label>
        <input type="password" id="confirmpassword" name="confirmpassword">
        <button type="submit">Iniciar Sesion</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "Recetas");
        
        //Comprobar si el usuario que quiere crear ya existe
        $sqlUse = $conexion->prepare("SELECT * FROM users_pec3 WHERE username = ?");
        $sqlUse->bind_param("s",$username);
        $sqlUse->execute();
        $resUser = $sqlUse->get_result();

        //Si encuentra un usuario con ese username
        if($resUser->num_rows>0){
            echo "<p> Ya existe un usuario con ese nombre. Cambia el nombre </p>";
        }
        //Si no tengo ese usuario con ese username
        else{
           
            //Comprobación de si las dos contraseñas son iguales
            if($confirmpassword === $password){
                  // Cifrado de la contraseña
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            
                // Inserción del usuario en la base de datos
                $datos = $conexion->prepare("INSERT INTO users_pec3 (username, nombre, apellidos, password) VALUES (?, ?, ?, ?)");
                $datos->bind_param("ssss", $username, $nombre, $apellidos, $hashed_password);
                
                if ($datos->execute()) {
                    echo "Usuario registrado Correctamente";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error al crear el usuario ";
                }
            }
            else{
                echo "<p>Las contraseñas no coinciden </p>";
            }
            $datos->close();
        }
        
        $resUser->close();
        $conexion->close();
    }
    ?>
</body>
</html>
