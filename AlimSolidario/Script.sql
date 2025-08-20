-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2025 at 01:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alimsolidario`
--

-- --------------------------------------------------------

--
-- Table structure for table `donaciones`
--

CREATE TABLE `donaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` enum('bueno','cerca de expirar','dañado') NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `fecha_expiracion` date DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `visto` tinyint(1) DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('disponible','solicitado') DEFAULT 'disponible',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria` varchar(50) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `titulo`, `descripcion`, `cantidad`, `fecha_publicacion`, `estado`, `fecha`, `categoria`, `ubicacion`, `imagen`, `usuario_id`) VALUES
(1, 'Arroz', 'Arroz de buena calidad, 10 kg por paquete.', 5, '2025-08-20 19:23:37', 'disponible', '2025-08-20 19:33:58', 'Grano', 'San José', 'https://walmartcr.vtexassets.com/arquivos/ids/610493/Arroz-Tio-Pelo-99-Grano-Entero-1800-gr-1-31043.jpg?v=638515680492000000', 0),
(2, 'Frijoles', 'Frijoles negros, paquete de 5 kg.', 10, '2025-08-20 19:23:37', 'disponible', '2025-08-20 19:33:58', 'Grano', 'Heredia', 'https://walmartcr.vtexassets.com/arquivos/ids/507931/Frijol-Rojo-Carolina-800gr-1-30622.jpg?v=638416006402700000', 0),
(3, 'Arroz', 'Arroz de buena calidad, 10 kg por paquete.', 5, '2025-08-20 19:24:55', 'disponible', '2025-08-20 19:33:58', 'Grano', 'Alajuela', 'https://walmartni.vtexassets.com/arquivos/ids/384153/Arroz-Tio-Pelon-Grano-Entero-80-2000Gr-2-7193.jpg?v=638489001649330000', 0),
(4, 'Frijoles', 'Frijoles negros, paquete de 5 kg.', 10, '2025-08-20 19:24:55', 'disponible', '2025-08-20 19:33:58', 'Grano', 'Limón', 'https://walmartcr.vtexassets.com/arquivos/ids/917820/6083_01.jpg?v=638817999029100000', 0),
(5, 'Aceite', 'Aceite de cocina, botella de 1 litro.', 20, '2025-08-20 19:24:55', 'disponible', '2025-08-20 19:33:58', 'Liquido', 'Puntarenas', 'https://walmartcr.vtexassets.com/arquivos/ids/531959/Aceite-Mazola-946-ml-1-94217.jpg?v=638421934789070000', 0),
(6, 'Azúcar', 'Azúcar blanca, 5 kg por bolsa.', 15, '2025-08-20 19:24:55', 'disponible', '2025-08-20 19:33:58', 'Grano', 'San José', 'https://walmartcr.vtexassets.com/arquivos/ids/690504-800-450?v=638609146892830000&width=800&height=450&aspect=true', 0),
(7, 'Harina', 'Harina de trigo, 10 kg por paquete.', 8, '2025-08-20 19:24:55', 'disponible', '2025-08-20 19:33:58', 'Grano', 'Cartago', 'https://walmartcr.vtexassets.com/arquivos/ids/503107/Harina-Nacarina-Integral-1000gr-1-29145.jpg?v=638415036147700000', 0),
(8, 'Pasta', 'Pasta italiana, 500g por paquete.', 25, '2025-08-20 19:24:55', 'disponible', '2025-08-20 19:33:58', 'Harina', 'Guanacaste', 'https://walmartcr.vtexassets.com/arquivos/ids/507537/Pasta-Prince-Plumas-Salsa-Carbonara-230gr-1-29240.jpg?v=638416004635000000', 0),
(9, 'Leche', 'Leche en polvo, 800g por paquete.', 30, '2025-08-20 19:24:55', 'disponible', '2025-08-20 19:33:58', 'Lácteo', 'Desamparados', 'https://ik.imagekit.io/autoenlinea/imgjpg/tr:f-webp/592550_2.jpg', 0),
(10, 'Sal', 'Sal de mesa, paquete de 1 kg.', 50, '2025-08-20 19:24:55', 'disponible', '2025-08-20 19:33:58', 'Grano', 'Escazú', 'https://walmartcr.vtexassets.com/arquivos/ids/387867/Sal-Marca-Sol-Fina-Sin-Fluor-Bolsa-500gr-1-84666.jpg?v=638152801105100000', 0),
(11, 'Tomates', 'Tomates frescos, 5 kg.', 12, '2025-08-20 19:24:55', 'disponible', '2025-08-20 19:33:58', 'Verdura', 'Santa Ana', 'https://dehesaelmilagro.com/cdn/shop/articles/Tomates_peque.jpg?v=1570427028', 0),
(12, 'Papas', 'Papas frescas, 10 kg.', 10, '2025-08-20 19:24:55', 'disponible', '2025-08-20 19:33:58', 'Verdura', 'Goicoechea', 'https://saborusa.com.pa/imagesmg/imagenes/5ff3e6a0b703f_potatoes-food-supermarket-agriculture-JG7QGNY.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` enum('donador','beneficiario') NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`, `rol`, `fecha_registro`) VALUES
(1, 'Juan Pérez', 'juan@example.com', 'password', 'donador', '2025-08-20 16:22:30'),
(2, 'Ana Gómez', 'ana@example.com', 'password', 'beneficiario', '2025-08-20 16:22:30'),
(3, 'Dagoberto Andres Morera Alvarez', 'correo1@gmail.com', '$2y$10$cfvXxx4s77Qk5oifa4ZLHO8hew7UScOquJAaPgGZPTPVmOd/Uvh1W', 'beneficiario', '2025-08-20 16:26:45'),
(4, 'Sebas Diaz', 'correo2@gmail.com', '$2y$10$hKLvNZN7gAL9yJj4kz9/9uBTyOxNhc6fukoPPYrBETK7oZM6KcsLi', 'donador', '2025-08-20 16:50:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donaciones`
--
ALTER TABLE `donaciones`
  ADD CONSTRAINT `donaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
