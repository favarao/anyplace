-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 14/12/2023 às 05:06
-- Versão do servidor: 8.0.35
-- Versão do PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `anyplace`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncio`
--

CREATE TABLE `anuncio` (
  `id` int NOT NULL,
  `idProduto` int NOT NULL,
  `url` varchar(255) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  `dataAtualizacao` datetime NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int NOT NULL,
  `nome` varchar(125) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracao`
--

CREATE TABLE `configuracao` (
  `id` int NOT NULL,
  `nomeSistema` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nomeAdministrador` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `configuracao`
--

INSERT INTO `configuracao` (`id`, `nomeSistema`, `nomeAdministrador`, `logo`) VALUES
(1, 'anyPlace', 'Guilherme', 'logo.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracaonegociacao`
--

CREATE TABLE `configuracaonegociacao` (
  `id` int NOT NULL,
  `idPessoa` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `tipo` decimal(10,2) NOT NULL,
  `novoValor` decimal(10,2) DEFAULT NULL,
  `novoTipo` decimal(10,2) DEFAULT NULL,
  `dataInicial` date NOT NULL,
  `dataFinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contasreceber`
--

CREATE TABLE `contasreceber` (
  `id` int NOT NULL,
  `idPessoa` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `valorRecebido` decimal(10,2) NOT NULL,
  `dataInicial` date NOT NULL,
  `dataFinal` date NOT NULL,
  `dataRecebimento` date NOT NULL,
  `dataCadastro` datetime NOT NULL,
  `dataAtualizacao` datetime NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `emailcobranca`
--

CREATE TABLE `emailcobranca` (
  `id` int NOT NULL,
  `idContaReceber` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca`
--

CREATE TABLE `marca` (
  `id` int NOT NULL,
  `nome` varchar(125) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `loja` varchar(255) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `contato` varchar(125) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome`, `loja`, `cnpj`, `email`, `telefone`, `celular`, `contato`, `endereco`, `status`) VALUES
(1, 'maria', '', '111111111111111111', '1@1', '1', '1', '123', '1', 1),
(2, '123456', 'LOJA', '11.111.111/1111-11', '12312312@12321312', '1', '(11) 11111-1111', '12321', '1', 1),
(3, '1', '', '111111111111111111', '1@1', '1', '1', '321', '1', 1),
(4, '1', '', '111111111111111111', '1@1', '1', '1', '', '1', 1),
(5, '1', '', '111111111111111111', '1@1', '1', '1', '', '1', 1),
(6, '1', '', '111111111111111111', '1@1', '1', '1', '', '1', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int NOT NULL,
  `idPessoa` int NOT NULL,
  `idCategoria` int NOT NULL,
  `idMarca` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sku` varchar(125) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `descricao` mediumtext NOT NULL,
  `descricaoResumida` varchar(255) NOT NULL,
  `fotos` varchar(255) NOT NULL,
  `dataCadastro` date NOT NULL,
  `dataAtualizacao` date NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `promocao`
--

CREATE TABLE `promocao` (
  `id` int NOT NULL,
  `valor` int NOT NULL,
  `dataInicial` datetime NOT NULL,
  `dataFinal` datetime NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `promocao_produtos`
--

CREATE TABLE `promocao_produtos` (
  `idPromocao` int NOT NULL,
  `idProduto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `login` varchar(125) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(125) COLLATE utf8mb4_general_ci NOT NULL,
  `idCliente` int DEFAULT NULL,
  `grupo` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `idCliente`, `grupo`, `status`) VALUES
(1, 'admin', '4297f44b13955235245b2497399d7a93', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id` int NOT NULL,
  `idAnuncio` int NOT NULL,
  `idContaReceber` int DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduto` (`idProduto`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `configuracao`
--
ALTER TABLE `configuracao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `configuracaonegociacao`
--
ALTER TABLE `configuracaonegociacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPessoa` (`idPessoa`);

--
-- Índices de tabela `contasreceber`
--
ALTER TABLE `contasreceber`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPessoa` (`idPessoa`);

--
-- Índices de tabela `emailcobranca`
--
ALTER TABLE `emailcobranca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idContaReceber` (`idContaReceber`);

--
-- Índices de tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `promocao`
--
ALTER TABLE `promocao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `configuracaonegociacao`
--
ALTER TABLE `configuracaonegociacao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contasreceber`
--
ALTER TABLE `contasreceber`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `emailcobranca`
--
ALTER TABLE `emailcobranca`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `promocao`
--
ALTER TABLE `promocao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
