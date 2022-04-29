CREATE DATABASE `textbooks`;
USE `textbooks`;

CREATE TABLE `renters` (
  `id` int(11) AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ucf_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rented` varchar(255) DEFAULT NULL,
  `checked_out` varchar(244) NOT NULL DEFAULT 'false',
  PRIMARY KEY(`id`)
);

--
-- Dumping data for table `renters`
--

INSERT INTO `renters` (`id`, `first_name`, `last_name`, `email`, `ucf_id`, `username`, `password`, `rented`, `checked_out`) VALUES
(1, 'mykeria', 'cooks', 'test@knights.ucf.edu', 1234567, 'mcooks', '$2y$10$jhSIk2N5BnkEEzgEBWQDw.AUQIEcrH8V0AcNLfW2nkjTAH2WgAAlW', NULL, 'false');
