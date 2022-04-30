CREATE DATABASE `textbook`;
USE `textbook`;

CREATE TABLE `renters` (
  `id` int(11) AUTO_INCREMENT,
  `username` varchar(255),
  `password` varchar(255),
  `first_name` varchar(255),
  `last_name` varchar(255),
  `ucf_id` int(11),
  `email` varchar(255),
  `rented` varchar(255),
  `checked_out` varchar(255),
  PRIMARY KEY(`id`)
);

INSERT INTO `renters` (`id`, `username`, `password`, `first_name`, `last_name`, `ucf_id`, `email`) VALUES
(1, 'dan', '$2y$10$jhSIk2N5BnkEEzgEBWQDw.AUQIEcrH8V0AcNLfW2nkjTAH2WgAAlW', 'daniel', 'cox', '1234', 'test@email.com');
