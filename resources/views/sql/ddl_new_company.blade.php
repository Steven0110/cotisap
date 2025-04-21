use {{$data['dbname']}};
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_articulos
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_articulos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clase` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `UMV` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moneda` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comentarios` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lista` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key_2` (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=472 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_art_quotations
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_art_quotations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numCotizacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numLine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigoArt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreArt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `moneda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precioLista` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UMV` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precioUnidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PrecioVenta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `importe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `marca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '- Ningún fabricante -',
  `costo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `utilidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `factor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subTotalLinea` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `almacen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tiempoEntrega` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29997 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_capacitacions
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_capacitacions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_companies
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL,
  `Nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dominio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HOST_Sap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `USER_Sap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASS_Sap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DB_Sap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HOST_cotiSap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `USER_cotiSap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASS_cotiSap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DB_cotiSap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SMTP_host` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SMTP_port` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SMTP_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SMTP_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factClave` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_notes
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condiciones` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_payment
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numCotizacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metodo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moneda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comprobante` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Efectivo',
  `referencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Efectivo',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_policies
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_policies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_quotations
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_quotations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numCotizacion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreCliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalMXN` decimal(20,2) NOT NULL,
  `totalUSD` decimal(20,2) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `comentarios` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idVendedor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numCliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notasCotizacion` int(11) NOT NULL,
  `fechaEntrega` date NOT NULL,
  `tipoEntrega` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personaEntrega` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonoEntrega` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correoEntrega` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccionEntrega` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fleteraEntrega` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mbrhosting_quotations_numcotizacion_unique` (`numCotizacion`)
) ENGINE=MyISAM AUTO_INCREMENT=2365 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_roles
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rol` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataConfig` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_sliders
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_sliders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interno` tinyint(1) NOT NULL,
  `cliente` tinyint(1) NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_specs
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_specs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_template
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataConfig` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.{{$data['prefix']}}_tools
CREATE TABLE IF NOT EXISTS `{{$data['prefix']}}_tools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archivo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
