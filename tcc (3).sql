-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Nov-2017 às 19:08
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargas`
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
  `descricao` text NOT NULL,
  `status` int(11) NOT NULL,
  `proposta` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cargas`
--

INSERT INTO `cargas` (`id`, `id_user`, `titulo`, `categoria`, `subcategoria`, `cep_r`, `rua_r`, `numero_r`, `bairro_r`, `cidade_r`, `estado_r`, `cep_e`, `rua_e`, `numero_e`, `bairro_e`, `cidade_e`, `estado_e`, `descricao`, `status`, `proposta`, `created_at`) VALUES
(1, 1, 'Teste de AnÃºncio', '1', '4', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '01505-010', 'Rua Anita Ferraz', '100', 'SÃ©', 'SÃ£o Paulo', 'SP', 'Teste de AnÃºncio', 3, 2, '2017-11-20 21:43:43'),
(2, 1, 'MudanÃ§a', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 0, 0, '2017-11-20 21:49:10'),
(3, 1, 'teste', '2', '5', '01505-010', 'Rua Anita Ferraz', '100', 'SÃ©', 'SÃ£o Paulo', 'SP', '01505-010', 'Rua Anita Ferraz', '100', 'SÃ©', 'SÃ£o Paulo', 'SP', 'testeeeeeeeeeeeeee', 0, 0, '2017-11-20 22:24:03'),
(4, 1, 'MudanÃ§a', '1', '1', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '686', 'Santa Maria', 'Osasco', 'SP', 'testeeeeeeeeee', 0, 0, '2017-11-21 17:27:14'),
(5, 15, 'MudanÃ§a para Mogi', '1', '3', '06149-260', 'Rua MÃ¡rio Quintana', '969', 'Santa Maria', 'Osasco', 'SP', '06149-260', 'Rua MÃ¡rio Quintana', '969', 'Santa Maria', 'Osasco', 'SP', 'Carga um pouco velha, tomar cuidado.', 0, 0, '2017-11-21 20:45:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `views`) VALUES
(1, 'Mudancas', 12),
(2, 'Artigos Domesticos', 1),
(1, 'Mudancas', 12),
(2, 'Artigos Domesticos', 1),
(3, 'Cargas', 1),
(3, 'Cargas', 1),
(4, 'Veiculos', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracao_frete`
--

CREATE TABLE `configuracao_frete` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `gris` int(11) NOT NULL,
  `despacho` int(11) NOT NULL,
  `tas` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `configuracao_frete`
--

INSERT INTO `configuracao_frete` (`id`, `id_user`, `gris`, `despacho`, `tas`) VALUES
(1, 13, 10, 10, 10),
(2, 16, 30, 20, 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracao_frete_condicoes`
--

CREATE TABLE `configuracao_frete_condicoes` (
  `id` int(11) NOT NULL,
  `id_configuracao` int(11) NOT NULL,
  `frete_peso_liquido` varchar(255) NOT NULL,
  `frete_ad_valorem` varchar(3) NOT NULL,
  `frete_peso_minimo` varchar(255) NOT NULL,
  `frete_km` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `configuracao_frete_condicoes`
--

INSERT INTO `configuracao_frete_condicoes` (`id`, `id_configuracao`, `frete_peso_liquido`, `frete_ad_valorem`, `frete_peso_minimo`, `frete_km`) VALUES
(1, 1, '0', '10', '0', '10'),
(2, 1, '0', '0', '0', '20'),
(3, 1, '0', '0', '0', '30'),
(4, 1, '0', '0', '0', '50'),
(5, 1, '0', '0', '0', '100'),
(6, 1, '0', '0', '0', '999'),
(7, 2, '0', '0', '0', '10'),
(8, 2, '0', '0', '0', '20'),
(9, 2, '0', '0', '0', '30'),
(10, 2, '0', '0', '0', '50'),
(11, 2, '0', '0', '0', '100'),
(12, 2, '0', '0', '0', '999');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
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
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`id`, `name`, `phone`, `email`, `message`, `created_at`) VALUES
(1, 'Alef Felix de Farias', '1135927481', 'alef.developerweb@gmail.com', 'asdfasdfasdf', '2017-11-13 21:51:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `items_cargas`
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
-- Extraindo dados da tabela `items_cargas`
--

INSERT INTO `items_cargas` (`id`, `id_cargas`, `nome`, `comp`, `largura`, `altura`, `medida`, `peso`, `quantidade`) VALUES
(1, 1, 'Teste de AnÃºncio', '10', '10', '10', 'M', '10', '1'),
(2, 2, 'SofÃ¡', '10', '10', '10', 'M', '10', '1'),
(3, 2, 'Refrigerador', '10', '10', '10', 'M', '10', '1'),
(4, 2, 'FogÃ£o', '10', '10', '10', 'M', '10', '1'),
(5, 3, 'teste', '10', '10', '10', 'M', '10', '1'),
(6, 4, 'SofÃ¡', '10', '10', '10', 'M', '10', '2'),
(7, 4, 'Geladeira', '10', '30', '2', 'M', '5', '1'),
(8, 4, 'TelevisÃ£o', '4', '5', '2', 'M', '2', '1'),
(9, 5, 'ArmÃ¡rio', '4', '3', '2', 'M', '8', '1'),
(10, 5, 'SofÃ¡', '3', '2', '3', 'M', '10', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `motorista`
--

CREATE TABLE `motorista` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `rg` varchar(13) NOT NULL,
  `oe` varchar(2) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `nregistro` varchar(12) NOT NULL,
  `cathab` varchar(3) NOT NULL,
  `validade` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `motorista`
--

INSERT INTO `motorista` (`id`, `id_user`, `firstname`, `lastname`, `rg`, `oe`, `cpf`, `nregistro`, `cathab`, `validade`, `created_at`) VALUES
(9, 13, 'teste', 'teste', '12.947.618-28', 'SP', '129.847.129-84', '192847918264', 'A', '2024-10-27', '2017-11-21 15:36:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cargas` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `id_cargas`, `token`, `created_at`) VALUES
(5, 1, 1, 'EC-32M17957589408125', '2017-11-26 00:11:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `proposta`
--

CREATE TABLE `proposta` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `id_cargas` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `peso_total` varchar(255) NOT NULL,
  `peso_tabela` varchar(255) NOT NULL,
  `valor_total` varchar(255) NOT NULL,
  `valor_tabela` varchar(255) NOT NULL,
  `tas` varchar(255) NOT NULL,
  `despacho` varchar(255) NOT NULL,
  `pedagio` varchar(255) NOT NULL,
  `lance_inicial` varchar(255) NOT NULL,
  `lance_minimo` varchar(255) NOT NULL,
  `info_cliente` varchar(1000) NOT NULL,
  `termo_condicoes` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `proposta`
--

INSERT INTO `proposta` (`id`, `status`, `id_cargas`, `id_usuario`, `peso_total`, `peso_tabela`, `valor_total`, `valor_tabela`, `tas`, `despacho`, `pedagio`, `lance_inicial`, `lance_minimo`, `info_cliente`, `termo_condicoes`, `created_at`) VALUES
(1, 0, 2, 13, '0', '0', '0', '0', '0', '0', '0', '1000', '1000', 'testeeeeeeeeeeeeeee', 'testeeeeeeeee', '2017-11-20 22:00:05'),
(2, 1, 1, 13, '0', '0', '0', '0', '0', '0', '0', '1000', '1000', 'teste', 'teste', '2017-11-21 15:32:01'),
(3, 0, 4, 13, '0', '0', '0', '0', '0', '0', '0', '2000', '2000', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2017-11-21 17:35:55'),
(4, 0, 1, 13, '0', '0', '0', '0', '10', '10', '0', '1000', '1000', 'testeusahfiuashfiuhasdyufgasduyfgausydgfyuasdgftyasgdfytasdftgasdfuygasduyfgasudyfgasduyfgausydfgasdfuygasdfuyasgdfuyasdgfuyasgdfuyagsdfuygasdufgasdufygasdufygasduyfg', 'sauydfgausydfuaysdbfuyasdvfutasdvfytasdvftasdvfutavsdf', '2017-11-21 20:15:21'),
(5, 0, 5, 16, '0', '0', '0', '0', '22', '20', '', '10000', '12000', 'wlkÃ§hlsajf poskfaslfdhvkgsdfjoÃ§ghÃ§sldzgkvxnksdfnlfmfsa sifaghfsjvnkea rlghflaks ', 'coisa qualquer', '2017-11-21 21:06:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `subcategoria` varchar(255) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `id_categoria`, `subcategoria`, `views`) VALUES
(1, 1, 'Apartamento de 3 quartos', 10),
(2, 1, 'Casa de 3 quartos', 0),
(3, 1, 'Casa de 4 quartos', 1),
(4, 1, 'Apartamento de 2 quartos', 1),
(5, 2, 'Moveis', 1),
(6, 2, 'Eletrodomesticos', 0),
(7, 2, 'Antiguidades', 0),
(8, 2, 'Frageis', 0),
(9, 3, 'Carga Fracionada', 1),
(10, 3, 'Carga Completa', 0),
(11, 4, 'Motos', 0),
(12, 4, 'Barcos', 0),
(13, 4, 'Carros', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
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
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `cpf`, `rg`, `datanasc`, `sexo`, `telefone`, `celular`, `email`, `password`, `level`, `created_at`) VALUES
(1, 'Alef', 'Felix de Farias', '401.373.008-16', '392959008', '1997-10-27', 'M', '(11)3592-4781', '(11)97760-4520', 'alef.developerweb@gmail.com', '35924781', '0', '2017-11-13 01:22:31'),
(15, 'Anilson', 'Loyola de Melo Nogueira', '111.111.111-11', '11.111.111-1', '1997-02-01', 'M', '(11)2499-6858', '(11)95336-3433', 'anilson.nogueira@gmail.com', '12345678', '0', '2017-11-21 20:35:29'),
(16, 'Papum', 'MudanÃ§as', '60.662.996/0001-22', '', '', '', '(21)9999-9999', '(22)99999-9999', 'emailpapum@gmail.com', '12345678', '1', '2017-11-21 20:48:37'),
(14, 'Alef', 'Felix de Farias', '999.999.999-99', '39.295.900-8', '1997-10-27', 'M', '(11)3592-7481', '(11)97760-4520', '2', '35924781', '0', '2017-11-21 20:13:54'),
(13, 'Transportadora', 'transportes', '38.360.820/0001-67', '', '', '', '(11)3592-4781', '(11)97760-4520', 'transportadora@transportadora.com', '35924781', '1', '2017-11-19 15:50:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `renavam` varchar(255) NOT NULL,
  `chassi` varchar(255) NOT NULL,
  `placa` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `anomodelo` varchar(4) NOT NULL,
  `anofabricacao` varchar(4) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `comentario` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id`, `id_user`, `renavam`, `chassi`, `placa`, `modelo`, `marca`, `anomodelo`, `anofabricacao`, `categoria`, `comentario`, `created_at`) VALUES
(19, 13, 'teste', 'teste', 'tes-1284', 'teste', 'teste', '2001', '2002', 'vuc', 'teste', '2017-11-19 17:45:43'),
(20, 13, 'TESTE', 'TESTE', 'TES-1297', 'teste', 'teste', '2002', '2003', 'vuc', 'teste', '2017-11-21 15:36:52'),
(21, 16, '121212', '121212', '112-1212', '2002', '1', '2001', '2002', 'vuc', '', '2017-11-21 20:54:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cargas`
--
ALTER TABLE `cargas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuracao_frete`
--
ALTER TABLE `configuracao_frete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuracao_frete_condicoes`
--
ALTER TABLE `configuracao_frete_condicoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_cargas`
--
ALTER TABLE `items_cargas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motorista`
--
ALTER TABLE `motorista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposta`
--
ALTER TABLE `proposta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cargas`
--
ALTER TABLE `cargas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `configuracao_frete`
--
ALTER TABLE `configuracao_frete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `configuracao_frete_condicoes`
--
ALTER TABLE `configuracao_frete_condicoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `items_cargas`
--
ALTER TABLE `items_cargas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `motorista`
--
ALTER TABLE `motorista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `proposta`
--
ALTER TABLE `proposta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
