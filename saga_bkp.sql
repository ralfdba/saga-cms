-- MySQL dump 10.18  Distrib 10.3.27-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: saga
-- ------------------------------------------------------
-- Server version	10.3.27-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cocomentarios`
--

DROP TABLE IF EXISTS `cocomentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cocomentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publicacion_id` int(10) NOT NULL,
  `rut_usuario` varchar(12) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` int(10) DEFAULT 0 COMMENT '0 = Comentario aprobado\n1 = Comentario rechazado ',
  `comentario` varchar(200) DEFAULT NULL,
  `reserva_id` varchar(45) DEFAULT NULL COMMENT 'Para evaluar la video conferencia',
  `evaluacion` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`,`publicacion_id`,`rut_usuario`),
  KEY `idxrut` (`publicacion_id`,`rut_usuario`,`estado`,`reserva_id`,`evaluacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cocomentarios`
--

LOCK TABLES `cocomentarios` WRITE;
/*!40000 ALTER TABLE `cocomentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `cocomentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comunas`
--

DROP TABLE IF EXISTS `comunas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comunas` (
  `comuna_id` int(11) NOT NULL AUTO_INCREMENT,
  `comuna_nombre` varchar(64) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  PRIMARY KEY (`comuna_id`)
) ENGINE=MyISAM AUTO_INCREMENT=346 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comunas`
--

LOCK TABLES `comunas` WRITE;
/*!40000 ALTER TABLE `comunas` DISABLE KEYS */;
INSERT INTO `comunas` VALUES (1,'Arica',1),(2,'Camarones',1),(3,'General Lagos',2),(4,'Putre',2),(5,'Alto Hospicio',3),(6,'Iquique',3),(7,'Camiña',4),(8,'Colchane',4),(9,'Huara',4),(10,'Pica',4),(11,'Pozo Almonte',4),(12,'Antofagasta',5),(13,'Mejillones',5),(14,'Sierra Gorda',5),(15,'Taltal',5),(16,'Calama',6),(17,'Ollague',6),(18,'San Pedro de Atacama',6),(19,'María Elena',7),(20,'Tocopilla',7),(21,'Chañaral',8),(22,'Diego de Almagro',8),(23,'Caldera',9),(24,'Copiapó',9),(25,'Tierra Amarilla',9),(26,'Alto del Carmen',10),(27,'Freirina',10),(28,'Huasco',10),(29,'Vallenar',10),(30,'Canela',11),(31,'Illapel',11),(32,'Los Vilos',11),(33,'Salamanca',11),(34,'Andacollo',12),(35,'Coquimbo',12),(36,'La Higuera',12),(37,'La Serena',12),(38,'Paihuaco',12),(39,'Vicuña',12),(40,'Combarbalá',13),(41,'Monte Patria',13),(42,'Ovalle',13),(43,'Punitaqui',13),(44,'Río Hurtado',13),(45,'Isla de Pascua',14),(46,'Calle Larga',15),(47,'Los Andes',15),(48,'Rinconada',15),(49,'San Esteban',15),(50,'La Ligua',16),(51,'Papudo',16),(52,'Petorca',16),(53,'Zapallar',16),(54,'Hijuelas',17),(55,'La Calera',17),(56,'La Cruz',17),(57,'Limache',17),(58,'Nogales',17),(59,'Olmué',17),(60,'Quillota',17),(61,'Algarrobo',18),(62,'Cartagena',18),(63,'El Quisco',18),(64,'El Tabo',18),(65,'San Antonio',18),(66,'Santo Domingo',18),(67,'Catemu',19),(68,'Llaillay',19),(69,'Panquehue',19),(70,'Putaendo',19),(71,'San Felipe',19),(72,'Santa María',19),(73,'Casablanca',20),(74,'Concón',20),(75,'Juan Fernández',20),(76,'Puchuncaví',20),(77,'Quilpué',20),(78,'Quintero',20),(79,'Valparaíso',20),(80,'Villa Alemana',20),(81,'Viña del Mar',20),(82,'Colina',21),(83,'Lampa',21),(84,'Tiltil',21),(85,'Pirque',22),(86,'Puente Alto',22),(87,'San José de Maipo',22),(88,'Buin',23),(89,'Calera de Tango',23),(90,'Paine',23),(91,'San Bernardo',23),(92,'Alhué',24),(93,'Curacaví',24),(94,'María Pinto',24),(95,'Melipilla',24),(96,'San Pedro',24),(97,'Cerrillos',25),(98,'Cerro Navia',25),(99,'Conchalí',25),(100,'El Bosque',25),(101,'Estación Central',25),(102,'Huechuraba',25),(103,'Independencia',25),(104,'La Cisterna',25),(105,'La Granja',25),(106,'La Florida',25),(107,'La Pintana',25),(108,'La Reina',25),(109,'Las Condes',25),(110,'Lo Barnechea',25),(111,'Lo Espejo',25),(112,'Lo Prado',25),(113,'Macul',25),(114,'Maipú',25),(115,'Ñuñoa',25),(116,'Pedro Aguirre Cerda',25),(117,'Peñalolén',25),(118,'Providencia',25),(119,'Pudahuel',25),(120,'Quilicura',25),(121,'Quinta Normal',25),(122,'Recoleta',25),(123,'Renca',25),(124,'San Miguel',25),(125,'San Joaquín',25),(126,'San Ramón',25),(127,'Santiago',25),(128,'Vitacura',25),(129,'El Monte',26),(130,'Isla de Maipo',26),(131,'Padre Hurtado',26),(132,'Peñaflor',26),(133,'Talagante',26),(134,'Codegua',27),(135,'Coínco',27),(136,'Coltauco',27),(137,'Doñihue',27),(138,'Graneros',27),(139,'Las Cabras',27),(140,'Machalí',27),(141,'Malloa',27),(142,'Mostazal',27),(143,'Olivar',27),(144,'Peumo',27),(145,'Pichidegua',27),(146,'Quinta de Tilcoco',27),(147,'Rancagua',27),(148,'Rengo',27),(149,'Requínoa',27),(150,'San Vicente de Tagua Tagua',27),(151,'La Estrella',28),(152,'Litueche',28),(153,'Marchihue',28),(154,'Navidad',28),(155,'Peredones',28),(156,'Pichilemu',28),(157,'Chépica',29),(158,'Chimbarongo',29),(159,'Lolol',29),(160,'Nancagua',29),(161,'Palmilla',29),(162,'Peralillo',29),(163,'Placilla',29),(164,'Pumanque',29),(165,'San Fernando',29),(166,'Santa Cruz',29),(167,'Cauquenes',30),(168,'Chanco',30),(169,'Pelluhue',30),(170,'Curicó',31),(171,'Hualañé',31),(172,'Licantén',31),(173,'Molina',31),(174,'Rauco',31),(175,'Romeral',31),(176,'Sagrada Familia',31),(177,'Teno',31),(178,'Vichuquén',31),(179,'Colbún',32),(180,'Linares',32),(181,'Longaví',32),(182,'Parral',32),(183,'Retiro',32),(184,'San Javier',32),(185,'Villa Alegre',32),(186,'Yerbas Buenas',32),(187,'Constitución',33),(188,'Curepto',33),(189,'Empedrado',33),(190,'Maule',33),(191,'Pelarco',33),(192,'Pencahue',33),(193,'Río Claro',33),(194,'San Clemente',33),(195,'San Rafael',33),(196,'Talca',33),(197,'Arauco',34),(198,'Cañete',34),(199,'Contulmo',34),(200,'Curanilahue',34),(201,'Lebu',34),(202,'Los Álamos',34),(203,'Tirúa',34),(204,'Alto Biobío',35),(205,'Antuco',35),(206,'Cabrero',35),(207,'Laja',35),(208,'Los Ángeles',35),(209,'Mulchén',35),(210,'Nacimiento',35),(211,'Negrete',35),(212,'Quilaco',35),(213,'Quilleco',35),(214,'San Rosendo',35),(215,'Santa Bárbara',35),(216,'Tucapel',35),(217,'Yumbel',35),(218,'Chiguayante',36),(219,'Concepción',36),(220,'Coronel',36),(221,'Florida',36),(222,'Hualpén',36),(223,'Hualqui',36),(224,'Lota',36),(225,'Penco',36),(226,'San Pedro de La Paz',36),(227,'Santa Juana',36),(228,'Talcahuano',36),(229,'Tomé',36),(230,'Bulnes',37),(231,'Chillán',37),(232,'Chillán Viejo',37),(233,'Cobquecura',37),(234,'Coelemu',37),(235,'Coihueco',37),(236,'El Carmen',37),(237,'Ninhue',37),(238,'Ñiquen',37),(239,'Pemuco',37),(240,'Pinto',37),(241,'Portezuelo',37),(242,'Quillón',37),(243,'Quirihue',37),(244,'Ránquil',37),(245,'San Carlos',37),(246,'San Fabián',37),(247,'San Ignacio',37),(248,'San Nicolás',37),(249,'Treguaco',37),(250,'Yungay',37),(251,'Carahue',38),(252,'Cholchol',38),(253,'Cunco',38),(254,'Curarrehue',38),(255,'Freire',38),(256,'Galvarino',38),(257,'Gorbea',38),(258,'Lautaro',38),(259,'Loncoche',38),(260,'Melipeuco',38),(261,'Nueva Imperial',38),(262,'Padre Las Casas',38),(263,'Perquenco',38),(264,'Pitrufquén',38),(265,'Pucón',38),(266,'Saavedra',38),(267,'Temuco',38),(268,'Teodoro Schmidt',38),(269,'Toltén',38),(270,'Vilcún',38),(271,'Villarrica',38),(272,'Angol',39),(273,'Collipulli',39),(274,'Curacautín',39),(275,'Ercilla',39),(276,'Lonquimay',39),(277,'Los Sauces',39),(278,'Lumaco',39),(279,'Purén',39),(280,'Renaico',39),(281,'Traiguén',39),(282,'Victoria',39),(283,'Corral',40),(284,'Lanco',40),(285,'Los Lagos',40),(286,'Máfil',40),(287,'Mariquina',40),(288,'Paillaco',40),(289,'Panguipulli',40),(290,'Valdivia',40),(291,'Futrono',41),(292,'La Unión',41),(293,'Lago Ranco',41),(294,'Río Bueno',41),(295,'Ancud',42),(296,'Castro',42),(297,'Chonchi',42),(298,'Curaco de Vélez',42),(299,'Dalcahue',42),(300,'Puqueldón',42),(301,'Queilén',42),(302,'Quemchi',42),(303,'Quellón',42),(304,'Quinchao',42),(305,'Calbuco',43),(306,'Cochamó',43),(307,'Fresia',43),(308,'Frutillar',43),(309,'Llanquihue',43),(310,'Los Muermos',43),(311,'Maullín',43),(312,'Puerto Montt',43),(313,'Puerto Varas',43),(314,'Osorno',44),(315,'Puero Octay',44),(316,'Purranque',44),(317,'Puyehue',44),(318,'Río Negro',44),(319,'San Juan de la Costa',44),(320,'San Pablo',44),(321,'Chaitén',45),(322,'Futaleufú',45),(323,'Hualaihué',45),(324,'Palena',45),(325,'Aisén',46),(326,'Cisnes',46),(327,'Guaitecas',46),(328,'Cochrane',47),(329,'O\'higgins',47),(330,'Tortel',47),(331,'Coihaique',48),(332,'Lago Verde',48),(333,'Chile Chico',49),(334,'Río Ibáñez',49),(335,'Antártica',50),(336,'Cabo de Hornos',50),(337,'Laguna Blanca',51),(338,'Punta Arenas',51),(339,'Río Verde',51),(340,'San Gregorio',51),(341,'Porvenir',52),(342,'Primavera',52),(343,'Timaukel',52),(344,'Natales',53),(345,'Torres del Paine',53);
/*!40000 ALTER TABLE `comunas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conotificaciones`
--

DROP TABLE IF EXISTS `conotificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conotificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL COMMENT 'Titulo descriptivo de la notificación',
  `estado` int(10) DEFAULT 0 COMMENT '0 = Activo\n1 = Inactivo',
  `asunto` varchar(120) DEFAULT NULL COMMENT 'Asunto para el correo que se enviará',
  `de` varchar(45) DEFAULT NULL COMMENT 'Ej: noreply@datomed.com',
  `para` varchar(45) DEFAULT NULL COMMENT 'Destinatario del mensaje',
  `cuerpo` longtext DEFAULT NULL,
  `tipo_notificacion` int(10) NOT NULL DEFAULT 0 COMMENT '0 = Mail de bienvenida.\n1 = Mail solicitud de hora telemedicina\n2 = Mail solicitud de hora presencial\n3 = Mail solicitud de hora telemedicina aprobado\n4 = Mail solicitud de hora presencial aprobado\n5 = Mail solicitud de hora rechazado',
  PRIMARY KEY (`id`,`tipo_notificacion`),
  KEY `idx` (`estado`,`tipo_notificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conotificaciones`
--

LOCK TABLES `conotificaciones` WRITE;
/*!40000 ALTER TABLE `conotificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `conotificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `copublicacion`
--

DROP TABLE IF EXISTS `copublicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `copublicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(10) DEFAULT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `cuerpo` longtext DEFAULT NULL,
  `estado` varchar(45) DEFAULT '0' COMMENT '0 = Activo, 1 = Inactivo',
  `fecha` datetime DEFAULT current_timestamp(),
  `extracto` varchar(150) DEFAULT NULL,
  `imagen_url` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copublicacion`
--

LOCK TABLES `copublicacion` WRITE;
/*!40000 ALTER TABLE `copublicacion` DISABLE KEYS */;
INSERT INTO `copublicacion` VALUES (1,1,'Noticia Blog Demo','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis quis nisi et ullamcorper. Sed fermentum ligula a enim placerat elementum. Curabitur eu nisi molestie odio efficitur tincidunt vitae non nunc. Suspendisse nec magna felis. Aliquam erat volutpat. Duis nunc nisl, mollis eget tristique non, condimentum sit amet quam. Nunc sit amet eleifend magna. Fusce ligula arcu, mattis ut lorem at, fringilla lacinia metus. Curabitur eget eros lorem.</p>\r\n<p>&nbsp;</p>\r\n<p>Phasellus eleifend quam vel arcu varius, vel tristique nisl efficitur. Fusce venenatis, lorem id porta luctus, elit dolor sodales lorem, aliquet commodo libero dolor ac sapien. Donec efficitur nisi risus, fermentum semper felis consequat tempor. Vivamus ac lacinia purus. Etiam porta sem vel massa ultrices fringilla. Mauris risus magna, feugiat et turpis nec, elementum vestibulum odio. Aliquam ac facilisis massa. Sed suscipit justo sed metus elementum, fermentum congue justo porta. Maecenas suscipit justo eu facilisis feugiat. Phasellus nec odio et tortor accumsan pharetra sed at quam. Mauris rhoncus orci sem, eu auctor arcu porta ac. Proin egestas elit at lobortis suscipit.</p>\r\n<p>&nbsp;</p>\r\n<p>Praesent malesuada molestie dignissim. Nulla maximus laoreet consectetur. Vestibulum ac nisl vitae nisi sagittis dictum at id magna. Vivamus porta nisl et augue posuere, in congue lectus porttitor. Nulla eget enim tincidunt, congue turpis id, tempus elit. Sed euismod, eros at pellentesque porttitor, tellus est accumsan ante, ut porta massa nisi quis nisi. In interdum mattis libero, eget rutrum elit laoreet nec. Nullam congue, augue eget lobortis viverra, urna massa facilisis lectus, vel rhoncus sem ligula sit amet erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ut neque libero. Phasellus aliquet ut libero tincidunt luctus. Pellentesque egestas finibus nisl ac pulvinar. Maecenas faucibus, purus et dignissim eleifend, odio mauris mattis elit, a mollis leo eros ut est. Nam lobortis nibh eu enim maximus aliquam. Aliquam erat volutpat. Aliquam erat volutpat.</p>','0','2019-01-09 09:39:33','<p>Lorem ipsum dolor sit amet</p>','');
/*!40000 ALTER TABLE `copublicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(200) DEFAULT NULL,
  `rut` varchar(12) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `nombre_fantasia` varchar(210) DEFAULT NULL,
  `estado_pago` smallint(2) DEFAULT 0,
  `email_notificacion` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_empresas` (`rut`,`estado_pago`,`nombre_fantasia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'NETSTREAM','99581960-0','Monjitas 90',NULL,0,'info@netstream.cl');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'usuarios','Usuarios sin privilegios'),(3,'Front','Menu para el front');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `macategorias`
--

DROP TABLE IF EXISTS `macategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `macategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de la categoría, sirve para publicación de contenidos',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `macategorias`
--

LOCK TABLES `macategorias` WRITE;
/*!40000 ALTER TABLE `macategorias` DISABLE KEYS */;
INSERT INTO `macategorias` VALUES (1,'Blog');
/*!40000 ALTER TABLE `macategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maestros`
--

DROP TABLE IF EXISTS `maestros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maestros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `estado` smallint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maestros`
--

LOCK TABLES `maestros` WRITE;
/*!40000 ALTER TABLE `maestros` DISABLE KEYS */;
INSERT INTO `maestros` VALUES (1,'Todos',0);
/*!40000 ALTER TABLE `maestros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_menu` varchar(200) NOT NULL,
  `descripcion` varchar(140) DEFAULT NULL,
  `controlador` varchar(200) NOT NULL,
  `orden` int(1) DEFAULT NULL,
  `front` int(1) DEFAULT 1 COMMENT '0 = Se muestra en sistema interior de navegacion\n1 = Se muestra en front',
  PRIMARY KEY (`id`),
  KEY `nombre_menu` (`nombre_menu`),
  KEY `controlador` (`controlador`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='items de menu asociados a un controlador';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Menu','Mantenedor Menu','admin/menu/index',2,0),(2,'Usuarios','Menú para usuarios','admin/usuarios/index',1,0),(3,'Mensajería','notificaciones del sistema','admin/mensajeria/index',4,0),(4,'Categorías','categorías del sistema','admin/categorias/index',3,0),(9,'Grupos','Sin descripción','admin/grupos/index',5,0),(10,'Blog','Blog sistema','admin/blog/index',6,0),(11,'Empresas','Sin descripción','/admin/empresas/index',7,0),(12,'Maestros','Maestro para notificaciones','admin/maestros/index',7,0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(10) NOT NULL DEFAULT 0,
  `menu_id` int(10) NOT NULL DEFAULT 0,
  `permiso_id` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`grupo_id`,`menu_id`,`permiso_id`),
  KEY `grupo_id` (`grupo_id`),
  KEY `menu_id` (`menu_id`),
  KEY `permiso_id` (`permiso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='asociaciÃ³n permisos por grupos de usuarios asociados a un item de menu';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,1,1,1),(2,1,2,1),(3,1,3,1),(4,1,4,1),(5,1,9,1),(6,3,5,1),(7,3,6,1),(8,3,7,1),(9,3,8,1),(10,1,10,1),(11,1,11,1),(12,1,12,1);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos_dic`
--

DROP TABLE IF EXISTS `permisos_dic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos_dic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_permiso` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nombre_permiso` (`nombre_permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='diccionario de permisos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos_dic`
--

LOCK TABLES `permisos_dic` WRITE;
/*!40000 ALTER TABLE `permisos_dic` DISABLE KEYS */;
/*!40000 ALTER TABLE `permisos_dic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincias` (
  `provincia_id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia_nombre` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`provincia_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincias`
--

LOCK TABLES `provincias` WRITE;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` VALUES (1,'Arica',1),(2,'Parinacota',1),(3,'Iquique',2),(4,'El Tamarugal',2),(5,'Antofagasta',3),(6,'El Loa',3),(7,'Tocopilla',3),(8,'Chañaral',4),(9,'Copiapó',4),(10,'Huasco',4),(11,'Choapa',5),(12,'Elqui',5),(13,'Limarí',5),(14,'Isla de Pascua',6),(15,'Los Andes',6),(16,'Petorca',6),(17,'Quillota',6),(18,'San Antonio',6),(19,'San Felipe de Aconcagua',6),(20,'Valparaiso',6),(21,'Chacabuco',7),(22,'Cordillera',7),(23,'Maipo',7),(24,'Melipilla',7),(25,'Santiago',7),(26,'Talagante',7),(27,'Cachapoal',8),(28,'Cardenal Caro',8),(29,'Colchagua',8),(30,'Cauquenes',9),(31,'Curicó',9),(32,'Linares',9),(33,'Talca',9),(34,'Arauco',10),(35,'Bio Bío',10),(36,'Concepción',10),(37,'Ñuble',10),(38,'Cautín',11),(39,'Malleco',11),(40,'Valdivia',12),(41,'Ranco',12),(42,'Chiloé',13),(43,'Llanquihue',13),(44,'Osorno',13),(45,'Palena',13),(46,'Aisén',14),(47,'Capitán Prat',14),(48,'Coihaique',14),(49,'General Carrera',14),(50,'Antártica Chilena',15),(51,'Magallanes',15),(52,'Tierra del Fuego',15),(53,'Última Esperanza',15);
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regiones`
--

DROP TABLE IF EXISTS `regiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regiones` (
  `region_id` int(11) NOT NULL AUTO_INCREMENT,
  `region_nombre` varchar(64) NOT NULL,
  `region_ordinal` varchar(4) NOT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regiones`
--

LOCK TABLES `regiones` WRITE;
/*!40000 ALTER TABLE `regiones` DISABLE KEYS */;
INSERT INTO `regiones` VALUES (1,'Arica y Parinacota','XV'),(2,'Tarapacá','I'),(3,'Antofagasta','II'),(4,'Atacama','III'),(5,'Coquimbo','IV'),(6,'Valparaiso','V'),(7,'Metropolitana de Santiago','RM'),(8,'Libertador General Bernardo O\'Higgins','VI'),(9,'Maule','VII'),(10,'Biobío','VIII'),(11,'La Araucanía','IX'),(12,'Los Ríos','XIV'),(13,'Los Lagos','X'),(14,'Aisén del General Carlos Ibáñez del Campo','XI'),(15,'Magallanes y de la Antártica Chilena','XII');
/*!40000 ALTER TABLE `regiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo`
--

DROP TABLE IF EXISTS `seo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_description` varchar(200) NOT NULL DEFAULT '0',
  `titulo` varchar(200) NOT NULL DEFAULT '0',
  `meta_tags` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla para posicionamiento web';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo`
--

LOCK TABLES `seo` WRITE;
/*!40000 ALTER TABLE `seo` DISABLE KEYS */;
/*!40000 ALTER TABLE `seo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `rut` varchar(12) NOT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `comuna_id` int(10) DEFAULT NULL,
  `region_id` int(10) DEFAULT NULL,
  `provincia_id` int(10) DEFAULT NULL,
  `prevision_id` varchar(50) DEFAULT NULL,
  `imagen_url` varchar(100) DEFAULT NULL,
  `membresia` int(2) NOT NULL DEFAULT 0 COMMENT '0 = sin membresía\n1 = membresía premium',
  `rut_colegio_medico` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`membresia`,`rut`),
  KEY `rut_idx` (`rut`,`comuna_id`,`region_id`,`first_name`,`last_name`,`provincia_id`,`rut_colegio_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,'/CYyNC8PcP4mJme0iTPcbu',1268889823,1610728318,1,'Admin','istrator','ADMIN','0','',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(8,'::1','','$2y$08$OYTQkNL3jO0Kkm3hT9xn9u5YESgwo0W7meaWIKddxMO3Ft2lnxRLm',NULL,'ralf@netstream.cl',NULL,'eHZrdcYgTLcMiFGxV1ycbu239f66f55d300a8368',1517083546,'jHuEYS7GSYJBNNor4BjHQO',1517070481,1542635430,1,'Rodrigo','Alfaro',NULL,NULL,'15021038-0','Santa Isabel 502',NULL,NULL,NULL,NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (1,1,1),(11,1,2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-15 14:44:57
