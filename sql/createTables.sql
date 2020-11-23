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
(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `shopping_cart`
(
  `user_id` bigint
(20) UNSIGNED NOT NULL,
  `item_id` bigint
(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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


ALTER TABLE `items`
ADD PRIMARY KEY
(`id`),
ADD UNIQUE KEY `id`
(`id`);


ALTER TABLE `shopping_cart`
ADD KEY `user_id`
(`user_id`),
ADD KEY `item_id`
(`item_id`);



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
(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint
(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

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