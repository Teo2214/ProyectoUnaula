-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: transitounaula
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciudad` (
  `ciudadId` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `codigo` varchar(60) NOT NULL,
  PRIMARY KEY (`ciudadId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `departamentoId` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `codigo` varchar(60) NOT NULL,
  PRIMARY KEY (`departamentoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multa`
--

DROP TABLE IF EXISTS `multa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `multa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estado` tinyint(1) DEFAULT NULL,
  `idTipoMulta` int NOT NULL,
  `documento` int NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `idAgente` int NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `placa` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`documento`),
  KEY `idAgente` (`idAgente`),
  KEY `placa` (`placa`),
  KEY `idTipoMulta` (`idTipoMulta`),
  CONSTRAINT `multa_ibfk_3` FOREIGN KEY (`idAgente`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `multa_ibfk_4` FOREIGN KEY (`idTipoMulta`) REFERENCES `tipomulta` (`idTipoMulta`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multa`
--

LOCK TABLES `multa` WRITE;
/*!40000 ALTER TABLE `multa` DISABLE KEYS */;
INSERT INTO `multa` VALUES (20,0,2,1155116,'ewgsrg','2024-05-27',121345,'Coliseo de combate guillermo gaviria ','IWL16D '),(22,0,6,1022153812,'HOLAAA TEST','2024-05-28',121345,'Coliseo de combate guillermo gaviria ','IWL16D ');
/*!40000 ALTER TABLE `multa` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `incrementos` AFTER INSERT ON `multa` FOR EACH ROW BEGIN
    DECLARE vehiculo_placa VARCHAR(8);
    
    SET vehiculo_placa = NEW.placa; -- Obtiene la placa del vehículo asociado a la multa
    
    -- Incrementa el número de multas para el vehículo
    UPDATE vehiculo
    SET numeroMultas = numeroMultas + 1
    WHERE placa = vehiculo_placa;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `organismosactivos`
--

DROP TABLE IF EXISTS `organismosactivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organismosactivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `agentesActivos` int NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `ciudadId` int DEFAULT NULL,
  `departamentoId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departamentoId` (`departamentoId`),
  KEY `ciudadId` (`ciudadId`),
  CONSTRAINT `organismosactivos_ibfk_1` FOREIGN KEY (`departamentoId`) REFERENCES `departamentos` (`departamentoId`),
  CONSTRAINT `organismosactivos_ibfk_2` FOREIGN KEY (`ciudadId`) REFERENCES `ciudad` (`ciudadId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organismosactivos`
--

LOCK TABLES `organismosactivos` WRITE;
/*!40000 ALTER TABLE `organismosactivos` DISABLE KEYS */;
/*!40000 ALTER TABLE `organismosactivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soat`
--

DROP TABLE IF EXISTS `soat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `soat` (
  `idSoat` int NOT NULL,
  `vencimiento` date DEFAULT NULL,
  `placa` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`idSoat`),
  KEY `placa` (`placa`),
  CONSTRAINT `soat_ibfk_1` FOREIGN KEY (`placa`) REFERENCES `vehiculo` (`placa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soat`
--

LOCK TABLES `soat` WRITE;
/*!40000 ALTER TABLE `soat` DISABLE KEYS */;
/*!40000 ALTER TABLE `soat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tecno`
--

DROP TABLE IF EXISTS `tecno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tecno` (
  `idTecno` int NOT NULL,
  `vencimiento` date DEFAULT NULL,
  `placa` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`idTecno`),
  KEY `placa` (`placa`),
  CONSTRAINT `tecno_ibfk_1` FOREIGN KEY (`placa`) REFERENCES `vehiculo` (`placa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tecno`
--

LOCK TABLES `tecno` WRITE;
/*!40000 ALTER TABLE `tecno` DISABLE KEYS */;
/*!40000 ALTER TABLE `tecno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipomulta`
--

DROP TABLE IF EXISTS `tipomulta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipomulta` (
  `idTipoMulta` int NOT NULL,
  `tipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`idTipoMulta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipomulta`
--

LOCK TABLES `tipomulta` WRITE;
/*!40000 ALTER TABLE `tipomulta` DISABLE KEYS */;
INSERT INTO `tipomulta` VALUES (1,'Tipo A','El infractor, conductor de un vehículo no automotor, recibirá una multa de 4 salarios mínimos diarios legales vigentes.',154700),(2,'Tipo B','El infractor, conductor y/o propietario de un vehículo automotor, recibirá una multa de 8 salarios mínimos diarios legales vigentes.',309350),(3,'Tipo C','El infractor, conductor y/o propietario de un vehículo automotor, recibirá una multa de 15 salarios mínimos diarios legales vigentes.',580000),(4,'Tipo D','El infractor, conductor y/o propietario de un vehículo automotor, recibirá una multa de 30 salarios mínimos diarios legales vigentes.',1160000),(5,'Tipo E','El infractor, conductor y/o propietario de un vehículo automotor, recibirá una multa de 45 salarios mínimos diarios legales vigentes.',1740000),(6,'Tipo F','Conducir bajo el influjo del alcohol o bajo los efectos de sustancias psicoactivas. Dependiendo del grado de alcoholemia y la reincidencia el infractor deberá pagar una multa que va entre 90 y 1.440 salarios mínimos diarios legales vigentes (smdlv).',3480000);
/*!40000 ALTER TABLE `tipomulta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipovehiculo`
--

DROP TABLE IF EXISTS `tipovehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipovehiculo` (
  `idTipoVehiculo` int NOT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `impuestoAproximado` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`idTipoVehiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipovehiculo`
--

LOCK TABLES `tipovehiculo` WRITE;
/*!40000 ALTER TABLE `tipovehiculo` DISABLE KEYS */;
INSERT INTO `tipovehiculo` VALUES (1,'MOTO',20000),(2,'CARRO',800000);
/*!40000 ALTER TABLE `tipovehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `agente` tinyint(1) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (121345,'MATEO','B','echeverrimateo2004@gmail.com','3004612249','$2y$10$wDWz6cA4a26ETfYXCMaLUO4uE6UJybqMBJ4W/Nqp9FYuisJC7eoSq',1,'',1),(43119084,'Kelly','Echeverri Herrera','user@user.com','3137602842','$2y$10$3ddNQN7WbDBVVEaQ/7w3aOUr4YWgz5pjjy0wUqiMMfkKwiAyi42hu',1,'',1),(1022153812,'Mateo','admin','mateo.botero3812@unaula.edu.co','3233152006','$2y$10$x.juCAydYKWZXjfQ1E7jS.m6odN82PvH5krNDIlB9CAoWCWgaEmg6',0,'',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculo`
--

DROP TABLE IF EXISTS `vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehiculo` (
  `placa` varchar(8) NOT NULL,
  `marca` varchar(30) DEFAULT NULL,
  `modelo` varchar(5) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `documentoPropietario` int DEFAULT NULL,
  `cilindraje` varchar(20) DEFAULT NULL,
  `idTipoVehiculo` int DEFAULT NULL,
  `tipoServicio` varchar(30) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `numeroMultas` int NOT NULL,
  PRIMARY KEY (`placa`),
  KEY `idTipoVehiculo` (`idTipoVehiculo`),
  CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`idTipoVehiculo`) REFERENCES `tipovehiculo` (`idTipoVehiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo`
--

LOCK TABLES `vehiculo` WRITE;
/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
INSERT INTO `vehiculo` VALUES ('IWL16D ','AGILITY','2016','COLOMBIA',1,1022153812,'125',1,'PARTICULAR','BLANCO',1);
/*!40000 ALTER TABLE `vehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'transitounaula'
--

--
-- Dumping routines for database 'transitounaula'
--
/*!50003 DROP PROCEDURE IF EXISTS `ActualizarMulta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarMulta`(
    IN p_id INT,
    IN p_estado VARCHAR(50),
    IN p_idTipoMulta INT,
    IN p_documento VARCHAR(50),
    IN p_descripcion VARCHAR(255),
    IN p_fecha DATE,
    IN p_idAgente INT,
    IN p_direccion VARCHAR(255),
    IN p_placa VARCHAR(20)
)
BEGIN
    UPDATE multa
    SET estado = p_estado,
        idTipoMulta = p_idTipoMulta,
        documento = p_documento,
        descripcion = p_descripcion,
        fecha = p_fecha,
        idAgente = p_idAgente,
        direccion = p_direccion,
        placa = p_placa
    WHERE id = p_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ActualizarVehiculo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarVehiculo`(
    IN p_placa VARCHAR(20),
    IN p_marca VARCHAR(100),
    IN p_modelo VARCHAR(100),
    IN p_pais VARCHAR(100),
    IN p_estado VARCHAR(50),
    IN p_documentoPropietario VARCHAR(50),
    IN p_cilindraje INT,
    IN p_idTipoVehiculo INT,
    IN p_tipoServicio VARCHAR(50),
    IN p_color VARCHAR(50),
    IN p_numeroMultas INT
)
BEGIN
    UPDATE vehiculo
    SET marca = p_marca,
        modelo = p_modelo,
        pais = p_pais,
        estado = p_estado,
        documentoPropietario = p_documentoPropietario,
        cilindraje = p_cilindraje,
        idTipoVehiculo = p_idTipoVehiculo,
        tipoServicio = p_tipoServicio,
        color = p_color,
        numeroMultas = p_numeroMultas
    WHERE placa = p_placa;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `EliminarMulta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarMulta`(
    IN p_id INT
)
BEGIN
    DELETE FROM multa WHERE id = p_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `EliminarVehiculo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarVehiculo`(
    IN p_placa VARCHAR(20)
)
BEGIN
    DELETE FROM vehiculo WHERE placa = p_placa;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `InsertarMulta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarMulta`(
    IN p_estado VARCHAR(50),
    IN p_idTipoMulta INT,
    IN p_documento VARCHAR(50),
    IN p_descripcion VARCHAR(255),
    IN p_fecha DATE,
    IN p_idAgente INT,
    IN p_direccion VARCHAR(255),
    IN p_placa VARCHAR(20)
)
BEGIN
    INSERT INTO multa (estado, idTipoMulta, documento, descripcion, fecha, idAgente, direccion, placa)
    VALUES (p_estado, p_idTipoMulta, p_documento, p_descripcion, p_fecha, p_idAgente, p_direccion, p_placa);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `InsertarVehiculo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarVehiculo`(
    IN p_placa VARCHAR(20),
    IN p_marca VARCHAR(100),
    IN p_modelo VARCHAR(100),
    IN p_pais VARCHAR(100),
    IN p_estado VARCHAR(50),
    IN p_documentoPropietario VARCHAR(50),
    IN p_cilindraje INT,
    IN p_idTipoVehiculo INT,
    IN p_tipoServicio VARCHAR(50),
    IN p_color VARCHAR(50),
    IN p_numeroMultas INT
)
BEGIN
    INSERT INTO vehiculo (placa, marca, modelo, pais, estado, documentoPropietario, cilindraje, idTipoVehiculo, tipoServicio, color, numeroMultas)
    VALUES (p_placa, p_marca, p_modelo, p_pais, p_estado, p_documentoPropietario, p_cilindraje, p_idTipoVehiculo, p_tipoServicio, p_color, p_numeroMultas);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-27 21:49:31
