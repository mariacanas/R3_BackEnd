
<?php require 'menu.php' ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h1>Iniciar Sesion</h1>

    <form action="login.php" method="POST">
        <label for="username"> Nombre de Usuario </label>
        <input type="text" id="username" name="username" required>
        <label for="password">Contraseña</label>
        <input type="password" id="password"name="password" required>
        <button type="submit">Iniciar Sesion</button>
    </form>

    <?php
        //Comprueba si el formulario con los datos de iniciar sesión se han enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conexion = new mysqli("localhost","root","","Recetas");

            //Variable donde se almacena los datos introducidos por el usuario
            $username = $_POST['username'];
            $password = $_POST['password'];

            //Consulta a la tabla de la bd para comprobar si existen los datos introducidos
            $sql = "SELECT * FROM users_pec3 WHERE username = ?";
            //Para obtener los datos del usuario de la BD se usa prepare para evitar inyeccioines SQL
            $resultado_datos = $conexion->prepare($sql);
            $resultado_datos->bind_param("s",$username);
            $resultado_datos->execute();
            $rst = $resultado_datos->get_result();

            //Si ya tengo a ese usuario creado en la base de datos
            if($rst->num_rows === 1){
                $datos_usuario = $rst->fetch_assoc();
                if(password_verify($password, $datos_usuario['password'])){
                    $_SESSION['username'] = $datos_usuario['username'];
                    //Mensaje de bienvenida a la página
                    
                    header("Location: index.php");
                    exit();
                 }
                 //Si los datos de la contraseña no coinciden
                 else{
                    echo "<p>Datos NO correctos </p>";
                 }
            }
            //Si no existe ese usuario
            else{
                echo "<p>Datos NO correctos </p>";
            }
            $resultado_datos->close();
            $conexion->close();
        }
    ?>
</body>
</html>