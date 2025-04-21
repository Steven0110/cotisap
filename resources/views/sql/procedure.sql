DROP PROCEDURE IF EXISTS createCompany;
DELIMITER $$
CREATE PROCEDURE createCompany(IN prefix varchar(30))
BEGIN
  SET @create_articulos = CONCAT('CREATE TABLE IF NOT EXISTS ', prefix, '_articulos (');
  SET @create_articulos = CONCAT(@create_articulos, 'id int(10) unsigned NOT NULL AUTO_INCREMENT,');
  SET @create_articulos = CONCAT(@create_articulos, 'codigo varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'descripcion varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'clase varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'grupo int(11) NOT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'precio decimal(8,2) NOT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'UMV varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'moneda varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'comentarios varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'user_id int(11) NOT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'status tinyint(1) NOT NULL DEFAULT 1,');
  SET @create_articulos = CONCAT(@create_articulos, 'created_at timestamp NULL DEFAULT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'updated_at timestamp NULL DEFAULT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'lista int(11) NOT NULL,');
  SET @create_articulos = CONCAT(@create_articulos, 'PRIMARY KEY (id),');
  SET @create_articulos = CONCAT(@create_articulos, 'KEY key_2 (codigo)');
  SET @create_articulos = CONCAT(@create_articulos, ') ENGINE=MyISAM AUTO_INCREMENT=472 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
  
  SET @create_art_quotations = CONCAT('CREATE TABLE IF NOT EXISTS ', prefix, '_art_quotations (');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'id int(10) unsigned NOT NULL AUTO_INCREMENT,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'numCotizacion varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'numLine varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'codigoArt varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'nombreArt varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'cantidad int(11) NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'moneda varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'precioLista varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'UMV varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'precioUnidad varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'PrecioVenta varchar(255) COLLATE utf8mb4_unicode_ci,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'importe varchar(255) COLLATE utf8mb4_unicode_ci,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'marca varchar(255) COLLATE utf8mb4_unicode_ci ,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'costo varchar(255) COLLATE utf8mb4_unicode_ci,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'desc varchar(255) COLLATE utf8mb4_unicode_ci,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'utilidad varchar(255) COLLATE utf8mb4_unicode_ci,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'factor varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'subTotalLinea varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'almacen varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'tiempoEntrega varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'observaciones varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'created_at timestamp NULL DEFAULT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'updated_at timestamp NULL DEFAULT NULL,');
  SET @create_art_quotations = CONCAT(@create_art_quotations, 'PRIMARY KEY (id)');
  SET @create_art_quotations = CONCAT(@create_art_quotations, ') ENGINE=MyISAM AUTO_INCREMENT=29997 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');

  SET @create_capacitations = CONCAT('CREATE TABLE IF NOT EXISTS ', prefix, '_capacitations (');

  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  titulo varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  categoria varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  descripcion varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  archivo varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  status tinyint(1) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  link varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


  PREPARE articulos FROM @create_articulos;
  PREPARE art_quotations FROM @create_art_quotations;

  EXECUTE articulos;
  EXECUTE art_quotations;

  DEALLOCATE PREPARE articulos;
  DEALLOCATE PREPARE art_quotations;
END
$$

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.XXX_companies
CREATE TABLE IF NOT EXISTS XXX_companies (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  status tinyint(1) NOT NULL,
  Nombre varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  Company varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  logo varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  dominio varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  HOST_Sap varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  USER_Sap varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PASS_Sap varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  DB_Sap varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  HOST_cotiSap varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  USER_cotiSap varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PASS_cotiSap varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  DB_cotiSap varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  SMTP_host varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  SMTP_port varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  SMTP_user varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  SMTP_pass varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  factClave varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.XXX_notes
CREATE TABLE IF NOT EXISTS XXX_notes (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  condiciones varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  status tinyint(1) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.XXX_payment
CREATE TABLE IF NOT EXISTS XXX_payment (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  numCotizacion varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  metodo varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  monto varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  moneda varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  date varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  comprobante varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Efectivo',
  referencia varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Efectivo',
  status varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.XXX_policies
CREATE TABLE IF NOT EXISTS XXX_policies (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  titulo varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  descripcion varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  precio int(11) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.XXX_quotations
CREATE TABLE IF NOT EXISTS XXX_quotations (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  numCotizacion varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  nombreCliente varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  totalMXN decimal(20,2) NOT NULL,
  totalUSD decimal(20,2) NOT NULL,
  total decimal(20,2) NOT NULL,
  comentarios varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  idVendedor varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  tc varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  estatus varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  account varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  numCliente varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  notasCotizacion int(11) NOT NULL,
  fechaEntrega date NOT NULL,
  tipoEntrega varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  personaEntrega varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  telefonoEntrega varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  correoEntrega varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  direccionEntrega varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  fleteraEntrega varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY mbrhosting_quotations_numcotizacion_unique (numCotizacion)
) ENGINE=MyISAM AUTO_INCREMENT=2365 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.XXX_roles
CREATE TABLE IF NOT EXISTS XXX_roles (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  rol varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  dataConfig varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.XXX_sliders
CREATE TABLE IF NOT EXISTS XXX_sliders (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  titulo varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  archivo varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  interno tinyint(1) NOT NULL,
  cliente tinyint(1) NOT NULL,
  status varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.XXX_specs
CREATE TABLE IF NOT EXISTS XXX_specs (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  nombre varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  descripcion varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  tipo int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.XXX_template
CREATE TABLE IF NOT EXISTS XXX_template (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  tipo varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  categoria varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  data varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  dataConfig varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla cotisap_01.XXX_tools
CREATE TABLE IF NOT EXISTS XXX_tools (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  categoria varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  marca varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  titulo varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  descripcion varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  archivo varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  link varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  status tinyint(1) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
