SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `page` (`id`, `name`, `content`, `active`) VALUES
(1,	'Test',	'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nunc velit, auctor eu ligula quis, tempor placerat nibh. Donec sodales diam eros, id dignissim magna pretium quis. Nunc suscipit ut arcu ut viverra. Ut fermentum eros at tincidunt venenatis. Nulla in venenatis ipsum, ac tempor libero. Ut dictum erat non blandit tincidunt. Etiam urna elit, tincidunt a neque nec, lacinia facilisis nulla. Pellentesque ac ante nisl. Donec finibus vehicula tortor eu malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas eu dolor dui.</p>\n\n<p>Donec non nulla sed massa cursus fringilla. Quisque leo leo, efficitur ac dolor vitae, interdum pharetra ipsum. Duis facilisis quam in mi ullamcorper faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec aliquet enim non dui maximus, sit amet tincidunt ligula scelerisque. Aenean ut imperdiet tortor. Quisque magna velit, luctus at ex et, fringilla convallis leo.</p>\n',	1);

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `setting` (`key`, `value`) VALUES
('email',	'kollarovic@gmail.com'),
('skin',	'red');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(60) NOT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(9,	'John Doe',	'demo@demo.com',	'$2y$10$bJf6ewjzAmVnil6igZVbh.C/dMLJ6ikkIsiM/kFUcs6nV.ES1bBZu',	'admin');