CREATE DATABASE IF NOT EXISTS `palomsg` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `palomsg`;


DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `pseudo` text NOT NULL,
  `contacts` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `pseudo` text NOT NULL,
  `email` text NOT NULL,
  `password` longtext NOT NULL,
  `token` longtext NOT NULL,
  `ip` text NOT NULL,
  `grade` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);


--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

