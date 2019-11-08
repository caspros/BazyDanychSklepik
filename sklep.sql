-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Lis 2019, 18:53
-- Wersja serwera: 10.1.31-MariaDB
-- Wersja PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `id_adres` int(11) NOT NULL,
  `wojewodztwo` varchar(45) NOT NULL,
  `kod_pocztowy` varchar(6) NOT NULL,
  `miasto` varchar(45) NOT NULL,
  `ulica` varchar(45) NOT NULL,
  `nr_domu` int(11) NOT NULL,
  `nr_lokalu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id_kategorie` int(11) NOT NULL,
  `kategoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id_kategorie`, `kategoria`) VALUES
(1, 'Koszulki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klienci` int(11) NOT NULL,
  `Imie` varchar(45) NOT NULL,
  `Nazwisko` varchar(45) NOT NULL,
  `haslo` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `id_adres` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id_klienci`, `Imie`, `Nazwisko`, `haslo`, `email`, `id_adres`) VALUES
(1, 'Benek', 'Admin', '$2y$10$PptpQr2zIZq64oz2Ry5dje0RYG5i.F1WDcGCKV', 'admin1@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oferta_dnia`
--

CREATE TABLE `oferta_dnia` (
  `id_oferta_dnia` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `cena_w_dniu` decimal(10,2) NOT NULL,
  `id_produkty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id_produkty` int(11) NOT NULL,
  `nazwa` varchar(45) NOT NULL,
  `opis` text NOT NULL,
  `opinie_klientow` text,
  `cena` decimal(10,2) NOT NULL,
  `dostepna_ilosc` int(11) NOT NULL,
  `producent` varchar(45) NOT NULL,
  `oceny` enum('1','2','3','4','5') DEFAULT NULL,
  `rozmiar` varchar(5) NOT NULL,
  `id_kategorie` int(11) NOT NULL,
  `id_klienci` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id_produkty`, `nazwa`, `opis`, `opinie_klientow`, `cena`, `dostepna_ilosc`, `producent`, `oceny`, `rozmiar`, `id_kategorie`, `id_klienci`) VALUES
(8, 'Koszulka Mike Tyson', 'Koszulka zrobiona z pomysłem', '4', '50.00', 5, 'BenoCORP', NULL, 'XL', 1, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `promocje`
--

CREATE TABLE `promocje` (
  `id_promocje` int(11) NOT NULL,
  `nowa_cena` decimal(10,2) NOT NULL,
  `id_produkty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id_zamowienia` int(11) NOT NULL,
  `data_zlozenia` datetime NOT NULL,
  `data_wyslania` datetime NOT NULL,
  `zaplacono` tinyint(4) NOT NULL,
  `id_klienci` int(11) NOT NULL,
  `id_zamowienie_produkty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie_produkty`
--

CREATE TABLE `zamowienie_produkty` (
  `id_zamowienie_produkty` int(11) NOT NULL,
  `ile_sztuk` int(11) NOT NULL,
  `id_produkty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`id_adres`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id_kategorie`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klienci`),
  ADD KEY `fk_klienci_adres_idx` (`id_adres`);

--
-- Indeksy dla tabeli `oferta_dnia`
--
ALTER TABLE `oferta_dnia`
  ADD PRIMARY KEY (`id_oferta_dnia`),
  ADD KEY `fk_oferta_dnia_produkty1_idx` (`id_produkty`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id_produkty`),
  ADD KEY `fk_produkty_kategorie1_idx` (`id_kategorie`),
  ADD KEY `fk_produkty_klienci1_idx` (`id_klienci`);

--
-- Indeksy dla tabeli `promocje`
--
ALTER TABLE `promocje`
  ADD PRIMARY KEY (`id_promocje`),
  ADD KEY `fk_promocje_produkty1_idx` (`id_produkty`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id_zamowienia`),
  ADD KEY `fk_zamowienia_klienci1_idx` (`id_klienci`),
  ADD KEY `fk_zamowienia_zamowienie_produkty1_idx` (`id_zamowienie_produkty`);

--
-- Indeksy dla tabeli `zamowienie_produkty`
--
ALTER TABLE `zamowienie_produkty`
  ADD PRIMARY KEY (`id_zamowienie_produkty`),
  ADD KEY `fk_zamowienie_produkty_produkty1_idx` (`id_produkty`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `adres`
--
ALTER TABLE `adres`
  MODIFY `id_adres` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id_kategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klienci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `oferta_dnia`
--
ALTER TABLE `oferta_dnia`
  MODIFY `id_oferta_dnia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id_produkty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `promocje`
--
ALTER TABLE `promocje`
  MODIFY `id_promocje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zamowienie_produkty`
--
ALTER TABLE `zamowienie_produkty`
  MODIFY `id_zamowienie_produkty` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD CONSTRAINT `fk_klienci_adres` FOREIGN KEY (`id_adres`) REFERENCES `mydb`.`adres` (`id_adres`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `oferta_dnia`
--
ALTER TABLE `oferta_dnia`
  ADD CONSTRAINT `fk_oferta_dnia_produkty1` FOREIGN KEY (`id_produkty`) REFERENCES `mydb`.`produkty` (`id_produkty`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `fk_produkty_kategorie1` FOREIGN KEY (`id_kategorie`) REFERENCES `mydb`.`kategorie` (`id_kategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produkty_klienci1` FOREIGN KEY (`id_klienci`) REFERENCES `mydb`.`klienci` (`id_klienci`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `promocje`
--
ALTER TABLE `promocje`
  ADD CONSTRAINT `fk_promocje_produkty1` FOREIGN KEY (`id_produkty`) REFERENCES `mydb`.`produkty` (`id_produkty`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `fk_zamowienia_klienci1` FOREIGN KEY (`id_klienci`) REFERENCES `mydb`.`klienci` (`id_klienci`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zamowienia_zamowienie_produkty1` FOREIGN KEY (`id_zamowienie_produkty`) REFERENCES `mydb`.`zamowienie_produkty` (`id_zamowienie_produkty`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `zamowienie_produkty`
--
ALTER TABLE `zamowienie_produkty`
  ADD CONSTRAINT `fk_zamowienie_produkty_produkty1` FOREIGN KEY (`id_produkty`) REFERENCES `mydb`.`produkty` (`id_produkty`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
