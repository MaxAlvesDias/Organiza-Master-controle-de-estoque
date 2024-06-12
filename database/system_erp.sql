-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Ago-2018 às 18:02
-- Versão do servidor: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_erp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `address_neighborhood` varchar(50) DEFAULT NULL,
  `address_city` varchar(50) DEFAULT NULL,
  `address_state` varchar(50) DEFAULT NULL,
  `address_country` varchar(50) DEFAULT NULL,
  `address_zipcode` varchar(50) DEFAULT NULL,
  `address_number` varchar(50) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `stars` int(1) NOT NULL DEFAULT '3',
  `internal_obs` text,
  `id_company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `address`, `address_neighborhood`, `address_city`, `address_state`, `address_country`, `address_zipcode`, `address_number`, `address2`, `stars`, `internal_obs`, `id_company`) VALUES
(1, 'Reinaldo Nunes Torres de Oliveira 10', 'reinaldo2_olv@live.com', '(11) 3465-5410', 'Rua Arnaldo Guinle', 'Coelho Neto', 'Rio de Janeiro, RJ', 'RJ', 'Brasil', '21530-020', '122', 'ap 3238', 5, 'ok', 1),
(2, 'Reinaldo Nunes Torres de Oliveira', 'reinaldo2_olv@live.com', '(11) 3465-5410', 'Rua Arnaldo Guinle', 'Coelho Neto', 'Rio de Janeiro, RJ', 'RJ', 'Brasil', '21530-020', '122', 'ap 3238', 5, 'ok\\\"', 1),
(3, 'Larissa_Erthal', 'larissa_erthal@live.com', '(11) 3465-5410', 'Rua Arnaldo Guinle', 'Coelho Neto', 'Rio de Janeiro, RJ', 'RJ', 'Brasil', '21530-020', '122', 'ap 3238', 5, 'ok', 1),
(5, 'teste', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1),
(7, 'Desenvolvedores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1),
(8, 'Ze da silva', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1),
(9, 'Fulano', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1),
(10, 'Fulano333', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1),
(11, 'aaaa', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 3, '-', 1),
(12, 'Someone', 'errere@live.com', '(11) 3465-5421', 'Avenida Prefeito SÃ¡ Lessa', 'Coelho Neto', 'Rio de Janeiro', 'RJ', 'Brasil', '21530-040', '122', 'ap 3238', 3, '...', 1),
(13, 'sssss', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 3, '-', 1),
(14, 'teste2121', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 3, '-', 1),
(15, 'testeds', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 3, '-', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(1, 'ADMIN'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `min_quantity` int(11) NOT NULL,
  `id_company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `price`, `quantity`, `min_quantity`, `id_company`) VALUES
