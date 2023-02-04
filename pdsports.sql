-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-26 18:36:40
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `pdsports`
--

DELIMITER $$
--
-- 程序
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `gooding_bkb` (IN `id` INT(20), IN `name` VARCHAR(20) CHARSET utf8, IN `phoneNum` VARCHAR(11) CHARSET utf8, IN `sport` VARCHAR(20) CHARSET utf8, IN `chNum` INT(3), IN `chTime1` VARCHAR(20) CHARSET utf8, IN `chTime2` VARCHAR(20) CHARSET utf8, IN `classid` VARCHAR(20))  BEGIN

INSERT INTO `phonenum_gooding`(`id`,`class_id`, `name`, `phoneNum`, `sport`, `chNum`, `chDate`, `chTIme`) 
SELECT id,classid,name,phoneNum,sport,chNum,chTime1,chTime2;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `gooding_bmt` (IN `id` INT(20), IN `name` VARCHAR(20) CHARSET utf8, IN `phoneNum` VARCHAR(11) CHARSET utf8, IN `sport` VARCHAR(20) CHARSET utf8, IN `chNum` INT(3), IN `chTime1` VARCHAR(20) CHARSET utf8, IN `chTime2` VARCHAR(20) CHARSET utf8, IN `classid` VARCHAR(20))  BEGIN

INSERT INTO `phonenum_gooding`(`id`, `class_id`,`name`, `phoneNum`, `sport`, `chNum`, `chDate`, `chTIme`) 
SELECT id, classid,name,phoneNum,sport,chNum,chTime1,chTime2;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `gooding_other` (IN `id` INT(20), IN `name` VARCHAR(20) CHARSET utf8, IN `phoneNum` VARCHAR(11) CHARSET utf8, IN `sport` VARCHAR(20) CHARSET utf8, IN `chNum` INT(3), IN `chTime1` VARCHAR(20) CHARSET utf8, IN `chTime2` VARCHAR(20) CHARSET utf8, IN `classid` VARCHAR(20))  BEGIN

INSERT INTO `phonenum_gooding`(`id`, `class_id`,`name`, `phoneNum`, `sport`, `chNum`, `chDate`, `chTIme`) 
SELECT id, classid,name,phoneNum,sport,chNum,chTime1,chTime2 ;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `refresh` ()  BEGIN

UPDATE `site_status` SET `status_used`=15 WHERE sport_id = 1;
UPDATE `site_status` SET `status_used`=20 WHERE sport_id = 2;
UPDATE `site_status` SET `status_used`=6 WHERE sport_id = 3;
UPDATE `site_status` SET `status_used`=40 WHERE sport_id = 4;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `refresh_today` (IN `cdate` DATE, IN `ctime` TIME)  BEGIN

DECLARE gym int;
DECLARE swim int;
DECLARE bmt int;
DECLARE bkb int;
DECLARE x int;

UPDATE `site_status` SET `status_used`=15 WHERE sport_id = 1;
UPDATE `site_status` SET `status_used`=20 WHERE sport_id = 2;
UPDATE `site_status` SET `status_used`=6 WHERE sport_id = 3;
UPDATE `site_status` SET `status_used`=40 WHERE sport_id = 4;

set x = (SELECT SUM(chNum) FROM `phonenum_gooding` WHERE phonenum_gooding.chDate = cdate AND (phonenum_gooding.chTIme >= ctime AND phonenum_gooding.chTIme <= (ctime + INTERVAL 1 HOUR)) AND phonenum_gooding.sport = 'Badminton');
SET bmt  = (SELECT site_status.status_used FROM site_status WHERE site_status.sport_id =1)
- IF( x IS null, 0, x);
UPDATE site_status SET site_status.status_used = bmt
WHERE site_status.sport_id = 1;


SET x = (SELECT SUM(chNum) FROM `phonenum_gooding` WHERE phonenum_gooding.chDate = cdate AND (phonenum_gooding.chTIme >= ctime AND phonenum_gooding.chTIme <= (ctime + INTERVAL 1 HOUR)) AND phonenum_gooding.sport = 'Gym');
SET gym  = (SELECT site_status.status_used FROM site_status WHERE site_status.sport_id =2) - IF( x IS null, 0, x);
UPDATE site_status SET site_status.status_used = gym
WHERE site_status.sport_id = 2;


