

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";





CREATE DATABASE IF NOT EXISTS `msg` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `msg`;


--
-- Table structure for table `schema_table`
--

CREATE TABLE `schema_table` (
  `id` bigint(20) NOT NULL,
  `tablename` text NOT NULL,
  `usr1` text NOT NULL,
  `usr2` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schema_table`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `schema_table`
--
ALTER TABLE `schema_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schema_table`
--
ALTER TABLE `schema_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;


