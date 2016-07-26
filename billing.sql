-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: Jul 26, 2016 as 02:40 PM
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `billing`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_title` varchar(128) NOT NULL,
  `account_password` varchar(128) NOT NULL,
  `account_email` varchar(64) NOT NULL,
  `account_must_change_pass` tinyint(1) NOT NULL,
  `account_last_access_date` datetime DEFAULT NULL,
  `account_last_access_ip` varchar(24) DEFAULT NULL,
  `account_blocked_date` datetime DEFAULT NULL,
  `account_created_date` datetime NOT NULL,
  `account_updated_date` datetime NOT NULL,
  `account_is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `client_user_email` (`account_email`) COMMENT 'Unique emails per client_id'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Extraindo dados da tabela `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_title`, `account_password`, `account_email`, `account_must_change_pass`, `account_last_access_date`, `account_last_access_ip`, `account_blocked_date`, `account_created_date`, `account_updated_date`, `account_is_admin`) VALUES
(52, 'Admin User', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'admin@admin.com', 0, '2016-07-26 14:20:32', '127.0.0.1', NULL, '2016-06-11 20:00:00', '2016-07-26 12:36:08', 1),
(53, 'Cliente exemplo', '*64990F15E43CFCE422734218A61BA0AEAF3B66F5', 'contato@cliente_exemplo.com.br', 0, '2016-06-12 09:42:00', '127.0.0.1', '2016-06-12 18:08:33', '2016-06-12 08:49:24', '2016-06-12 18:08:33', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cron_logs`
--

CREATE TABLE IF NOT EXISTS `cron_logs` (
  `cron_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `cron_log_datetime` datetime NOT NULL,
  `cron_log_status` varchar(32) NOT NULL,
  `cron_log_error` varchar(128) NOT NULL,
  PRIMARY KEY (`cron_log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `cron_logs`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_path` varchar(128) NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `file_zone` varchar(64) NOT NULL,
  `file_zone_fk_id` int(11) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_description` text,
  `file_index_date` date DEFAULT NULL,
  `file_index_time` time DEFAULT NULL,
  `file_index_order` float DEFAULT NULL,
  `file_upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `files`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_account_id` int(11) NOT NULL,
  `invoice_amount` float NOT NULL,
  `invoice_description` varchar(255) NOT NULL,
  `invoice_created_date` date NOT NULL,
  `invoice_due_date` date NOT NULL,
  `invoice_paid_date` date DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `invoice_account_id` (`invoice_account_id`,`invoice_due_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `invoice_account_id`, `invoice_amount`, `invoice_description`, `invoice_created_date`, `invoice_due_date`, `invoice_paid_date`) VALUES
(1, 53, 150, 'Fatura 00001', '0000-00-00', '2016-06-12', NULL),
(2, 53, 122, 'nao', '0000-00-00', '2016-06-14', NULL),
(3, 53, 122, 'nao', '0000-00-00', '2016-06-14', NULL),
(4, 53, 122, 'nao', '2016-06-12', '2016-06-14', NULL),
(5, 53, 122.23, 'nao', '2016-06-12', '2016-06-14', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice_notifications`
--

CREATE TABLE IF NOT EXISTS `invoice_notifications` (
  `invoice_notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_notification_invoice_id` int(11) NOT NULL,
  `invoice_notification_type` varchar(16) NOT NULL,
  `invoice_notification_read` datetime DEFAULT NULL,
  `invoice_notification_read_ip` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`invoice_notification_id`),
  KEY `invoice_notification_invoice_id` (`invoice_notification_invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `invoice_notifications`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice_status_updates`
--

CREATE TABLE IF NOT EXISTS `invoice_status_updates` (
  `invoice_status_update_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_status_update_invoice_id` int(11) NOT NULL,
  `invoice_status_update_datetime` datetime NOT NULL,
  `invoice_status_update_gateway` varchar(32) NOT NULL,
  `invoice_status_update_transaction` varchar(128) NOT NULL,
  `invoice_status_update_status_code` varchar(64) NOT NULL,
  PRIMARY KEY (`invoice_status_update_id`),
  KEY `invoice_status_update_invoice_id` (`invoice_status_update_invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `invoice_status_updates`
--

INSERT INTO `invoice_status_updates` (`invoice_status_update_id`, `invoice_status_update_invoice_id`, `invoice_status_update_datetime`, `invoice_status_update_gateway`, `invoice_status_update_transaction`, `invoice_status_update_status_code`) VALUES
(1, 5, '2016-06-12 18:54:10', '1', 'D8022D5F-1B64-4CE5-B1AD-BFBDEF14FBFF', '1'),
(2, 5, '2016-06-12 19:05:24', '1', 'D8022D5F-1B64-4CE5-B1AD-BFBDEF14FBFF', '2'),
(3, 5, '2016-06-12 19:47:10', '1', 'D8022D5F-1B64-4CE5-B1AD-BFBDEF14FBFF', '1'),
(4, 5, '2016-06-12 19:47:22', '1', 'D8022D5F-1B64-4CE5-B1AD-BFBDEF14FBFF', '1'),
(5, 5, '2016-06-12 19:53:28', '1', 'D8022D5F-1B64-4CE5-B1AD-BFBDEF14FBFF', '1'),
(6, 5, '2016-06-12 19:54:16', '1', 'A2D00952-7444-481A-A26A-8EDC6D45A3FC', '1'),
(7, 5, '2016-06-12 20:06:05', '1', 'A2D00952-7444-481A-A26A-8EDC6D45A3FC', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recurrencies`
--

CREATE TABLE IF NOT EXISTS `recurrencies` (
  `recurrency_id` int(11) NOT NULL AUTO_INCREMENT,
  `recurrency_account_id` int(11) NOT NULL,
  `recurrency_amount` float NOT NULL,
  `recurrency_when_day` smallint(6) NOT NULL,
  `recurrency_when_month` smallint(6) DEFAULT NULL,
  `recurrency_description` varchar(255) NOT NULL,
  `recurrency_limit` int(11) NOT NULL,
  `recurrency_start` tinyint(1) NOT NULL,
  PRIMARY KEY (`recurrency_id`),
  KEY `recurrency_account_id` (`recurrency_account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `recurrencies`
--

INSERT INTO `recurrencies` (`recurrency_id`, `recurrency_account_id`, `recurrency_amount`, `recurrency_when_day`, `recurrency_when_month`, `recurrency_description`, `recurrency_limit`, `recurrency_start`) VALUES
(1, 52, 19.99, 10, NULL, 'Recorrência Mensal', 0, 0),
(2, 52, 199.99, 15, 4, 'Recorrência Anual', 0, 0),
(3, 53, 110, 25, NULL, 'Satia', 0, 0),
(4, 53, 124, 17, NULL, 'Geral', 0, 1);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`invoice_account_id`) REFERENCES `accounts` (`account_id`);

--
-- Restrições para a tabela `invoice_notifications`
--
ALTER TABLE `invoice_notifications`
  ADD CONSTRAINT `invoice_notifications_ibfk_1` FOREIGN KEY (`invoice_notification_invoice_id`) REFERENCES `invoices` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `invoice_status_updates`
--
ALTER TABLE `invoice_status_updates`
  ADD CONSTRAINT `invoice_status_updates_ibfk_1` FOREIGN KEY (`invoice_status_update_invoice_id`) REFERENCES `invoices` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `recurrencies`
--
ALTER TABLE `recurrencies`
  ADD CONSTRAINT `recurrencies_ibfk_1` FOREIGN KEY (`recurrency_account_id`) REFERENCES `accounts` (`account_id`);
