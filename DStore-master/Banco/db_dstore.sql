-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06-Dez-2022 às 01:02
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_dstore`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(255) NOT NULL AUTO_INCREMENT,
  `nomeCategoria` varchar(255) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nomeCategoria`) VALUES
(1, 'Placa de vídeo'),
(2, 'Periféricos'),
(3, 'Eletrônicos'),
(4, 'Processadores'),
(5, 'Periféricos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(255) NOT NULL AUTO_INCREMENT,
  `nomeCliente` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `emailCliente` varchar(255) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone_cliente` varchar(15) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(8) NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nomeCliente`, `cpf`, `emailCliente`, `genero`, `data_nascimento`, `telefone_cliente`, `cep`, `estado`, `cidade`, `rua`, `numero`) VALUES
(1, 'Carlos Torres', '444.444.444-44', 'carlos@email.com', 'Masculino', '1985-07-15', '(11) 1111-1111', '55555-555', 'SP', 'Sorocaba', 'qualquer1', '855'),
(2, 'Aline', '333.222.111-33', 'aline@aaa.com', 'Feminino', '1997-09-25', '035 55555533', '98765432', 'BA', 'Salvador', 'sdafsdgsdaga33', '533'),
(4, 'Jennifer', '888.777.666', 'jenifer@jenifer.com', 'Feminino', '1999-05-02', '(55) 5555-5555', '77777-777', 'AP', 'safsafdsgsagsda', 'sdgsdgsagsd', '150'),
(20, 'bruninho', '616.911.119-98', 'bruninho@gmail.com', 'Masculino', '2022-11-30', '(11) 1111-1494', '69291-915', 'SP', 'Itaim', 'cecilio gomides', '13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `idFornecedor` int(255) NOT NULL AUTO_INCREMENT,
  `nomeFornecedor` varchar(300) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `telefoneFornecedor` varchar(15) NOT NULL,
  `emailFornecedor` varchar(255) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  PRIMARY KEY (`idFornecedor`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`idFornecedor`, `nomeFornecedor`, `cnpj`, `telefoneFornecedor`, `emailFornecedor`, `cep`, `estado`, `cidade`) VALUES
(8, 'AMD', '55.555.555/5555-55', '(55) 5555-5555', 'amd@gmail.com', '55555-555', 'SP', 'SÃ£o Paulo'),
(14, 'Intel', '44.444.444/4444-44', '(44) 4444-4444', 'intel@gmail.com', '44444-444', 'SP', 'SÃ£o Paulo'),
(15, 'Redragon', '11.111.111/1111-11', '(55) 2222-2222', 'Redragon@email.com', '55555-555', 'SP', 'SÃ£o Paulo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `idProduto` int(255) NOT NULL AUTO_INCREMENT,
  `nomeProduto` varchar(255) NOT NULL,
  `descricaoProduto` varchar(510) NOT NULL,
  `precoProduto` varchar(255) NOT NULL,
  `idFornecedor` varchar(255) NOT NULL,
  `idCategoria` varchar(255) NOT NULL,
  `dataFabricacao` date NOT NULL,
  `qtdeProduto` int(255) NOT NULL,
  `imagemProduto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `nomeProduto`, `descricaoProduto`, `precoProduto`, `idFornecedor`, `idCategoria`, `dataFabricacao`, `qtdeProduto`, `imagemProduto`) VALUES
(72, 'Teclado', 'Teclado Gamer', '250,00', '8', 'PerifÃ©ricos', '2022-11-29', 20, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `recuperar_senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `data_nascimento`, `cpf`, `cargo`, `cep`, `estado`, `cidade`, `senha`, `recuperar_senha`) VALUES
(1, 'Devenix', 'grupodevenix@gmail.com', '2001-11-27', '222.222.222-22', 'administrador', '66616-191', 'SP', 'Suzano', '$2y$10$5EujzoOI9mV2umQbG9pHienyJNQXsLeuj/xkhtGqaWzskXqFkmfrq', 'NULL'),
(2, 'Amanda', 'amanda@email.com', '2000-05-15', '669.292.994-99', 'Gerente', '08888-888', 'SP', 'Santos', '$2y$10$YqkdoIOrhe4912/qilq0Eeb/Z1lSurNdikgwJCAYLoWA25FhWDuIi', 'NULL'),
(6, 'Carlos', 'carlos@carlos.com', '2000-05-30', '444.444.444-44', 'gerente', '88888-888', 'SP', 'PoÃ¡', '$2y$10$Uj9vfeElkp9bqKiombVrg.Sdo2Iqumigoi58Fw4c9Xlvf3jgDIvDu', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
