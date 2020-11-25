-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Nov 2020 um 11:16
-- Server-Version: 10.1.39-MariaDB
-- PHP-Version: 7.3.5

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `shop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE `items`
(
  `id` bigint
(20) UNSIGNED NOT NULL,
  `name` varchar
(128) DEFAULT NULL,
  `description` varchar
(128) DEFAULT NULL,
  `image` varchar
(128) DEFAULT NULL,
  `price` decimal
(10,2) DEFAULT NULL,
  `user_id` bigint
(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopping_cart`
--

CREATE TABLE `shopping_cart`
(
  `id` bigint
(20) UNSIGNED NOT NULL,
  `user_id` bigint
(20) UNSIGNED NOT NULL,
  `item_id` bigint
(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users`
(
  `id` bigint
(20) UNSIGNED NOT NULL,
  `name` varchar
(128) NOT NULL,
  `email` varchar
(128) NOT NULL,
  `password` varchar
(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `items`
--
ALTER TABLE `items`
ADD PRIMARY KEY
(`id`),
ADD UNIQUE KEY `id`
(`id`),
ADD KEY `items_ibfk_1`
(`user_id`);

--
-- Indizes für die Tabelle `shopping_cart`
--
ALTER TABLE `shopping_cart`
ADD PRIMARY KEY
(`id`),
ADD UNIQUE KEY `id`
(`id`),
ADD KEY `user_id`
(`user_id`),
ADD KEY `item_id`
(`item_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY
(`id`),
ADD UNIQUE KEY `email`
(`email`),
ADD UNIQUE KEY `id`
(`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint
(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` bigint
(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint
(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `items`
--
ALTER TABLE `items`
ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY
(`user_id`) REFERENCES `users`
(`id`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Constraints der Tabelle `shopping_cart`
--
ALTER TABLE `shopping_cart`
ADD CONSTRAINT `item_id` FOREIGN KEY
(`item_id`) REFERENCES `items`
(`id`) ON
DELETE CASCADE ON
UPDATE CASCADE,
ADD CONSTRAINT `user_id` FOREIGN KEY
(`user_id`) REFERENCES `users`
(`id`) ON
DELETE CASCADE ON
UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
