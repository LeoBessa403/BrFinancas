-- MySQL Workbench Synchronization
-- Generated: 2016-12-07 14:03
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Leo

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_AUDITORIA` (
  `co_auditoria` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_tabela` VARCHAR(150) NULL DEFAULT NULL,
  `dt_realizado` DATETIME NULL DEFAULT NULL,
  `no_operacao` VARCHAR(1) NULL DEFAULT NULL,
  `ds_item_anterior` TEXT NULL DEFAULT NULL,
  `ds_item_atual` TEXT NULL DEFAULT NULL,
  `co_registro` INT(10) NULL DEFAULT NULL,
  `ds_perfil_usuario` TEXT NULL DEFAULT NULL,
  `co_usuario` INT(10) NOT NULL,
  PRIMARY KEY (`co_auditoria`, `co_usuario`),
  INDEX `fk_TB_AUDITORIA_TB_USUARIO1_idx` (`co_usuario` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_EVENTO` (
  `co_evento` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_evento` VARCHAR(250) NULL DEFAULT NULL,
  `ds_conteudo` TEXT NULL DEFAULT NULL,
  `ds_palavras_chaves` VARCHAR(100) NULL DEFAULT NULL,
  `dt_cadastro` DATETIME NULL DEFAULT NULL,
  `dt_realizado` DATE NULL DEFAULT NULL,
  `ds_local` VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (`co_evento`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_IMAGEM` (
  `co_imagem` INT(10) NOT NULL AUTO_INCREMENT,
  `ds_caminho` VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (`co_imagem`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_FUNCIONALIDADE` (
  `co_funcionalidade` INT(11) NOT NULL AUTO_INCREMENT,
  `no_funcionalidade` VARCHAR(150) NOT NULL,
  `ds_rota` VARCHAR(250) NOT NULL,
  `st_status` VARCHAR(1) NOT NULL DEFAULT 'I' COMMENT 'A - Ativo / I - Inativo',
  PRIMARY KEY (`co_funcionalidade`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_MEMBRO` (
  `co_membro` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_responsavel` VARCHAR(100) NULL DEFAULT NULL,
  `st_estuda` VARCHAR(1) NULL DEFAULT NULL,
  `st_trabalha` VARCHAR(1) NULL DEFAULT NULL,
  `ds_conhecimento` TEXT NULL DEFAULT NULL,
  `st_status` VARCHAR(1) NULL DEFAULT NULL,
  `st_batizado` VARCHAR(1) NOT NULL,
  `st_eucaristia` VARCHAR(1) NOT NULL,
  `st_crisma` VARCHAR(1) NOT NULL,
  `co_pessoa` INT(11) NOT NULL,
  PRIMARY KEY (`co_membro`, `co_pessoa`),
  INDEX `fk_TB_MEMBRO_TB_PESSOA1_idx` (`co_pessoa` ASC),
  CONSTRAINT `fk_TB_MEMBRO_TB_PESSOA1`
    FOREIGN KEY (`co_pessoa`)
    REFERENCES `gej_bd`.`TB_PESSOA` (`co_pessoa`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_INSCRICAO` (
  `co_inscricao` INT(10) UNSIGNED NOT NULL,
  `ds_pastoral` TEXT NULL DEFAULT NULL,
  `ds_retiro` VARCHAR(1) NULL DEFAULT NULL,
  `ds_membro_ativo` VARCHAR(1) NULL DEFAULT 'N',
  `ds_situacao_atual_grupo` INT(1) NULL DEFAULT NULL,
  `co_evento` INT(10) UNSIGNED NOT NULL,
  `nu_camisa` INT(1) NOT NULL,
  `no_responsavel` VARCHAR(50) NOT NULL,
  `nu_tel_responsavel` VARCHAR(15) NOT NULL,
  `ds_descricao` TEXT NOT NULL,
  `co_pessoa` INT(11) NOT NULL,
  PRIMARY KEY (`co_inscricao`, `co_pessoa`),
  INDEX `fk_tb_membro_retiro_tb_retiro1_idx` (`co_evento` ASC),
  INDEX `fk_TB_INSCRICAO_TB_PESSOA1_idx` (`co_pessoa` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_PERFIL` (
  `co_perfil` INT(11) NOT NULL AUTO_INCREMENT,
  `no_perfil` VARCHAR(45) NOT NULL,
  `st_status` VARCHAR(1) NULL DEFAULT 'I',
  PRIMARY KEY (`co_perfil`),
  UNIQUE INDEX `co_perfil_UNIQUE` (`co_perfil` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_USUARIO` (
  `co_usuario` INT(10) NOT NULL AUTO_INCREMENT,
  `ds_senha` VARCHAR(100) NOT NULL,
  `ds_code` VARCHAR(50) NOT NULL,
  `st_status` VARCHAR(1) NOT NULL DEFAULT 'I' COMMENT '\'A - Ativo / I - Inativo\'',
  `dt_cadastro` DATETIME NOT NULL,
  `co_imagem` INT(10) NOT NULL,
  `co_pessoa` INT(11) NOT NULL,
  PRIMARY KEY (`co_usuario`, `co_imagem`, `co_pessoa`),
  INDEX `fk_TB_USUARIO_TB_IMAGEM1_idx` (`co_imagem` ASC),
  INDEX `fk_TB_USUARIO_TB_PESSOA2_idx` (`co_pessoa` ASC),
  CONSTRAINT `fk_TB_USUARIO_TB_IMAGEM1`
    FOREIGN KEY (`co_imagem`)
    REFERENCES `gej_bd`.`TB_IMAGEM` (`co_imagem`),
  CONSTRAINT `fk_TB_USUARIO_TB_PESSOA2`
    FOREIGN KEY (`co_pessoa`)
    REFERENCES `gej_bd`.`TB_PESSOA` (`co_pessoa`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_USUARIO_PERFIL` (
  `co_usuario_perfil` INT(11) NOT NULL AUTO_INCREMENT,
  `co_usuario` INT(10) NOT NULL,
  `co_perfil` INT(11) NOT NULL,
  PRIMARY KEY (`co_usuario_perfil`, `co_usuario`, `co_perfil`),
  INDEX `fk_TB_USUARIO_PERFIL_TB_USUARIO1_idx` (`co_usuario` ASC),
  INDEX `fk_TB_USUARIO_PERFIL_TB_PERFIL1_idx` (`co_perfil` ASC),
  CONSTRAINT `fk_TB_USUARIO_PERFIL_TB_USUARIO1`
    FOREIGN KEY (`co_usuario`)
    REFERENCES `gej_bd`.`TB_USUARIO` (`co_usuario`),
  CONSTRAINT `fk_TB_USUARIO_PERFIL_TB_PERFIL1`
    FOREIGN KEY (`co_perfil`)
    REFERENCES `gej_bd`.`TB_PERFIL` (`co_perfil`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_PERFIL_FUNCIONALIDADE` (
  `co_perfil_funcionalidade` INT(11) NOT NULL AUTO_INCREMENT,
  `co_perfil` INT(11) NOT NULL,
  `co_funcionalidade` INT(11) NOT NULL,
  PRIMARY KEY (`co_perfil_funcionalidade`, `co_perfil`, `co_funcionalidade`),
  INDEX `fk_tb_perfil_tb_funcionalidade_tb_funcionalidade1_idx` (`co_funcionalidade` ASC),
  INDEX `fk_tb_perfil_tb_funcionalidade_tb_perfil1_idx` (`co_perfil` ASC),
  CONSTRAINT `fk_tb_perfil_tb_funcionalidade_tb_perfil1`
    FOREIGN KEY (`co_perfil`)
    REFERENCES `gej_bd`.`TB_PERFIL` (`co_perfil`),
  CONSTRAINT `fk_tb_perfil_tb_funcionalidade_tb_funcionalidade1`
    FOREIGN KEY (`co_funcionalidade`)
    REFERENCES `gej_bd`.`TB_FUNCIONALIDADE` (`co_funcionalidade`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_PESSOA` (
  `co_pessoa` INT(11) NOT NULL AUTO_INCREMENT,
  `nu_cpf` VARCHAR(15) NULL DEFAULT NULL,
  `no_pessoa` VARCHAR(100) NOT NULL,
  `nu_rg` VARCHAR(15) NULL DEFAULT NULL,
  `dt_cadastro` DATETIME NULL DEFAULT NULL,
  `dt_nascimento` DATE NULL DEFAULT NULL,
  `st_sexo` VARCHAR(1) NULL DEFAULT NULL,
  `co_contato` INT(11) NOT NULL,
  `co_endereco` INT(11) NOT NULL,
  PRIMARY KEY (`co_pessoa`, `co_contato`, `co_endereco`),
  INDEX `fk_TB_PESSOA_TB_CONTATO1_idx` (`co_contato` ASC),
  INDEX `fk_TB_PESSOA_TB_ENDERECO1_idx` (`co_endereco` ASC),
  CONSTRAINT `fk_TB_PESSOA_TB_CONTATO1`
    FOREIGN KEY (`co_contato`)
    REFERENCES `gej_bd`.`TB_CONTATO` (`co_contato`),
  CONSTRAINT `fk_TB_PESSOA_TB_ENDERECO1`
    FOREIGN KEY (`co_endereco`)
    REFERENCES `gej_bd`.`TB_ENDERECO` (`co_endereco`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_CONTATO` (
  `co_contato` INT(11) NOT NULL AUTO_INCREMENT,
  `nu_tel1` VARCHAR(15) NOT NULL,
  `nu_tel2` VARCHAR(15) NULL DEFAULT NULL,
  `nu_tel3` VARCHAR(15) NULL DEFAULT NULL,
  `ds_email` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`co_contato`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_ENDERECO` (
  `co_endereco` INT(11) NOT NULL AUTO_INCREMENT,
  `ds_endereco` VARCHAR(150) NOT NULL,
  `ds_complemento` VARCHAR(100) NULL DEFAULT NULL,
  `ds_bairro` VARCHAR(80) NULL DEFAULT NULL,
  `nu_cep` VARCHAR(15) NULL DEFAULT NULL,
  `no_cidade` VARCHAR(80) NULL DEFAULT NULL,
  `sg_uf` VARCHAR(2) NULL DEFAULT NULL,
  PRIMARY KEY (`co_endereco`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_ACESSO` (
  `co_acesso` INT(11) NOT NULL AUTO_INCREMENT,
  `ds_session_id` VARCHAR(255) NOT NULL,
  `dt_inicio_acesso` DATETIME NULL DEFAULT NULL,
  `dt_fim_acesso` DATETIME NULL DEFAULT NULL,
  `co_usuario` INT(10) NOT NULL,
  PRIMARY KEY (`co_acesso`, `co_usuario`),
  INDEX `fk_TB_ACESSO_TB_USUARIO1_idx` (`co_usuario` ASC),
  CONSTRAINT `fk_TB_ACESSO_TB_USUARIO1`
    FOREIGN KEY (`co_usuario`)
    REFERENCES `gej_bd`.`TB_USUARIO` (`co_usuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_PAGAMENTO` (
  `co_pagamento` INT(11) NOT NULL AUTO_INCREMENT,
  `nu_total` DECIMAL NULL DEFAULT NULL,
  `nu_valor_pago` DECIMAL NULL DEFAULT NULL,
  `nu_parcelas` INT(11) NULL DEFAULT NULL,
  `tp_situacao` VARCHAR(1) NULL DEFAULT 'N' COMMENT 'N - Não iniciado / I - Iniciado / C - Concluido',
  `ds_observacao` TEXT NULL DEFAULT NULL,
  `co_inscricao` INT(10) UNSIGNED NOT NULL,
  `co_tipo_pagamento` INT(11) NOT NULL,
  PRIMARY KEY (`co_pagamento`, `co_inscricao`),
  INDEX `fk_TB_PAGAMENTO_TB_INSCRICAO1_idx` (`co_inscricao` ASC),
  CONSTRAINT `fk_TB_PAGAMENTO_TB_INSCRICAO1`
    FOREIGN KEY (`co_inscricao`)
    REFERENCES `gej_bd`.`TB_INSCRICAO` (`co_inscricao`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_PARCELAMENTO` (
  `co_parcelamento` INT(11) NOT NULL AUTO_INCREMENT,
  `nu_parcela` INT(11) NULL DEFAULT NULL,
  `nu_valor_parcela` DECIMAL NULL DEFAULT NULL,
  `nu_valor_parcela_pago` DECIMAL NULL DEFAULT NULL,
  `dt_vencimento` DATE NULL DEFAULT NULL,
  `dt_vencimento_pago` DATE NULL DEFAULT NULL,
  `ds_observacao` TEXT NULL DEFAULT NULL,
  `co_pagamento` INT(11) NOT NULL,
  PRIMARY KEY (`co_parcelamento`, `co_pagamento`,  `co_tipo_pagamento`),
  INDEX `fk_TB_PARCELAMENTO_TB_PAGAMENTO1_idx` (`co_pagamento` ASC),
  INDEX `fk_TB_PARCELAMENTO_TB_TIPO_PAGAMENTO1_idx` (`co_tipo_pagamento` ASC),
  CONSTRAINT `fk_TB_PARCELAMENTO_TB_PAGAMENTO1`
    FOREIGN KEY (`co_pagamento`)
    REFERENCES `gej_bd`.`TB_PAGAMENTO` (`co_pagamento`),
  CONSTRAINT `fk_TB_PARCELAMENTO_TB_TIPO_PAGAMENTO1`
    FOREIGN KEY (`co_tipo_pagamento`)
    REFERENCES `gej_bd`.`TB_TIPO_PAGAMENTO` (`co_tipo_pagamento`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `gej_bd`.`TB_TIPO_PAGAMENTO` (
  `co_tipo_pagamento` INT(11) NOT NULL AUTO_INCREMENT,
  `ds_tipo_pagamento` VARCHAR(45) NULL DEFAULT NULL,
  `sg_tipo_pagamento` VARCHAR(2) NULL DEFAULT NULL,
  PRIMARY KEY (`co_tipo_pagamento`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
