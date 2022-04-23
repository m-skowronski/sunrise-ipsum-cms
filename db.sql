-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2022 at 12:16 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(11) NOT NULL,
  `pageName` tinytext COLLATE utf8mb4_polish_ci NOT NULL,
  `menuOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idMenu`, `pageName`, `menuOrder`) VALUES
(1, 'Strona główna', 1),
(2, 'Przykładowa strona', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `idPages` int(11) NOT NULL,
  `pageName` tinytext COLLATE utf8mb4_polish_ci NOT NULL,
  `pageURI` tinytext COLLATE utf8mb4_polish_ci NOT NULL,
  `metaTitle` tinytext COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `metaDesc` tinytext COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `pageHeader` mediumtext COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `pageContent` longtext COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`idPages`, `pageName`, `pageURI`, `metaTitle`, `metaDesc`, `pageHeader`, `pageContent`) VALUES
(1, 'Strona główna', '', 'Witaj w Sunrise Ipsum CMS!', 'Sunrise Ipsum - prosty system CMS umożliwiający tworzenie artykułów oraz edycję sekcji head w ramach optymalizacji SEO.', 'Witaj w Sunrise Ipsum!', '<h3>Zarządzanie systemem CMS</h3>\r\n<p>Ten prosty CMS umożliwia dodawanie stron, edycję ich kolejności w menu oraz edycję sekcji head i tworzenie przyjaznych link&oacute;w w celu optymalizacji witryny pod kątem SEO.</p>\r\n<p>Aby zarządzać swoją witryną przejdź do <code><a href=\"http://localhost/admin/\">panelu administratora</a>.</code></p>'),
(2, 'Przykładowa strona', 'Przyk%C5%82adowa%20strona', 'Przykładowa strona - Sunrise Ipsum CMS', 'Przykładowa strona utworzone w Sunrise Ipsum CMS.', 'Oto przykładowa strona', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin aliquam aliquam tortor pulvinar accumsan. Phasellus sagittis in augue pellentesque faucibus. Sed dignissim nibh sit amet nisl varius accumsan quis vel neque. Suspendisse gravida tellus quis blandit tempor. Integer ut erat eu nibh accumsan porttitor. Nam maximus iaculis ultricies. Suspendisse ac mauris eu mauris facilisis blandit. Sed dignissim, orci vel tristique hendrerit, urna lacus tempus tortor, sed iaculis tortor sapien bibendum odio. Nam sit amet ex magna. Nullam justo neque, ullamcorper eget erat id, porta condimentum felis. Ut interdum mollis fermentum. Pellentesque consequat viverra neque at ullamcorper. Etiam mollis molestie dolor at venenatis. Proin pretium mauris in sapien ultricies, fermentum convallis metus posuere. Quisque posuere, justo nec venenatis consectetur, ligula dolor aliquam quam, vel laoreet ante nisi in arcu. Vivamus venenatis gravida est.</p>\r\n<p>Vestibulum massa neque, ornare eget turpis vel, placerat ultricies felis. Donec aliquam convallis libero, ut finibus felis elementum at. Sed aliquet felis ac tellus blandit, eu bibendum libero imperdiet. Cras lacinia, mi quis auctor feugiat, metus orci condimentum velit, ut cursus erat ipsum ac purus. Aenean placerat egestas augue. Curabitur condimentum imperdiet faucibus. Donec mi risus, luctus vitae ante ut, blandit fringilla est. Mauris aliquam aliquet lectus, at ullamcorper libero rhoncus ut. Vivamus dignissim, ipsum in porttitor laoreet, enim justo aliquam erat, non eleifend mi ipsum a ex. Donec maximus congue ipsum, et aliquet est commodo eu. Ut varius massa ac turpis porttitor tristique. Suspendisse a dignissim odio. Maecenas sit amet urna mi. Sed sed euismod turpis. Quisque sed velit blandit, dapibus diam vitae, rhoncus elit. Nunc consectetur orci lorem, aliquet suscipit tortor pretium sit amet.</p>\r\n<p>Aenean at arcu at massa egestas bibendum. Integer egestas lacus ullamcorper arcu placerat, ac molestie nisi dapibus. Sed eleifend nibh eget nunc tempor cursus. Nullam lacus augue, vestibulum vel viverra eget, suscipit vitae lectus. In a mi eget ante fermentum bibendum. Sed sagittis facilisis ante rhoncus rhoncus. In blandit sapien magna, a cursus mi condimentum non. Nullam non est pretium, accumsan felis nec, auctor tellus. Donec eu nulla commodo augue fermentum bibendum id in metus. Integer dictum, magna a egestas imperdiet, libero eros sodales quam, at pharetra urna nunc convallis quam. Quisque rhoncus sodales urna, eu congue nunc accumsan condimentum.</p>\r\n<p>Donec varius vulputate metus, fringilla commodo ipsum sollicitudin eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vulputate ullamcorper mauris, eu feugiat mauris imperdiet nec. Maecenas porta tincidunt sollicitudin. Maecenas et efficitur purus. Vivamus luctus pellentesque mauris varius bibendum. Proin id laoreet dolor. Integer laoreet bibendum laoreet. Donec suscipit lectus nec diam ultricies cursus. Aliquam at finibus purus, non auctor sapien. Praesent ultricies tortor vitae consectetur pulvinar. Duis id augue sit amet metus pellentesque cursus eu sed ante. Nulla facilisi. Pellentesque gravida orci non dolor hendrerit, quis ullamcorper mi efficitur. Vivamus euismod non sem quis sagittis.</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `loginUsers` tinytext COLLATE utf8mb4_polish_ci NOT NULL,
  `pwdUsers` longtext COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `loginUsers`, `pwdUsers`) VALUES
(1, 'admin', '$2y$10$bV/DJCRZFSm2w8Q9jzjAn.aPzKLPb42oAy8zEPG19cp0mj/JO1XHu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`idPages`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `idPages` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
