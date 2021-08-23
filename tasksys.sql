-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 12:38 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasksys`
--

-- --------------------------------------------------------

--
-- Table structure for table `statustype`
--

CREATE TABLE `statustype` (
  `id` smallint(6) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statustype`
--

INSERT INTO `statustype` (`id`, `name`) VALUES
(1, 'Completed'),
(2, 'In Progress'),
(3, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `text` varchar(300) NOT NULL,
  `time` date NOT NULL,
  `userId` int(11) NOT NULL,
  `lng` varchar(300) NOT NULL,
  `lat` varchar(300) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `text`, `time`, `userId`, `lng`, `lat`, `status`) VALUES
(2, 'Ociscivanje', 'Da bude sve cistije mister proper', '2020-01-25', 4, '42.441447', '19.263273', 1),
(5, 'Dostavka', 'Dostaviti potrebne materijale u bemax', '2019-12-28', 3, '43.155024', '18.844474', 2),
(7, 'Very Yes', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more ', '2020-01-15', 3, '42.824970', '19.514490', 1),
(8, 'Sortiranje', 'Sortiranje nove breskve u 3 klase.', '2020-01-09', 3, '43.069519', '19.754910', 3),
(9, 'Autoput', 'Asfaltiranje novog autoputa ', '2019-12-30', 3, '43.139689', '19.599371', 2),
(10, 'Namos', 'Ugradnja klimatizacije u namos salonu namjestaja.', '2020-01-16', 3, '42.55658', '19.08472', 2),
(11, 'Ugradnja Prozora', 'Na onaj baron preko puta faksa da se nakace novi prozori', '2019-12-30', 4, '42.207141', '18.945988', 1),
(12, 'Kopanje kanala', 'Jedan dobar kanal da se ova voda makne sa puta.', '2019-12-28', 21, '42.428303', '19.270615', 2),
(13, 'Poravnanje', 'Poravnati ove trotoare po centru da nam se narod ne spotice', '2020-01-14', 26, '42.444451', '19.253637', 3),
(14, 'Planina', 'It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more', '2020-01-29', 4, '42.448466', '19.273188', 3),
(15, 'Krevet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2020-01-29', 4, '42.447341', '19.259807', 1),
(17, 'Stolica', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '2020-02-05', 26, '42.424724', '19.241509', 1),
(19, 'Jakna', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia', '2020-01-15', 21, '42.436787', '19.235449', 2),
(20, 'Prepelica', 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', '2019-12-29', 21, '42.428303', '19.270615', 2),
(21, 'Nosenje paleta', 'Odnijeti 12 Euro paleta na objekat 4', '2020-03-03', 3, '42.432009', '19.267050', 2),
(23, 'Felicia Pearson', 'We work all over, had bout 5 jobs last month.', '2020-03-03', 26, '42.432009', '19.267050', 2),
(24, 'Mijesanje Stvari', 'Potrebno je izmijesati 520kg breskve za proizvodnju dzema', '2020-05-13', 3, '42.428303', '19.270615', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`) VALUES
(2, 'marko', 'marko', 2),
(3, 'ivan', 'ivan', 2),
(4, 'vladimir', 'vladimir', 2),
(5, 'miroslav', 'miroslav', 4),
(21, 'mirko', 'mirko', 3),
(22, 'nemanja', 'nemanja', 1),
(25, 'misha', 'misha', 4),
(26, 'jovan', 'jovan', 2),
(27, 'jocko', 'jocko', 2);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `name`) VALUES
(1, 'boss'),
(2, 'worker'),
(3, 'manager'),
(4, 'banned');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `statustype`
--
ALTER TABLE `statustype`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `statustype`
--
ALTER TABLE `statustype`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`status`) REFERENCES `statustype` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type`) REFERENCES `usertype` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
