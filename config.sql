CREATE DATABASE IF NOT EXISTS `openedmsg` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE DATABASE IF NOT EXISTS `msg` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `openedmsg`;

-- --------------------------------------------------------


DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `contacts` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lang`;
CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `language` text NOT NULL,
  `country` text NOT NULL,
  `is_this` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `email` text NOT NULL,
  `password` longtext NOT NULL,
  `token` longtext NOT NULL,
  `ip` text NOT NULL,
  `grade` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);



ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;


use `msg`;


CREATE TABLE `schema_table` (
  `id` bigint(20) NOT NULL,
  `tablename` text NOT NULL,
  `usr1` text NOT NULL,
  `usr2` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `schema_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `schema_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

