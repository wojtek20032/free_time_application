-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Cze 2024, 12:11
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `campa`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `calendar_events`
--

CREATE TABLE `calendar_events` (
  `id` int(11) UNSIGNED NOT NULL,
  `idUzytkownika` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `participating` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `calendar_events`
--

INSERT INTO `calendar_events` (`id`, `idUzytkownika`, `name`, `description`, `date`, `location`, `note`, `participating`) VALUES
(1, 1, '2332', '323', '2024-06-07', '3232', '2332', 1),
(2, 1, '2332', '323', '2024-05-17', '3232', '2332', 1),
(3, 1, 'PIO', 'Mamy zajecia z pio w pon', '2024-05-23', 'Politechniak łodzka', 'musze kupic ksiazke', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `idUzytkownika` int(11) UNSIGNED NOT NULL,
  `Username` varchar(30) NOT NULL,
  `E_mail` varchar(60) NOT NULL,
  `hashed_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`idUzytkownika`, `Username`, `E_mail`, `hashed_password`) VALUES
(1, 'asdas', 'adasd@gmail.com', '00ea1da4192a2030f9ae023de3b3143ed647bbab'),
(3, '1234', '1234@gmail.com', '48719aa2bae9af4fb6c733dfc33f6b1ac3801c43'),
(4, 'eqwe', 'qeqe@gmail.com', '47bfa5607502bddca724613c51acc60f54a1e57a'),
(5, '765', '765@edu.p.lodz.pl', '48719aa2bae9af4fb6c733dfc33f6b1ac3801c43'),
(6, '4948', 'yt@gmail.com', '48719aa2bae9af4fb6c733dfc33f6b1ac3801c43');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUzytkownika`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `calendar_events`
--
ALTER TABLE `calendar_events`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `idUzytkownika` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD CONSTRAINT `calendar_events_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `users` (`idUzytkownika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