set x =(SELECT SUM(chNum) FROM `phonenum_gooding` WHERE phonenum_gooding.chDate = cdate AND (phonenum_gooding.chTIme >= ctime AND phonenum_gooding.chTIme <= (ctime + INTERVAL 1 HOUR)) AND phonenum_gooding.sport = 'Basketball');
SET bkb  = (SELECT site_status.status_used FROM site_status WHERE site_status.sport_id =3) - IF( x IS null, 0, x);
UPDATE site_status SET site_status.status_used = bkb
WHERE site_status.sport_id = 3;



SET x = (SELECT SUM(chNum) FROM `phonenum_gooding` WHERE phonenum_gooding.chDate = cdate AND (phonenum_gooding.chTIme >= ctime AND phonenum_gooding.chTIme <= (ctime + INTERVAL 1 HOUR)) AND phonenum_gooding.sport = 'Swim');
SET swim  = (SELECT site_status.status_used FROM site_status WHERE site_status.sport_id =4) - IF( x IS null, 0, x);
UPDATE site_status SET site_status.status_used = swim
WHERE site_status.sport_id =4;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `phonenum_gooding`
--

CREATE TABLE `phonenum_gooding` (
  `id` int(11) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phoneNum` varchar(15) NOT NULL,
  `sport` varchar(20) NOT NULL,
  `chNum` int(2) NOT NULL,
  `chDate` date NOT NULL,
  `chTIme` time NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `phonenum_gooding`
--

INSERT INTO `phonenum_gooding` (`id`, `class_id`, `name`, `phoneNum`, `sport`, `chNum`, `chDate`, `chTIme`, `timestamp`) VALUES
(1672050088, '', 'dav', '0968759863', 'Badminton', 2, '2022-12-26', '19:00:00', '2022-12-26 09:55:39'),
(1672050911, '', 'kevin', '0968759863', 'Gym', 2, '2022-12-26', '19:00:00', '2022-12-26 10:25:21'),
(1672051519, '', 'kevin', '0123456789', 'Basketball', 3, '2022-12-26', '20:30:00', '2022-12-26 10:30:46'),
(1672059062, '', 'kevin', '0123456789', 'Swim', 4, '2022-12-26', '21:35:00', '2022-12-26 12:35:22'),
(1672059797, '', 'kevin', '01234596789', 'Gym', 1, '2022-12-26', '22:01:00', '2022-12-26 13:01:12'),
(1672060969, '', 'David', '0968759863', 'Badminton', 1, '2022-12-26', '22:06:00', '2022-12-26 13:06:11'),
(1672061076, '', 'henry', '0123456789', 'Gym', 1, '2022-12-26', '22:30:00', '2022-12-26 13:06:53'),
(1672073882, '', 'Yang', '0123456987', 'Badminton', 2, '2022-12-28', '00:31:00', '2022-12-26 16:32:06'),
(1672076317, '4A9G0908', 'David', '0968456789', 'Badminton', 1, '2022-12-27', '10:35:00', '2022-12-26 17:35:59');

-- --------------------------------------------------------

--
-- 資料表結構 `site_price`
--

CREATE TABLE `site_price` (
  `id` int(20) NOT NULL,
  `price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `site_price`
--

INSERT INTO `site_price` (`id`, `price`) VALUES
(1, 150),
(2, 80),
(3, 600),
(4, 100);

-- --------------------------------------------------------

--
-- 資料表結構 `site_status`
--

CREATE TABLE `site_status` (
  `sport_id` int(20) NOT NULL,
  `status_used` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `site_status`
--

INSERT INTO `site_status` (`sport_id`, `status_used`) VALUES
(1, 13),
(2, 20),
(3, 6),
(4, 40);

-- --------------------------------------------------------

--
-- 資料表結構 `sports`
--

CREATE TABLE `sports` (
  `sport_id` int(11) NOT NULL,
  `sport_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `sports`
--

INSERT INTO `sports` (`sport_id`, `sport_name`) VALUES
(1, 'badminton'),
(2, 'gym'),
(3, 'basketball'),
(4, 'swim');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `phonenum_gooding`
--
ALTER TABLE `phonenum_gooding`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `site_price`
--
ALTER TABLE `site_price`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `site_status`
--
ALTER TABLE `site_status`
  ADD PRIMARY KEY (`sport_id`);

--
-- 資料表索引 `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`sport_id`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `site_price`
--
ALTER TABLE `site_price`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `site_status`
--
ALTER TABLE `site_status`
  MODIFY `sport_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `sports`
--
ALTER TABLE `sports`
  MODIFY `sport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
