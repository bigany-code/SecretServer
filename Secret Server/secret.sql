-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Máj 31. 17:44
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `secret`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `secrets`
--

CREATE TABLE `secrets` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `secret` varchar(255) NOT NULL,
  `expire_after_views` int(11) NOT NULL,
  `expire_after_minutes` int(11) NOT NULL,
  `views` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `secrets`
--

INSERT INTO `secrets` (`id`, `url`, `secret`, `expire_after_views`, `expire_after_minutes`, `views`, `created_at`) VALUES
(115, 'b1dc8c7425ea7b8f', 'aaaa', 10, 1, 0, '2023-05-27 20:07:37'),
(117, '75c435511f7e55e6', 'aaaaaaa', 10, 1, 0, '2023-05-27 20:09:53'),
(118, '7c857c28ca6babd0', 'aaaaaaa', 10, 1, 0, '2023-05-27 20:10:05'),
(119, '3881a6a094d44cbe', 'aaaaaa', 3, 1, 1, '2023-05-27 20:10:59');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `secrets`
--
ALTER TABLE `secrets`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `secrets`
--
ALTER TABLE `secrets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
