-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        5.5.8 - MySQL Community Server (GPL)
-- 서버 OS:                        Win32
-- HeidiSQL 버전:                  12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- dataset 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `dataset` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dataset`;

-- 테이블 dataset.peak_lh 구조 내보내기
CREATE TABLE IF NOT EXISTS `peak_lh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `peak1` varchar(50) DEFAULT NULL,
  `peak2` varchar(50) DEFAULT NULL,
  `peak3` varchar(50) DEFAULT NULL,
  `min1` varchar(50) DEFAULT NULL,
  `min2` varchar(50) DEFAULT NULL,
  `min3` varchar(50) DEFAULT NULL,
  `max1` varchar(50) DEFAULT NULL,
  `max2` varchar(50) DEFAULT NULL,
  `max3` varchar(50) DEFAULT NULL,
  `data9` varchar(50) DEFAULT NULL,
  `data10` varchar(50) DEFAULT NULL,
  `data11` varchar(50) DEFAULT NULL,
  `data12` varchar(50) DEFAULT NULL,
  `data13` varchar(50) DEFAULT NULL,
  `data14` varchar(50) DEFAULT NULL,
  `data15` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 테이블 데이터 dataset.peak_lh:~0 rows (대략적) 내보내기

-- 테이블 dataset.peak_rh 구조 내보내기
CREATE TABLE IF NOT EXISTS `peak_rh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `peak1` varchar(50) DEFAULT NULL,
  `peak2` varchar(50) DEFAULT NULL,
  `peak3` varchar(50) DEFAULT NULL,
  `min1` varchar(50) DEFAULT NULL,
  `min2` varchar(50) DEFAULT NULL,
  `min3` varchar(50) DEFAULT NULL,
  `max1` varchar(50) DEFAULT NULL,
  `max2` varchar(50) DEFAULT NULL,
  `max3` varchar(50) DEFAULT NULL,
  `data9` varchar(50) DEFAULT NULL,
  `data10` varchar(50) DEFAULT NULL,
  `data11` varchar(50) DEFAULT NULL,
  `data12` varchar(50) DEFAULT NULL,
  `data13` varchar(50) DEFAULT NULL,
  `data14` varchar(50) DEFAULT NULL,
  `data15` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 테이블 데이터 dataset.peak_rh:~0 rows (대략적) 내보내기

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
