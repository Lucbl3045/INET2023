-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2023 at 12:24 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitalinet`
--
CREATE DATABASE IF NOT EXISTS `hospitalinet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hospitalinet`;

-- --------------------------------------------------------

--
-- Table structure for table `dispositivos`
--

CREATE TABLE `dispositivos` (
  `dispositivoID` int(11) NOT NULL,
  `zonaID` int(10) UNSIGNED NOT NULL,
  `nombreDispositivo` varchar(32) DEFAULT NULL,
  `ubicacion` enum('cama','baño','otro') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dispositivos`
--

INSERT INTO `dispositivos` (`dispositivoID`, `zonaID`, `nombreDispositivo`, `ubicacion`) VALUES
(1, 2, 'Boton1', 'cama');

-- --------------------------------------------------------

--
-- Table structure for table `llamadas`
--

CREATE TABLE `llamadas` (
  `llamadaID` int(10) UNSIGNED NOT NULL,
  `pacienteID` int(10) UNSIGNED NOT NULL,
  `tiempoDeLlamada` datetime NOT NULL,
  `tiempoDeRespuesta` datetime DEFAULT NULL,
  `dispositivoDeLlamadaID` int(10) UNSIGNED NOT NULL,
  `nivelDeEmergencia` enum('1','2','3','4') NOT NULL,
  `medicoQueAtendioID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `llamadas`
--

INSERT INTO `llamadas` (`llamadaID`, `pacienteID`, `tiempoDeLlamada`, `tiempoDeRespuesta`, `dispositivoDeLlamadaID`, `nivelDeEmergencia`, `medicoQueAtendioID`) VALUES
(1, 2, '2023-09-21 15:40:10', '2023-09-21 18:40:10', 1, '4', 6);

-- --------------------------------------------------------

--
-- Table structure for table `medicos`
--

CREATE TABLE `medicos` (
  `medicoID` int(10) UNSIGNED NOT NULL,
  `DNI` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `apellido` varchar(64) NOT NULL,
  `usuarioID` int(10) UNSIGNED NOT NULL,
  `zonaID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicos`
--

INSERT INTO `medicos` (`medicoID`, `DNI`, `nombre`, `apellido`, `usuarioID`, `zonaID`) VALUES
(6, 4, 'Manuel', 'Iglesias', 43, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

CREATE TABLE `pacientes` (
  `pacienteID` int(10) UNSIGNED NOT NULL,
  `DNI` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `apellido` varchar(64) NOT NULL,
  `nacimiento` date NOT NULL,
  `domicilio` varchar(64) NOT NULL,
  `sexo` char(1) NOT NULL,
  `zonaID` int(10) UNSIGNED NOT NULL,
  `medicoID` int(10) UNSIGNED NOT NULL,
  `notas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`pacienteID`, `DNI`, `nombre`, `apellido`, `nacimiento`, `domicilio`, `sexo`, `zonaID`, `medicoID`, `notas`) VALUES
(2, 12654, 'gervaaaa', 'gastropodods', '2009-10-13', 'bolivia2', 'f', 3, 0, 'tiene peloae'),
(3, 25384026, 'Laura', 'Sanchez', '1993-04-21', 'San juan 34, CABA', 'f', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarioID` int(10) UNSIGNED NOT NULL,
  `contrasenia` varchar(64) NOT NULL,
  `esAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`usuarioID`, `contrasenia`, `esAdmin`) VALUES
(1, 'temp', 1),
(23, '$2y$10$H2mUDtGLpFKRBsdNGUjLrucx6Ayq6n5Tzz6C4paJdGJBS9.m9MXYS', 0),
(43, '$2y$10$oOx3142OsmQoZMIpmWFMpuGwzcXabdYPSJiAXTiti1yjSHxQ1VJjK', 0),
(55, '$2y$10$qAbMoqKwooxVts3lKHz1Fus4ov9LExdbLK.w1t7XvfmdwRUTJAJBG', 0),
(66, '$2y$10$U1RrRQcwaCkj6kfhjDtqtuTvdQRX9eeLviUFLWCIrxF8lPWuxtYU2', 0),
(77, '$2y$10$zKyeAgFiD58VSqdzoYe7i.BJlLU.p26paOnt86rOQsvSaV7L8lXxy', 0),
(131, '$2y$10$wWElZBvBFL3kdgGCOUe59Oq1Vd0aSJBB8.nnzsNFIDbYyQpxDEVWy', 1),
(132, '$2y$10$rprRhLG6U6Wd4uWBnZJPPOyGganEYm4iO7htRI70IL1drvuNdBVJK', 0),
(133, '$2y$10$68P7jqnkBmCELDEWRLf4FeID4vZUCaNqcRLNGdN8iUzjnKrvplMJy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zonas`
--

CREATE TABLE `zonas` (
  `zonaID` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zonas`
--

INSERT INTO `zonas` (`zonaID`, `nombre`) VALUES
(1, 'Sala de espera'),
(2, 'Consultorios\r\n                                                '),
(3, 'Recepción'),
(4, 'Reanimación'),
(5, 'Entrada');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`dispositivoID`);

--
-- Indexes for table `llamadas`
--
ALTER TABLE `llamadas`
  ADD PRIMARY KEY (`llamadaID`);

--
-- Indexes for table `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`medicoID`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`pacienteID`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarioID`);

--
-- Indexes for table `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`zonaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `dispositivoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `llamadas`
--
ALTER TABLE `llamadas`
  MODIFY `llamadaID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicos`
--
ALTER TABLE `medicos`
  MODIFY `medicoID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `pacienteID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarioID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `zonas`
--
ALTER TABLE `zonas`
  MODIFY `zonaID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
