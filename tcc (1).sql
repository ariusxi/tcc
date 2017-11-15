-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 14/11/2017 às 16:44
-- Versão do servidor: 5.7.20-0ubuntu0.16.04.1
-- Versão do PHP: 5.6.31-4+ubuntu16.04.1+deb.sury.org+4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargas`
--

CREATE TABLE `cargas` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `subcategoria` varchar(255) NOT NULL,
  `cep_r` varchar(255) NOT NULL,
  `rua_r` varchar(255) NOT NULL,
  `numero_r` varchar(255) NOT NULL,
  `bairro_r` varchar(255) NOT NULL,
  `cidade_r` varchar(255) NOT NULL,
  `estado_r` varchar(255) NOT NULL,
  `cep_e` varchar(255) NOT NULL,
  `rua_e` varchar(255) NOT NULL,
  `numero_e` varchar(255) NOT NULL,
  `bairro_e` varchar(255) NOT NULL,
  `cidade_e` varchar(255) NOT NULL,
  `estado_e` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `cargas`
--

INSERT INTO `cargas` (`id`, `id_user`, `titulo`, `categoria`, `subcategoria`, `cep_r`, `rua_r`, `numero_r`, `bairro_r`, `cidade_r`, `estado_r`, `cep_e`, `rua_e`, `numero_e`, `bairro_e`, `cidade_e`, `estado_e`, `created_at`) VALUES
(3, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:09:45'),
(4, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:10:50'),
(5, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:11:09'),
(6, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:12:31'),
(7, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:12:56'),
(8, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:13:17'),
(9, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:14:53'),
(10, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:17:22'),
(11, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:18:16'),
(12, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:19:04'),
(13, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:20:28'),
(14, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:21:48'),
(15, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:22:23'),
(16, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:23:44'),
(17, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:25:52'),
(18, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:26:23'),
(19, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:26:46'),
(20, 1, 'teste', '1', '1', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 02:30:58'),
(21, 1, 'teste', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 08:37:32'),
(22, 1, 'teste', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 08:39:08'),
(23, 1, 'teste', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 08:40:45'),
(24, 1, 'teste', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 08:44:13'),
(25, 1, 'teste', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 08:49:11'),
(26, 1, 'teste', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 08:59:48'),
(27, 1, 'teste', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 09:06:33'),
(28, 1, 'teste', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 09:12:22'),
(29, 1, 'MudanÃ§a', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '2017-11-14 09:16:49');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `views`) VALUES
(1, 'Mudancas', 6),
(2, 'Artigos Domesticos', 0),
(3, 'Cargas', 0),
(4, 'Veiculos', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `contato`
--

INSERT INTO `contato` (`id`, `name`, `phone`, `email`, `message`, `created_at`) VALUES
(1, 'Alef Felix de Farias', '1135927481', 'alef.developerweb@gmail.com', 'asdfasdfasdf', '2017-11-13 21:51:07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `items_cargas`
--

CREATE TABLE `items_cargas` (
  `id` int(11) NOT NULL,
  `id_cargas` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `comp` varchar(10) NOT NULL,
  `largura` varchar(10) NOT NULL,
  `altura` varchar(10) NOT NULL,
  `medida` varchar(10) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `quantidade` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `items_cargas`
--

INSERT INTO `items_cargas` (`id`, `id_cargas`, `nome`, `comp`, `largura`, `altura`, `medida`, `peso`, `quantidade`) VALUES
(1, 10, 'teste', '10', '10', '10', 'M', '10', '1'),
(2, 11, 'teste', '10', '10', '10', 'M', '10', '1'),
(3, 12, 'teste', '10', '10', '10', 'M', '10', '1'),
(4, 13, 'teste', '10', '10', '10', 'M', '10', '1'),
(5, 14, 'teste', '10', '10', '10', 'M', '10', '1'),
(6, 15, 'teste', '10', '10', '10', 'M', '10', '1'),
(7, 16, 'teste', '10', '10', '10', 'M', '10', '1'),
(8, 17, 'teste', '10', '10', '10', 'M', '10', '1'),
(9, 18, 'teste', '10', '10', '10', 'M', '10', '1'),
(10, 19, 'teste', '10', '10', '10', 'M', '10', '1'),
(11, 20, 'teste', '10', '10', '10', 'M', '10', '1'),
(12, 21, 'teste', '10', '10', '10', 'M', '10', '1'),
(13, 22, 'teste', '10', '10', '10', 'M', '10', '1'),
(14, 23, 'teste', '10', '10', '10', 'M', '10', '1'),
(15, 24, 'teste', '10', '10', '10', 'M', '10', '1'),
(16, 25, 'teste', '10', '10', '10', 'M', '10', '1'),
(17, 26, 'teste', '10', '10', '10', 'M', '10', '1'),
(18, 27, 'teste', '10', '10', '10', 'M', '10', '1'),
(19, 28, 'teste', '10', '10', '10', 'M', '10', '1'),
(20, 29, 'SofÃ¡', '10', '10', '10', 'M', '10', '1'),
(21, 29, 'TelevisÃ£o', '10', '10', '10', 'M', '10', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `subcategoria` varchar(255) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `id_categoria`, `subcategoria`, `views`) VALUES
(1, 1, 'Apartamento de 3 quartos', 6),
(2, 1, 'Casa de 3 quartos', 0),
(3, 1, 'Casa de 4 quartos', 0),
(4, 1, 'Apartamento de 2 quartos', 0),
(5, 2, 'Moveis', 0),
(6, 2, 'Eletrodomesticos', 0),
(7, 2, 'Antiguidades', 0),
(8, 2, 'Frageis', 0),
(9, 3, 'Carga Fracionada', 0),
(10, 3, 'Carga Completa', 0),
(11, 4, 'Motos', 0),
(12, 4, 'Barcos', 0),
(13, 4, 'Carros', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `rg` varchar(255) NOT NULL,
  `datanasc` varchar(255) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `cpf`, `rg`, `datanasc`, `sexo`, `telefone`, `celular`, `email`, `password`, `level`, `created_at`) VALUES
(1, 'Alef', 'Felix de Farias', '40137300816', '392959008', '1997-10-27', 'F', '1135924781', '11977604520', 'alef.developerweb@gmail.com', '35924781', '0', '2017-11-13 01:22:31'),
(3, 'Transportadora', 'RazÃ£o', '124812874618276', '', '', '', '1135927481', '11977604520', 'transportadora1@transportadora.com', '35924781', '1', '2017-11-13 02:01:46');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cargas`
--
ALTER TABLE `cargas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `items_cargas`
--
ALTER TABLE `items_cargas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cargas`
--
ALTER TABLE `cargas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `items_cargas`
--
ALTER TABLE `items_cargas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
