# MySQL-Front 5.1  (Build 4.13)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;


# Host: localhost    Database: soft-mercado
# ------------------------------------------------------
# Server version 5.6.17

#
# Source for table pedidos
#

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) DEFAULT NULL,
  `produto` varchar(150) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `imposto` char(3) DEFAULT NULL,
  `qtd` char(6) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `subtotal_impostos` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idpedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de Pedidos';

#
# Dumping data for table pedidos
#

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

#
# Source for table produtos
#

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `idproduto` int(11) NOT NULL AUTO_INCREMENT,
  `idcat` int(11) DEFAULT NULL,
  `produto` varchar(150) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `imposto` char(3) DEFAULT NULL,
  PRIMARY KEY (`idproduto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de Produtos';

#
# Dumping data for table produtos
#

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

#
# Source for table produtos_cats
#

DROP TABLE IF EXISTS `produtos_cats`;
CREATE TABLE `produtos_cats` (
  `idcat` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idcat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de Categorias';

#
# Dumping data for table produtos_cats
#

LOCK TABLES `produtos_cats` WRITE;
/*!40000 ALTER TABLE `produtos_cats` DISABLE KEYS */;
/*!40000 ALTER TABLE `produtos_cats` ENABLE KEYS */;
UNLOCK TABLES;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
