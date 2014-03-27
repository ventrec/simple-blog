-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Vert: localhost
-- Generert den: 27. Mar, 2014 21:14 PM
-- Tjenerversjon: 5.6.12-log
-- PHP-Versjon: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simpleblog`
--
CREATE DATABASE IF NOT EXISTS `simpleblog` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `simpleblog`;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `blogpost`
--

CREATE TABLE IF NOT EXISTS `blogpost` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` smallint(6) DEFAULT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=19 ;

--
-- Dataark for tabell `blogpost`
--

INSERT INTO `blogpost` (`id`, `title`, `date`, `author`, `body`, `created_at`, `updated_at`) VALUES
(1, 'Testing this blog system', '2014-03-26 13:33:21', 1, '<p>This is a test to verify that the system is working.</p>\r\n<p>This is a paragraph of awesomeness.</p>', '2014-03-27 17:58:24', '0000-00-00 00:00:00'),
(2, 'A new title for a new blog post', '2014-03-26 17:31:28', 1, '<p class="lead">This is an introduction for the blog post that you''re about to read. This introduction took several seconds to finish, and it still isn''t finished. Who knows how long this will last?</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam blandit bibendum tortor. Nunc sit amet dolor sed elit pharetra mollis. Nam posuere feugiat neque adipiscing imperdiet. Nullam id eros dolor. Donec sit amet convallis diam, rhoncus faucibus purus. Nullam tempor, purus sed convallis imperdiet, tortor tortor vulputate metus, eget venenatis lacus lacus at tellus. Vivamus pharetra ultricies accumsan. Morbi venenatis risus sit amet augue ullamcorper fermentum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam egestas orci et lacus vulputate, in faucibus ipsum fringilla. Integer ornare orci id lorem convallis dignissim id non lectus. Morbi in dapibus tellus. Pellentesque in lorem consequat, dictum sem vel, accumsan velit. Nunc sit amet porttitor lacus. Quisque aliquam accumsan nisi, feugiat sagittis enim placerat vel.</p><p>Integer ultricies euismod elementum. Mauris accumsan quam ac ligula pretium porta. Aliquam facilisis risus nec quam placerat lacinia. Quisque pharetra dui id sem suscipit, nec varius magna venenatis. Donec ultrices convallis felis, a scelerisque nulla convallis sit amet. Nulla facilisi. Sed consequat lectus libero, vitae vestibulum dui semper vitae. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque porttitor sem arcu, sed gravida quam blandit vel. Aliquam et augue fermentum, sagittis est id, sagittis dui. Phasellus nec felis ut lorem iaculis sodales in et ipsum. Aenean et facilisis quam.</p>', '2014-03-27 17:58:24', '0000-00-00 00:00:00'),
(6, 'Important title', '2014-03-27 20:25:14', 1, '<p>Important text that everyone has to read.</p>\r\n<p>Unimportant text.</p>', '2014-03-27 22:11:17', '2014-03-27 22:11:17'),
(8, 'A new title for this post test', '2014-03-27 20:27:26', 1, '<p>Test test test!</p>', '2014-03-27 22:11:29', '2014-03-27 22:11:29');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) COLLATE utf8_bin NOT NULL,
  `password` varchar(250) COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$wXN9FpesDIhH2Aa/KSetEuWacE9uJ8yYVLhRAJUIoCktbKy9mXMTK', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `blogpost`
--
ALTER TABLE `blogpost`
  ADD CONSTRAINT `blogpost_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
