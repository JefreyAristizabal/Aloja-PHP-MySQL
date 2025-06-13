-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: adminaloja
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleado` (
  `idEmpleado` int NOT NULL AUTO_INCREMENT,
  `Nombre_Completo` varchar(45) DEFAULT NULL,
  `Usuario` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Rol` enum('EMPLEADO','ADMIN') DEFAULT NULL,
  PRIMARY KEY (`idEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'Usuario Admin','admin','adminpass','ADMIN'),(2,'Empleado Uno','emp1','Papitas','EMPLEADO');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

--
-- Table structure for table `estadia`
--

DROP TABLE IF EXISTS `estadia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estadia` (
  `idEstadia` int NOT NULL AUTO_INCREMENT,
  `Fecha_Inicio` date DEFAULT NULL,
  `Fecha_Fin` date DEFAULT NULL,
  `Fecha_Registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `Costo` double DEFAULT NULL,
  `Habitacion_idHabitacion` int NOT NULL,
  PRIMARY KEY (`idEstadia`),
  KEY `fk_Estadia_Habitacion1_idx` (`Habitacion_idHabitacion`),
  CONSTRAINT `fk_Estadia_Habitacion1` FOREIGN KEY (`Habitacion_idHabitacion`) REFERENCES `habitacion` (`idHABITACION`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadia`
--

/*!40000 ALTER TABLE `estadia` DISABLE KEYS */;
INSERT INTO `estadia` VALUES (18,'2026-03-03','2026-06-06','2025-06-13 18:36:53',3123,8);
/*!40000 ALTER TABLE `estadia` ENABLE KEYS */;

--
-- Table structure for table `habitacion`
--

DROP TABLE IF EXISTS `habitacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `habitacion` (
  `idHABITACION` int NOT NULL AUTO_INCREMENT,
  `CAPACIDAD` int unsigned DEFAULT NULL,
  `DESCRIPCION` varchar(45) DEFAULT NULL,
  `NOMBRE` varchar(45) DEFAULT NULL,
  `COSTONOCHE` double DEFAULT NULL,
  `IMAGEN` varchar(255) DEFAULT NULL,
  `ESTADO` enum('OCUPADO','EN MANTENIMIENTO','DISPONIBLE') DEFAULT NULL,
  PRIMARY KEY (`idHABITACION`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitacion`
--

/*!40000 ALTER TABLE `habitacion` DISABLE KEYS */;
INSERT INTO `habitacion` VALUES (8,3,'Muy bonita','Habitación 101',NULL,'../imagenes_habitaciones/1749857222_descargar.jpg',NULL),(9,1,'Muy bonita también','Habitación 102',NULL,'../imagenes_habitaciones/1749857435_descargar (1).jpg',NULL),(10,2,'Muy fea','Habitación 103',NULL,'../imagenes_habitaciones/1749857452_descargar (2).jpg',NULL),(11,10,'Muy horrible','Habitación 104',NULL,'../imagenes_habitaciones/1749857476_descargar (3).jpg',NULL),(12,9,'Muy sucia, qué asco','Habitación 105',NULL,'../imagenes_habitaciones/1749857509_descargar (4).jpg',NULL);
/*!40000 ALTER TABLE `habitacion` ENABLE KEYS */;

--
-- Table structure for table `huesped`
--

DROP TABLE IF EXISTS `huesped`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `huesped` (
  `idHUESPED` int NOT NULL AUTO_INCREMENT,
  `Nombre_completo` varchar(45) DEFAULT NULL,
  `tipo_documento` varchar(45) DEFAULT NULL,
  `numero_documento` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Número de documento del huésped, puede ser un número de identificación o pasaporte',
  `Telefono_huesped` varchar(45) DEFAULT NULL,
  `Origen` varchar(45) DEFAULT NULL,
  `Nombre_Contacto` varchar(45) DEFAULT NULL,
  `Telefono_contacto` varchar(45) DEFAULT NULL,
  `Observaciones` varchar(45) DEFAULT NULL,
  `observaciones2` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idHUESPED`),
  UNIQUE KEY `numero_documento` (`numero_documento`),
  UNIQUE KEY `numero_documento_2` (`numero_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `huesped`
--

/*!40000 ALTER TABLE `huesped` DISABLE KEYS */;
INSERT INTO `huesped` VALUES (4,'Jefrey','tarjeta','44332211','456789012','Uruguay','Pedro Martínez','654321098','Ninguna','Ninguna'),(5,'Pedro González','cedula','55667788','567890123','Paraguay','Sofía González','543210987','Ninguna','Ninguna'),(6,'Laura Rodríguez','otros','88776655','678901234','Bolivia','Miguel Rodríguez','432109876','Ninguna','Ninguna'),(7,'Miguel Fernández','DNI','99887766','789012345','Ecuador','Lucía Fernández','321098765','Ninguna','Ninguna'),(8,'Lucía Sánchez','DNI','66778899','890123456','Colombia','Jorge Sánchez','210987654','Ninguna','Ninguna'),(9,'Jorge Ramírez','DNI','77665544','901234567','Venezuela','Elena Ramírez','109876543','Ninguna','Ninguna');
/*!40000 ALTER TABLE `huesped` ENABLE KEYS */;

--
-- Table structure for table `huesped_has_estadia`
--

DROP TABLE IF EXISTS `huesped_has_estadia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `huesped_has_estadia` (
  `HUESPED_idHUESPED` int NOT NULL,
  `Estadia_idEstadia` int NOT NULL,
  KEY `fk_HUESPED_has_Estadia_Estadia1` (`Estadia_idEstadia`),
  KEY `fk_HUESPED_has_Estadia_HUESPED1` (`HUESPED_idHUESPED`),
  CONSTRAINT `fk_HUESPED_has_Estadia_Estadia1` FOREIGN KEY (`Estadia_idEstadia`) REFERENCES `estadia` (`idEstadia`),
  CONSTRAINT `fk_HUESPED_has_Estadia_HUESPED1` FOREIGN KEY (`HUESPED_idHUESPED`) REFERENCES `huesped` (`idHUESPED`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `huesped_has_estadia`
--

/*!40000 ALTER TABLE `huesped_has_estadia` DISABLE KEYS */;
INSERT INTO `huesped_has_estadia` VALUES (4,18);
/*!40000 ALTER TABLE `huesped_has_estadia` ENABLE KEYS */;

--
-- Table structure for table `novedades`
--

DROP TABLE IF EXISTS `novedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `novedades` (
  `idNovedades` int NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Estadia_idEstadia` int NOT NULL,
  PRIMARY KEY (`idNovedades`),
  KEY `fk_Novedades_Estadia1_idx` (`Estadia_idEstadia`),
  CONSTRAINT `fk_Novedades_Estadia1` FOREIGN KEY (`Estadia_idEstadia`) REFERENCES `estadia` (`idEstadia`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novedades`
--

/*!40000 ALTER TABLE `novedades` DISABLE KEYS */;
INSERT INTO `novedades` VALUES (11,'Mi mama me miima',18);
/*!40000 ALTER TABLE `novedades` ENABLE KEYS */;

--
-- Table structure for table `otro_ingreso`
--

DROP TABLE IF EXISTS `otro_ingreso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `otro_ingreso` (
  `idOtro_Ingreso` int NOT NULL AUTO_INCREMENT,
  `Fecha_Registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `Empleado_idEmpleado` int DEFAULT NULL,
  `Empleado_idEmpleado1` int NOT NULL,
  PRIMARY KEY (`idOtro_Ingreso`),
  KEY `fk_Otro_Ingreso_Empleado1_idx` (`Empleado_idEmpleado1`),
  CONSTRAINT `fk_Otro_Ingreso_Empleado1` FOREIGN KEY (`Empleado_idEmpleado1`) REFERENCES `empleado` (`idEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otro_ingreso`
--

/*!40000 ALTER TABLE `otro_ingreso` DISABLE KEYS */;
INSERT INTO `otro_ingreso` VALUES (1,'2025-03-13 16:04:40',NULL,1),(2,'2025-03-13 16:04:40',NULL,2),(3,'2025-03-13 16:04:40',NULL,3),(4,'2025-03-13 16:04:40',NULL,4),(5,'2025-03-13 16:04:40',NULL,5),(6,'2025-03-13 16:04:40',NULL,6),(7,'2025-03-13 16:04:40',NULL,7),(8,'2025-03-13 16:04:40',NULL,8),(9,'2025-03-13 16:04:40',NULL,9),(10,'2025-03-13 16:04:40',NULL,10);
/*!40000 ALTER TABLE `otro_ingreso` ENABLE KEYS */;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos` (
  `idPagos` int NOT NULL AUTO_INCREMENT,
  `Fecha_Pago` datetime DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Empleado_idEmpleado` int NOT NULL,
  `Estadia_idEstadia` int NOT NULL,
  `HUESPED_idHUESPED` int NOT NULL,
  `Imagen` varchar(100) DEFAULT NULL,
  `Observacion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idPagos`,`HUESPED_idHUESPED`),
  UNIQUE KEY `idPagos` (`idPagos`),
  KEY `fk_Pagos_Empleado1_idx` (`Empleado_idEmpleado`),
  KEY `fk_Pagos_Estadia1_idx` (`Estadia_idEstadia`),
  KEY `fk_Pagos_HUESPED1_idx` (`HUESPED_idHUESPED`),
  CONSTRAINT `fk_Pagos_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  CONSTRAINT `fk_Pagos_Estadia1` FOREIGN KEY (`Estadia_idEstadia`) REFERENCES `estadia` (`idEstadia`),
  CONSTRAINT `fk_Pagos_HUESPED1` FOREIGN KEY (`HUESPED_idHUESPED`) REFERENCES `huesped` (`idHUESPED`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (6,'2025-02-03 15:01:00',123123123,1,18,4,'../imagenes_pagos/1749857847_Factura-deee9d17357b444baac4daccd31e06a6.jpg','123123123');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;

--
-- Table structure for table `tarifa`
--

DROP TABLE IF EXISTS `tarifa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarifa` (
  `idTarifa` int NOT NULL AUTO_INCREMENT,
  `Modalidad` varchar(45) DEFAULT NULL,
  `NroHuespedes` int DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Habitacion_idHabitacion` int NOT NULL,
  PRIMARY KEY (`idTarifa`),
  KEY `fk_Tarifa_Habitacion1_idx` (`Habitacion_idHabitacion`),
  CONSTRAINT `fk_Tarifa_Habitacion1` FOREIGN KEY (`Habitacion_idHabitacion`) REFERENCES `habitacion` (`idHABITACION`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarifa`
--

/*!40000 ALTER TABLE `tarifa` DISABLE KEYS */;
INSERT INTO `tarifa` VALUES (13,'Mi mama me mima',4,100,8),(14,'Mi mama me mima xd',1,1003,9),(15,'El pepe',2,123123,10),(16,'Moringa',10,123123,11),(17,'Pepeto',8,1231231,12);
/*!40000 ALTER TABLE `tarifa` ENABLE KEYS */;

--
-- Dumping routines for database 'adminaloja'
--
/*!50003 DROP PROCEDURE IF EXISTS `InsertEstadia` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertEstadia`(
  IN p_Fecha_Inicio DATE,
  IN p_Fecha_Fin DATE,
  IN p_Habitacion_idHabitacion INT,
  IN p_Costo DOUBLE
)
BEGIN
  DECLARE v_Fecha_Actual DATE;
  SET v_Fecha_Actual = CURDATE();

  
  IF p_Fecha_Inicio < v_Fecha_Actual THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'La fecha de inicio no puede ser inferior a la fecha actual.';
  ELSE
    
    INSERT INTO estadia (Fecha_Inicio, Fecha_Fin, Habitacion_idHabitacion, Costo)
    VALUES (p_Fecha_Inicio, p_Fecha_Fin, p_Habitacion_idHabitacion, p_Costo);
  END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `InsertHuesped` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertHuesped`(
  IN p_NombreCompleto VARCHAR(45),
  IN p_TipoDocumento VARCHAR(45),
  IN p_NumeroDocumento VARCHAR(45),
  IN p_TelefonoHuesped VARCHAR(45),
  IN p_Origen VARCHAR(45),
  IN p_NombreContacto VARCHAR(45),
  IN p_TelefonoContacto VARCHAR(45),
  IN p_Observaciones VARCHAR(45),
  IN p_Observaciones2 VARCHAR(45)
)
BEGIN
  
  IF LENGTH(p_TelefonoHuesped) = 10 AND LEFT(p_TelefonoHuesped, 1) = '3' THEN
    INSERT INTO huesped (
      Nombre_completo, 
      tipo_documento, 
      Numero_documento, 
      Telefono_huesped, 
      Origen, 
      Nombre_Contacto, 
      `Telefono contacto`, 
      Observaciones, 
      observaciones2
    ) VALUES (
      p_NombreCompleto, 
      p_TipoDocumento, 
      p_NumeroDocumento, 
      p_TelefonoHuesped, 
      p_Origen, 
      p_NombreContacto, 
      p_TelefonoContacto, 
      p_Observaciones, 
      p_Observaciones2
    );
  ELSE
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Invalid Colombian phone number. It must be 10 digits and start with 3.';
  END IF;
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

-- Dump completed on 2025-06-13 18:40:17
