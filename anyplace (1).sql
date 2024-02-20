-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 20/02/2024 às 02:06
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
  `nomeSistema` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomeAdministrador` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `configuracao`
--

INSERT INTO `configuracao` (`id`, `nomeSistema`, `nomeAdministrador`, `logo`) VALUES
(1, 'anyPlace 2', 'Guilherme', 'logo.png');

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
  `dataEnvio` date NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotoProduto`
--

CREATE TABLE `fotoProduto` (
  `id` int NOT NULL,
  `idProduto` int NOT NULL,
  `foto1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fotoProduto`
--

INSERT INTO `fotoProduto` (`id`, `idProduto`, `foto1`, `foto2`, `foto3`) VALUES
(1, 12, '', '', ''),
(2, 13, 'colar.png', 'conceitual.png', 'Diag. Seq RF_F2.png'),
(3, 14, 'F3 diagram.png', 'RF_F3.png', 'UseCase Diagram0.png'),
(4, 15, '', '', ''),
(5, 16, 'F3 diagram.png', 'RF_F3.png', 'UseCase Diagram0.png'),
(6, 17, '', '', ''),
(7, 18, '', '', ''),
(8, 19, 'F3 diagram.png', 'conceitual.png', 'Diag. Seq RF_F2.png'),
(9, 20, '', '', ''),
(10, 21, 'F3 diagram.png', 'conceitual.png', 'Diag. Seq RF_F2.png'),
(11, 22, 'RF_F7.png', 'conceitual.png', 'RF_F10.png'),
(12, 23, 'F3 diagram.png', 'RF_F3.png', 'UseCase Diagram0.png'),
(13, 24, '', '', ''),
(14, 25, 'colar.png', 'Class Diagram0.png', 'conceitual.png'),
(15, 26, 'produto1.png', 'produto2.png', 'produto3.png'),
(16, 27, 'produto1.png', 'produto2.png', 'produto3.png'),
(17, 28, 'produto2.png', '', '');

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
(9, 'maria', 'loja', '11.111.111/1111-11', 'maria@maria', '(33) 3333-3333', '(33) 33333-3333', 'maria', 'rua maria', 1),
(10, 'joao pedro favarao vieira', 'Loja joao', '12.312.321/3213-11', 'joao@live.com', '(11) 1111-1111', '(99) 9999-99999', 'joao ti', 'rua tal,1', 1),
(11, 'gdfgdssdsdfdsfsd', 'dsfsdsdf', '45.555.555/5555-55', 'dsfsdf@refdg', '(55) 5555-5555', '(55) 55555-5555', '34534534', '5434353', 999);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int NOT NULL,
  `idCliente` int NOT NULL,
  `idCategoria` int NOT NULL,
  `idMarca` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sku` varchar(125) NOT NULL,
  `valor` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estoque` int NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `descricao` mediumtext NOT NULL,
  `descricaoResumida` varchar(255) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `idCliente`, `idCategoria`, `idMarca`, `nome`, `sku`, `valor`, `estoque`, `peso`, `descricao`, `descricaoResumida`, `status`) VALUES
