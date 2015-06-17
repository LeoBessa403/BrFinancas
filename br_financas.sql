﻿-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `br_financas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_dados`
--

CREATE TABLE IF NOT EXISTS `tb_dados` (
  `id_dados` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(10) unsigned NOT NULL,
  `tel1` varchar(15) DEFAULT NULL,
  `tel2` varchar(15) DEFAULT NULL,
  `tel3` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_dados`),
  KEY `tb_dados_FKIndex1` (`id_pessoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `tb_dados`
--

INSERT INTO `tb_dados` (`id_dados`, `id_pessoa`, `tel1`, `tel2`, `tel3`, `email`, `site`) VALUES
(1, 1, '', '', '', '', ''),
(2, 2, '', '', '', '', ''),
(3, 3, '', '', '', '', ''),
(4, 4, '', '', '', '', ''),
(5, 5, '', '', '', '', ''),
(6, 6, '', '', '', '', ''),
(7, 7, '', '', '', '', ''),
(8, 8, '', '(61) 9300-3405', '', '', ''),
(9, 9, '', '', '', '', ''),
(10, 10, '', '', '', '', ''),
(11, 11, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_entidade`
--

CREATE TABLE IF NOT EXISTS `tb_entidade` (
  `id_entidade` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `observacao` varchar(255) DEFAULT NULL,
  `cadastro` datetime DEFAULT NULL,
  `tipo_entidade` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_entidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `tb_entidade`
--

INSERT INTO `tb_entidade` (`id_entidade`, `observacao`, `cadastro`, `tipo_entidade`) VALUES
(1, 'Compra de Monovin A', '2014-12-30 10:56:42', 'C'),
(2, 'Conta dividido com o pai da michelly, descontando R$ 35,00 da internet', '2014-12-30 10:57:41', 'C'),
(3, '', '2014-12-30 10:58:40', 'C'),
(4, '', '2014-12-30 11:10:58', 'C'),
(5, '', '2014-12-30 11:18:00', 'C'),
(6, '', '2014-12-30 11:18:21', 'C'),
(7, '', '2014-12-30 13:06:23', 'R'),
(8, 'Vendas dos produtos do atacadão bessa', '2014-12-30 13:07:20', 'R'),
(9, '', '2014-12-30 14:10:08', 'R'),
(10, '', '2014-12-30 14:10:23', 'C'),
(11, '', '2014-12-31 14:58:29', 'C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_negociacao`
--

CREATE TABLE IF NOT EXISTS `tb_negociacao` (
  `id_negociacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_entidade` int(10) unsigned NOT NULL,
  `cadastro` datetime DEFAULT NULL,
  `tipo_negociacao` varchar(2) DEFAULT NULL,
  `observacao` text,
  PRIMARY KEY (`id_negociacao`),
  KEY `tb_negociacao_FKIndex1` (`id_entidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `tb_negociacao`
--

INSERT INTO `tb_negociacao` (`id_negociacao`, `id_entidade`, `cadastro`, `tipo_negociacao`, `observacao`) VALUES
(1, 1, '2014-10-08 11:07:52', 'PG', 'Compra de Monovin A para atacadão bessa'),
(2, 3, '2014-12-30 11:08:14', 'PG', ''),
(3, 2, '2014-12-30 11:08:35', 'PG', ''),
(4, 4, '2014-12-30 11:11:43', 'PG', 'Conta de Telefone, TV por assinatura e Internet'),
(6, 8, '2014-12-30 13:15:17', 'RC', 'Compras dos produtos do atacadão bessa'),
(7, 8, '2014-12-30 13:15:40', 'RC', 'Compras dos produtos do atacadão bessa'),
(8, 8, '2014-12-30 13:18:56', 'RC', 'Compras dos produtos do atacadão bessa '),
(13, 8, '2014-12-30 13:52:31', 'RC', ''),
(14, 7, '2014-12-30 14:09:14', 'RC', ''),
(15, 9, '2014-12-29 14:11:22', 'RC', ''),
(16, 11, '2014-12-31 14:59:11', 'PG', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pagamento`
--

CREATE TABLE IF NOT EXISTS `tb_pagamento` (
  `id_pagamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_negociacao` int(10) unsigned NOT NULL,
  `tipo_pagamento` varchar(2) DEFAULT NULL,
  `valor_pago` decimal(10,2) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `situacao` varchar(1) DEFAULT NULL,
  `numero_parcelas` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`),
  KEY `tb_pagamento_FKIndex1` (`id_negociacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `tb_pagamento`
--

INSERT INTO `tb_pagamento` (`id_pagamento`, `id_negociacao`, `tipo_pagamento`, `valor_pago`, `valor_total`, `situacao`, `numero_parcelas`) VALUES
(1, 1, 'BT', 1060.44, 1060.44, 'F', 1),
(2, 2, 'BT', NULL, 410.73, 'A', 60),
(3, 3, 'DI', NULL, 100.00, 'A', 60),
(4, 4, 'DI', NULL, 230.00, 'A', 60),
(10, 13, 'DI', NULL, 3150.00, 'A', 10),
(11, 14, 'DI', NULL, 3000.00, 'A', 60),
(12, 15, 'DI', NULL, 215.00, 'A', 1),
(13, 16, 'DI', NULL, 54.00, 'A', 60);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_parcelamento`
--

CREATE TABLE IF NOT EXISTS `tb_parcelamento` (
  `id_parcelamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_pagamento` int(10) unsigned NOT NULL,
  `parcela` int(10) unsigned NOT NULL,
  `valor_parcela` decimal(10,2) DEFAULT NULL,
  `valor_parcela_pago` decimal(10,2) DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `vencimento_pago` date DEFAULT NULL,
  `observacao_parcela` text,
  PRIMARY KEY (`id_parcelamento`),
  KEY `tb_parcelamento_FKIndex1` (`id_pagamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=419 ;

--
-- Extraindo dados da tabela `tb_parcelamento`
--

INSERT INTO `tb_parcelamento` (`id_parcelamento`, `id_pagamento`, `parcela`, `valor_parcela`, `valor_parcela_pago`, `vencimento`, `vencimento_pago`, `observacao_parcela`) VALUES
(1, 1, 1, 1060.44, 1060.44, '2014-12-30', '2014-12-30', 'Compra de Monovin A para atacadão bessa'),
(2, 2, 1, 410.73, NULL, '2015-01-05', NULL, ''),
(3, 2, 2, 410.73, NULL, '2015-02-05', NULL, ''),
(4, 2, 3, 410.73, NULL, '2015-03-05', NULL, ''),
(5, 2, 4, 410.73, NULL, '2015-04-05', NULL, ''),
(6, 2, 5, 410.73, NULL, '2015-05-05', NULL, ''),
(7, 2, 6, 410.73, NULL, '2015-06-05', NULL, ''),
(8, 2, 7, 410.73, NULL, '2015-07-05', NULL, ''),
(9, 2, 8, 410.73, NULL, '2015-08-05', NULL, ''),
(10, 2, 9, 410.73, NULL, '2015-09-05', NULL, ''),
(11, 2, 10, 410.73, NULL, '2015-10-05', NULL, ''),
(12, 2, 11, 410.73, NULL, '2015-11-05', NULL, ''),
(13, 2, 12, 410.73, NULL, '2015-12-05', NULL, ''),
(14, 2, 13, 410.73, NULL, '2016-01-05', NULL, ''),
(15, 2, 14, 410.73, NULL, '2016-02-05', NULL, ''),
(16, 2, 15, 410.73, NULL, '2016-03-05', NULL, ''),
(17, 2, 16, 410.73, NULL, '2016-04-05', NULL, ''),
(18, 2, 17, 410.73, NULL, '2016-05-05', NULL, ''),
(19, 2, 18, 410.73, NULL, '2016-06-05', NULL, ''),
(20, 2, 19, 410.73, NULL, '2016-07-05', NULL, ''),
(21, 2, 20, 410.73, NULL, '2016-08-05', NULL, ''),
(22, 2, 21, 410.73, NULL, '2016-09-05', NULL, ''),
(23, 2, 22, 410.73, NULL, '2016-10-05', NULL, ''),
(24, 2, 23, 410.73, NULL, '2016-11-05', NULL, ''),
(25, 2, 24, 410.73, NULL, '2016-12-05', NULL, ''),
(26, 2, 25, 410.73, NULL, '2017-01-05', NULL, ''),
(27, 2, 26, 410.73, NULL, '2017-02-05', NULL, ''),
(28, 2, 27, 410.73, NULL, '2017-03-05', NULL, ''),
(29, 2, 28, 410.73, NULL, '2017-04-05', NULL, ''),
(30, 2, 29, 410.73, NULL, '2017-05-05', NULL, ''),
(31, 2, 30, 410.73, NULL, '2017-06-05', NULL, ''),
(32, 2, 31, 410.73, NULL, '2017-07-05', NULL, ''),
(33, 2, 32, 410.73, NULL, '2017-08-05', NULL, ''),
(34, 2, 33, 410.73, NULL, '2017-09-05', NULL, ''),
(35, 2, 34, 410.73, NULL, '2017-10-05', NULL, ''),
(36, 2, 35, 410.73, NULL, '2017-11-05', NULL, ''),
(37, 2, 36, 410.73, NULL, '2017-12-05', NULL, ''),
(38, 2, 37, 410.73, NULL, '2018-01-05', NULL, ''),
(39, 2, 38, 410.73, NULL, '2018-02-05', NULL, ''),
(40, 2, 39, 410.73, NULL, '2018-03-05', NULL, ''),
(41, 2, 40, 410.73, NULL, '2018-04-05', NULL, ''),
(42, 2, 41, 410.73, NULL, '2018-05-05', NULL, ''),
(43, 2, 42, 410.73, NULL, '2018-06-05', NULL, ''),
(44, 2, 43, 410.73, NULL, '2018-07-05', NULL, ''),
(45, 2, 44, 410.73, NULL, '2018-08-05', NULL, ''),
(46, 2, 45, 410.73, NULL, '2018-09-05', NULL, ''),
(47, 2, 46, 410.73, NULL, '2018-10-05', NULL, ''),
(48, 2, 47, 410.73, NULL, '2018-11-05', NULL, ''),
(49, 2, 48, 410.73, NULL, '2018-12-05', NULL, ''),
(50, 2, 49, 410.73, NULL, '2019-01-05', NULL, ''),
(51, 2, 50, 410.73, NULL, '2019-02-05', NULL, ''),
(52, 2, 51, 410.73, NULL, '2019-03-05', NULL, ''),
(53, 2, 52, 410.73, NULL, '2019-04-05', NULL, ''),
(54, 2, 53, 410.73, NULL, '2019-05-05', NULL, ''),
(55, 2, 54, 410.73, NULL, '2019-06-05', NULL, ''),
(56, 2, 55, 410.73, NULL, '2019-07-05', NULL, ''),
(57, 2, 56, 410.73, NULL, '2019-08-05', NULL, ''),
(58, 2, 57, 410.73, NULL, '2019-09-05', NULL, ''),
(59, 2, 58, 410.73, NULL, '2019-10-05', NULL, ''),
(60, 2, 59, 410.73, NULL, '2019-11-05', NULL, ''),
(61, 2, 60, 410.73, NULL, '2019-12-05', NULL, ''),
(62, 3, 1, 100.00, NULL, '2015-01-10', NULL, ''),
(63, 3, 2, 100.00, NULL, '2015-02-10', NULL, ''),
(64, 3, 3, 100.00, NULL, '2015-03-10', NULL, ''),
(65, 3, 4, 100.00, NULL, '2015-04-10', NULL, ''),
(66, 3, 5, 100.00, NULL, '2015-05-10', NULL, ''),
(67, 3, 6, 100.00, NULL, '2015-06-10', NULL, ''),
(68, 3, 7, 100.00, NULL, '2015-07-10', NULL, ''),
(69, 3, 8, 100.00, NULL, '2015-08-10', NULL, ''),
(70, 3, 9, 100.00, NULL, '2015-09-10', NULL, ''),
(71, 3, 10, 100.00, NULL, '2015-10-10', NULL, ''),
(72, 3, 11, 100.00, NULL, '2015-11-10', NULL, ''),
(73, 3, 12, 100.00, NULL, '2015-12-10', NULL, ''),
(74, 3, 13, 100.00, NULL, '2016-01-10', NULL, ''),
(75, 3, 14, 100.00, NULL, '2016-02-10', NULL, ''),
(76, 3, 15, 100.00, NULL, '2016-03-10', NULL, ''),
(77, 3, 16, 100.00, NULL, '2016-04-10', NULL, ''),
(78, 3, 17, 100.00, NULL, '2016-05-10', NULL, ''),
(79, 3, 18, 100.00, NULL, '2016-06-10', NULL, ''),
(80, 3, 19, 100.00, NULL, '2016-07-10', NULL, ''),
(81, 3, 20, 100.00, NULL, '2016-08-10', NULL, ''),
(82, 3, 21, 100.00, NULL, '2016-09-10', NULL, ''),
(83, 3, 22, 100.00, NULL, '2016-10-10', NULL, ''),
(84, 3, 23, 100.00, NULL, '2016-11-10', NULL, ''),
(85, 3, 24, 100.00, NULL, '2016-12-10', NULL, ''),
(86, 3, 25, 100.00, NULL, '2017-01-10', NULL, ''),
(87, 3, 26, 100.00, NULL, '2017-02-10', NULL, ''),
(88, 3, 27, 100.00, NULL, '2017-03-10', NULL, ''),
(89, 3, 28, 100.00, NULL, '2017-04-10', NULL, ''),
(90, 3, 29, 100.00, NULL, '2017-05-10', NULL, ''),
(91, 3, 30, 100.00, NULL, '2017-06-10', NULL, ''),
(92, 3, 31, 100.00, NULL, '2017-07-10', NULL, ''),
(93, 3, 32, 100.00, NULL, '2017-08-10', NULL, ''),
(94, 3, 33, 100.00, NULL, '2017-09-10', NULL, ''),
(95, 3, 34, 100.00, NULL, '2017-10-10', NULL, ''),
(96, 3, 35, 100.00, NULL, '2017-11-10', NULL, ''),
(97, 3, 36, 100.00, NULL, '2017-12-10', NULL, ''),
(98, 3, 37, 100.00, NULL, '2018-01-10', NULL, ''),
(99, 3, 38, 100.00, NULL, '2018-02-10', NULL, ''),
(100, 3, 39, 100.00, NULL, '2018-03-10', NULL, ''),
(101, 3, 40, 100.00, NULL, '2018-04-10', NULL, ''),
(102, 3, 41, 100.00, NULL, '2018-05-10', NULL, ''),
(103, 3, 42, 100.00, NULL, '2018-06-10', NULL, ''),
(104, 3, 43, 100.00, NULL, '2018-07-10', NULL, ''),
(105, 3, 44, 100.00, NULL, '2018-08-10', NULL, ''),
(106, 3, 45, 100.00, NULL, '2018-09-10', NULL, ''),
(107, 3, 46, 100.00, NULL, '2018-10-10', NULL, ''),
(108, 3, 47, 100.00, NULL, '2018-11-10', NULL, ''),
(109, 3, 48, 100.00, NULL, '2018-12-10', NULL, ''),
(110, 3, 49, 100.00, NULL, '2019-01-10', NULL, ''),
(111, 3, 50, 100.00, NULL, '2019-02-10', NULL, ''),
(112, 3, 51, 100.00, NULL, '2019-03-10', NULL, ''),
(113, 3, 52, 100.00, NULL, '2019-04-10', NULL, ''),
(114, 3, 53, 100.00, NULL, '2019-05-10', NULL, ''),
(115, 3, 54, 100.00, NULL, '2019-06-10', NULL, ''),
(116, 3, 55, 100.00, NULL, '2019-07-10', NULL, ''),
(117, 3, 56, 100.00, NULL, '2019-08-10', NULL, ''),
(118, 3, 57, 100.00, NULL, '2019-09-10', NULL, ''),
(119, 3, 58, 100.00, NULL, '2019-10-10', NULL, ''),
(120, 3, 59, 100.00, NULL, '2019-11-10', NULL, ''),
(121, 3, 60, 100.00, NULL, '2019-12-10', NULL, ''),
(122, 4, 1, 230.00, NULL, '2015-01-08', NULL, ''),
(123, 4, 2, 230.00, NULL, '2015-02-08', NULL, ''),
(124, 4, 3, 230.00, NULL, '2015-03-08', NULL, ''),
(125, 4, 4, 230.00, NULL, '2015-04-08', NULL, ''),
(126, 4, 5, 230.00, NULL, '2015-05-08', NULL, ''),
(127, 4, 6, 230.00, NULL, '2015-06-08', NULL, ''),
(128, 4, 7, 230.00, NULL, '2015-07-08', NULL, ''),
(129, 4, 8, 230.00, NULL, '2015-08-08', NULL, ''),
(130, 4, 9, 230.00, NULL, '2015-09-08', NULL, ''),
(131, 4, 10, 230.00, NULL, '2015-10-08', NULL, ''),
(132, 4, 11, 230.00, NULL, '2015-11-08', NULL, ''),
(133, 4, 12, 230.00, NULL, '2015-12-08', NULL, ''),
(134, 4, 13, 230.00, NULL, '2016-01-08', NULL, ''),
(135, 4, 14, 230.00, NULL, '2016-02-08', NULL, ''),
(136, 4, 15, 230.00, NULL, '2016-03-08', NULL, ''),
(137, 4, 16, 230.00, NULL, '2016-04-08', NULL, ''),
(138, 4, 17, 230.00, NULL, '2016-05-08', NULL, ''),
(139, 4, 18, 230.00, NULL, '2016-06-08', NULL, ''),
(140, 4, 19, 230.00, NULL, '2016-07-08', NULL, ''),
(141, 4, 20, 230.00, NULL, '2016-08-08', NULL, ''),
(142, 4, 21, 230.00, NULL, '2016-09-08', NULL, ''),
(143, 4, 22, 230.00, NULL, '2016-10-08', NULL, ''),
(144, 4, 23, 230.00, NULL, '2016-11-08', NULL, ''),
(145, 4, 24, 230.00, NULL, '2016-12-08', NULL, ''),
(146, 4, 25, 230.00, NULL, '2017-01-08', NULL, ''),
(147, 4, 26, 230.00, NULL, '2017-02-08', NULL, ''),
(148, 4, 27, 230.00, NULL, '2017-03-08', NULL, ''),
(149, 4, 28, 230.00, NULL, '2017-04-08', NULL, ''),
(150, 4, 29, 230.00, NULL, '2017-05-08', NULL, ''),
(151, 4, 30, 230.00, NULL, '2017-06-08', NULL, ''),
(152, 4, 31, 230.00, NULL, '2017-07-08', NULL, ''),
(153, 4, 32, 230.00, NULL, '2017-08-08', NULL, ''),
(154, 4, 33, 230.00, NULL, '2017-09-08', NULL, ''),
(155, 4, 34, 230.00, NULL, '2017-10-08', NULL, ''),
(156, 4, 35, 230.00, NULL, '2017-11-08', NULL, ''),
(157, 4, 36, 230.00, NULL, '2017-12-08', NULL, ''),
(158, 4, 37, 230.00, NULL, '2018-01-08', NULL, ''),
(159, 4, 38, 230.00, NULL, '2018-02-08', NULL, ''),
(160, 4, 39, 230.00, NULL, '2018-03-08', NULL, ''),
(161, 4, 40, 230.00, NULL, '2018-04-08', NULL, ''),
(162, 4, 41, 230.00, NULL, '2018-05-08', NULL, ''),
(163, 4, 42, 230.00, NULL, '2018-06-08', NULL, ''),
(164, 4, 43, 230.00, NULL, '2018-07-08', NULL, ''),
(165, 4, 44, 230.00, NULL, '2018-08-08', NULL, ''),
(166, 4, 45, 230.00, NULL, '2018-09-08', NULL, ''),
(167, 4, 46, 230.00, NULL, '2018-10-08', NULL, ''),
(168, 4, 47, 230.00, NULL, '2018-11-08', NULL, ''),
(169, 4, 48, 230.00, NULL, '2018-12-08', NULL, ''),
(170, 4, 49, 230.00, NULL, '2019-01-08', NULL, ''),
(171, 4, 50, 230.00, NULL, '2019-02-08', NULL, ''),
(172, 4, 51, 230.00, NULL, '2019-03-08', NULL, ''),
(173, 4, 52, 230.00, NULL, '2019-04-08', NULL, ''),
(174, 4, 53, 230.00, NULL, '2019-05-08', NULL, ''),
(175, 4, 54, 230.00, NULL, '2019-06-08', NULL, ''),
(176, 4, 55, 230.00, NULL, '2019-07-08', NULL, ''),
(177, 4, 56, 230.00, NULL, '2019-08-08', NULL, ''),
(178, 4, 57, 230.00, NULL, '2019-09-08', NULL, ''),
(179, 4, 58, 230.00, NULL, '2019-10-08', NULL, ''),
(180, 4, 59, 230.00, NULL, '2019-11-08', NULL, ''),
(181, 4, 60, 230.00, NULL, '2019-12-08', NULL, ''),
(263, 10, 1, 315.00, NULL, '2015-01-05', NULL, ''),
(264, 10, 2, 315.00, NULL, '2015-02-04', NULL, ''),
(265, 10, 3, 315.00, NULL, '2015-03-06', NULL, ''),
(266, 10, 4, 315.00, NULL, '2015-04-05', NULL, ''),
(267, 10, 5, 315.00, NULL, '2015-05-05', NULL, ''),
(268, 10, 6, 315.00, NULL, '2015-06-04', NULL, ''),
(269, 10, 7, 315.00, NULL, '2015-07-04', NULL, ''),
(270, 10, 8, 315.00, NULL, '2015-08-03', NULL, ''),
(271, 10, 9, 315.00, NULL, '2015-09-02', NULL, ''),
(272, 10, 10, 315.00, NULL, '2015-10-02', NULL, ''),
(297, 11, 1, 3000.00, NULL, '2015-01-08', NULL, ''),
(298, 11, 2, 3000.00, NULL, '2015-02-08', NULL, ''),
(299, 11, 3, 3000.00, NULL, '2015-03-08', NULL, ''),
(300, 11, 4, 3000.00, NULL, '2015-04-08', NULL, ''),
(301, 11, 5, 3000.00, NULL, '2015-05-08', NULL, ''),
(302, 11, 6, 3000.00, NULL, '2015-06-08', NULL, ''),
(303, 11, 7, 3000.00, NULL, '2015-07-08', NULL, ''),
(304, 11, 8, 3000.00, NULL, '2015-08-08', NULL, ''),
(305, 11, 9, 3000.00, NULL, '2015-09-08', NULL, ''),
(306, 11, 10, 3000.00, NULL, '2015-10-08', NULL, ''),
(307, 11, 11, 3000.00, NULL, '2015-11-08', NULL, ''),
(308, 11, 12, 3000.00, NULL, '2015-12-08', NULL, ''),
(309, 11, 13, 3000.00, NULL, '2016-01-08', NULL, ''),
(310, 11, 14, 3000.00, NULL, '2016-02-08', NULL, ''),
(311, 11, 15, 3000.00, NULL, '2016-03-08', NULL, ''),
(312, 11, 16, 3000.00, NULL, '2016-04-08', NULL, ''),
(313, 11, 17, 3000.00, NULL, '2016-05-08', NULL, ''),
(314, 11, 18, 3000.00, NULL, '2016-06-08', NULL, ''),
(315, 11, 19, 3000.00, NULL, '2016-07-08', NULL, ''),
(316, 11, 20, 3000.00, NULL, '2016-08-08', NULL, ''),
(317, 11, 21, 3000.00, NULL, '2016-09-08', NULL, ''),
(318, 11, 22, 3000.00, NULL, '2016-10-08', NULL, ''),
(319, 11, 23, 3000.00, NULL, '2016-11-08', NULL, ''),
(320, 11, 24, 3000.00, NULL, '2016-12-08', NULL, ''),
(321, 11, 25, 3000.00, NULL, '2017-01-08', NULL, ''),
(322, 11, 26, 3000.00, NULL, '2017-02-08', NULL, ''),
(323, 11, 27, 3000.00, NULL, '2017-03-08', NULL, ''),
(324, 11, 28, 3000.00, NULL, '2017-04-08', NULL, ''),
(325, 11, 29, 3000.00, NULL, '2017-05-08', NULL, ''),
(326, 11, 30, 3000.00, NULL, '2017-06-08', NULL, ''),
(327, 11, 31, 3000.00, NULL, '2017-07-08', NULL, ''),
(328, 11, 32, 3000.00, NULL, '2017-08-08', NULL, ''),
(329, 11, 33, 3000.00, NULL, '2017-09-08', NULL, ''),
(330, 11, 34, 3000.00, NULL, '2017-10-08', NULL, ''),
(331, 11, 35, 3000.00, NULL, '2017-11-08', NULL, ''),
(332, 11, 36, 3000.00, NULL, '2017-12-08', NULL, ''),
(333, 11, 37, 3000.00, NULL, '2018-01-08', NULL, ''),
(334, 11, 38, 3000.00, NULL, '2018-02-08', NULL, ''),
(335, 11, 39, 3000.00, NULL, '2018-03-08', NULL, ''),
(336, 11, 40, 3000.00, NULL, '2018-04-08', NULL, ''),
(337, 11, 41, 3000.00, NULL, '2018-05-08', NULL, ''),
(338, 11, 42, 3000.00, NULL, '2018-06-08', NULL, ''),
(339, 11, 43, 3000.00, NULL, '2018-07-08', NULL, ''),
(340, 11, 44, 3000.00, NULL, '2018-08-08', NULL, ''),
(341, 11, 45, 3000.00, NULL, '2018-09-08', NULL, ''),
(342, 11, 46, 3000.00, NULL, '2018-10-08', NULL, ''),
(343, 11, 47, 3000.00, NULL, '2018-11-08', NULL, ''),
(344, 11, 48, 3000.00, NULL, '2018-12-08', NULL, ''),
(345, 11, 49, 3000.00, NULL, '2019-01-08', NULL, ''),
(346, 11, 50, 3000.00, NULL, '2019-02-08', NULL, ''),
(347, 11, 51, 3000.00, NULL, '2019-03-08', NULL, ''),
(348, 11, 52, 3000.00, NULL, '2019-04-08', NULL, ''),
(349, 11, 53, 3000.00, NULL, '2019-05-08', NULL, ''),
(350, 11, 54, 3000.00, NULL, '2019-06-08', NULL, ''),
(351, 11, 55, 3000.00, NULL, '2019-07-08', NULL, ''),
(352, 11, 56, 3000.00, NULL, '2019-08-08', NULL, ''),
(353, 11, 57, 3000.00, NULL, '2019-09-08', NULL, ''),
(354, 11, 58, 3000.00, NULL, '2019-10-08', NULL, ''),
(355, 11, 59, 3000.00, NULL, '2019-11-08', NULL, ''),
(356, 11, 60, 3000.00, NULL, '2019-12-08', NULL, ''),
(358, 12, 1, 215.00, NULL, '2014-12-30', NULL, ''),
(359, 13, 1, 54.00, NULL, '2015-01-12', NULL, ''),
(360, 13, 2, 54.00, NULL, '2015-02-12', NULL, ''),
(361, 13, 3, 54.00, NULL, '2015-03-12', NULL, ''),
(362, 13, 4, 54.00, NULL, '2015-04-12', NULL, ''),
(363, 13, 5, 54.00, NULL, '2015-05-12', NULL, ''),
(364, 13, 6, 54.00, NULL, '2015-06-12', NULL, ''),
(365, 13, 7, 54.00, NULL, '2015-07-12', NULL, ''),
(366, 13, 8, 54.00, NULL, '2015-08-12', NULL, ''),
(367, 13, 9, 54.00, NULL, '2015-09-12', NULL, ''),
(368, 13, 10, 54.00, NULL, '2015-10-12', NULL, ''),
(369, 13, 11, 54.00, NULL, '2015-11-12', NULL, ''),
(370, 13, 12, 54.00, NULL, '2015-12-12', NULL, ''),
(371, 13, 13, 54.00, NULL, '2016-01-12', NULL, ''),
(372, 13, 14, 54.00, NULL, '2016-02-12', NULL, ''),
(373, 13, 15, 54.00, NULL, '2016-03-12', NULL, ''),
(374, 13, 16, 54.00, NULL, '2016-04-12', NULL, ''),
(375, 13, 17, 54.00, NULL, '2016-05-12', NULL, ''),
(376, 13, 18, 54.00, NULL, '2016-06-12', NULL, ''),
(377, 13, 19, 54.00, NULL, '2016-07-12', NULL, ''),
(378, 13, 20, 54.00, NULL, '2016-08-12', NULL, ''),
(379, 13, 21, 54.00, NULL, '2016-09-12', NULL, ''),
(380, 13, 22, 54.00, NULL, '2016-10-12', NULL, ''),
(381, 13, 23, 54.00, NULL, '2016-11-12', NULL, ''),
(382, 13, 24, 54.00, NULL, '2016-12-12', NULL, ''),
(383, 13, 25, 54.00, NULL, '2017-01-12', NULL, ''),
(384, 13, 26, 54.00, NULL, '2017-02-12', NULL, ''),
(385, 13, 27, 54.00, NULL, '2017-03-12', NULL, ''),
(386, 13, 28, 54.00, NULL, '2017-04-12', NULL, ''),
(387, 13, 29, 54.00, NULL, '2017-05-12', NULL, ''),
(388, 13, 30, 54.00, NULL, '2017-06-12', NULL, ''),
(389, 13, 31, 54.00, NULL, '2017-07-12', NULL, ''),
(390, 13, 32, 54.00, NULL, '2017-08-12', NULL, ''),
(391, 13, 33, 54.00, NULL, '2017-09-12', NULL, ''),
(392, 13, 34, 54.00, NULL, '2017-10-12', NULL, ''),
(393, 13, 35, 54.00, NULL, '2017-11-12', NULL, ''),
(394, 13, 36, 54.00, NULL, '2017-12-12', NULL, ''),
(395, 13, 37, 54.00, NULL, '2018-01-12', NULL, ''),
(396, 13, 38, 54.00, NULL, '2018-02-12', NULL, ''),
(397, 13, 39, 54.00, NULL, '2018-03-12', NULL, ''),
(398, 13, 40, 54.00, NULL, '2018-04-12', NULL, ''),
(399, 13, 41, 54.00, NULL, '2018-05-12', NULL, ''),
(400, 13, 42, 54.00, NULL, '2018-06-12', NULL, ''),
(401, 13, 43, 54.00, NULL, '2018-07-12', NULL, ''),
(402, 13, 44, 54.00, NULL, '2018-08-12', NULL, ''),
(403, 13, 45, 54.00, NULL, '2018-09-12', NULL, ''),
(404, 13, 46, 54.00, NULL, '2018-10-12', NULL, ''),
(405, 13, 47, 54.00, NULL, '2018-11-12', NULL, ''),
(406, 13, 48, 54.00, NULL, '2018-12-12', NULL, ''),
(407, 13, 49, 54.00, NULL, '2019-01-12', NULL, ''),
(408, 13, 50, 54.00, NULL, '2019-02-12', NULL, ''),
(409, 13, 51, 54.00, NULL, '2019-03-12', NULL, ''),
(410, 13, 52, 54.00, NULL, '2019-04-12', NULL, ''),
(411, 13, 53, 54.00, NULL, '2019-05-12', NULL, ''),
(412, 13, 54, 54.00, NULL, '2019-06-12', NULL, ''),
(413, 13, 55, 54.00, NULL, '2019-07-12', NULL, ''),
(414, 13, 56, 54.00, NULL, '2019-08-12', NULL, ''),
(415, 13, 57, 54.00, NULL, '2019-09-12', NULL, ''),
(416, 13, 58, 54.00, NULL, '2019-10-12', NULL, ''),
(417, 13, 59, 54.00, NULL, '2019-11-12', NULL, ''),
(418, 13, 60, 54.00, NULL, '2019-12-12', NULL, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pessoa`
--

CREATE TABLE IF NOT EXISTS `tb_pessoa` (
  `id_pessoa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_entidade` int(10) unsigned NOT NULL,
  `nome_razao` varchar(200) DEFAULT NULL,
  `cpf_cnpj` varchar(18) DEFAULT NULL,
  `tipo_pessoa` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_pessoa`),
  KEY `tb_pessoa_FKIndex1` (`id_entidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `tb_pessoa`
--

INSERT INTO `tb_pessoa` (`id_pessoa`, `id_entidade`, `nome_razao`, `cpf_cnpj`, `tipo_pessoa`) VALUES
(1, 1, 'Bartofil atacadista', '', 'J'),
(2, 2, 'CEB e CAESB', '', 'J'),
(3, 3, 'Condomínio Splendor Caldas', '', 'J'),
(4, 4, 'GVT telefonia', '', 'J'),
(5, 5, 'Bradesco Cartão de Crédito', '', 'J'),
(6, 6, 'Caixa Cartão de Crédito', '', 'J'),
(7, 7, 'Indra Company', '', 'J'),
(8, 8, 'Jose Arnaldo', '', 'F'),
(9, 9, 'Adriana Splendor', '', 'F'),
(10, 10, 'Adriana Splendor', '', 'F'),
(11, 11, 'Claro Celular', '', 'J');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `perfil` text COLLATE utf8_unicode_ci NOT NULL,
  `ultimo_acesso` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_user`
--

INSERT INTO `tb_user` (`id`, `nome`, `login`, `senha`, `code`, `perfil`, `ultimo_acesso`) VALUES
(1, 'Leonardo M C Bessa', 'leobessa', '123456', '123456', 'administrador, todo_acesso', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
