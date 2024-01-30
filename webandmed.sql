/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `andmebaas` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `andmebaas`;

CREATE TABLE IF NOT EXISTS `player_imports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `license` varchar(50) DEFAULT NULL,
  `citizenid` varchar(50) DEFAULT NULL,
  `vehicle` varchar(50) DEFAULT NULL,
  `hash` varchar(50) DEFAULT NULL,
  `mods` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `plate` varchar(50) NOT NULL,
  `fakeplate` varchar(50) DEFAULT NULL,
  `garage` longtext,
  `damage` varchar(1500) DEFAULT NULL,
  `parkingspot` varchar(200) DEFAULT NULL,
  `fuel` bigint(20) DEFAULT NULL,
  `engine` float DEFAULT '1000',
  `body` float DEFAULT '1000',
  `state` int(50) NOT NULL DEFAULT '1',
  `depotprice` int(11) NOT NULL DEFAULT '0',
  `drivingdistance` int(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `balance` int(11) NOT NULL DEFAULT '0',
  `paymentamount` int(11) NOT NULL DEFAULT '0',
  `paymentsleft` int(11) NOT NULL DEFAULT '0',
  `financetime` int(11) NOT NULL DEFAULT '0',
  `vinnumber` varchar(50) DEFAULT NULL,
  `vinscratch` int(2) DEFAULT '0',
  `nosColour` text,
  `traveldistance` int(50) DEFAULT '0',
  `noslevel` int(10) DEFAULT '0',
  `hasnitro` tinyint(4) DEFAULT '0',
  `harness` int(11) DEFAULT NULL,
  `glovebox` longtext,
  `trunk` longtext,
  `name` varchar(40) DEFAULT 'Unknown',
  `wheelfit` longtext,
  `carseller` int(11) DEFAULT '0',
  `impounded` tinyint(1) DEFAULT '0',
  `mdw_image` varchar(200) DEFAULT '',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `plate` (`plate`) USING BTREE,
  KEY `citizenid` (`citizenid`) USING BTREE,
  KEY `license` (`license`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT '0',
  `steamhex` varchar(1250) DEFAULT '0',
  `wlstatus` int(11) DEFAULT '0',
  `punktid` int(11) DEFAULT '100',
  `tunnid` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `web_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `desc` longtext,
  `type` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