(1, 'CD Marcela Bueno - O Que Vejo', 12.99, -103, 10, 1),
(3, 'SofÃ¡', 1534.33, 5, 2, 1),
(4, 'Celular Slim', 2, 10, 20, 1),
(5, 'TV5', 1.21, -2, 5, 1),
(6, 'TV77', 1873.99, 0, 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventory_history`
--

CREATE TABLE `inventory_history` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `action` varchar(8) NOT NULL,
  `date_action` datetime NOT NULL,
  `id_company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `inventory_history`
--

INSERT INTO `inventory_history` (`id`, `id_product`, `id_user`, `action`, `date_action`, `id_company`) VALUES
(41, 1, 1, 'decrease', '2018-08-18 00:56:15', 1),
(42, 1, 1, 'decrease', '2018-08-18 01:33:55', 1),
(43, 3, 1, 'decrease', '2018-08-18 11:47:25', 1),
(44, 1, 1, 'decrease', '2018-08-18 11:47:25', 1),
(45, 3, 1, 'decrease', '2018-08-20 11:49:22', 1),
(46, 1, 1, 'decrease', '2018-08-20 11:49:22', 1),
(47, 1, 1, 'decrease', '2018-08-20 12:23:38', 1),
(48, 3, 1, 'decrease', '2018-08-20 12:24:30', 1),
(49, 5, 1, 'decrease', '2018-08-20 12:25:52', 1),
(50, 6, 1, 'decrease', '2018-08-20 12:26:37', 1),
(51, 1, 1, 'decrease', '2018-08-20 12:33:34', 1),
(52, 3, 1, 'decrease', '2018-08-20 12:33:34', 1),
(53, 1, 1, 'decrease', '2018-08-20 13:04:00', 1),
(54, 5, 1, 'decrease', '2018-08-20 13:05:25', 1),
(55, 1, 1, 'decrease', '2018-08-23 10:35:10', 1),
(56, 3, 1, 'decrease', '2018-08-23 11:09:08', 1),
(57, 3, 1, 'decrease', '2018-08-23 20:08:19', 1),
(58, 3, 1, 'increase', '2018-08-25 01:27:53', 1),
(59, 1, 1, 'increase', '2018-08-25 01:29:46', 1),
(60, 1, 1, 'increase', '2018-08-25 10:46:54', 1),
(61, 3, 1, 'increase', '2018-08-25 13:02:22', 1),
(62, 3, 1, 'increase', '2018-08-25 13:29:44', 1),
(63, 3, 1, 'increase', '2018-08-25 15:16:41', 1),
(64, 3, 1, 'increase', '2018-08-25 15:16:57', 1),
(65, 3, 1, 'increase', '2018-08-25 15:20:55', 1),
(66, 3, 1, 'increase', '2018-08-25 15:22:55', 1),
(67, 3, 1, 'increase', '2018-08-25 15:24:03', 1),
(68, 3, 1, 'increase', '2018-08-25 15:25:50', 1),
(69, 3, 1, 'increase', '2018-08-25 15:26:59', 1),
(70, 3, 1, 'increase', '2018-08-25 15:27:14', 1),
(71, 3, 1, 'increase', '2018-08-25 15:28:10', 1),
(72, 1, 1, 'increase', '2018-08-25 16:55:42', 1),
(73, 3, 1, 'increase', '2018-08-25 16:55:42', 1),
(74, 3, 1, 'increase', '2018-08-25 17:06:28', 1),
(75, 6, 1, 'edit', '2018-08-25 21:05:23', 1),
(76, 1, 1, 'decrease', '2018-08-25 22:55:48', 1),
(77, 1, 1, 'increase', '2018-08-25 22:59:51', 1),
(78, 3, 1, 'increase', '2018-08-25 23:00:25', 1),
(79, 1, 1, 'decrease', '2018-08-25 23:01:33', 1),
(80, 3, 1, 'decrease', '2018-08-25 23:01:34', 1),
(81, 1, 1, 'decrease', '2018-08-25 23:39:35', 1),
(82, 1, 1, 'decrease', '2018-08-25 23:49:38', 1),
(83, 1, 1, 'increase', '2018-08-26 12:57:18', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `params` varchar(200) NOT NULL,
  `id_company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `name`, `params`, `id_company`) VALUES
(1, 'Desenvolvedores', '1,2,8,10,11,12,13,14,15,16,17,18,19,20,21', 1),
(2, 'teste', '1,2,7', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_params`
--

CREATE TABLE `permission_params` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permission_params`
--

INSERT INTO `permission_params` (`id`, `name`, `id_company`) VALUES
(1, 'permission.view', 1),
(2, 'permission.link', 1),
(8, 'users.view', 1),
(10, 'clients.view', 1),
(11, 'clients.edit', 1),
(12, 'clients.view', 1),
(13, 'inventory.view', 1),
(14, 'inventory.add', 1),
(15, 'inventory.edit', 1),
(16, 'sales.view', 1),
(17, 'sales.edit', 1),
(18, 'report.view', 1),
(19, 'purchases.view', 1),
(20, 'resellers.view', 1),
(21, 'resellers.edit', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_purchase` datetime NOT NULL,
  `total_price` float NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_reseller` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `purchases`
--

INSERT INTO `purchases` (`id`, `id_user`, `date_purchase`, `total_price`, `id_company`, `id_reseller`) VALUES
(1, 1, '2018-08-26 12:57:18', 12.99, 1, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `purchases_products`
--

CREATE TABLE `purchases_products` (
  `id` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` float NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `purchases_products`
--

INSERT INTO `purchases_products` (`id`, `id_purchase`, `quantity`, `purchase_price`, `id_company`, `id_product`) VALUES
(1, 1, 1, 12.99, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `resellers`
--

CREATE TABLE `resellers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `id_company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resellers`
--

INSERT INTO `resellers` (`id`, `name`, `email`, `phone`, `id_company`) VALUES
(6, 'Mercado Super Compras', 'supercompras@gmail.com', '(21) 3286-9541', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_sale` datetime NOT NULL,
  `total_price` float NOT NULL,
  `id_company` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sales`
--

INSERT INTO `sales` (`id`, `id_client`, `id_user`, `date_sale`, `total_price`, `id_company`, `status`) VALUES
(6, 3, 1, '2018-08-25 23:49:38', 12.99, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sales_products`
--

CREATE TABLE `sales_products` (
  `id` int(11) NOT NULL,
  `id_sale` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sale_price` float NOT NULL,
  `id_company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sales_products`
--

INSERT INTO `sales_products` (`id`, `id_sale`, `id_product`, `quantity`, `sale_price`, `id_company`) VALUES
(5, 6, 1, 1, 12.99, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `id_group`, `id_company`) VALUES
(1, 'admin', 'net_admin@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1),
(2, 'admin', 'admin@admin', '202cb962ac59075b964b07152d234b70', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_history`
--
ALTER TABLE `inventory_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_params`
--
ALTER TABLE `permission_params`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases_products`
--
ALTER TABLE `purchases_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resellers`
--
ALTER TABLE `resellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_products`
--
ALTER TABLE `sales_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory_history`
--
ALTER TABLE `inventory_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permission_params`
--
ALTER TABLE `permission_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchases_products`
--
ALTER TABLE `purchases_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resellers`
--
ALTER TABLE `resellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales_products`
--
ALTER TABLE `sales_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
