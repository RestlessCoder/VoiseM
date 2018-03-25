-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: March 15, 2018 at 02:20 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `slotify`
--

-- --------------------------------------------------------

--
-- Table structure for table `Songs`
--

CREATE TABLE IF NOT EXISTS `songs` (
`id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17;

--
-- Dumping data for table `songs`
--
INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`) VALUES
(1, 'If we were destined', 9, 12, 6, '4:13', 'assets/music/ben-ifweweredestined.mp3', 1, 0),
(2, 'Havana', 2, 2, 2, '3:38', 'assets/music/camilacabello-havana.mp3', 2, 0),
(3, 'Thats what i like', 1, 1, 1, '3:35', 'assets/music/brunomars-thatswhatilike.mp3', 1, 0),
(4, 'Symphony', 3, 3, 3, '3:37', 'assets/music/cleanbandit-symphony.mp3', 1, 0),
(5, 'Shape of you', 4, 4, 2, '4:23', 'assets/music/edsheeran-shapeofyou.mp3', 1, 0),
(6, 'Perfect', 4, 4, 2, '4:23', 'assets/music/edsheeran-perfect.mp3', 2, 0),
(7, 'What Kind of Man', 6, 7, 4, '4:47', 'assets/music/jaychou-whatkindofman.mp3', 1, 0),
(8, 'Rhythm of the Rain', 6, 7, 4, '4:39', 'assets/music/jaychou-rhythmoftherain.mp3', 2, 0),
(9, 'On Call 36', 7, 8, 5, '5:17', 'assets/music/joeychung-oncall36.mp3', 1, 0),
(10, '愛你', 11, 5, 4, '4:02', 'assets/music/kimberley-aini.mp3', 1, 0),
(11, 'Witness insecurity', 8, 9, 5, '3:47', 'assets/music/lindachung-witnessinsecurity.mp3', 1, 0),
(12, 'The Moon Represents My Heart', 8, 9, 5, '3:18', 'assets/music/lindachung-themoonrepresentsmyheart.mp3', 2, 0),
(13, 'Treat you better', 5, 6, 2, '3:00', 'assets/music/shawnmendes-treatyoubetter.mp3', 1, 0),
(14, 'Mercy', 5, 6, 2, '3:25', 'assets/music/shawnmendes-mercy.mp3', 2, 0),
(15, 'Stay With Me', 12, 10, 6, '3:12', 'assets/music/chanyeolpunch-staywithme.mp3', 1, 0),
(16, 'Ill be fine', 10, 11, 6, '4:11', 'assets/music/suran-illbefine.mp3 ', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Songs`
--
ALTER TABLE `songs`
ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Songs`
--
ALTER TABLE `songs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
