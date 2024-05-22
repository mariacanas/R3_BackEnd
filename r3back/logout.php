
<?php require 'menu.php' ?>
<?php
    //Cierre de sesión y redirige al usuario a index.php (Página principal)
    session_start();
    session_destroy();
    header("Location: index.php");
?>
