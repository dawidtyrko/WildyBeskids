-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Maj 2023, 15:31
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`idAdmin`, `idUser`) VALUES
(1, 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `idCategory` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`idCategory`, `name`, `description`) VALUES
(1, 'test', 'test');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `hutpost`
--

CREATE TABLE `hutpost` (
  `idPost` int(11) NOT NULL,
  `description` longtext DEFAULT NULL,
  `idImage` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idHut` int(11) DEFAULT NULL,
  `dateAdded` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `hutpost`
--

INSERT INTO `hutpost` (`idPost`, `description`, `idImage`, `idUser`, `idHut`, `dateAdded`) VALUES
(9, 'Widok z tarasu schroniska', 42, 15, 15, '2023-05-29 23:06:33');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `image`
--

CREATE TABLE `image` (
  `idImage` int(11) NOT NULL,
  `filename` varchar(70) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `image`
--

INSERT INTO `image` (`idImage`, `filename`, `idUser`) VALUES
(38, 'IMG-64750fd118a336.40633112.jpg', 15),
(39, 'IMG-64751054f35a41.65579832.jpg', 15),
(40, 'IMG-647510efaaf6d2.21125908.jpg', 15),
(41, 'IMG-64751305dd0a55.48262773.jpg', 15),
(42, 'IMG-647513d9432b12.04403038.jpg', 15),
(43, 'IMG-6475169de39a25.99965222.jpg', 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mountainhut`
--

CREATE TABLE `mountainhut` (
  `idHut` int(11) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `link` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `mountainhut`
--

INSERT INTO `mountainhut` (`idHut`, `description`, `link`) VALUES
(5, 'Szyndzielnia PTTK', 'https://www.szyndzielnia.com.pl'),
(7, 'Hala Miziowa PTTK', 'https://halamiziowa.pl'),
(8, 'Przysłop PTTK', 'https://przyslop.pl'),
(9, 'Rysianka PTTK', 'http://www.rysianka.com.pl'),
(10, 'Krawców Wierch PTTK', 'https://krawcow.pttk.pl'),
(11, 'Klimczok PTTK', 'http://www.schroniskoklimczok.com.pl'),
(12, 'Błatnia PTTK', 'https://www.blatnia.pl'),
(13, 'Magurka PTTK', 'https://www.magurka.beskidy.pl'),
(14, 'Markowe Szczawiny PTTK', 'https://markoweszczawiny.pttk.pl'),
(15, 'Skrzyczne PTTK', 'http://www.skrzyczne.szczyrk.pl/pl/home');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `post`
--

CREATE TABLE `post` (
  `idPost` int(11) NOT NULL,
  `latitude` varchar(30) DEFAULT NULL,
  `longitude` varchar(30) DEFAULT NULL,
  `stars` tinyint(1) DEFAULT NULL,
  `water` tinyint(1) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `idImage` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idCategory` int(11) DEFAULT NULL,
  `idHut` int(11) DEFAULT NULL,
  `dateAdded` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `post`
--

INSERT INTO `post` (`idPost`, `latitude`, `longitude`, `stars`, `water`, `description`, `idImage`, `idUser`, `idCategory`, `idHut`, `dateAdded`) VALUES
(16, '49.627851', '19.016347', 1, 0, 'Super miejsc&oacute;wka na namioty z pięknym widokiem na gwiazdy!', 39, 15, 1, NULL, '2023-05-29 22:51:33'),
(18, '49.736629', '18.986601', 1, 0, 'Idealne miejsce na obozowisko z hamakami', 41, 15, 1, NULL, '2023-05-29 23:03:01');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `firstName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`idUser`, `user`, `pass`, `firstName`, `lastName`, `email`, `active`) VALUES
(15, 'Gruby', '$2y$10$oTeTzb1iI7RDOo8k7AXjKe0xfbi3F/p.oBY9pTmX1NLsx7U2nY1Jm', 'Dawid', 'Tyrko', 'test.admin@gmail.com', 1),
(16, 'JanKowalski', '$2y$10$74r5DN0H3aUAALXZZnPNbOCFVz0.emGuoNkZx2Zcy9m1Pzh4JEXF6', 'Jan', 'Kowalski', 'jan@gmail.com', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD KEY `idUser` (`idUser`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indeksy dla tabeli `hutpost`
--
ALTER TABLE `hutpost`
  ADD PRIMARY KEY (`idPost`),
  ADD KEY `idImage` (`idImage`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idHut` (`idHut`);

--
-- Indeksy dla tabeli `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`idImage`),
  ADD KEY `idUser` (`idUser`);

--
-- Indeksy dla tabeli `mountainhut`
--
ALTER TABLE `mountainhut`
  ADD PRIMARY KEY (`idHut`);

--
-- Indeksy dla tabeli `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`),
  ADD KEY `idImage` (`idImage`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idCategory` (`idCategory`),
  ADD KEY `idHut` (`idHut`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `hutpost`
--
ALTER TABLE `hutpost`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `image`
--
ALTER TABLE `image`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT dla tabeli `mountainhut`
--
ALTER TABLE `mountainhut`
  MODIFY `idHut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Ograniczenia dla tabeli `hutpost`
--
ALTER TABLE `hutpost`
  ADD CONSTRAINT `hutpost_ibfk_1` FOREIGN KEY (`idImage`) REFERENCES `image` (`idImage`),
  ADD CONSTRAINT `hutpost_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `hutpost_ibfk_3` FOREIGN KEY (`idHut`) REFERENCES `mountainhut` (`idHut`);

--
-- Ograniczenia dla tabeli `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Ograniczenia dla tabeli `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`idImage`) REFERENCES `image` (`idImage`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`idCategory`) REFERENCES `category` (`idCategory`),
  ADD CONSTRAINT `post_ibfk_4` FOREIGN KEY (`idHut`) REFERENCES `mountainhut` (`idHut`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
