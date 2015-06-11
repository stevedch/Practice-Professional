-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2015 a las 21:40:29
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dev_wine_cellar`
--

DROP DATABASE IF EXISTS `dev_wine_cellar`;

CREATE DATABASE IF NOT EXISTS `dev_wine_cellar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dev_wine_cellar`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `customer_rut` varchar(9) DEFAULT NULL,
  `customer_name` varchar(80) DEFAULT NULL,
  `customer_lastname` varchar(80) DEFAULT NULL,
  `customer_motherslastname` varchar(80) DEFAULT NULL,
  `customer_address` varchar(254) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`id`, `customer_rut`, `customer_name`, `customer_lastname`, `customer_motherslastname`, `customer_address`) VALUES
(1, '222', 'steve', 's', 's', 's'),
(2, '123123', 'Steven', 'Delgado', 'Chacón', 'los olivos 0536'),
(3, '227397519', 'Steven', 'Delgado', 'Chacon', 'av los naranjos 033');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_detail`
--

DROP TABLE IF EXISTS `invoice_detail`;
CREATE TABLE IF NOT EXISTS `invoice_detail` (
  `id` int(11) NOT NULL,
  `invoice_billingdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_detail_price` decimal(19,3) DEFAULT '0.000',
  `invoice_detail_quantity` int(11) DEFAULT '0',
  `invoice_detail_discount` int(11) DEFAULT '0',
  `invoice_detail_total` decimal(19,3) DEFAULT '0.000',
  `id_customer` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `invoice_detail`
--

INSERT INTO `invoice_detail` (`id`, `invoice_billingdate`, `invoice_detail_price`, `invoice_detail_quantity`, `invoice_detail_discount`, `invoice_detail_total`, `id_customer`, `id_product`) VALUES
(1, '2015-06-10 19:34:06', '12.000', 4, 0, '24.000', 3, 2);

--
-- Disparadores `invoice_detail`
--
DROP TRIGGER IF EXISTS `update_delete_stock`;
DELIMITER $$
CREATE TRIGGER `update_delete_stock` AFTER INSERT ON `invoice_detail`
 FOR EACH ROW BEGIN
      UPDATE
      `product` SET `product_stock_quantity`=(`product_stock_quantity` - NEW.invoice_detail_quantity) WHERE `id`= NEW.id_product;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(80) DEFAULT NULL,
  `product_price` decimal(19,3) DEFAULT '0.000',
  `product_max_discount` decimal(19,3) DEFAULT '0.000',
  `product_stock_quantity` int(11) DEFAULT '0',
  `category_name` varchar(120) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `product_max_discount`, `product_stock_quantity`, `category_name`) VALUES
