CREATE DATABASE IF NOT EXISTS `BDD_DB`;
USE `BDD_DB`;


CREATE TABLE IF NOT EXISTS `Acesso` (
  `ID_Acesso` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_Acesso` varchar(50) DEFAULT NULL,
  `Timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID_Area` int(11) DEFAULT NULL,
  `ID_Ficheiro` int(11) DEFAULT NULL,
  `ID_Func` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Acesso`),
  KEY `AC_Ficheiro` (`ID_Ficheiro`),
  KEY `AC_Funcionario` (`ID_Func`),
  KEY `AC_Area` (`ID_Area`),
  CONSTRAINT `AC_Area` FOREIGN KEY (`ID_Area`) REFERENCES `Area` (`ID_Area`),
  CONSTRAINT `AC_Ficheiro` FOREIGN KEY (`ID_Ficheiro`) REFERENCES `Ficheiro` (`ID_Ficheiro`),
  CONSTRAINT `AC_Funcionario` FOREIGN KEY (`ID_Func`) REFERENCES `Funcionario` (`ID_Func`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `Area` (
  `ID_Area` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Area` varchar(50) DEFAULT NULL,
  `Desc_Area` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Area`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;


DELIMITER //
CREATE DEFINER=`skip-grants`@`%` PROCEDURE `DelAcess`(
	IN `ida_IN` INT

)
BEGIN
	#Ignorar área associada
	SET foreign_key_checks = 0; 
	
	DELETE FROM Acesso WHERE ID_Acesso=ida_IN;
END//
DELIMITER ;


DELIMITER //
CREATE DEFINER=`skip-grants`@`%` PROCEDURE `DelArea`(
	IN `ida_IN` INT




)
BEGIN
	#Ignorar área associada
	SET foreign_key_checks = 0; 
	
	#apagar área,ficheiros e acesso
	DELETE Area, Ficheiro, Acesso FROM Area
	INNER JOIN Ficheiro ON Ficheiro.ID_Ficheiro = Area.ID_Ficheiro 
	INNER JOIN Acesso ON Acesso.ID_Ficheiro = Ficheiro.ID_Ficheiro 
	WHERE Area.ID_Area=ida_IN;
	
	
END//
DELIMITER ;

DELIMITER //
CREATE DEFINER=`skip-grants`@`%` PROCEDURE `DelDisp`(
	IN `id_IN` INT

)


BEGIN
	#Para apagar ignorar Funcionário ou Placa(no segundo caso) associados
	SET foreign_key_checks = 0; 
	
	#Será posto ou outro?
	IF (SELECT Dispositivo.ID_posto FROM Dispositivo WHERE Dispositivo.ID_Dispositivo = id_IN) IS NOT NULL THEN
		#Apagar Dispositivo/Outros e não Placa
		DELETE Dispositivo, Posto FROM Dispositivo 
		INNER JOIN Posto ON Posto.ID_Posto = Dispositivo.ID_Posto
		WHERE Dispositivo.ID_Dispositivo = id_IN;
	ELSE 
		#Apagar Dispositivo/Outros/Placa
		DELETE Dispositivo, Outros, Placa_Rede FROM Dispositivo 
		INNER JOIN Outros ON Outros.ID_Outros = Dispositivo.ID_Outros
		LEFT JOIN Placa_Rede ON Placa_Rede.ID_Placa = Outros.ID_Placa
		WHERE Dispositivo.ID_Dispositivo = id_IN;
	END IF;
END//
DELIMITER ;

-- Dumping structure for table BDD_DB.DeleteLog
CREATE TABLE IF NOT EXISTS `DeleteLog` (
  `ID_Del` int(11) DEFAULT NULL,
  `Nome_Del` varchar(50) DEFAULT NULL,
  `Func_Del` varchar(50) DEFAULT NULL,
  `Timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for procedure BDD_DB.DelFich
DELIMITER //
CREATE DEFINER=`skip-grants`@`%` PROCEDURE `DelFich`(
	IN `idf_IN` INT




)
BEGIN
	#Ignorar área associada
	SET foreign_key_checks = 0; 
	
	#Apagar ficheiro e acessos associados
	DELETE Ficheiro, Acesso FROM Ficheiro
	INNER JOIN Acesso ON Acesso.ID_Ficheiro = Ficheiro.ID_Ficheiro 
	WHERE Ficheiro.ID_Ficheiro=idf_IN;
	
END//
DELIMITER ;

DELIMITER //
CREATE DEFINER=`skip-grants`@`%` PROCEDURE `DelFunc`(
	IN `idf_IN` INT

)
BEGIN
	#Ignorar área associada
	SET foreign_key_checks = 0; 
	
	#Apagar Funcionario e posto associado
	DELETE Funcionario, Login_Posto FROM Funcionario
	INNER JOIN Login_Posto ON Login_Posto.ID_func = Funcionario.ID_Func
	WHERE Funcionario.ID_Func=idf_IN;
	
END//
DELIMITER ;



DELIMITER //
CREATE DEFINER=`skip-grants`@`%` PROCEDURE `DelLic`(
	IN `idl_IN` INT


)
BEGIN
	#Ignorar área associada
	SET foreign_key_checks = 0; 
	
	DELETE FROM Licenca_Software WHERE ID_LIC=idl_IN;
END//
DELIMITER ;


DELIMITER //
CREATE DEFINER=`skip-grants`@`%` PROCEDURE `DelPost`(
	IN `idp_IN` INT

)
BEGIN
	#Ignorar área associada
	SET foreign_key_checks = 0; 
	
	DELETE FROM Posto WHERE ID_Posto=idp_IN;
END//
DELIMITER ;


CREATE TABLE IF NOT EXISTS `Dispositivo` (
  `ID_Dispositivo` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_Dispositivo` varchar(50) DEFAULT NULL,
  `ID_Posto` int(11) DEFAULT NULL,
  `ID_Outros` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Dispositivo`),
  KEY `DISP_Posto` (`ID_Posto`),
  KEY `DISP_Outros` (`ID_Outros`),
  CONSTRAINT `DISP_Outros` FOREIGN KEY (`ID_Outros`) REFERENCES `Outros` (`ID_Outros`),
  CONSTRAINT `DISP_Posto` FOREIGN KEY (`ID_Posto`) REFERENCES `Posto` (`ID_Posto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `Ficheiro` (
  `ID_Ficheiro` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Ficheiro` varchar(50) DEFAULT NULL,
  `ID_Area` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Ficheiro`),
  KEY `FNK_Area` (`ID_Area`),
  CONSTRAINT `FNK_Area` FOREIGN KEY (`ID_Area`) REFERENCES `Area` (`ID_Area`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `Funcionario` (
  `ID_Func` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Func` varchar(50) DEFAULT NULL,
  `Password_Func` varchar(50) DEFAULT NULL,
  `Nivel_Func` int(11) DEFAULT NULL,
  `Handle_Func` varchar(50) DEFAULT NULL,
  `Email_Func` varchar(50) DEFAULT NULL,
  `Ativo_Func` int(1) DEFAULT NULL,
  `ID_Posto` int(11) DEFAULT NULL,
  `ID_Area` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Func`),
  KEY `FUNK_Posto` (`ID_Posto`),
  KEY `FUNK_Area` (`ID_Area`),
  CONSTRAINT `FUNK_Area` FOREIGN KEY (`ID_Area`) REFERENCES `Area` (`ID_Area`),
  CONSTRAINT `FUNK_Posto` FOREIGN KEY (`ID_Posto`) REFERENCES `Posto` (`ID_Posto`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `Licenca_Software` (
  `ID_LIC` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_LIC` varchar(50) DEFAULT NULL,
  `Serial_LIC` varchar(50) DEFAULT NULL,
  `Fornecedor_LIC` varchar(50) DEFAULT NULL,
  `ID_Posto` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_LIC`),
  KEY `LIC_Posto` (`ID_Posto`),
  CONSTRAINT `LIC_Posto` FOREIGN KEY (`ID_Posto`) REFERENCES `Posto` (`ID_Posto`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `Login_Posto` (
  `ID_Login` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Func` int(11) DEFAULT NULL,
  `ID_Posto` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Login`),
  KEY `LK_Funcionario` (`ID_Func`),
  KEY `LK_Posto` (`ID_Posto`),
  CONSTRAINT `LK_Funcionario` FOREIGN KEY (`ID_Func`) REFERENCES `Funcionario` (`ID_Func`),
  CONSTRAINT `LK_Posto` FOREIGN KEY (`ID_Posto`) REFERENCES `Posto` (`ID_Posto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `Outros` (
  `ID_Outros` int(11) NOT NULL AUTO_INCREMENT,
  `Modelo_Outros` varchar(50) DEFAULT NULL,
  `ID_Placa` int(11) DEFAULT NULL,
  `ID_Func` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Outros`),
  KEY `PRK_Placa` (`ID_Placa`),
  KEY `PRK_User` (`ID_Func`),
  CONSTRAINT `PRK_Placa` FOREIGN KEY (`ID_Placa`) REFERENCES `Placa_Rede` (`ID_Placa`),
  CONSTRAINT `PRK_User` FOREIGN KEY (`ID_Func`) REFERENCES `Funcionario` (`ID_Func`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `Periferico` (
  `ID_Periferico` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Periferico` varchar(50) DEFAULT '0',
  `Serial_Periferico` varchar(50) DEFAULT '0',
  `ID_Posto` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Periferico`),
  KEY `PRF_Posto` (`ID_Posto`),
  CONSTRAINT `PRF_Posto` FOREIGN KEY (`ID_Posto`) REFERENCES `Posto` (`ID_Posto`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `Placa_Rede` (
  `ID_Placa` int(11) NOT NULL AUTO_INCREMENT,
  `Endereco_Placa` varchar(50) DEFAULT NULL,
  `Endereco_MAC` varchar(50) DEFAULT NULL,
  `Endereco_Subrede` varchar(50) DEFAULT NULL,
  `Endereco_DNS` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Placa`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `Posto` (
  `ID_Posto` int(11) NOT NULL AUTO_INCREMENT,
  `Modelo_Posto` varchar(50) DEFAULT NULL,
  `CPU_Posto` varchar(50) DEFAULT NULL,
  `RAM_Posto` varchar(50) DEFAULT NULL,
  `MB_Posto` varchar(50) DEFAULT NULL,
  `OS_Posto` varchar(50) DEFAULT NULL,
  `ID_Placa` int(11) DEFAULT NULL,
  `ID_Func` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Posto`),
  KEY `PST_Placa` (`ID_Placa`),
  KEY `PST_Func` (`ID_Func`),
  CONSTRAINT `PST_Func` FOREIGN KEY (`ID_Func`) REFERENCES `Funcionario` (`ID_Func`),
  CONSTRAINT `PST_Placa` FOREIGN KEY (`ID_Placa`) REFERENCES `Placa_Rede` (`ID_Placa`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;



SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `DelFich_Log` BEFORE DELETE ON `Ficheiro` FOR EACH ROW BEGIN

	#variáveis
   DECLARE duser varchar(50);

   #Encontrar Funcionario a realizar ação
   SELECT USER() INTO duser;

   #inserir dados no nosso registo de "purgarório", para ficar registado quem apaga um ficheiro/acessos
   INSERT INTO contacts_audit
   ( Nome_Ficheiro,deleted_by)
   VALUES
   ( OLD.Nome_Ficheiro, duser);

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
