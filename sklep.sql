-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Lis 2019, 11:36
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
(1, 'Koszulki'),
(2, 'Spodnie'),
(3, 'Kubki'),
(4, 'Długopisy'),
(5, 'Bluzy'),
(6, 'Naklejki'),
(7, 'Ramki'),
(8, 'RTV'),
(9, 'AGD'),
(10, 'Alkohol'),
(11, 'Zabawki');

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
(5, 'Benek', 'Benek', '76678ce4ef2dc607104cf9955b502443', 'benek1@o2.pl', NULL),
(6, 'Test', 'Tescik', 'cc03e747a6afbbcbf8be7668acfebee5', 'test@gmail.com', NULL),
(7, 'Admin', 'Adminowski', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', NULL),
(8, 'Baltazar', 'KrÃ³l', 'f17f4b3e8e709cd3c89a6dbd949d7171', 'baltazar@123.pl', NULL),
(9, 'Robcio', 'Robertos', '6058d199135afa99b8446f246e7b5cec', 'robertos@o2.pl', NULL),
(10, 'Graf', 'Graf', '2c01010b99ef591baef2d11237937e54', 'Graf@Graf.pl', NULL);

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
-- Struktura tabeli dla tabeli `opinie`
--

CREATE TABLE `opinie` (
  `id_opinie` int(11) NOT NULL,
  `id_produkty` int(11) NOT NULL,
  `id_klienci` int(11) NOT NULL,
  `gwiazdka` int(11) DEFAULT NULL,
  `opinia` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `opinie`
--

INSERT INTO `opinie` (`id_opinie`, `id_produkty`, `id_klienci`, `gwiazdka`, `opinia`) VALUES
(2, 8, 5, 5, 'Ta koszulka jest super, chodzę w niej codziennie! Jakość wykonania przerosła moje najśmielsze oczekiwania! Jak najbardziej polecam :)'),
(4, 14, 7, 5, 'Kupiłem Kubek dla synka i był bardzo zadowolony! Bardzo szybka dostawa, polecam sklep alledrogo :D'),
(5, 16, 6, 5, 'Nigdzie nie mogłem znaleźć bluzy z ziemniakiem, aż nagle natknąłem się na aukcje w sklepie alledrogo! Bluza doszła i jest świetna!');

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
  `zdjecie` varchar(50) NOT NULL DEFAULT 'default_product.png',
  `id_kategorie` int(11) NOT NULL,
  `id_klienci` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id_produkty`, `nazwa`, `opis`, `opinie_klientow`, `cena`, `dostepna_ilosc`, `producent`, `oceny`, `rozmiar`, `zdjecie`, `id_kategorie`, `id_klienci`) VALUES
(8, 'Koszulka Mike Tyson', 'Koszulka zrobiona z pomysłem', '4', '50.00', 5, 'BenoCORP', NULL, 'XL', 'koszulka_mike.png', 1, NULL),
(12, 'Spodnie Jeans Master', 'Wykonane z najlepszej jakości materiału Jeans, idealnie dopasowują się do ciała', '5', '100.00', 5, 'Jeans&Jeans', NULL, 'M', 'jeans_m.png', 2, NULL),
(14, 'Kubek Studenta', 'Kubek wykonany z porcelany z nadrukowanym napisem, który odźwierciedla brutalną rzeczywistość studentów', '5', '30.00', 10, 'KubekKuba', NULL, '', 'kubek_student1.png', 3, NULL),
(15, 'Długopis ze ściągą', 'Długopis z miejscem na ściąge, idealny dla ucznia, studenta', '5', '15.00', 150, 'DługiPisak sp. Z o.o', NULL, '', 'dlugopis_1.png', 4, NULL),
(16, 'Bluza z ziemniakiem', 'Bluza wykonana z tworzywa sztucznego, idealna aby wyróżnić się z tłumu', '3', '70.00', 10, 'Bluzex sp. Z o.o', NULL, 'L', 'bluza_1.png', 5, NULL),
(17, 'Naklejka na podłogę Kosmos', 'Kosmiczna naklejka na podłogę, duże nasycenie barw, realistyczna', '5', '60.00', 10, 'Naklejkownia sp. Z o.o', NULL, '', 'naklejka_1.png', 6, NULL);

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

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id_zamowienia`, `data_zlozenia`, `data_wyslania`, `zaplacono`, `id_klienci`, `id_zamowienie_produkty`) VALUES
(2, '2019-11-22 19:40:50', '0000-00-00 00:00:00', 0, 5, 1),
(3, '2019-11-22 19:44:50', '0000-00-00 00:00:00', 1, 5, 2);

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
-- Zrzut danych tabeli `zamowienie_produkty`
--

INSERT INTO `zamowienie_produkty` (`id_zamowienie_produkty`, `ile_sztuk`, `id_produkty`) VALUES
(1, 2, 14),
(2, 1, 8);

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
-- Indeksy dla tabeli `opinie`
--
ALTER TABLE `opinie`
  ADD PRIMARY KEY (`id_opinie`),
  ADD KEY `id_klienci` (`id_klienci`),
  ADD KEY `id_produkty` (`id_produkty`) USING BTREE;

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
  MODIFY `id_kategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klienci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `oferta_dnia`
--
ALTER TABLE `oferta_dnia`
  MODIFY `id_oferta_dnia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `opinie`
--
ALTER TABLE `opinie`
  MODIFY `id_opinie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id_produkty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `promocje`
--
ALTER TABLE `promocje`
  MODIFY `id_promocje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `zamowienie_produkty`
--
ALTER TABLE `zamowienie_produkty`
  MODIFY `id_zamowienie_produkty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Ograniczenia dla tabeli `opinie`
--
ALTER TABLE `opinie`
  ADD CONSTRAINT `opinie_ibfk_1` FOREIGN KEY (`id_produkty`) REFERENCES `produkty` (`id_produkty`) ON UPDATE CASCADE,
  ADD CONSTRAINT `opinie_ibfk_2` FOREIGN KEY (`id_klienci`) REFERENCES `klient` (`id_klienci`) ON UPDATE CASCADE;

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
