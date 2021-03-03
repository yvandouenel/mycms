-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: mycms
-- ------------------------------------------------------
-- Server version	5.7.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `node`
--

DROP TABLE IF EXISTS `node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node` (
  `nid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(32) CHARACTER SET ascii NOT NULL DEFAULT 'article' COMMENT 'The type of the node.',
  `title` varchar(255) NOT NULL,
  `summary` longtext,
  `seo_title` varchar(255) DEFAULT NULL,
  `body` longtext,
  `image` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nid`),
  UNIQUE KEY `path` (`path`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COMMENT='The base table for node.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node`
--

LOCK TABLES `node` WRITE;
/*!40000 ALTER TABLE `node` DISABLE KEYS */;
INSERT INTO `node` VALUES (1,'article','Page d\'accueil',NULL,'Titre pour la page d\'accueil optimisé pour le référencement','<p>Ceci est le corps de la page d\'accueil</p>','diagrammeFluxFormulaireAuthentification.png','/'),(16,'article','Kelly Slater','Résumé','Simply the best !','<h3 class=\"mw-headline\" id=\"Enfance\">Enfance</h3>\r\n<p>Robert Kelly Slater est né à Cocoa Beach, en Floride. Il a deux frères.</p>','kelly-slater-in-france_s.jpg','kelly-slater'),(27,'article','Surf Pop-up','Le Pop Up est un mouvement qui est soit ignoré par ceux qui l\'exécutent parfaitement, soit il devient une barrière infranchissable pour la pratique du surf..','Surf Pop-up tout savoir pour bien débuter','<p>Tout d\'abord, sachez qu\'il n\'y a pas de manière «correcte» d\'exécuter un pop-up mais plusieurs manières. Elles sont différentes mais ont en commun d\'être fluides et aboutissent finalement à une position de surf droite et décontractée.</p>\r\n<p style=\"clear:both\"><iframe style=\"float:left; margin-right: 20px; max-width: 45%;\" width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/XYZ46bGfZ08\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe></p>\r\n<p>Certains plantent le pied arrière en premier, tandis que d\'autres plantent les pieds simultanément. Vous remarquerez que certains ont encore les mains sur la planche lorsque leur pied avant se plante, tandis que d’autres ont déjà commencé à redresser le torse et les bras pendant que le pied avant entre en contact avec la planche.</p>\r\n\r\n<p>Il y aura également des besoins individuels pour la technique en fonction d\'aspects tels que votre taille, la longueur de votre fémur, la taille de la planche et les blessures articulaires antérieures, les chirurgies et la mobilité.</p>\r\n\r\n<p>Ce que vous pouvez et devez retenir de cette vidéo, c\'est que le mouvement est fluide. Ce n’est pas tant un «POP» qu’un \"casual\"</p>\r\n\r\n<p>Le pop-up en résumé : \"Mettons mes jambes sous moi de manière fluide pour que je puisse me lever et commencer à manœuvrer la planche pour interagir avec la face de la vague\".</p>','popup.jpg','surf-pop-up'),(28,'article','La portance','Un corps placé dans un écoulement d\'air (ou d\'eau) subit une force aérodynamique (ou hydrodynamique). ','schéma de la portance','Un corps placé dans un écoulement d\'air (ou d\'eau) subit une force aérodynamique (ou hydrodynamique). Pour l\'analyse, on décompose cette force en une composante parallèle au vent relatif : la traînée (voir aussi Aérodynamique), et une composante perpendiculaire au vent relatif : la portance.\r\n\r\nPour une voile, la portance est dirigée de l\'intrados (la face « au vent », concave), vers l\'extrados (la face « sous le vent », convexe).\r\nPour une aile d\'avion, la portance est dirigée de l\'intrados (la face inférieure), vers l\'extrados (la face supérieure). En aérodynamique, la portance s\'exerce à angle droit de la vitesse ; elle n\'est donc verticale que lorsque le corps en mouvement est en translation horizontale (en vol de croisière pour un avion). Les surfaces verticales sont conçues pour développer des portances latérales.\r\nPour un planeur ou un avion en descente moteur coupé, la portance est alors légèrement orientée vers l\'avant ; sa composante parallèle à la vitesse est une poussée égale et opposée à la traînée. L\'aile du planeur est alors propulsive1.','portance.PNG','portance'),(34,'article','Les fonctions','Une fonction désigne en programmation un « sous-programme » permettant d\'effectuer des opérations répétitives.','réf','Une fonction désigne en programmation un « sous-programme » permettant d\'effectuer des opérations répétitives. Au lieu d\'écrire le code complet autant de fois que nécessaire, on crée une fonction que l’on appellera pour l\'exécuter, ce qui peut aussi alléger le code, le rendre plus lisible.','function.png','formation');
/*!40000 ALTER TABLE `node` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-03  8:33:12
