-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2019 at 02:52 AM
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
(13, 4, '2019-07-16 09:26:58', '2019-07-16 09:26:58', 'new'),
(14, 4, '2019-07-17 22:47:43', '2019-07-17 22:47:43', 'new'),
(15, 4, '2019-07-29 18:03:16', '2019-07-29 18:03:16', 'new'),
(16, 4, '2019-07-29 18:04:58', '2019-07-29 18:04:58', 'new'),
(17, 4, '2019-07-29 18:07:42', '2019-07-29 18:07:42', 'new'),
(18, 4, '2019-07-29 18:08:48', '2019-07-29 18:08:48', 'new'),
(19, 4, '2019-07-29 18:09:46', '2019-07-29 18:09:46', 'new'),
(20, 4, '2019-07-29 18:14:52', '2019-07-29 18:14:52', 'new'),
(21, 4, '2019-07-29 18:15:37', '2019-07-29 18:15:37', 'new'),
(22, 4, '2019-07-29 18:18:05', '2019-07-29 18:18:05', 'new'),
(23, 4, '2019-07-29 18:27:56', '2019-07-29 18:27:56', 'new'),
(24, 4, '2019-08-09 13:03:22', '2019-08-09 13:03:22', 'new');

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
(8, 13, 3, 24, '12.85'),
(9, 14, 2, 15, '0.15'),
(10, 14, 3, 23, '12.85'),
(11, 15, 1, 3, '0.09'),
(12, 15, 2, 2, '0.15'),
(13, 16, 1, 3, '0.09'),
(14, 16, 2, 2, '0.15'),
(15, 17, 1, 1, '0.09'),
(16, 17, 2, 1, '0.15'),
(17, 17, 3, 1, '12.85'),
(18, 18, 1, 2, '0.09'),
(19, 18, 2, 2, '0.15'),
(20, 18, 3, 2, '12.85'),
(21, 19, 1, 3, '0.09'),
(22, 19, 2, 3, '0.15'),
(23, 19, 3, 3, '12.85'),
(24, 20, 1, 4, '0.09'),
(25, 20, 2, 4, '0.15'),
(26, 20, 3, 4, '12.85'),
(27, 21, 1, 5, '0.09'),
(28, 21, 2, 5, '0.15'),
(29, 21, 3, 5, '12.85'),
(30, 22, 1, 6, '0.09'),
(31, 22, 2, 6, '0.15'),
(32, 22, 3, 6, '12.85'),
(33, 23, 1, 7, '0.09'),
(34, 23, 2, 7, '0.15'),
(35, 23, 3, 7, '12.85'),
(36, 24, 2, 1, '0.15'),
(37, 24, 3, 1, '12.85'),
(38, 24, 5, 5, '5.78'),
(39, 24, 9, 1, '0.23');

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
  `description` text NOT NULL,
  `rating` float(3,2) NOT NULL,
  `reviews` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `summary`, `description`, `rating`, `reviews`) VALUES
(1, 'Paperclip', '0.09', 'paperclip.jpg', 'Een alledaags kantoorartikel om meerdere vellen papier bijeen te houden.', 'Buig de paperclip open, schuif het papier er tussen en buig de paperclip vervolgens weer bijeen. Werkt goed in combinatie met een kleine hoeveelheid papier. Voor grotere hoeveelheden wordt echter aangeraden een nietje te gebruiken.', 3.50, 2),
(2, 'Strip nietjes', '0.15', 'nietjes.jpg', 'Voor het permanent vastschieten van uw vellen papier. Werkt het beste in combinatie met een nietmachine.', 'Wanneer een paperclip niet voldoende is om uw papier bijeen te houden, schieten nietjes graag te hulp. Doordat nietjes zich rechtstreeks door het papier heen bevestigen, geeft dit een sterkere verbinding dan de gemiddelde paperclip. Veroorzaakt echter wel minimale blijvende schade aan het papier.', 0.00, 0),
(3, 'Nietmachine', '12.85', 'nietmachine.jpg', 'Elk bij elkaar horende stapel papieren heeft een nietmachine nodig.', 'De nietmachine, in combinatie met een rits nietjes, verbindt pagina\'s permanent aan elkaar door het nietje door het papier te schieten en de pootjes om te buigen. Niets houdt deze connectie nu nog tegen!', 0.00, 0),
(4, 'Geurzakje lavendel', '2.19', 'geurzakje_lavendel.jpg', 'Dit is een zakje met lavendel.', 'Zelfgeplukt in de Provence in Zuid-Frankrijk, waar een klooster staat, helemaal in een vallei, prachtig, helemaal bedekt met die blauw-paarse lavendel. En dat is al m\'n hele leven eigenlijk, is dat een plek die ik ongelofelijk mooi vind. Ik vind het leuk om dan, als ik even geen zin meer heb ofzo, dan ruik ik er even aan en dan denk ik dat ik daar ben, en dan kan ik er weer tegen.', 0.00, 0),
(5, 'Luxe balpen', '5.78', 'luxe_balpen.jpg', 'Een alledaags kantoorartikel, maar dan de luxe variant.', 'Voor al uw permanente schrijf- en tekenbehoeften. Ook bruikbaar als balanceeropbject, kauwobject of epicentrum van irritatie van uw collega\'s bij in korte tijd veelvuldig in- en uitschakelen. Buiten het gebruik van creatieve kinderen houden.', 0.00, 0),
(6, 'Luxe vulpen', '6.88', 'luxe_vulpen.jpg', 'Een enigszins ouderwets kantoorartikel, en dan de luxe variant.', 'Voor al uw permanente schrijf- en tekenbehoeften. Ook bruikbaar als balanceeropbject, kauwobject. De inkt in de pen is hervulbaar en daarmee de pen herbruikbaar. Buiten het gebruik van rommelige en onhandige collega\'s houden.', 0.00, 0),
(7, 'Markeerstiften', '0.79', 'markeerstiften.jpg', 'Handig voor het markeren van belangrijke tekst.', 'Het pakket bevat vier markeerstiften met elk een andere kleur. Let op! De stiften drogen na gedurende tijd uit en zijn dan onbruikbaar. Markering is permanent.', 0.00, 0),
(8, 'Schaar', '3.47', 'schaar.jpg', 'Extra stevige schaar om... mee te knippen.', 'Verboden mee te nemen naar o.a. uitgaansgelegenheden, sportevenementen en vliegtuigen.', 0.00, 0),
(9, 'Stressbal', '0.23', 'stressbal.jpg', 'Last van stress? Reageer het hier op af.', 'Niet elke dag kan even soepel verlopen. Om deze dagen toch wat dragelijker te maken, zou iedereen een stressbal moeten hebben. Even knijpen (of desgewenst iets langer) en voel de frustratie weglopen.', 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(9, 'hoi7@hoi.nl', 'hoi', 'awfawefesdf'),
(10, 'bartcommandeur23@gmail.com', 'adminroot123', 'Bart Commandeur'),
(11, 'nerd123@hotmail.com', 'efef', 'efef');

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
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
