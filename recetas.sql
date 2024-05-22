-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2024 a las 15:30:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `recetas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `Id` int(11) NOT NULL,
  `nombreReceta` varchar(100) NOT NULL,
  `fechaHora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `categoria` enum('Italiano','Mexicano','Español','') NOT NULL,
  `ingredientes` text NOT NULL,
  `tiempoPreparacion` int(11) NOT NULL,
  `nivelDificultad` enum('Bajo','Medio','Alto','') NOT NULL,
  `instrucciones` text NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`Id`, `nombreReceta`, `fechaHora`, `categoria`, `ingredientes`, `tiempoPreparacion`, `nivelDificultad`, `instrucciones`, `imagen`) VALUES
(1, 'Pollo al Horno con Patatas', '2024-05-01 07:40:13', 'Español', 'Muslos de pollo, patatas, cebolla, aceite de oliva.', 60, 'Bajo', 'Marinar el pollo con ajo, romero y aceite de oliva, colocar en una bandeja con patatas y cebolla, hornear hasta que esté dorado y crujiente.', 'https://imag.bonviveur.com/pollo-asado-al-horno-con-patatas.jpg'),
(2, 'Tortilla de Patatas', '2024-05-09 10:51:20', 'Español', 'Patatas, huevos, cebolla, aceite de oliva, sal.', 35, 'Medio', 'Freír las patatas y la cebolla, mezclar con los huevos batidos, cocinar en una sartén hasta que esté cuajada por ambos lados.', 'https://www.goya.com/media/3816/tortilla-espan-ola-potato-omelet.jpg?quality=80'),
(3, 'Gazpacho Andaluz', '2024-05-20 20:54:14', 'Español', 'Tomate, pepino, pimiento verde, cebolla, ajo, pan duro, vinagre, aceite de oliva, sal.', 10, 'Bajo', 'Triturar todos los ingredientes en una licuadora hasta obtener una textura suave, enfriar en el refrigerador y servir bien frío', 'https://cdn.recetasderechupete.com/wp-content/uploads/2020/05/Gazpacho-andaluz-Ajustes-de-rechupete-2.jpg'),
(4, 'Pasta con champiñones', '2024-05-23 10:24:14', 'Italiano', 'Pasta, champiñones, crema de leche, mantequilla, ajo, queso parmesano.', 20, 'Alto', 'Cocinar la pasta al dente, saltear los champiñones con ajo, agregar la crema de leche y la mantequilla, mezclar con la pasta y el queso parmesano.', 'https://recetasdecocina.elmundo.es/wp-content/uploads/2023/04/pasta-con-champinones.jpg'),
(5, 'Ensalada de frutas', '2024-05-11 11:05:54', '', 'Piña, fresas, melón, kiwi, plátano, jugo de naranja.', 5, 'Bajo', 'Cortar la fruta en trozos pequeños y mezclar con jugo de naranja.', 'https://www.bancodealimentoschicago.org/wp-content/uploads/2022/04/Fruit-Salad.jpg'),
(6, 'Receta1', '2024-05-14 21:18:41', 'Italiano', 'Ingredientes Receta1', 10, 'Alto', 'Instrucciones Receta1', 'https://www.bancodealimentoschicago.org/wp-content/uploads/2022/04/Fruit-Salad.jpg'),
(7, 'Receta2', '2024-05-14 21:18:01', 'Mexicano', 'Ingredientes Receta2', 60, 'Alto', 'Instrucciones Receta2', 'https://www.bancodealimentoschicago.org/wp-content/uploads/2022/04/Fruit-Salad.jpg'),
(8, 'Receta3', '2024-05-14 21:18:10', 'Mexicano', 'Ingredientes Receta3', 50, 'Alto', 'Instrucciones Receta3', 'https://www.bancodealimentoschicago.org/wp-content/uploads/2022/04/Fruit-Salad.jpg'),
(9, 'Receta4', '2024-05-14 21:18:31', 'Italiano', 'Ingredientes Receta4', 25, 'Alto', 'Instrucciones Receta4', 'https://www.bancodealimentoschicago.org/wp-content/uploads/2022/04/Fruit-Salad.jpg'),
(10, 'Receta5', '2024-05-14 21:18:54', 'Italiano', 'Ingredientes Receta5', 35, 'Medio', 'Instrucciones Receta5', 'https://www.bancodealimentoschicago.org/wp-content/uploads/2022/04/Fruit-Salad.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_pec3`
--

CREATE TABLE `users_pec3` (
  `username` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmpassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_pec3`
--

INSERT INTO `users_pec3` (`username`, `nombre`, `apellidos`, `password`, `confirmpassword`) VALUES
('mcanas21', 'Maria', 'Canas Encinas', '$2y$10$ezIla./NPIoqL/o1psLe1.kPmW.jl7STZtUDJlH2EMMW/n.o1hc7a', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `users_pec3`
--
ALTER TABLE `users_pec3`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
