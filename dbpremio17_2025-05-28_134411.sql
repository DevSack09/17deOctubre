-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dbpremio17
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `control_registros`
--

DROP TABLE IF EXISTS `control_registros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `control_registros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `abierto` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_apertura` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_cierre` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `encuesta_satisfaccion`
--

DROP TABLE IF EXISTS `encuesta_satisfaccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `encuesta_satisfaccion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `pregunta1` varchar(10) DEFAULT NULL,
  `pregunta2` varchar(10) DEFAULT NULL,
  `pregunta3` varchar(10) DEFAULT NULL,
  `sugerencia` text,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idusuario` int NOT NULL,
  `dashboard` tinyint(1) DEFAULT '0',
  `usuarios` tinyint(1) DEFAULT '0',
  `formulario` tinyint(1) DEFAULT '0',
  `inicio` tinyint(1) DEFAULT '0',
  `reportes` tinyint(1) DEFAULT '0',
  `descarga` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `folio` varchar(15) DEFAULT NULL,
  `usuario_id` int NOT NULL,
  `curp` varchar(18) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `apellidoP` varchar(250) DEFAULT NULL,
  `apellidoM` varchar(250) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `numeroExterior` varchar(20) DEFAULT NULL,
  `numeroInterior` varchar(20) DEFAULT NULL,
  `colonia` varchar(255) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `municipio` varchar(250) DEFAULT NULL,
  `localidad` varchar(250) DEFAULT NULL,
  `gradoEstudios` varchar(250) DEFAULT NULL,
  `ocupacionActual` varchar(250) DEFAULT NULL,
  `gradoActual` varchar(250) DEFAULT NULL,
  `estudiosActuales` varchar(250) DEFAULT NULL,
  `cargoActual` varchar(250) DEFAULT NULL,
  `centroEstudiosTrabajo` varchar(255) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `numerofijo` varchar(20) DEFAULT NULL,
  `numeromovil` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `otraRedSocial` varchar(255) DEFAULT NULL,
  `seudonimo` varchar(250) DEFAULT NULL,
  `titulo_ensayo` varchar(255) DEFAULT NULL,
  `categoria` varchar(250) DEFAULT NULL,
  `archivo_ensayo` varchar(255) DEFAULT NULL,
  `credencial_votar` varchar(255) DEFAULT NULL,
  `declaracion_originalidad` varchar(255) DEFAULT NULL,
  `consentimiento_expreso_adultos` varchar(255) DEFAULT NULL,
  `identificacion_fotografia` varchar(255) DEFAULT NULL,
  `carta_autorizacion` varchar(255) DEFAULT NULL,
  `declaracion_originalidad_menores` varchar(255) DEFAULT NULL,
  `comprobante_domicilio_tutor` varchar(255) DEFAULT NULL,
  `consentimiento_expreso_menores` varchar(255) DEFAULT NULL,
  `ine_tutor` varchar(255) DEFAULT NULL,
  `discapacidad` varchar(10) DEFAULT NULL,
  `discapacidad_cual` varchar(250) DEFAULT NULL,
  `tipo_discapacidad` varchar(250) DEFAULT NULL,
  `lengua_indigena` varchar(10) DEFAULT NULL,
  `lengua_cual` varchar(250) DEFAULT NULL,
  `auto_indigena` varchar(10) DEFAULT NULL,
  `comunidad_indigena` varchar(10) DEFAULT NULL,
  `comunidad_cual` varchar(250) DEFAULT NULL,
  `diversidad` varchar(10) DEFAULT NULL,
  `diversidad_cual` varchar(250) DEFAULT NULL,
  `medio_convocatoria` varchar(250) DEFAULT NULL,
  `acepta_privacidad` tinyint(1) DEFAULT '0',
  `acepta_consentimiento` tinyint(1) DEFAULT '0',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '0',
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `curp` (`curp`),
  UNIQUE KEY `folio` (`folio`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `idrol` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidoP` varchar(100) DEFAULT NULL,
  `apellidoM` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `rol` varchar(45) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) DEFAULT '1',
  `delete` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'dbpremio17'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-11 21:13:33
