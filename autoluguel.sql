-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23-Mar-2019 às 22:22
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autoluguel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `preco_base` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `preco_base`) VALUES
(1, 'Básico', '50.00'),
(2, 'Intermediário', '100.00'),
(3, 'Luxuoso', '150.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(20) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `email`, `senha`) VALUES
(1, 'Murilo Carvalho de Freitas ', 'murilocarvalhodfreitas@gmail.com', '123'),
(2, 'Mara Carvalho de Freitas', 'maracarvalho68@yahoo.com.br', '123456'),
(3, 'Gabriel Maia', 'maia@gmail.com', 'maia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `distancia`
--

CREATE TABLE `distancia` (
  `id_distancia` int(11) NOT NULL,
  `local1` int(11) NOT NULL,
  `local2` int(11) NOT NULL,
  `distancia` double(20,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `distancia`
--

INSERT INTO `distancia` (`id_distancia`, `local1`, `local2`, `distancia`) VALUES
(1, 1, 3, 130.00000),
(2, 1, 2, 100.00000),
(3, 3, 2, 30.00000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE `local` (
  `id_local` int(11) NOT NULL,
  `local` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `local`
--

INSERT INTO `local` (`id_local`, `local`) VALUES
(1, 'Fortaleza'),
(2, 'Salvador'),
(3, 'Recife');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `retirada` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `devolucao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `diaria` double NOT NULL,
  `preco_total` int(11) NOT NULL,
  `atraso` tinyint(1) NOT NULL,
  `local_retirada` int(11) NOT NULL,
  `local_devolucao` int(11) NOT NULL,
  `cadeira_infantil` tinyint(1) NOT NULL,
  `gps` tinyint(1) NOT NULL,
  `kit_conectividade` tinyint(1) NOT NULL,
  `kit_protecao` int(11) NOT NULL,
  `devolvido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `id_cliente`, `id_veiculo`, `retirada`, `devolucao`, `diaria`, `preco_total`, `atraso`, `local_retirada`, `local_devolucao`, `cadeira_infantil`, `gps`, `kit_conectividade`, `kit_protecao`, `devolvido`) VALUES
(1, 1, 1, '2019-03-17 23:01:00', '2019-03-20 23:01:00', 154, 462, 0, 1, 3, 1, 1, 0, 2, 1),
(2, 1, 2, '2019-03-20 00:09:00', '2019-03-21 00:09:00', 143, 143, 0, 3, 1, 0, 1, 1, 1, 1),
(3, 1, 1, '2019-03-18 03:25:00', '2019-03-22 03:25:00', 154, 616, 0, 3, 3, 1, 1, 1, 2, 1),
(4, 1, 1, '2019-03-20 15:24:00', '2019-03-27 15:24:00', 108, 756, 0, 1, 3, 0, 1, 1, 2, 1),
(5, 1, 2, '2019-03-20 16:18:00', '2019-03-26 16:18:00', 158, 948, 0, 2, 1, 0, 1, 1, 2, 0),
(6, 3, 1, '2019-03-20 17:45:00', '2019-03-21 17:45:00', 93, 93, 0, 1, 2, 0, 1, 1, 1, 1),
(7, 3, 3, '2019-03-21 20:53:00', '2019-03-22 20:53:00', 208, 218, 1, 1, 2, 0, 1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id_veiculo` int(20) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `qtd_ocupantes` int(11) NOT NULL,
  `qtd_bagagem` int(11) NOT NULL,
  `qtd_porta` int(11) NOT NULL,
  `motorizacao` varchar(10) NOT NULL,
  `ar_cond` tinyint(1) NOT NULL,
  `usb` tinyint(1) NOT NULL,
  `air_bag` tinyint(1) NOT NULL,
  `abs` tinyint(1) NOT NULL,
  `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id_veiculo`, `placa`, `modelo`, `qtd_ocupantes`, `qtd_bagagem`, `qtd_porta`, `motorizacao`, `ar_cond`, `usb`, `air_bag`, `abs`, `categoria`) VALUES
(1, 'HYX-6661', 'FORD FIESTA 2009', 5, 10, 4, '1.0', 1, 1, 0, 0, 1),
(2, 'XYX-5689', 'HONDA CIVIC 2012', 5, 15, 4, '1.8', 1, 1, 1, 1, 2),
(3, 'BBC-8654', 'JEEP RENEGADE 2019', 5, 20, 4, '2.0', 1, 1, 1, 1, 3),
(4, 'IDM-2002', 'FIAT  UNO MILLE 2013', 5, 5, 2, '1.0', 1, 0, 0, 0, 1),
(5, 'INT-2019', 'RANGE ROVER 2015', 5, 18, 4, '2.0', 1, 1, 1, 1, 3),
(6, 'PPO-5120', 'CHEVROLET COBALT 2019', 5, 8, 4, '1.8', 1, 1, 1, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `distancia`
--
ALTER TABLE `distancia`
  ADD PRIMARY KEY (`id_distancia`),
  ADD KEY `fk_id_local` (`local1`),
  ADD KEY `fk_id_local2` (`local2`);

--
-- Indexes for table `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`id_local`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id_veiculo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `distancia`
--
ALTER TABLE `distancia`
  MODIFY `id_distancia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `local`
--
ALTER TABLE `local`
  MODIFY `id_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id_veiculo` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `distancia`
--
ALTER TABLE `distancia`
  ADD CONSTRAINT `fk_id_local` FOREIGN KEY (`local1`) REFERENCES `local` (`id_local`),
  ADD CONSTRAINT `fk_id_local2` FOREIGN KEY (`local2`) REFERENCES `local` (`id_local`);

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
