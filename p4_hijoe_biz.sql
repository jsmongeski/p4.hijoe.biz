-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 24, 2013 at 11:39 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `p4_hijoe_biz`
--
#CREATE DATABASE IF NOT EXISTS `p4_hijoe_biz` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hijoebiz_p4`;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE IF NOT EXISTS `portfolios` (
  `portfolio_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `last_update` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `portfolio_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`portfolio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`portfolio_id`, `created`, `modified`, `last_update`, `timezone`, `portfolio_name`, `email`) VALUES
(154, 1387915422, 1387915422, 0, '', 'yourstocks', ''),
(155, 1387915779, 1387915779, 0, '', 'mystocks', '');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `purchase_price` float NOT NULL,
  `nshares` int(11) NOT NULL,
  `broker_url` varchar(255) NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `portfolio_id` (`portfolio_id`),
  KEY `portfolio_id_2` (`portfolio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `created`, `modified`, `portfolio_id`, `symbol`, `purchase_price`, `nshares`, `broker_url`) VALUES
(107, 1387915446, 1387915446, 154, 'AAA', 3, 3, ''),
(108, 1387915446, 1387915446, 154, 'DDD', 2, 2, ''),
(111, 1387915828, 1387915828, 155, 'MMM', 3, 2, ''),
(112, 1387915828, 1387915828, 155, 'AA', 1, 1, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`portfolio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