(1, 'Té Dharamsala', '12.000', '0.000', 6, 'Bebidas'),
(2, 'Cerveza tibetana Barley', '12.000', '0.000', 8, 'Bebidas'),
(3, 'Sirope de regaliz', '12.000', '0.000', 0, 'Condimentos'),
(4, 'Especias Cajun del chef Anton', '12.000', '0.000', 0, 'Condimentos'),
(5, 'Mezcla Gumbo del chef Anton', '12.000', '0.000', 0, 'Condimentos'),
(6, 'Mermelada de grosellas de la abuela', '12.000', '0.000', 0, 'Condimentos'),
(7, 'Peras secas orgánicas del tío Bob', '12.000', '0.000', 0, 'Frutas/Verduras'),
(8, 'Salsa de arándanos Northwoods', '12.000', '0.000', 0, 'Condimentos'),
(9, 'Buey Mishi Kobe', '12.000', '0.000', 0, 'Carnes'),
(10, 'Pez espada', '12.000', '0.000', 0, 'Pescado/Marisco'),
(11, 'Queso Cabrales', '12.000', '0.000', 0, 'Lácteos'),
(12, 'Queso Manchego La Pastora', '12.000', '0.000', 0, 'Lácteos'),
(13, 'Algas Konbu', '12.000', '0.000', 0, 'Pescado/Marisco'),
(14, 'Cuajada de judías', '12.000', '0.000', 0, 'Frutas/Verduras'),
(15, 'Salsa de soja baja en sodio', '12.000', '0.000', 0, 'Condimentos'),
(16, 'Postre de merengue Pavlova', '12.000', '0.000', 0, 'Repostería'),
(17, 'Cordero Alice Springs', '12.000', '0.000', 0, 'Carnes'),
(18, 'Langostinos tigre Carnarvon', '12.000', '0.000', 0, 'Pescado/Marisco'),
(19, 'Pastas de té de chocolate', '12.000', '0.000', 0, 'Repostería'),
(20, 'Mermelada de Sir Rodney', '12.000', '0.000', 0, 'Repostería'),
(21, 'Bollos de Sir Rodney', '12.000', '0.000', 0, 'Repostería'),
(22, 'Pan de centeno crujiente estilo Gustaf', '12.000', '0.000', 0, 'Granos/Cereales'),
(23, 'Pan fino', '12.000', '0.000', 0, 'Granos/Cereales'),
(24, 'Refresco Guaraná Fantástica', '12.000', '0.000', 0, 'Bebidas'),
(25, 'Crema de chocolate y nueces NuNuCa', '12.000', '0.000', 0, 'Repostería'),
(26, 'Ositos de goma Gumbär', '12.000', '0.000', 0, 'Repostería'),
(27, 'Chocolate Schoggi', '12.000', '0.000', 0, 'Repostería'),
(28, 'Col fermentada Rössle', '12.000', '0.000', 0, 'Frutas/Verduras'),
(29, 'Salchicha Thüringer', '12.000', '0.000', 0, 'Carnes'),
(30, 'Arenque blanco del noroeste', '12.000', '0.000', 0, 'Pescado/Marisco'),
(31, 'Queso gorgonzola Telino', '12.000', '0.000', 0, 'Lácteos'),
(32, 'Queso Mascarpone Fabioli', '12.000', '0.000', 0, 'Lácteos'),
(33, 'Queso de cabra', '12.000', '0.000', 0, 'Lácteos'),
(34, 'Cerveza Sasquatch', '12.000', '0.000', 0, 'Bebidas'),
(35, 'Cerveza negra Steeleye', '12.000', '0.000', 0, 'Bebidas'),
(36, 'Escabeche de arenque', '12.000', '0.000', 0, 'Pescado/Marisco'),
(37, 'Salmón ahumado Gravad', '12.000', '0.000', 0, 'Pescado/Marisco'),
(38, 'Vino Côte de Blaye', '12.000', '0.000', 0, 'Bebidas'),
(39, 'Licor verde Chartreuse', '12.000', '0.000', 0, 'Bebidas'),
(40, 'Carne de cangrejo de Boston', '12.000', '0.000', 0, 'Pescado/Marisco'),
(41, 'Crema de almejas estilo Nueva Inglaterr', '12.000', '0.000', 0, 'Pescado/Marisco'),
(42, 'Tallarines de Singapur', '12.000', '0.000', 0, 'Granos/Cereales'),
(43, 'Café de Malasia', '12.000', '0.000', 0, 'Bebidas'),
(44, 'Azúcar negra Malacca', '12.000', '0.000', 0, 'Condimentos'),
(45, 'Arenque ahumado', '12.000', '0.000', 0, 'Pescado/Marisco'),
(46, 'Arenque salado', '12.000', '0.000', 0, 'Pescado/Marisco'),
(47, 'Galletas Zaanse', '12.000', '0.000', 0, 'Repostería'),
(48, 'Chocolate holandés', '12.000', '0.000', 0, 'Repostería'),
(49, 'Regaliz', '12.000', '0.000', 0, 'Repostería'),
(50, 'Chocolate blanco', '12.000', '0.000', 0, 'Repostería'),
(51, 'Manzanas secas Manjimup', '12.000', '0.000', 0, 'Frutas/Verduras'),
(52, 'Cereales para Filo', '12.000', '0.000', 0, 'Granos/Cereales'),
(53, 'Empanada de carne', '12.000', '0.000', 0, 'Carnes'),
(54, 'Empanada de cerdo', '12.000', '0.000', 0, 'Carnes'),
(55, 'Paté chino', '12.000', '0.000', 0, 'Carnes'),
(56, 'Gnocchi de la abuela Alicia', '12.000', '0.000', 0, 'Granos/Cereales'),
(57, 'Raviolis Angelo', '12.000', '0.000', 0, 'Granos/Cereales'),
(58, 'Caracoles de Borgoña', '12.000', '0.000', 0, 'Pescado/Marisco'),
(59, 'Raclet de queso Courdavault', '12.000', '0.000', 0, 'Lácteos'),
(60, 'Camembert Pierrot', '12.000', '0.000', 0, 'Lácteos'),
(61, 'Sirope de arce', '12.000', '0.000', 0, 'Condimentos'),
(62, 'Tarta de azúcar', '12.000', '0.000', 0, 'Repostería'),
(63, 'Sandwich de vegetales', '12.000', '0.000', 0, 'Condimentos'),
(64, 'Bollos de pan de Wimmer', '12.000', '0.000', 0, 'Granos/Cereales'),
(65, 'Salsa de pimiento picante de Luisiana', '12.000', '0.000', 0, 'Condimentos'),
(66, 'Especias picantes de Luisiana', '12.000', '0.000', 0, 'Condimentos'),
(67, 'Cerveza Laughing Lumberjack', '12.000', '0.000', 0, 'Bebidas'),
(68, 'Barras de pan de Escocia', '12.000', '0.000', 0, 'Repostería'),
(69, 'Queso Gudbrandsdals', '12.000', '0.000', 0, 'Lácteos'),
(70, 'Cerveza Outback', '12.000', '0.000', 0, 'Bebidas'),
(71, 'Crema de queso Fløtemys', '12.000', '0.000', 0, 'Lácteos'),
(72, 'Queso Mozzarella Giovanni', '12.000', '0.000', 0, 'Lácteos'),
(73, 'Caviar rojo', '12.000', '0.000', 0, 'Pescado/Marisco'),
(74, 'Queso de soja Longlife', '12.000', '0.000', 0, 'Frutas/Verduras'),
(75, 'Cerveza Klosterbier Rhönbräu', '12.000', '0.000', 0, 'Bebidas'),
(76, 'Licor Cloudberry', '12.000', '0.000', 0, 'Bebidas'),
(77, 'Salsa verde original Frankfurter', '12.000', '0.000', 0, 'Condimentos'),
(78, 'Salsa verde  Wimmer', '12.000', '0.000', 0, 'Condimentos'),
(79, 'Salsa Carnarvon Frankfurter', '12.000', '0.000', 0, 'Condimentos'),
(80, 'Salsa Rodney Frankfurter', '12.000', '0.000', 0, 'Condimentos'),
(81, 'Salsa Rössle Frankfurter', '12.000', '0.000', 0, 'Condimentos'),
(82, 'Salsa Telino Frankfurter', '12.000', '0.000', 0, 'Condimentos'),
(83, 'Cerveza Sir Rhönbräu', '12.000', '0.000', 0, 'Bebidas'),
(84, 'Cerveza Klosterbier Sir', '12.000', '0.000', 0, 'Bebidas'),
(85, 'Cerveza picante Rhönbräu', '12.000', '0.000', 0, 'Bebidas'),
(86, 'Cerveza Klosterbier picante', '12.000', '0.000', 0, 'Bebidas'),
(87, 'Licor Sirope', '12.000', '0.000', 0, 'Bebidas'),
(88, 'Licor Chocolate', '12.000', '0.000', 0, 'Bebidas'),
(89, 'Licor rojo', '12.000', '0.000', 0, 'Bebidas'),
(90, 'Licor Gnocchi', '12.000', '0.000', 0, 'Bebidas'),
(91, 'Queso Escocia', '12.000', '0.000', 0, 'Lácteos'),
(92, 'Queso Gudbrandsdals', '12.000', '0.000', 0, 'Lácteos'),
(93, 'Cerveza Gudbrandsdals', '12.000', '0.000', 0, 'Bebidas'),
(94, 'soja Fløtemys', '12.000', '0.000', 0, 'Lácteos'),
(95, 'Queso Mozzarella Giovanni', '12.000', '0.000', 0, 'Lácteos'),
(96, 'Caviar rojo', '12.000', '0.000', 0, 'Pescado/Marisco'),
(97, 'Queso de soja Longlife', '12.000', '0.000', 0, 'Frutas/Verduras'),
(98, 'Arenque Fløtemys', '12.000', '0.000', 0, 'Pescado/Marisco'),
(99, 'Arenque salado', '12.000', '0.000', 0, 'Pescado/Marisco'),
(100, 'Galletas Arenque', '12.000', '0.000', 0, 'Repostería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider`
--

DROP TABLE IF EXISTS `provider`;
CREATE TABLE IF NOT EXISTS `provider` (
  `id` int(11) NOT NULL,
  `provider_name` varchar(80) DEFAULT NULL,
  `provider_telephone` varchar(45) DEFAULT NULL,
  `provider_address` varchar(254) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provider`
--

INSERT INTO `provider` (`id`, `provider_name`, `provider_telephone`, `provider_address`) VALUES
(1, 'Test 1', '022 6282497', 'test 067 47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_detail`
--

DROP TABLE IF EXISTS `purchase_detail`;
CREATE TABLE IF NOT EXISTS `purchase_detail` (
  `id` int(11) NOT NULL,
  `purchase_billingdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `purchase_detail_unit_value` decimal(19,3) DEFAULT '0.000',
  `purchase_detail_price` decimal(19,3) DEFAULT '0.000',
  `purchase_detail_quantity` int(11) DEFAULT '0',
  `purchase_detail_iva` int(11) DEFAULT '0',
  `purchase_detail_discount` int(11) DEFAULT '0',
  `purchase_detail_value_total` decimal(19,3) DEFAULT '0.000',
  `id_provider` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `purchase_detail`
--

INSERT INTO `purchase_detail` (`id`, `purchase_billingdate`, `purchase_detail_unit_value`, `purchase_detail_price`, `purchase_detail_quantity`, `purchase_detail_iva`, `purchase_detail_discount`, `purchase_detail_value_total`, `id_provider`, `id_product`) VALUES
(1, '2015-06-10 19:33:06', '0.000', '12.630', 12, 19, 0, '1233.000', 1, 2);

--
-- Disparadores `purchase_detail`
--
DROP TRIGGER IF EXISTS `update_stock`;
DELIMITER $$
CREATE TRIGGER `update_stock` AFTER INSERT ON `purchase_detail`
 FOR EACH ROW BEGIN

      UPDATE
      `product` SET `product_stock_quantity`=(`product_stock_quantity`  +  NEW.purchase_detail_quantity) WHERE `id`=   NEW.id_product;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(80) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_user` tinyint(1) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `role` varchar(80) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `mail`, `created_at`, `status_user`, `salt`, `role`) VALUES
(1, 'AdministradorGeneral', '9yH4rRN2gE270CG7sQ16weDXJh0q/C7fr0zGPaKNa7IBvygBL3AySg2+toeqIwOWvuR13zIuh2Par7MOAgArpw==', 'admingeneral@gmail.com', '2015-06-03 04:58:05', 1, '9217615885574022d749ea', 'ROLE_SUPER_ADMIN'),
(2, 'Gerente', '6MxIaMuTWHhhcwOVEddT2F0LGTvjqz0HqxPmuQWWccJiTOUYzgJob6T0JE8joRGO0I41tmal+GwyZMpzW5Rl2w==', 'gerente@gmail.com', '2015-06-03 18:11:22', 1, '109299797556e9a8a0e5ae', 'ROLE_GERENTE'),
(3, 'Operador', 'lVFIyynrIp25tkhVemY23qLzeg2tUogg8NLYkU/+waCvPEyhZTtz/n7zjgc2387VQpSWj/+IuRiHbMR36eJ0ZQ==', 'operador@gmail.com', '2015-06-03 18:12:52', 1, '710570742556e9ae4c50b9', 'ROLE_OPERADOR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_i_d_customer_id` (`id_customer`), ADD KEY `fk_i_d_product_id` (`id_product`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_p_d_provider_id` (`id_provider`), ADD KEY `fk_p_d_product_id` (`id_product`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT de la tabla `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `purchase_detail`
--
ALTER TABLE `purchase_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `invoice_detail`
--
ALTER TABLE `invoice_detail`
ADD CONSTRAINT `fk_i_d_customer_id` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_i_d_product_id` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `purchase_detail`
--
ALTER TABLE `purchase_detail`
ADD CONSTRAINT `fk_p_d_product_id` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_p_d_provider_id` FOREIGN KEY (`id_provider`) REFERENCES `provider` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
