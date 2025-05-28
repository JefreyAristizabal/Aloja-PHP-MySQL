-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: adminaloja
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
  `idEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Completo` varchar(45) DEFAULT NULL,
  `Usuario` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Rol` enum('EMPLEADO','ADMIN') DEFAULT NULL,
  PRIMARY KEY (`idEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
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
  `idEstadia` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_Inicio` date DEFAULT NULL,
  `Fecha_Fin` date DEFAULT NULL,
  `Fecha_Registro` datetime DEFAULT current_timestamp(),
  `Costo` double DEFAULT NULL,
  `Habitacion_idHabitacion` int(11) NOT NULL,
  PRIMARY KEY (`idEstadia`),
  KEY `fk_Estadia_Habitacion1_idx` (`Habitacion_idHabitacion`),
  CONSTRAINT `fk_Estadia_Habitacion1` FOREIGN KEY (`Habitacion_idHabitacion`) REFERENCES `habitacion` (`idHABITACION`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadia`
--

/*!40000 ALTER TABLE `estadia` DISABLE KEYS */;
INSERT INTO `estadia` VALUES (1,'2025-03-01','2025-03-05','2025-02-28 10:00:00',700,1),(2,'2025-03-06','2025-03-10','2025-03-05 12:00:00',750,2),(3,'2025-03-11','2025-03-15','2025-03-10 14:00:00',1000,3),(4,'2025-03-16','2025-03-20','2025-03-15 16:00:00',600,4),(5,'2025-03-21','2025-03-25','2025-03-20 18:00:00',800,5),(6,'2025-03-26','2025-03-30','2025-03-25 20:00:00',1200,6),(7,'2025-04-01','2025-04-05','2025-03-31 08:00:00',550,7),(8,'2025-04-06','2025-04-10','2025-04-05 10:00:00',700,8),(9,'2025-04-11','2025-04-15','2025-04-10 12:00:00',950,9),(10,'2025-04-16','2025-04-20','2025-04-15 14:00:00',1100,10);
/*!40000 ALTER TABLE `estadia` ENABLE KEYS */;

--
-- Table structure for table `habitacion`
--

DROP TABLE IF EXISTS `habitacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `habitacion` (
  `idHABITACION` int(11) NOT NULL AUTO_INCREMENT,
  `CAPACIDAD` int(10) unsigned DEFAULT NULL,
  `DESCRIPCION` varchar(45) DEFAULT NULL,
  `NOMBRE` varchar(45) DEFAULT NULL,
  `COSTONOCHE` double DEFAULT NULL,
  `IMAGEN` varchar(255) DEFAULT NULL,
  `ESTADO` enum('OCUPADO','EN MANTENIMIENTO','DISPONIBLE') DEFAULT NULL,
  PRIMARY KEY (`idHABITACION`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitacion`
--

/*!40000 ALTER TABLE `habitacion` DISABLE KEYS */;
INSERT INTO `habitacion` VALUES (1,2,'Con WI-FI y TV','Habitación Doble',NULL,'imagenes_habitaciones/1744057446_descarga.jpg',NULL),(2,1,'Con WI-FI, comida incluida y TV','Habitación Individual',NULL,'imagenes_habitaciones/1744058631_descarga (1).jpg',NULL),(3,5,'Con WI-FI, comida incluida y vista al mar','Habitación Suite',NULL,'imagenes_habitaciones/1744058702_descarga (2).jpg',NULL),(4,3,'Con WI-FI y TV','Habitación Triple',NULL,'imagenes_habitaciones/1744058743_descarga (3).jpg',NULL),(5,4,'Con WI-FI','Habitación Cuatruple',NULL,'imagenes_habitaciones/1744058795_descarga (4).jpg',NULL),(6,6,'Con WI-FI, comida incluida y TV','Habitación Suite',NULL,'imagenes_habitaciones/1744071612_images.jpg',NULL),(7,1,'Con WI-FI y comida incluida','Habitación Estudio',NULL,'imagenes_habitaciones/1744485544_images.jpg',NULL);
/*!40000 ALTER TABLE `habitacion` ENABLE KEYS */;

--
-- Table structure for table `huesped`
--

