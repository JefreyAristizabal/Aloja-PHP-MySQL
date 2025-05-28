-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: adminaloja
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `cancelacion_reserva`
--

DROP TABLE IF EXISTS `cancelacion_reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cancelacion_reserva` (
  `ID_Cancelacion` int NOT NULL AUTO_INCREMENT,
  `ID_Cliente` int NOT NULL,
  `ID_Hospedaje` int NOT NULL,
  `ID_Habitacion` int DEFAULT NULL,
  `Fecha` datetime NOT NULL,
  PRIMARY KEY (`ID_Cancelacion`),
  KEY `ID_Hospedaje` (`ID_Hospedaje`),
  KEY `ID_Cliente` (`ID_Cliente`),
  KEY `ID_Habitacion` (`ID_Habitacion`),
  CONSTRAINT `cancelacion_reserva_ibfk_1` FOREIGN KEY (`ID_Hospedaje`) REFERENCES `hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `cancelacion_reserva_ibfk_2` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`),
  CONSTRAINT `cancelacion_reserva_ibfk_3` FOREIGN KEY (`ID_Habitacion`) REFERENCES `habitaciones` (`ID_Habitacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancelacion_reserva`
--

LOCK TABLES `cancelacion_reserva` WRITE;
/*!40000 ALTER TABLE `cancelacion_reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `cancelacion_reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `ID_Cliente` int NOT NULL AUTO_INCREMENT,
  `Nombre_Completo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Tipo_Documento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Numero_Documento` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Correo_Electronico` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Telefono` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Celular` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Contacto_Emergencia` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Contacto_Emergencia2` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Luis Miguel Torres Gómez','CC','3001234567','luis.torresgomez@gmail.com','6011234567','3211234567',NULL,NULL,'lmto1234'),(2,'Andrea Sofía Rodríguez Ramírez','TI','3023456789','andrea.rodriguez@gmail.com','6012345678','3222345678',NULL,NULL,'asrr5678'),(3,'Javier Alejandro Morales Peña','CC','3009876543','javier.morales@gmail.com','6013456789','3233456789',NULL,NULL,'jamp9012'),(4,'Camila Fernanda López Ruiz','TI','3034567890','camila.lopezruiz@gmail.com','6014567890','3244567890',NULL,NULL,'cflr3456'),(5,'Diego Andrés Jiménez Herrera','CC','3012345678','diego.jimenez@gmail.com','6015678901','3255678901',NULL,NULL,'dajh7890'),(6,'Natalia Valentina Vargas Ríos','TI','3045678901','natalia.vargas@gmail.com','6016789012','3266789012',NULL,NULL,'nvvr1123'),(7,'Alejandro Esteban Castro Gómez','CC','3023456780','alejandro.castro@gmail.com','6017890123','3277890123',NULL,NULL,'aecg4567'),(8,'Valeria Isabel Ramírez Ruiz','TI','3056789012','valeria.ramirez@gmail.com','6018901234','3288901234',NULL,NULL,'virr8901'),(9,'Sebastián Mauricio Gil Quintero','CC','3034567891','sebastian.gil@gmail.com','6019012345','3290012345',NULL,NULL,'smgq2345'),(10,'Daniela Carolina Romero Salazar','TI','3067890123','daniela.romero@gmail.com','6010123456','3300123456',NULL,NULL,'dcrs6ur');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_cliente_delete` BEFORE DELETE ON `clientes` FOR EACH ROW BEGIN
  INSERT INTO clientes_eliminados (
    ID_Cliente, Nombre_Completo, Tipo_Documento, Numero_Documento, Correo_Electronico, Telefono, Celular, Contrasena, Contacto_Emergencia, Contacto_Emergencia2, Fecha_Eliminacion
  ) VALUES (
    OLD.ID_Cliente, OLD.Nombre_Completo, OLD.Tipo_Documento, OLD.Numero_Documento, OLD.Correo_Electronico, OLD.Telefono, OLD.Celular, OLD.Contrasena, OLD.Contacto_Emergencia, OLD.Contacto_Emergencia2, NOW()
  );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `clientes_eliminados`
--

DROP TABLE IF EXISTS `clientes_eliminados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes_eliminados` (
  `ID_Cliente` int NOT NULL,
  `Nombre_Completo` varchar(200) NOT NULL,
  `Tipo_Documento` varchar(100) NOT NULL,
  `Numero_Documento` varchar(200) NOT NULL,
  `Correo_Electronico` varchar(200) DEFAULT NULL,
  `Telefono` varchar(200) DEFAULT NULL,
  `Celular` varchar(200) DEFAULT NULL,
  `Contrasena` varchar(255) DEFAULT NULL,
  `Contacto_Emergencia` varchar(50) DEFAULT NULL,
  `Contacto_Emergencia2` varchar(50) DEFAULT NULL,
  `Fecha_Eliminacion` datetime NOT NULL,
  KEY `ID_Cliente` (`ID_Cliente`),
  CONSTRAINT `clientes_eliminados_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_eliminados`
--

LOCK TABLES `clientes_eliminados` WRITE;
/*!40000 ALTER TABLE `clientes_eliminados` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes_eliminados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario_calificacion`
--

DROP TABLE IF EXISTS `comentario_calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentario_calificacion` (
  `ID_Comentario` int NOT NULL AUTO_INCREMENT,
  `ID_Cliente` int NOT NULL,
  `Calificacion` float(2,1) DEFAULT NULL,
  `Comentario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ID_Hospedaje` int NOT NULL,
  PRIMARY KEY (`ID_Comentario`),
  KEY `ID_Cliente` (`ID_Cliente`),
  KEY `ID_Hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `comentario_calificacion_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`),
  CONSTRAINT `comentario_calificacion_ibfk_2` FOREIGN KEY (`ID_Hospedaje`) REFERENCES `hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `comentario_calificacion_chk_1` CHECK ((`Calificacion` between 0 and 5.0))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario_calificacion`
--

LOCK TABLES `comentario_calificacion` WRITE;
/*!40000 ALTER TABLE `comentario_calificacion` DISABLE KEYS */;
INSERT INTO `comentario_calificacion` VALUES (1,2,4.8,'Todo muy bonito, me gusto lo comodo que es, el servicio tambien muy bueno',2);
/*!40000 ALTER TABLE `comentario_calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados` (
  `ID_Empleado` int NOT NULL AUTO_INCREMENT,
  `Nombre_Completo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Tipo_Documento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Numero_Documento` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Correo_Electronico` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Telefono` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Celular` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Puesto_Trabajo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,'Juan Manuel Pérez Gómez','CC','4001234567','juan.perezgomez@empresa.com','6011122334','3111234567','jmpg1234','Gerente'),(2,'María Fernanda López Ramírez','CC','4023456789','maria.lopezramirez@empresa.com','6012233445','3122345678','mflr5678','Asistente'),(3,'Carlos Alberto Rodríguez Torres','CC','4009876543','carlos.rodriguez@empresa.com','6013344556','3133456789','cart9012','Supervisor'),(4,'Ana Patricia Gómez Martínez','CC','4034567890','ana.gomezmartinez@empresa.com','6014455667','3144567890','apgm3456','Secretaria'),(5,'Pedro Luis Jiménez Herrera','CC','4012345678','pedro.jimenezherrera@empresa.com','6015566778','3155678901','pljh7890','Ingeniero'),(6,'Luisa Fernanda Fernández Ríos','CC','4045678901','luisa.fernandezrios@empresa.com','6016677889','3166789012','lffr1123','Diseñadora'),(7,'Andrés Felipe Martínez Vega','CC','4023456780','andres.martinezvega@empresa.com','6017788990','3177890123','afmv4567','Programador'),(8,'Carolina Andrea Castro Ruiz','CC','4056789012','carolina.castroruiz@empresa.com','6018899001','3188901234','cacr8901','Contadora'),(9,'Felipe Alejandro Ruiz Camacho','CC','4034567891','felipe.ruizcamacho@empresa.com','6019900123','3190012345','farc2345','Técnico'),(10,'Daniela Valentina Mejía Vargas','CC','4067890123','daniela.mejíavargas@empresa.com','6010123456','3200123456','dvmv6789','Administradora');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturacion`
--

DROP TABLE IF EXISTS `facturacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturacion` (
  `ID_Factura` int NOT NULL AUTO_INCREMENT,
  `ID_Cliente` int NOT NULL,
  `ID_Hospedaje` int NOT NULL,
  `Fecha_Factura` datetime NOT NULL,
  `Monto_Total` bigint NOT NULL,
  PRIMARY KEY (`ID_Factura`),
  KEY `ID_Cliente` (`ID_Cliente`),
  KEY `ID_Hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`),
  CONSTRAINT `facturacion_ibfk_2` FOREIGN KEY (`ID_Hospedaje`) REFERENCES `hospedaje` (`ID_Hospedaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturacion`
--

LOCK TABLES `facturacion` WRITE;
/*!40000 ALTER TABLE `facturacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habitaciones`
--

DROP TABLE IF EXISTS `habitaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `habitaciones` (
  `ID_Habitacion` int NOT NULL AUTO_INCREMENT,
  `ID_Hospedaje` int NOT NULL,
  `Costo_Por_Dia` bigint DEFAULT NULL,
  `Costo_Por_Mes` bigint DEFAULT NULL,
  `Costo_Por_Año` bigint DEFAULT NULL,
  `Capacidad` int DEFAULT NULL,
  `Estado` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID_Habitacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitaciones`
--

LOCK TABLES `habitaciones` WRITE;
/*!40000 ALTER TABLE `habitaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `habitaciones` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_habitacion_update` AFTER UPDATE ON `habitaciones` FOR EACH ROW BEGIN
  IF OLD.Costo_Por_Dia <> NEW.Costo_Por_Dia THEN
    INSERT INTO historial_precios (ID_Hospedaje, ID_Habitacion, Tipo_Tiempo, Precio, Fecha_Actualizacion)
    VALUES (NEW.ID_Hospedaje, NEW.ID_Habitacion, 'Dia', NEW.Costo_Por_Dia, NOW());
  END IF;

  IF OLD.Costo_Por_Mes <> NEW.Costo_Por_Mes THEN
    INSERT INTO historial_precios (ID_Hospedaje, ID_Habitacion, Tipo_Tiempo, Precio, Fecha_Actualizacion)
    VALUES (NEW.ID_Hospedaje, NEW.ID_Habitacion, 'Mes', NEW.Costo_Por_Mes, NOW());
  END IF;

  IF OLD.Costo_Por_Año <> NEW.Costo_Por_Año THEN
    INSERT INTO historial_precios (ID_Hospedaje, ID_Habitacion, Tipo_Tiempo, Precio, Fecha_Actualizacion)
    VALUES (NEW.ID_Hospedaje, NEW.ID_Habitacion, 'Año', NEW.Costo_Por_Año, NOW());
  END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_habitacion_delete` BEFORE DELETE ON `habitaciones` FOR EACH ROW BEGIN
  INSERT INTO historial_habitaciones_eliminadas (
    ID_Habitacion, ID_Hospedaje, Costo_Por_Dia, Costo_Por_Mes, Costo_Por_Año, Capacidad, Estado, Fecha_Eliminacion
  ) VALUES (
    OLD.ID_Habitacion, OLD.ID_Hospedaje, OLD.Costo_Por_Dia, OLD.Costo_Por_Mes, OLD.Costo_Por_Año, OLD.Capacidad, OLD.Estado, NOW()
  );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `historial_habitaciones_eliminadas`
--

DROP TABLE IF EXISTS `historial_habitaciones_eliminadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_habitaciones_eliminadas` (
  `ID_Habitacion` int NOT NULL,
  `ID_Hospedaje` int NOT NULL,
  `Costo_Por_Dia` bigint DEFAULT NULL,
  `Costo_Por_Mes` bigint DEFAULT NULL,
  `Costo_Por_Año` bigint DEFAULT NULL,
  `Capacidad` int DEFAULT NULL,
  `Estado` varchar(25) DEFAULT NULL,
  `Fecha_Eliminacion` datetime NOT NULL,
  KEY `ID_Habitacion` (`ID_Habitacion`),
  KEY `ID_Hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `historial_habitaciones_eliminadas_ibfk_1` FOREIGN KEY (`ID_Habitacion`) REFERENCES `habitaciones` (`ID_Habitacion`),
  CONSTRAINT `historial_habitaciones_eliminadas_ibfk_2` FOREIGN KEY (`ID_Hospedaje`) REFERENCES `hospedaje` (`ID_Hospedaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_habitaciones_eliminadas`
--

LOCK TABLES `historial_habitaciones_eliminadas` WRITE;
/*!40000 ALTER TABLE `historial_habitaciones_eliminadas` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_habitaciones_eliminadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_hospedajes_eliminados`
--

DROP TABLE IF EXISTS `historial_hospedajes_eliminados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_hospedajes_eliminados` (
  `ID_Hospedaje` int NOT NULL,
  `Nombre_Hospedaje` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Costo_Por_Dia` int DEFAULT NULL,
  `Costo_Por_Mes` bigint DEFAULT NULL,
  `Costo_Por_Año` bigint DEFAULT NULL,
  `Tipo_Hospedaje` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Disponibilidad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Max_Personas` int DEFAULT NULL,
  `Ciudad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Departamento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Fecha_Eliminacion` datetime NOT NULL,
  KEY `ID_Hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `historial_hospedajes_eliminados_ibfk_1` FOREIGN KEY (`ID_Hospedaje`) REFERENCES `hospedaje` (`ID_Hospedaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_hospedajes_eliminados`
--

LOCK TABLES `historial_hospedajes_eliminados` WRITE;
/*!40000 ALTER TABLE `historial_hospedajes_eliminados` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_hospedajes_eliminados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_precios`
--

DROP TABLE IF EXISTS `historial_precios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_precios` (
  `ID_Historial` int NOT NULL AUTO_INCREMENT,
  `ID_Hospedaje` int NOT NULL,
  `ID_Habitacion` int DEFAULT NULL,
  `Tipo_Tiempo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Precio` bigint NOT NULL,
  `Fecha_Actualizacion` datetime NOT NULL,
  PRIMARY KEY (`ID_Historial`),
  KEY `ID_Hospedaje` (`ID_Hospedaje`),
  KEY `ID_Habitacion` (`ID_Habitacion`),
  CONSTRAINT `historial_precios_ibfk_1` FOREIGN KEY (`ID_Hospedaje`) REFERENCES `hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `historial_precios_ibfk_2` FOREIGN KEY (`ID_Habitacion`) REFERENCES `habitaciones` (`ID_Habitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_precios`
--

LOCK TABLES `historial_precios` WRITE;
/*!40000 ALTER TABLE `historial_precios` DISABLE KEYS */;
INSERT INTO `historial_precios` VALUES (1,1,NULL,'Dia',55000,'2025-02-24 16:29:32');
/*!40000 ALTER TABLE `historial_precios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospedaje`
--

DROP TABLE IF EXISTS `hospedaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hospedaje` (
  `ID_Hospedaje` int NOT NULL AUTO_INCREMENT,
  `Nombre_Hospedaje` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Costo_Por_Dia` int DEFAULT NULL,
  `Costo_Por_Mes` bigint DEFAULT NULL,
  `Costo_Por_Año` bigint DEFAULT NULL,
  `Tipo_Hospedaje` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Disponibilidad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Max_Personas` int DEFAULT NULL,
  `Ciudad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Departamento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Hospedaje`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospedaje`
--

LOCK TABLES `hospedaje` WRITE;
/*!40000 ALTER TABLE `hospedaje` DISABLE KEYS */;
INSERT INTO `hospedaje` VALUES (1,'Edificio Oasis',55000,1500000,18000000,'Apartamento','Calle 10 #5-30',NULL,4,'Medellín','Antioquia'),(2,'Residencia Los Andes',60000,1800000,21000000,'Casa','Carrera 7 #12-45',NULL,5,'Bogotá','Cundinamarca'),(3,'Hotel Caribe',120000,3600000,42000000,'Hotel','Avenida 1 #3-20',NULL,2,'Cartagena','Bolívar'),(4,'Posada Pacífica',70000,2100000,25200000,'Posada','Calle 12 #7-15',NULL,3,'Buenaventura','Valle del Cauca'),(5,'Finca Las Palmas',50000,1500000,18000000,'Finca','Vereda El Paraíso',NULL,6,'Armenia','Quindío'),(6,'Apartamentos El Poblado',80000,2400000,28800000,'Apartamento','Calle 20 #30-50',NULL,4,'Bucaramanga','Santander'),(7,'Cabañas La Montaña',55000,1650000,19800000,'Cabaña','Kilómetro 5 vía El Retiro',NULL,6,'Manizales','Caldas'),(8,'Hostal El Sol',40000,1200000,14400000,'Hostal','Calle 3 #2-10',NULL,8,'Pereira','Risaralda'),(9,'Refugio El Bosque',45000,1350000,16200000,'Refugio','Camino Real',NULL,5,'Villavicencio','Meta'),(10,'Villa Campestre',90000,2700000,32400000,'Villa','Carretera Central #25-50',NULL,7,'Cali','Valle del Cauca');
/*!40000 ALTER TABLE `hospedaje` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_hospedaje_update` AFTER UPDATE ON `hospedaje` FOR EACH ROW BEGIN
  IF OLD.Costo_Por_Dia <> NEW.Costo_Por_Dia THEN
    INSERT INTO historial_precios (ID_Hospedaje, Tipo_Tiempo, Precio, Fecha_Actualizacion)
    VALUES (NEW.ID_Hospedaje, 'Dia', NEW.Costo_Por_Dia, NOW());
  END IF;
  
  IF OLD.Costo_Por_Mes <> NEW.Costo_Por_Mes THEN
    INSERT INTO historial_precios (ID_Hospedaje, Tipo_Tiempo, Precio, Fecha_Actualizacion)
    VALUES (NEW.ID_Hospedaje, 'Mes', NEW.Costo_Por_Mes, NOW());
  END IF;
  
  IF OLD.Costo_Por_Año <> NEW.Costo_Por_Año THEN
    INSERT INTO historial_precios (ID_Hospedaje, Tipo_Tiempo, Precio, Fecha_Actualizacion)
    VALUES (NEW.ID_Hospedaje, 'Año', NEW.Costo_Por_Año, NOW());
  END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_hospedaje_delete` BEFORE DELETE ON `hospedaje` FOR EACH ROW BEGIN
  INSERT INTO historial_hospedajes_eliminados (
    ID_Hospedaje, Nombre_Hospedaje, Costo_Por_Dia, Costo_Por_Mes, Costo_Por_Año, Tipo_Hospedaje, Direccion, Disponibilidad, Max_Personas, Ciudad, Departamento, Fecha_Eliminacion
  ) VALUES (
    OLD.ID_Hospedaje, OLD.Nombre_Hospedaje, OLD.Costo_Por_Dia, OLD.Costo_Por_Mes, OLD.Costo_Por_Año, OLD.Tipo_Hospedaje, OLD.Direccion, OLD.Disponibilidad, OLD.Max_Personas, OLD.Ciudad, OLD.Departamento, NOW()
  );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `imagenes_hospedajes`
--

DROP TABLE IF EXISTS `imagenes_hospedajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imagenes_hospedajes` (
  `ID_Imagen` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ID_Hospedaje` int DEFAULT NULL,
  PRIMARY KEY (`ID_Imagen`),
  KEY `ID_Hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `imagenes_hospedajes_ibfk_1` FOREIGN KEY (`ID_Hospedaje`) REFERENCES `hospedaje` (`ID_Hospedaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes_hospedajes`
--

LOCK TABLES `imagenes_hospedajes` WRITE;
/*!40000 ALTER TABLE `imagenes_hospedajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `imagenes_hospedajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ofertas` (
  `ID_Oferta` int NOT NULL AUTO_INCREMENT,
  `Inicio_FechaLanza` date DEFAULT NULL,
  `Fin_FechaLanza` date DEFAULT NULL,
  `Oferta_Porcentaje` float NOT NULL,
  `ID_Hospedaje` int NOT NULL,
  PRIMARY KEY (`ID_Oferta`),
  KEY `ID_Hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`ID_Hospedaje`) REFERENCES `hospedaje` (`ID_Hospedaje`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ofertas`
--

LOCK TABLES `ofertas` WRITE;
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
INSERT INTO `ofertas` VALUES (1,'2025-01-25','2025-02-20',0.2,1);
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `renta`
--

DROP TABLE IF EXISTS `renta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `renta` (
  `ID_Renta` int NOT NULL AUTO_INCREMENT,
  `ID_Cliente` int NOT NULL,
  `ID_Hospedaje` int NOT NULL,
  `ID_Habitacion` int DEFAULT NULL,
  `Fecha_Entrada` date NOT NULL,
  `Fecha_Salida` date DEFAULT NULL,
  `Costo_Total` bigint DEFAULT NULL,
  PRIMARY KEY (`ID_Renta`),
  KEY `ID_Cliente` (`ID_Cliente`),
  KEY `ID_Hospedaje` (`ID_Hospedaje`),
  KEY `ID_Habitacion` (`ID_Habitacion`),
  CONSTRAINT `renta_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`),
  CONSTRAINT `renta_ibfk_2` FOREIGN KEY (`ID_Hospedaje`) REFERENCES `hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `renta_ibfk_3` FOREIGN KEY (`ID_Habitacion`) REFERENCES `habitaciones` (`ID_Habitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `renta`
--

LOCK TABLES `renta` WRITE;
/*!40000 ALTER TABLE `renta` DISABLE KEYS */;
INSERT INTO `renta` VALUES (1,1,1,NULL,'2024-01-10','2024-01-15',275000),(2,2,2,NULL,'2024-02-05','2024-02-12',420000),(3,3,3,NULL,'2024-03-10','2024-03-20',1200000),(4,4,4,NULL,'2024-04-01','2024-04-07',420000),(5,5,5,NULL,'2024-05-15','2024-05-22',350000),(6,6,6,NULL,'2024-06-18','2024-06-25',560000),(7,7,7,NULL,'2024-07-01','2024-07-10',495000),(8,8,8,NULL,'2024-08-20','2024-08-28',320000),(9,9,9,NULL,'2024-09-05','2024-09-12',315000),(10,10,10,NULL,'2024-10-15','2024-10-22',630000);
/*!40000 ALTER TABLE `renta` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_renta_update` AFTER UPDATE ON `renta` FOR EACH ROW BEGIN
  IF OLD.Fecha_Salida <> NEW.Fecha_Salida THEN
    CALL CalcularCostoTotal(NEW.ID_Cliente);
  END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `reserva_cliente_hospedaje_habitacion`
--

DROP TABLE IF EXISTS `reserva_cliente_hospedaje_habitacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reserva_cliente_hospedaje_habitacion` (
  `ID_Reserva` int NOT NULL AUTO_INCREMENT,
  `ID_Cliente` int NOT NULL,
  `ID_Hospedaje` int NOT NULL,
  `ID_Habitacion` int DEFAULT NULL,
  `ID_Renta` int NOT NULL,
  PRIMARY KEY (`ID_Reserva`),
  KEY `ID_Renta` (`ID_Renta`),
  KEY `ID_Cliente` (`ID_Cliente`),
  KEY `ID_Hospedaje` (`ID_Hospedaje`),
  KEY `ID_Habitacion` (`ID_Habitacion`),
  CONSTRAINT `reserva_cliente_hospedaje_habitacion_ibfk_1` FOREIGN KEY (`ID_Renta`) REFERENCES `renta` (`ID_Renta`),
  CONSTRAINT `reserva_cliente_hospedaje_habitacion_ibfk_2` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`),
  CONSTRAINT `reserva_cliente_hospedaje_habitacion_ibfk_3` FOREIGN KEY (`ID_Hospedaje`) REFERENCES `hospedaje` (`ID_Hospedaje`),
  CONSTRAINT `reserva_cliente_hospedaje_habitacion_ibfk_4` FOREIGN KEY (`ID_Habitacion`) REFERENCES `habitaciones` (`ID_Habitacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva_cliente_hospedaje_habitacion`
--

LOCK TABLES `reserva_cliente_hospedaje_habitacion` WRITE;
/*!40000 ALTER TABLE `reserva_cliente_hospedaje_habitacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `reserva_cliente_hospedaje_habitacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos_hospedajes`
--

DROP TABLE IF EXISTS `videos_hospedajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `videos_hospedajes` (
  `ID_Video` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ID_Hospedaje` int DEFAULT NULL,
  PRIMARY KEY (`ID_Video`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos_hospedajes`
--

LOCK TABLES `videos_hospedajes` WRITE;
/*!40000 ALTER TABLE `videos_hospedajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `videos_hospedajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'adminaloja'
--

--
-- Dumping routines for database 'adminaloja'
--
/*!50003 DROP PROCEDURE IF EXISTS `ActualizarDisponibilidadHospedaje` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarDisponibilidadHospedaje`(IN hospedaje_id INT)
BEGIN
  DECLARE total_rentas INT;
  DECLARE disponibilidad_actual VARCHAR(50);

  -- Contar el número de rentas activas para el hospedaje cuya fecha de salida ha pasado
  SELECT COUNT(*) INTO total_rentas
  FROM renta
  WHERE ID_Hospedaje = hospedaje_id AND Fecha_Salida < CURDATE();

  -- Determinar la disponibilidad basada en el número de rentas activas
  IF total_rentas > 0 THEN
    SET disponibilidad_actual = 'Ocupado';
  ELSE
    SET disponibilidad_actual = 'Disponible';
  END IF;

  -- Actualizar la disponibilidad en la tabla hospedaje
  UPDATE hospedaje
  SET Disponibilidad = disponibilidad_actual
  WHERE ID_Hospedaje = hospedaje_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `AplicarOferta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `AplicarOferta`(IN cliente_id INT)
BEGIN
  DECLARE oferta_porcentaje FLOAT;
  DECLARE costo_total BIGINT;

  -- Obtener el costo total actual de la renta del cliente y el porcentaje de oferta
  SELECT r.Costo_Total, o.Oferta_Porcentaje INTO costo_total, oferta_porcentaje
  FROM renta r
  JOIN ofertas o ON r.ID_Hospedaje = o.ID_Hospedaje
  WHERE r.ID_Cliente = cliente_id;

  -- Aplicar el porcentaje de oferta al costo total
  SET costo_total = costo_total - (costo_total * oferta_porcentaje);

  -- Actualizar el costo total en la tabla renta
  UPDATE renta
  SET Costo_Total = costo_total
  WHERE ID_Cliente = cliente_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CalcularCostoTotal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CalcularCostoTotal`(IN cliente_id INT)
BEGIN
  UPDATE renta r
  JOIN hospedaje h ON r.ID_Hospedaje = h.ID_Hospedaje
  SET r.Costo_Total = CASE
    WHEN DATEDIFF(r.Fecha_Salida, r.Fecha_Entrada) < 30 THEN DATEDIFF(r.Fecha_Salida, r.Fecha_Entrada) * h.Costo_Por_Dia
    WHEN DATEDIFF(r.Fecha_Salida, r.Fecha_Entrada) < 365 THEN DATEDIFF(r.Fecha_Salida, r.Fecha_Entrada) * h.Costo_Por_Mes / 30
    ELSE DATEDIFF(r.Fecha_Salida, r.Fecha_Entrada) * h.Costo_Por_Año / 365
  END
  WHERE r.ID_Cliente = cliente_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CalcularCostoTotalHabitacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CalcularCostoTotalHabitacion`(IN cliente_id INT)
BEGIN
  UPDATE renta r
  JOIN habitaciones h ON r.ID_Habitacion = h.ID_Habitacion
  SET r.Costo_Total = CASE
    WHEN DATEDIFF(r.Fecha_Salida, r.Fecha_Entrada) < 30 THEN DATEDIFF(r.Fecha_Salida, r.Fecha_Entrada) * h.Costo_Por_Dia
    WHEN DATEDIFF(r.Fecha_Salida, r.Fecha_Entrada) < 365 THEN DATEDIFF(r.Fecha_Salida, r.Fecha_Entrada) * h.Costo_Por_Mes / 30
    ELSE DATEDIFF(r.Fecha_Salida, r.Fecha_Entrada) * h.Costo_Por_Año / 365
  END
  WHERE r.ID_Cliente = cliente_id;
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

-- Dump completed on 2025-03-06 19:29:14
