
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Recetas</title>

    <style>
        .menu{
            overflow: hidden;
            background-color: black;
            justify-content: center;
            display: flex;
            align-items: center;
            font-weight: bold;
        }
        .menu a{
            color: white;
            text-decoration: none;
            padding: 10px;
            font-size: 20px;
            margin: auto;
        }
        .menu a:hover{
            color: blue;
        }
    </style>
</head>
<body>

    <!--Menu navegación -->

    <div class="menu">
        <a href="index.php">Home</a>
        <a href="activity_2.php">Act_2</a>
        <a href="recipes.php">Recetas</a>
        <a href="api/recipes.php?page=1" target="_blank">API_recetas</a>
        <a href="api/recipe.php?id=1" target="_black">API_receta</a>
        
        <?php if(!isset($_SESSION['username'])): ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign up</a>
        <?php else: ?>
        <a href="edit.php">Perfil usuario</a>
        <a href="logout.php">Logout</a>
        <?php endif; ?>
    </div>
</body>
</html>