
DROP TABLE IF EXISTS `encuesta_satisfaccion`;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `registration`;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `curp` (`curp`),
  UNIQUE KEY `folio` (`folio`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `idrol` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--

DROP TABLE IF EXISTS `usuario`;
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