(6, 8, 1, 1, 'bermudaaa', '123111', 50.00, 10, 5.00, 'completa', 'res', 1),
(7, 7, 1, 1, 'lápis', '11111', 2.00, 100, 0.00, 'teste', '', 1),
(8, 8, 2, 2, '3333', '333', 333.33, 33, 33.00, '333', '333', 1),
(9, 8, 2, 2, '3333', '333', 333.33, 33, 33.00, '333', '333', 999),
(10, 8, 2, 2, '3333', '333', 333.33, 33, 33.00, '333', '333', 999),
(11, 8, 2, 2, '3333', '333', 333.33, 33, 33.00, '333', '333', 999),
(12, 8, 2, 2, '3333', '333', 333.33, 33, 33.00, '333', '333', 1),
(13, 8, 2, 2, '3333', '333', 333.33, 33, 33.00, '333', '333', 1),
(14, 7, 1, 1, 'bola', 'mvlcksm', 40.00, 23, 5.00, 'bola comum', 'bola', 1),
(15, 7, 1, 1, 'bola', 'mvlcksm', 40.00, 23, 5.00, 'bola comum', 'bola', 1),
(16, 7, 1, 1, 'bola', 'mvlcksm', 40.00, 23, 5.00, 'bola comum', 'bola', 1),
(17, 7, 1, 1, 'bola', 'mvlcksm', 40.00, 23, 5.00, 'bola comum', 'bola', 1),
(18, 0, 0, 0, '', '', 0.00, 0, 0.00, '', '', 1),
(19, 8, 1, 1, 'produto', '1233333333333', 33344.44, 44, 4.00, '4444444444', '4444444', 999),
(20, 0, 0, 0, '', '', 0.00, 0, 0.00, '', '', 1),
(21, 8, 1, 1, 'produto', '1233333333333', 33344.44, 44, 4.00, '4444444444', '4444444', 999),
(22, 8, 1, 1, 'produto', '1233333333333', 33344.44, 44, 4.00, '4444444444', '4444444', 999),
(23, 7, 1, 1, 'bola', 'mvlcksm', 40.00, 23, 5.00, 'bola comum', 'bola', 1),
(24, 7, 1, 1, 'bola', 'mvlcksm', 40.00, 23, 5.00, 'bola comum', 'bola', 1),
(25, 7, 1, 1, 'carro', '111111', 11.11, 11, 111.00, '1111', '1111', 1),
(26, 10, 1, 1, 'prod6', '12366', 1.23, 12, 2.00, '333', '333', 1),
(27, 10, 1, 1, 'bermuda', '123234', 50.00, -50, 5.00, 'Descrição Completa', 'Resumida', 1),
(28, 10, 1, 1, '34543', '43534543', 345.34, 444, 34.00, 'Descrição Completa', 'blablabla', 1);

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
  `login` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idCliente` int DEFAULT NULL,
  `grupo` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `idCliente`, `grupo`, `status`) VALUES
(1, 'admin', '4297f44b13955235245b2497399d7a93', NULL, 1, 1),
(5, 'maria2', '202cb962ac59075b964b07152d234b70', 9, 2, 1),
(6, 'joaopedro', 'e10adc3949ba59abbe56e057f20f883e', 10, 2, 1),
(7, 'teste', '202cb962ac59075b964b07152d234b70', 11, 2, 1);

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
-- Índices de tabela `fotoProduto`
--
ALTER TABLE `fotoProduto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduto` (`idProduto`);

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
-- Índices de tabela `promocao_produtos`
--
ALTER TABLE `promocao_produtos`
  ADD KEY `idProduto` (`idProduto`),
  ADD KEY `idPromocao` (`idPromocao`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAnuncio` (`idAnuncio`),
  ADD KEY `idContaReceber` (`idContaReceber`);

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
-- AUTO_INCREMENT de tabela `fotoProduto`
--
ALTER TABLE `fotoProduto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `promocao`
--
ALTER TABLE `promocao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `anuncio_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `configuracaonegociacao`
--
ALTER TABLE `configuracaonegociacao`
  ADD CONSTRAINT `configuracaonegociacao_ibfk_1` FOREIGN KEY (`idPessoa`) REFERENCES `pessoa` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `contasreceber`
--
ALTER TABLE `contasreceber`
  ADD CONSTRAINT `contasreceber_ibfk_1` FOREIGN KEY (`idPessoa`) REFERENCES `pessoa` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `emailcobranca`
--
ALTER TABLE `emailcobranca`
  ADD CONSTRAINT `emailcobranca_ibfk_1` FOREIGN KEY (`idContaReceber`) REFERENCES `contasreceber` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `fotoProduto`
--
ALTER TABLE `fotoProduto`
  ADD CONSTRAINT `fotoProduto_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `promocao_produtos`
--
ALTER TABLE `promocao_produtos`
  ADD CONSTRAINT `promocao_produtos_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `promocao_produtos_ibfk_2` FOREIGN KEY (`idPromocao`) REFERENCES `promocao` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`idAnuncio`) REFERENCES `anuncio` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`idContaReceber`) REFERENCES `contasreceber` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
