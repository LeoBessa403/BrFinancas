-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Máquina: cpmy0025.servidorwebfacil.com
-- Data de Criação: 28-Set-2015 às 11:00
-- Versão do servidor: 5.1.66-community-log
-- versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `i9_sistemas`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
(8, 8, '', '', '', '', ''),
(9, 9, '', '', '', '', ''),
(10, 10, '', '', '', '', ''),
(11, 11, '', '', '', '', ''),
(12, 12, '', '', '', '', ''),
(13, 13, '', '', '', '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `tb_entidade`
--

INSERT INTO `tb_entidade` (`id_entidade`, `observacao`, `cadastro`, `tipo_entidade`) VALUES
(1, '', '2015-09-28 10:00:59', 'C'),
(2, '', '2015-09-28 10:01:09', 'C'),
(3, '', '2015-09-28 10:01:28', 'C'),
(4, '', '2015-09-28 10:01:35', 'C'),
(5, '', '2015-09-28 10:01:41', 'C'),
(6, '', '2015-09-28 10:02:21', 'R'),
(7, '', '2015-09-28 10:02:33', 'R'),
(8, '', '2015-09-28 10:02:38', 'R'),
(9, '', '2015-09-28 10:02:44', 'R'),
(10, '', '2015-09-28 10:02:49', 'R'),
(11, '', '2015-09-28 10:02:56', 'R'),
(12, '', '2015-09-28 10:19:25', 'C'),
(13, 'Desenvolvimento Sistema Site', '2015-09-28 10:21:46', 'R');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `tb_negociacao`
--

INSERT INTO `tb_negociacao` (`id_negociacao`, `id_entidade`, `cadastro`, `tipo_negociacao`, `observacao`) VALUES
(1, 6, '2015-09-28 10:10:38', 'RC', ''),
(2, 7, '2015-08-25 10:11:54', 'RC', ''),
(3, 11, '2015-08-18 10:12:20', 'RC', ''),
(4, 8, '2015-09-20 10:13:19', 'RC', 'Compras Retiro'),
(5, 8, '2015-09-28 10:14:02', 'RC', 'Contas do Mes'),
(6, 10, '2015-08-14 10:15:27', 'RC', 'Restante do Pagamento do Empréstimo do Palco do evento do musical'),
(7, 10, '2015-09-19 10:16:21', 'RC', 'Compra dos Microfones'),
(8, 8, '2015-09-13 10:17:08', 'RC', 'Compra do Guarda Roupas'),
(9, 7, '2015-09-20 10:17:46', 'RC', 'Compra do Remédio da Lele'),
(10, 12, '2015-09-28 10:20:09', 'PG', 'Parcela doo Álbum de formatura da KArlene'),
(11, 13, '2015-09-28 10:22:21', 'RC', 'Parcela do Sistema e Site Amigos do Pet'),
(12, 9, '2015-09-28 10:25:06', 'RC', 'Pagamentos de Guarda Roupa dinheiro Emprestado para Faculdade '),
(13, 1, '2015-09-28 10:40:09', 'PG', ''),
(14, 2, '2015-09-28 10:39:33', 'PG', ''),
(15, 9, '2015-09-28 10:41:00', 'RC', 'Parcela das Contas de casa'),
(16, 8, '2015-09-28 10:41:40', 'RC', 'Pagamento da Ajuda do Box e obra do Banheiro'),
(17, 7, '2015-09-28 10:42:29', 'RC', 'Pagamento ajuda da Obra e Blindex'),
(18, 7, '2015-09-28 10:42:55', 'RC', 'Pagamento das contas de casa do mês');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `tb_pagamento`
--

INSERT INTO `tb_pagamento` (`id_pagamento`, `id_negociacao`, `tipo_pagamento`, `valor_pago`, `valor_total`, `situacao`, `numero_parcelas`) VALUES
(1, 1, 'DI', NULL, 28960.00, 'A', 8),
(2, 2, 'DI', NULL, 2000.00, 'A', 1),
(3, 3, 'DI', NULL, 500.00, 'A', 1),
(4, 4, 'DI', NULL, 155.00, 'A', 1),
(5, 5, 'DI', NULL, 50.00, 'A', 1),
(6, 6, 'DI', NULL, 550.00, 'A', 1),
(7, 7, 'DI', NULL, 850.00, 'A', 5),
(8, 8, 'DI', NULL, 250.00, 'A', 1),
(9, 9, 'DI', NULL, 95.00, 'A', 1),
(10, 10, 'DI', NULL, 120.00, 'A', 1),
(11, 11, 'DI', NULL, 750.00, 'A', 1),
(12, 12, 'DI', NULL, 800.00, 'A', 1),
(13, 13, 'DI', NULL, 2500.00, 'A', 1),
(14, 14, 'DI', NULL, 920.00, 'A', 1),
(15, 15, 'DI', NULL, 50.00, 'A', 1),
(16, 16, 'DI', NULL, 50.00, 'A', 1),
(17, 17, 'DI', NULL, 100.00, 'A', 1),
(18, 18, 'DI', NULL, 180.00, 'A', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Extraindo dados da tabela `tb_parcelamento`
--

INSERT INTO `tb_parcelamento` (`id_parcelamento`, `id_pagamento`, `parcela`, `valor_parcela`, `valor_parcela_pago`, `vencimento`, `vencimento_pago`, `observacao_parcela`) VALUES
(1, 1, 1, 3620.00, NULL, '2015-10-09', NULL, ''),
(2, 1, 2, 3620.00, NULL, '2015-11-06', NULL, ''),
(3, 1, 3, 3620.00, NULL, '2015-12-07', NULL, ''),
(4, 1, 4, 3620.00, NULL, '2016-01-08', NULL, ''),
(5, 1, 5, 3620.00, NULL, '2016-02-05', NULL, ''),
(6, 1, 6, 3620.00, NULL, '2016-03-07', NULL, ''),
(7, 1, 7, 3620.00, NULL, '2016-04-07', NULL, ''),
(8, 1, 8, 3620.00, NULL, '2016-05-06', NULL, ''),
(9, 2, 1, 2000.00, NULL, '2016-01-06', NULL, NULL),
(10, 3, 1, 500.00, NULL, '2016-01-07', NULL, NULL),
(11, 4, 1, 155.00, NULL, '2015-09-30', NULL, NULL),
(12, 5, 1, 50.00, NULL, '2015-09-30', NULL, NULL),
(13, 6, 1, 550.00, NULL, '2016-01-10', NULL, NULL),
(14, 7, 1, 170.00, NULL, '2015-10-06', NULL, ''),
(15, 7, 2, 170.00, NULL, '2015-11-08', NULL, ''),
(16, 7, 3, 170.00, NULL, '2015-12-06', NULL, ''),
(17, 7, 4, 170.00, NULL, '2016-01-09', NULL, ''),
(18, 7, 5, 170.00, NULL, '2016-02-07', NULL, ''),
(19, 8, 1, 250.00, NULL, '2015-11-30', NULL, NULL),
(20, 9, 1, 95.00, NULL, '2015-10-02', NULL, NULL),
(21, 10, 1, 120.00, NULL, '2015-10-10', NULL, NULL),
(22, 11, 1, 750.00, NULL, '2015-10-10', NULL, NULL),
(23, 12, 1, 800.00, NULL, '2015-10-02', NULL, NULL),
(26, 13, 1, 2500.00, NULL, '2015-10-08', NULL, NULL),
(25, 14, 1, 920.00, NULL, '2015-10-10', NULL, NULL),
(27, 15, 1, 50.00, NULL, '2015-10-02', NULL, NULL),
(28, 16, 1, 50.00, NULL, '2015-09-30', NULL, NULL),
(29, 17, 1, 100.00, NULL, '2015-10-02', NULL, NULL),
(30, 18, 1, 180.00, NULL, '2015-10-02', NULL, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `tb_pessoa`
--

INSERT INTO `tb_pessoa` (`id_pessoa`, `id_entidade`, `nome_razao`, `cpf_cnpj`, `tipo_pessoa`) VALUES
(1, 1, 'Cartão Caixa', '', 'J'),
(2, 2, 'Cartão Bradesco', '', 'J'),
(3, 3, 'Caesb', '', 'J'),
(4, 4, 'CEB', '', 'J'),
(5, 5, 'GVT', '', 'J'),
(6, 6, 'Indra ', '', 'J'),
(7, 7, 'Pai', '', 'F'),
(8, 8, 'Lilian', '', 'F'),
(9, 9, 'Leticia', '', 'F'),
(10, 10, 'GEJ', '', 'F'),
(11, 11, 'Tio Nena', '', 'F'),
(12, 12, 'Álbum Karlene', '', 'J'),
(13, 13, 'Diego Amigos Do Pet', '', 'F');

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
