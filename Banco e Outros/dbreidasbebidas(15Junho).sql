-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Jun-2020 às 23:23
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbreidasbebidas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `codCliente` int(11) NOT NULL,
  `tipoCliente` int(11) NOT NULL,
  `nomeCliente` varchar(250) NOT NULL,
  `cpf_cnpj` varchar(20) NOT NULL,
  `fixo` varchar(20) DEFAULT NULL,
  `movel` varchar(20) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `nomeRepresentante` varchar(250) DEFAULT NULL,
  `ativo` int(11) NOT NULL,
  `endereco_codEndereco` int(11) NOT NULL,
  `fkusuario` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `codEndereco` int(11) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `logradouro` varchar(150) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `numero` varchar(30) NOT NULL,
  `uf` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`codEndereco`, `cep`, `cidade`, `logradouro`, `bairro`, `complemento`, `numero`, `uf`) VALUES
(1, '71060-639', 'Brasília', 'QI 23 Lote 14', 'Guará II', 'Ap', '202', 'DF'),
(2, '71050-060', 'Brasília', 'QE 13 Conjunto F', 'Guará II', 'Conjunto d', '6', 'DF');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `idfornecedor` int(11) NOT NULL,
  `nomeFantasia` varchar(255) DEFAULT NULL,
  `razaoSocial` varchar(255) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `logradouro` varchar(150) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `numero` varchar(30) NOT NULL,
  `uf` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtolote`
--

CREATE TABLE `produtolote` (
  `codLote` int(11) NOT NULL,
  `nomeProduto` varchar(100) NOT NULL,
  `dataProduto` varchar(255) NOT NULL,
  `qtdEstoque` int(11) NOT NULL,
  `valorCompra` decimal(18,2) NOT NULL,
  `valorVenda` decimal(18,2) NOT NULL,
  `situacao` text NOT NULL,
  `descricao` text NOT NULL,
  `dataValidade` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `fornecedor_idfornecedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(250) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `perfil` int(11) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`email`, `nome`, `telefone`, `senha`, `perfil`, `ativo`) VALUES
('eduardo@gmail.com', 'Eduardo', '(61)88888-8888', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 0),
('patricia@gmail.com', 'Patrícia Mota', '(61)95555-5555', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `codVenda` int(11) NOT NULL,
  `qtdVenda` int(11) NOT NULL,
  `horaVenda` time NOT NULL,
  `dataVenda` date NOT NULL,
  `dataPagamento` date NOT NULL,
  `formaPagamento` int(11) NOT NULL,
  `valorTotal` decimal(18,2) NOT NULL,
  `descontoVenda` int(11) DEFAULT NULL,
  `statusVenda` int(11) NOT NULL,
  `codVendaEstorno` int(11) DEFAULT NULL,
  `descricaoEstorno` text DEFAULT NULL,
  `cliente_codCliente` int(11) NOT NULL,
  `endereco_codEndereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda_produtolote`
--

CREATE TABLE `venda_produtolote` (
  `fkVenda` int(11) NOT NULL,
  `fkProdutoLote` int(11) NOT NULL,
  `qtdProduto` int(11) NOT NULL,
  `subtotal` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codCliente`),
  ADD KEY `fk_Cliente_endereco_idx` (`endereco_codEndereco`),
  ADD KEY `fk_cliente_usuario1_idx` (`fkusuario`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`codEndereco`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idfornecedor`);

--
-- Índices para tabela `produtolote`
--
ALTER TABLE `produtolote`
  ADD PRIMARY KEY (`codLote`),
  ADD KEY `fk_produtoLote_fornecedor1_idx` (`fornecedor_idfornecedor`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`codVenda`),
  ADD KEY `fk_venda_Cliente1_idx` (`cliente_codCliente`),
  ADD KEY `fk_venda_endereco1_idx` (`endereco_codEndereco`);

--
-- Índices para tabela `venda_produtolote`
--
ALTER TABLE `venda_produtolote`
  ADD PRIMARY KEY (`fkVenda`,`fkProdutoLote`),
  ADD KEY `fkProdutoLote` (`fkProdutoLote`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `codEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_Cliente_endereco` FOREIGN KEY (`endereco_codEndereco`) REFERENCES `endereco` (`codEndereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cliente_usuario1` FOREIGN KEY (`fkusuario`) REFERENCES `usuario` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produtolote`
--
ALTER TABLE `produtolote`
  ADD CONSTRAINT `fk_produtoLote_fornecedor1` FOREIGN KEY (`fornecedor_idfornecedor`) REFERENCES `fornecedor` (`idfornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_venda_Cliente1` FOREIGN KEY (`cliente_codCliente`) REFERENCES `cliente` (`codCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venda_endereco1` FOREIGN KEY (`endereco_codEndereco`) REFERENCES `endereco` (`codEndereco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `venda_produtolote`
--
ALTER TABLE `venda_produtolote`
  ADD CONSTRAINT `venda_produtolote_ibfk_2` FOREIGN KEY (`fkProdutoLote`) REFERENCES `produtolote` (`codLote`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `venda_produtolote_ibfk_3` FOREIGN KEY (`fkVenda`) REFERENCES `venda` (`codVenda`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
