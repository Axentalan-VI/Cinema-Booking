-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 03, 2023 at 10:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MovieCinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `Movies`
--

CREATE TABLE `Movies` (
  `movie_theater_num` int(11) NOT NULL,
  `movie_title` varchar(100) NOT NULL,
  `movie_runtime` varchar(20) NOT NULL,
  `movie_genre` varchar(100) NOT NULL,
  `movie_poster` varchar(100) NOT NULL,
  `movie_poster2` varchar(100) DEFAULT NULL,
  `movie_releasedate` date NOT NULL,
  `movie_trailer` varchar(100) NOT NULL,
  `movie_director` varchar(100) NOT NULL,
  `movie_description` text NOT NULL,
  `movie_cast` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movies`
--

INSERT INTO `Movies` (`movie_theater_num`, `movie_title`, `movie_runtime`, `movie_genre`, `movie_poster`, `movie_poster2`, `movie_releasedate`, `movie_trailer`, `movie_director`, `movie_description`, `movie_cast`) VALUES
(1, 'Black Adam', '2h 5m', 'Action ,Superhero ,Adventure ,Fantasy ,Science Fiction', '/images/blackadam2.jpg', '/images/blackadam.jpg', '2022-10-19', 'https://www.youtube.com/watch?v=X0tOpBuYasI', 'Jaume Collet-Serra', 'In ancient Kahndaq, Teth Adam was bestowed the almighty powers of the gods. After using these powers for vengeance, he was imprisoned, becoming Black Adam. Nearly 5,000 years have passed, and Black Adam has gone from man to myth to legend. Now free, his unique form of justice, born out of rage, is challenged by modern-day heroes who form the Justice Society: Hawkman, Dr. Fate, Atom Smasher and Cyclone.', 'Dwayne Johnson ,Henry Cavill ,Sarah Shahi ,Noah Centineo ,Quintessa Swindell ,Pierce Brosnan\r\n'),
(2, 'Avatar: The Way of Water', '3h 12m', 'Action, Drama, Adventure, Fantasy ', '/images/Avatar2.jpg', '/images/avatar.jpg', '2022-12-15', 'https://www.youtube.com/watch?v=d9MyW72ELq0', 'James Cameron', 'Jake Sully and Ney\'tiri have formed a family and are doing everything to stay together. However, they must leave their home and explore the regions of Pandora. When an ancient threat resurfaces, Jake must fight a difficult war against the humans.', 'Sam Worthington ,Zoe Saldaña ,Sigourney Weaver ,Kate Winslet , Stephen Lang,Vin Diesel'),
(3, 'Black Panther: Wakanda Forever', '2h 41m', 'Adventure ,Superhero ,Action ,Science Fiction ,Drama', '/images/blackpanther2.jpg', '/images/blackpanther.jpg', '2022-11-09', 'https://www.youtube.com/watch?v=_Z3QKkl1WyM', 'Ryan Coogler', 'Queen Ramonda, Shuri, M\'Baku, Okoye and the Dora Milaje fight to protect their nation from intervening world powers in the wake of King T\'Challa\'s death. As the Wakandans strive to embrace their next chapter, the heroes must band together with Nakia and Everett Ross to forge a new path for their beloved kingdom.', 'Tenoch Huerta ,Letitia Wright ,Michael B. Jordan ,Angela Bassett ,Lupita Nyong\'o ,Dominique Thorne\r\n'),
(4, 'Puss in Boots: The Last Wish', '1h 40m', 'Action ,Comedy ,Animation ,Adventure ,Family Film', '/images/pussinbootes.jpg', NULL, '2022-12-08', 'https://www.youtube.com/watch?v=RqrXhwS33yc', 'Joel Crawford', 'Puss in Boots discovers that his passion for adventure has taken its toll: he has burnt through eight of his nine lives. Puss sets out on an epic journey to find the mythical Last Wish and restore his nine lives.', 'Antonio Banderas ,Salma Hayek ,Florence Pugh ,Harvey Guillen ,Olivia Colman ,John Mulaney'),
(5, 'The Menu', '1h 47m', 'Horror ,Thriller ,Comedy ,Narrative ,Satire ', '/images/the menu.jpg', NULL, '2022-11-17', 'https://www.youtube.com/watch?v=C_uTkUGcHv4', 'Mark Mylod', 'The film, penned by Will Tracy and Seth Reiss, \"focuses on a young couple who visits an exclusive destination restaurant on a remote island where the acclaimed chef has prepared a lavish tasting menu, along with some shocking surprise.\"Deadline notes, \"Fiennes plays the world-class chef who sets it all up and adds some unexpected ingredients to the menu planned. The action follows one particular A-list couple that takes part. I\'ve heard Stone will play half of that couple.\"', 'Anya Taylor-Joy ,Ralph Fiennes ,Nicholas Hoult ,Janet McTeer ,Hong Chau ,Aimee Carrero\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `Reservation`
--

CREATE TABLE `Reservation` (
  `reservation_id` int(11) NOT NULL,
  `seats_id` varchar(20) NOT NULL,
  `num_of_seats` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `showtime_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Reservation`
--

INSERT INTO `Reservation` (`reservation_id`, `seats_id`, `num_of_seats`, `theater_id`, `showtime_id`, `user_id`, `total_price`) VALUES
(1, 'A1,B1,H3,G2', 4, 1, 1, 1, 20.22),
(2, 'B4,C4,G4,H4,A4', 5, 1, 2, 1, 20.22),
(4, 'B5,C5,D5', 3, 2, 5, 1, 250),
(10, 'C1,D1,E1,F1', 4, 4, 2, 1, 240),
(14, 'E2,F2', 2, 2, 2, 29, 120),
(15, 'D1,E1', 2, 1, 4, 29, 100);

-- --------------------------------------------------------

--
-- Table structure for table `Showtime`
--

CREATE TABLE `Showtime` (
  `showtime_id` int(11) NOT NULL,
  `showtime_date` date NOT NULL,
  `showtime_hour` time NOT NULL,
  `showtime_price` double NOT NULL,
  `theater_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Showtime`
--

INSERT INTO `Showtime` (`showtime_id`, `showtime_date`, `showtime_hour`, `showtime_price`, `theater_id`) VALUES
(1, '2023-01-04', '01:30:00', 50, 2),
(2, '2023-01-03', '04:30:00', 60, 2),
(3, '2023-01-03', '07:30:00', 70, 2),
(4, '2023-01-03', '01:30:00', 50, 1),
(5, '2023-01-03', '04:30:00', 60, 1),
(6, '2023-01-03', '07:30:00', 70, 1),
(7, '2023-01-03', '01:30:00', 50, 3),
(8, '2023-01-03', '04:30:00', 60, 3),
(9, '2023-01-03', '07:30:00', 70, 3),
(10, '2023-01-04', '01:30:00', 50, 4),
(11, '2023-01-03', '04:30:00', 60, 4),
(12, '2023-01-03', '07:30:00', 70, 4),
(13, '2023-01-03', '01:30:00', 50, 5),
(14, '2023-01-03', '04:30:00', 60, 5),
(15, '2023-01-03', '07:30:00', 70, 5),
(16, '2023-01-04', '01:30:00', 50, 2),
(17, '2023-01-04', '04:30:00', 60, 2),
(18, '2023-01-04', '07:30:00', 70, 2),
(19, '2023-01-04', '01:30:00', 50, 1),
(20, '2023-01-04', '04:30:00', 60, 1),
(21, '2023-01-04', '07:30:00', 70, 1),
(22, '2023-01-04', '01:30:00', 50, 3),
(23, '2023-01-04', '04:30:00', 60, 3),
(24, '2023-01-04', '07:30:00', 70, 3),
(25, '2023-01-04', '01:30:00', 50, 4),
(26, '2023-01-04', '04:30:00', 60, 4),
(27, '2023-01-04', '07:30:00', 70, 4),
(28, '2023-01-04', '01:30:00', 50, 5),
(29, '2023-01-04', '04:30:00', 60, 5),
(30, '2023-01-04', '07:30:00', 70, 5),
(38, '2023-01-05', '01:30:00', 50, 2),
(39, '2023-01-05', '04:30:00', 60, 2),
(40, '2023-01-05', '07:30:00', 70, 2),
(41, '2023-01-05', '01:30:00', 50, 1),
(42, '2023-01-05', '04:30:00', 60, 1),
(43, '2023-01-05', '07:30:00', 70, 1),
(44, '2023-01-05', '01:30:00', 50, 3),
(45, '2023-01-05', '04:30:00', 60, 3),
(46, '2023-01-05', '07:30:00', 70, 3),
(47, '2023-01-05', '01:30:00', 50, 4),
(48, '2023-01-05', '04:30:00', 60, 4),
(49, '2023-01-05', '07:30:00', 70, 4),
(50, '2023-01-05', '01:30:00', 50, 5),
(51, '2023-01-05', '04:30:00', 60, 5),
(52, '2023-01-05', '07:30:00', 70, 5),
(53, '2023-01-05', '09:30:00', 90, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Soon_Movies`
--

CREATE TABLE `Soon_Movies` (
  `movie_id` int(11) NOT NULL,
  `movie_title` varchar(100) NOT NULL,
  `movie_trailer` varchar(100) NOT NULL,
  `movie_poster` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Soon_Movies`
--

INSERT INTO `Soon_Movies` (`movie_id`, `movie_title`, `movie_trailer`, `movie_poster`) VALUES
(1, 'M3GEN', 'https://youtu.be/BRb4U99OU80', '/images/M3gan.jpg'),
(2, 'A Man Called Otto', 'https://youtu.be/eFYUX9l-m5I', '/images/amancalledotto.jpg'),
(3, 'Mummies', 'https://youtu.be/WRB8YIc4U68', '/images/Mummies.jpg'),
(4, 'John Wick 4', 'https://youtu.be/YuEnpfJb6Yg', '/images/jw4.jpg'),
(5, 'Ant-Man and the Wasp: Quantumania', 'https://youtu.be/ZlNFpri-Y40', '/images/antmananadwasp.jpg'),
(6, 'Bobylon', 'https://youtu.be/t7HT83wkVss', '/images/Bablyon.jpg'),
(7, 'Shazam! Fury of the Gods', 'https://www.youtube.com/watch?v=Zi88i4CpHe4', '/images/Shazam.jpeg'),
(8, 'Spider-Man: Across the Spider-Verse', 'https://www.youtube.com/watch?v=XVnr-yno4l0', '/images/spiderman.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_first_name` varchar(255) DEFAULT NULL,
  `user_last_name` varchar(255) DEFAULT NULL,
  `user_date_of_birth` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_first_name`, `user_last_name`, `user_date_of_birth`) VALUES
(1, 'ismailwafaie@gmail.com', '1234', 'Ismail222', 'Wafaie234', '2003-03-13'),
(2, 'mohamedhassan@gmail.com', '4321', 'Mohamed', 'Hassan', '11-01-2002'),
(29, 'ahmedsherif@gmail.com', '9M5JqYvCfhCfx2m', 'ahmed', 'Sherif', '2023-01-25'),
(30, 'ahmedsherif1589@gmail.com', '9M5JqYvCfhCfx2m', 'shjdb', 'sdkvj', ''),
(31, 'ahmedsherif1589@gmail.com', '9M5JqYvCfhCfx2m', 'jshdb', 'sdjkvhb', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Movies`
--
ALTER TABLE `Movies`
  ADD PRIMARY KEY (`movie_theater_num`);

--
-- Indexes for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `theater_id` (`theater_id`),
  ADD KEY `showtime_id` (`showtime_id`);

--
-- Indexes for table `Showtime`
--
ALTER TABLE `Showtime`
  ADD PRIMARY KEY (`showtime_id`),
  ADD KEY `theater_id` (`theater_id`);

--
-- Indexes for table `Soon_Movies`
--
ALTER TABLE `Soon_Movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Showtime`
--
ALTER TABLE `Showtime`
  MODIFY `showtime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`theater_id`) REFERENCES `Movies` (`movie_theater_num`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`showtime_id`) REFERENCES `Showtime` (`showtime_id`);

--
-- Constraints for table `Showtime`
--
ALTER TABLE `Showtime`
  ADD CONSTRAINT `showtime_ibfk_1` FOREIGN KEY (`theater_id`) REFERENCES `Movies` (`movie_theater_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