DROP TABLE IF EXISTS `huesped`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `huesped` (
  `idHUESPED` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_completo` varchar(45) DEFAULT NULL,
  `tipo_documento` varchar(45) DEFAULT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `Telefono_huesped` varchar(45) DEFAULT NULL,
  `Origen` varchar(45) DEFAULT NULL,
  `Nombre_Contacto` varchar(45) DEFAULT NULL,
  `Telefono_contacto` varchar(45) DEFAULT NULL,
  `Observaciones` varchar(45) DEFAULT NULL,
  `observaciones2` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idHUESPED`),
  UNIQUE KEY `numero_documento` (`numero_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `huesped`
--

/*!40000 ALTER TABLE `huesped` DISABLE KEYS */;
INSERT INTO `huesped` VALUES (4,'Ana Martínez','DNI','44332211','456789012','Uruguay','Pedro Martínez','654321098','Ninguna','Ninguna'),(5,'Pedro González','DNI','55667788','567890123','Paraguay','Sofía González','543210987','Ninguna','Ninguna'),(6,'Laura Rodríguez','DNI','88776655','678901234','Bolivia','Miguel Rodríguez','432109876','Ninguna','Ninguna'),(7,'Miguel Fernández','DNI','99887766','789012345','Ecuador','Lucía Fernández','321098765','Ninguna','Ninguna'),(8,'Lucía Sánchez','DNI','66778899','890123456','Colombia','Jorge Sánchez','210987654','Ninguna','Ninguna'),(9,'Jorge Ramírez','DNI','77665544','901234567','Venezuela','Elena Ramírez','109876543','Ninguna','Ninguna');
/*!40000 ALTER TABLE `huesped` ENABLE KEYS */;

--
-- Table structure for table `huesped_has_estadia`
--

DROP TABLE IF EXISTS `huesped_has_estadia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `huesped_has_estadia` (
  `HUESPED_idHUESPED` int(11) NOT NULL,
  `Estadia_idEstadia` int(11) NOT NULL,
  KEY `fk_HUESPED_has_Estadia_Estadia1` (`Estadia_idEstadia`),
  KEY `fk_HUESPED_has_Estadia_HUESPED1` (`HUESPED_idHUESPED`),
  CONSTRAINT `fk_HUESPED_has_Estadia_Estadia1` FOREIGN KEY (`Estadia_idEstadia`) REFERENCES `estadia` (`idEstadia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_HUESPED_has_Estadia_HUESPED1` FOREIGN KEY (`HUESPED_idHUESPED`) REFERENCES `huesped` (`idHUESPED`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `huesped_has_estadia`
--

/*!40000 ALTER TABLE `huesped_has_estadia` DISABLE KEYS */;
INSERT INTO `huesped_has_estadia` VALUES (4,4);
/*!40000 ALTER TABLE `huesped_has_estadia` ENABLE KEYS */;

--
-- Table structure for table `novedades`
--

DROP TABLE IF EXISTS `novedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `novedades` (
  `idNovedades` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Estadia_idEstadia` int(11) NOT NULL,
  PRIMARY KEY (`idNovedades`),
  KEY `fk_Novedades_Estadia1_idx` (`Estadia_idEstadia`),
  CONSTRAINT `fk_Novedades_Estadia1` FOREIGN KEY (`Estadia_idEstadia`) REFERENCES `estadia` (`idEstadia`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novedades`
--

/*!40000 ALTER TABLE `novedades` DISABLE KEYS */;
INSERT INTO `novedades` VALUES (1,'Novedad 1',1),(2,'Novedad 2',2),(3,'Novedad 3',3),(4,'Novedad 4',4),(5,'Novedad 5',5),(6,'Novedad 6',6),(7,'Novedad 7',7),(8,'Novedad 8',8),(9,'Novedad 9',9),(10,'Novedad 10',10);
/*!40000 ALTER TABLE `novedades` ENABLE KEYS */;

--
-- Table structure for table `otro_ingreso`
--

DROP TABLE IF EXISTS `otro_ingreso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `otro_ingreso` (
  `idOtro_Ingreso` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_Registro` datetime DEFAULT current_timestamp(),
  `Empleado_idEmpleado` int(11) DEFAULT NULL,
  `Empleado_idEmpleado1` int(11) NOT NULL,
  PRIMARY KEY (`idOtro_Ingreso`),
  KEY `fk_Otro_Ingreso_Empleado1_idx` (`Empleado_idEmpleado1`),
  CONSTRAINT `fk_Otro_Ingreso_Empleado1` FOREIGN KEY (`Empleado_idEmpleado1`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
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
  `idPagos` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_Pago` datetime DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Empleado_idEmpleado` int(11) NOT NULL,
  `Estadia_idEstadia` int(11) NOT NULL,
  `HUESPED_idHUESPED` int(11) NOT NULL,
  `Imagen` varchar(100) DEFAULT NULL,
  `Observacion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idPagos`,`HUESPED_idHUESPED`),
  UNIQUE KEY `idPagos` (`idPagos`),
  KEY `fk_Pagos_Empleado1_idx` (`Empleado_idEmpleado`),
  KEY `fk_Pagos_Estadia1_idx` (`Estadia_idEstadia`),
  KEY `fk_Pagos_HUESPED1_idx` (`HUESPED_idHUESPED`),
  CONSTRAINT `fk_Pagos_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pagos_Estadia1` FOREIGN KEY (`Estadia_idEstadia`) REFERENCES `estadia` (`idEstadia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pagos_HUESPED1` FOREIGN KEY (`HUESPED_idHUESPED`) REFERENCES `huesped` (`idHUESPED`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (4,'2025-06-03 14:00:00',30000,1,2,9,'imagenes_pagos/1744490664_descarga.png','jijija');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;

--
-- Table structure for table `tarifa`
--

DROP TABLE IF EXISTS `tarifa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarifa` (
  `idTarifa` int(11) NOT NULL AUTO_INCREMENT,
  `Modalidad` varchar(45) DEFAULT NULL,
  `NroHuespedes` int(11) DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Habitacion_idHabitacion` int(11) NOT NULL,
  PRIMARY KEY (`idTarifa`),
  KEY `fk_Tarifa_Habitacion1_idx` (`Habitacion_idHabitacion`),
  CONSTRAINT `fk_Tarifa_Habitacion1` FOREIGN KEY (`Habitacion_idHabitacion`) REFERENCES `habitacion` (`idHABITACION`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarifa`
--

/*!40000 ALTER TABLE `tarifa` DISABLE KEYS */;
INSERT INTO `tarifa` VALUES (1,'Estándar',2,100,1),(2,'Deluxe',3,150,2),(3,'Suite',4,200,3),(4,'Estándar',2,100,4),(5,'Deluxe',3,150,5),(6,'Suite',4,200,6),(7,'Estándar',2,100,7),(8,'Deluxe',3,150,8),(9,'Suite',4,200,9),(10,'Estándar',2,100,10);
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

-- Dump completed on 2025-05-17 19:00:34
