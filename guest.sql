-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 03 2017 г., 18:45
-- Версия сервера: 5.5.50
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `book`
--

-- --------------------------------------------------------

--
-- Структура таблицы `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `id_msg` int(8) NOT NULL,
  `name` tinytext NOT NULL,
  `city` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  `msg` mediumtext NOT NULL,
  `answer` mediumtext NOT NULL,
  `puttime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hide` enum('show','hide') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id_msg`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `guest`
--
ALTER TABLE `guest`
  MODIFY `id_msg` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=141;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
