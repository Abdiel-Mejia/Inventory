-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.1.72-community - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para gestion_precios
CREATE DATABASE IF NOT EXISTS `gestion_precios` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gestion_precios`;

-- Volcando estructura para tabla gestion_precios.precios
CREATE TABLE IF NOT EXISTS `precios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla gestion_precios.precios: 8 rows
/*!40000 ALTER TABLE `precios` DISABLE KEYS */;
INSERT INTO `precios` (`id`, `descripcion`, `precio`, `fecha_creacion`, `imagen`) VALUES
	(24, 'Tenis Nike Dunk High Up Black and Varsity Maize', 3399.00, '2017-07-04 14:00:00', ' ../imagenes/productoH.png'),
	(23, 'Tenis de basquetbol para hombre Nike G.T. Jump 2', 4499.00, '2018-06-10 12:00:00', '../imagenes/productoG.png'),
	(22, 'Nike Air Max 90. Tenis para hombre.', 2999.00, '2019-06-01 08:00:00', '../imagenes/productoF.png'),
	(21, 'Nike Shox TL. Calzado para mujer.', 3699.00, '2020-05-25 16:20:00', '../imagenes/productoE.png'),
	(20, 'Nike Air Max 90 Futura. Tenis para mujer.', 2777.60, '2021-04-10 11:45:00', '../imagenes/productoD.png'),
	(19, 'Nike Air Max Excee. Tenis para hombre.', 2499.00, '2022-03-05 09:15:00', '../imagenes/productoC.png'),
	(18, 'Nike Air Max 270. Tenis para hombre.', 3799.00, '2023-02-20 14:30:00', '../imagenes/productoB.png'),
	(17, 'Nike Air Max 1 Premium. Tenis para mujer.', 3899.00, '2024-01-15 10:00:00', '../imagenes/productoA.png');
/*!40000 ALTER TABLE `precios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
