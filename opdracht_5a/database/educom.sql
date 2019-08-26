-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2019 at 05:37 AM
-- Server version: 5.7.23
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `educom`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_ordered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(254) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date_ordered`, `date_modified`, `status`) VALUES
(10, 4, '2019-07-12 13:43:48', '2019-07-12 13:43:48', 'new'),
(11, 4, '2019-07-12 13:46:59', '2019-07-12 13:46:59', 'new'),
(12, 4, '2019-07-12 14:07:07', '2019-07-12 14:07:07', 'new'),
(13, 4, '2019-07-16 09:26:58', '2019-07-16 09:26:58', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_unit` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `quantity`, `price_unit`) VALUES
(1, 10, 1, 15, '0.09'),
(2, 10, 2, 300, '0.15'),
(3, 10, 3, 20, '12.85'),
(4, 11, 1, 2, '0.09'),
(5, 11, 2, 8, '0.15'),
(6, 12, 1, 1, '0.09'),
(7, 13, 2, 23, '0.15'),
(8, 13, 3, 24, '12.85');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(254) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `image` varchar(254) NOT NULL,
  `summary` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `summary`, `description`) VALUES
(1, 'Paperclip', '0.09', 'paperclip.jpg', 'Een alledaags kantoorartikel om meerdere vellen papier bijeen te houden.', 'Buig de paperclip open, schuif het papier er tussen en buig de paperclip vervolgens weer bijeen. Werkt goed in combinatie met een kleine hoeveelheid papier. Voor grotere hoeveelheden wordt echter aangeraden een nietje te gebruiken.'),
(2, 'Strip nietjes', '0.15', 'nietjes.jpg', 'Voor het permanent vastschieten van uw vellen papier. Werkt het beste in combinatie met een nietmachine.', 'Wanneer een paperclip niet voldoende is om uw papier bijeen te houden, schieten nietjes graag te hulp. Doordat nietjes zich rechtstreeks door het papier heen bevestigen, geeft dit een sterkere verbinding dan de gemiddelde paperclip. Veroorzaakt echter wel minimale blijvende schade aan het papier.'),
(3, 'Nietmachine', '12.85', 'nietmachine.jpg', 'Elk bij elkaar horend stapel papieren heeft een nietmachine nodig.', 'De nietmachine, in combinatie met een rits nietjes, verbindt pagina\'s permanent aan elkaar door het nietje door het papier te schieten en de pootjes om te buigen. Niets houdt deze connectie nu nog tegen!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`) VALUES
(1, 'coach@man-kind.nl', 'halt!', 'Geert Weggemans'),
(2, 'asdf@asdf.asdf', 'asdf', 'test1 asdf'),
(4, 'hoi@hoi.nl', 'hoi', 'Hoi McHooi'),
(5, 'hoi3@hoi.nl', 'hoi3', 'asdfef'),
(6, 'hoi4@hoi.nl', 'hoi4', 'hoi4 hoi44'),
(7, 'hoi5@hoi.nl', 'hoi', 'hoi5 hoi55'),
(8, 'hoi6@hoi.nl', 'hoi', 'HOOOI6 McHooi6'),
(9, 'hoi7@hoi.nl', 'hoi', 'awfawefesdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
