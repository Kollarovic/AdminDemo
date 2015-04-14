-- Adminer 4.2.0 MySQL dump

SET NAMES utf8mb4;
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

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `vat` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product` (`id`, `name`, `image`, `description`, `price`, `unit`, `vat`, `active`) VALUES
(1,	'Apple Cinema 30\"',	'images/upload/45562794e5284cfc29c663ee372b4aa8.jpg',	'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nunc velit, auctor eu ligula quis, tempor placerat nibh. Donec sodales diam eros, id dignissim magna pretium quis. Nunc suscipit ut arcu ut viverra. Ut fermentum eros at tincidunt venenatis. Nulla in venenatis ipsum, ac tempor libero. Ut dictum erat non blandit tincidunt. Etiam urna elit, tincidunt a neque nec, lacinia facilisis nulla. Pellentesque ac ante nisl. Donec finibus vehicula tortor eu malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas eu dolor dui.</p>\n',	602.00,	' pcs ',	20,	1),
(2,	'iPhone',	'images/upload/99c84c4231031e3f7d9c11ac2b5f3a4e.jpg',	'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nunc velit, auctor eu ligula quis, tempor placerat nibh. Donec sodales diam eros, id dignissim magna pretium quis. Nunc suscipit ut arcu ut viverra. Ut fermentum eros at tincidunt venenatis. Nulla in venenatis ipsum, ac tempor libero. Ut dictum erat non blandit tincidunt. Etiam urna elit, tincidunt a neque nec, lacinia facilisis nulla. Pellentesque ac ante nisl. Donec finibus vehicula tortor eu malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas eu dolor dui.</p>\n',	123.20,	' pcs ',	20,	1),
(3,	'MacBook',	'images/upload/32dcc5c50cc7f5e643d7665adbecb2fa.jpg',	'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nunc velit, auctor eu ligula quis, tempor placerat nibh. Donec sodales diam eros, id dignissim magna pretium quis. Nunc suscipit ut arcu ut viverra. Ut fermentum eros at tincidunt venenatis. Nulla in venenatis ipsum, ac tempor libero. Ut dictum erat non blandit tincidunt. Etiam urna elit, tincidunt a neque nec, lacinia facilisis nulla. Pellentesque ac ante nisl. Donec finibus vehicula tortor eu malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas eu dolor dui.</p>\n',	602.00,	' pcs ',	20,	1),
(4,	'Canon EOS 5D',	'images/upload/7574c17e870ffd97f3a7aef994c79dd8.jpg',	'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nunc velit, auctor eu ligula quis, tempor placerat nibh. Donec sodales diam eros, id dignissim magna pretium quis. Nunc suscipit ut arcu ut viverra. Ut fermentum eros at tincidunt venenatis. Nulla in venenatis ipsum, ac tempor libero. Ut dictum erat non blandit tincidunt. Etiam urna elit, tincidunt a neque nec, lacinia facilisis nulla. Pellentesque ac ante nisl. Donec finibus vehicula tortor eu malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas eu dolor dui.</p>\n',	95.00,	' pcs ',	20,	1);

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
(9,	'John Doe',	'admin@admin.sk',	'$2y$10$jy5A0F.5TuA1BO09R0RcFuSdtVZ.f4tUy.1EWxSBt4rjIQ9GFUAbi',	'admin');

-- 2015-04-14 07:50:03