-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Gru 2019, 14:48
-- Wersja serwera: 10.1.38-MariaDB
-- Wersja PHP: 7.3.3

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
  `kod_pocztowy` varchar(6) DEFAULT NULL,
  `miasto` varchar(45) DEFAULT NULL,
  `ulica` varchar(45) DEFAULT NULL,
  `nr_domu` int(11) DEFAULT NULL,
  `nr_lokalu` int(11) DEFAULT NULL,
  `id_klienci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `adres`
--

INSERT INTO `adres` (`id_adres`, `kod_pocztowy`, `miasto`, `ulica`, `nr_domu`, `nr_lokalu`, `id_klienci`) VALUES
(1, '58-533', 'Mysłakowice', 'Nowa', 12, 123, 5),
(2, NULL, NULL, NULL, NULL, NULL, 6),
(3, '66-666', 'Piekło', 'Piekielna', 666, 65, 7),
(4, NULL, NULL, NULL, NULL, NULL, 8),
(5, NULL, NULL, NULL, NULL, NULL, 9),
(6, NULL, NULL, NULL, NULL, NULL, 10),
(8, NULL, NULL, NULL, NULL, NULL, 13),
(9, NULL, NULL, NULL, NULL, NULL, 14),
(10, NULL, NULL, NULL, NULL, NULL, 15),
(11, '50-111', 'Warszawa', 'Fajna', 51, 152, 16),
(12, '58-533', 'Mysłakowic', 'Nowa', 12, 23, 17),
(13, '02-200', 'Komikowo', 'Komikowa', 151, 1, 18);

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
  `id_adres` int(11) DEFAULT NULL,
  `uprawnienia` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0 - klient, 1 - administrator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id_klienci`, `Imie`, `Nazwisko`, `haslo`, `email`, `id_adres`, `uprawnienia`) VALUES
(5, 'Benek', 'Benek', '76678ce4ef2dc607104cf9955b502443', 'benek1@o2.pl', 1, 0),
(6, 'Test', 'Tescik', 'cc03e747a6afbbcbf8be7668acfebee5', 'test@gmail.com', 2, 0),
(7, 'Admin', 'Adminowski', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 3, 1),
(8, 'Baltazar', 'KrÃ³l', 'f17f4b3e8e709cd3c89a6dbd949d7171', 'baltazar@123.pl', 4, 0),
(9, 'Robcio', 'Robertos', '6058d199135afa99b8446f246e7b5cec', 'robertos@o2.pl', 5, 0),
(10, 'Graf', 'Graf', '2c01010b99ef591baef2d11237937e54', 'Graf@Graf.pl', 6, 0),
(13, 'Testownik', 'Testownik', 'e77ce99136875685f4ae312c4d45cf3b', 'testownik@gmail.com', 8, 0),
(14, 'Macio', 'Macio', '4959fafb966d47348c32072ce6538d0b', 'macio@o2.pl', 9, 0),
(15, 'Typek', 'Typek', 'b0a767234400dd537a97fe6c47b75172', 'typek@o2.pl', 10, 0),
(16, 'Bartosz', 'Bartosz', 'c9006f26a2b48d3dd09eba5569244f6f', 'bartosz@o2.pl', 11, 0),
(17, 'Wariat', 'Wariat', '027ca5a0d6c257aa627d3a4a9ea6f2e5', 'wariat@o2.pl', 12, 0),
(18, 'Komik', 'Komik', '0bcb58d9edd19ebb002e5da7ac82ebd8', 'komik@o2.pl', 13, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `id_koszyk` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `id_produkty` int(11) NOT NULL,
  `id_klienci` int(11) NOT NULL,
  `zlozono` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`id_koszyk`, `ilosc`, `cena`, `id_produkty`, `id_klienci`, `zlozono`) VALUES
(21, 1, 100, 12, 15, 0),
(22, 4, 15, 15, 15, 0),
(25, 1, 30, 14, 7, 0),
(28, 1, 1350, 54, 7, 0);

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
  `id_produkty` int(11) NOT NULL DEFAULT '0' COMMENT '0 - ocena sklepu',
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
(5, 16, 6, 5, 'Nigdzie nie mogłem znaleźć bluzy z ziemniakiem, aż nagle natknąłem się na aukcje w sklepie alledrogo! Bluza doszła i jest świetna!'),
(6, 0, 7, 1, 'Testowy komentarz o sklepie, jestem Adminem, to nie będę oceniał :)'),
(7, 0, 5, 10, 'Najlepszy sklep jaki widziałem! Super ceny i szybka dostawa! Serdecznie polecam! :D ');

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
  `rozmiar` varchar(100) DEFAULT NULL,
  `zdjecie` varchar(50) NOT NULL DEFAULT 'default_product.png',
  `id_kategorie` int(11) NOT NULL,
  `dostawa` int(11) NOT NULL DEFAULT '12'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id_produkty`, `nazwa`, `opis`, `opinie_klientow`, `cena`, `dostepna_ilosc`, `producent`, `oceny`, `rozmiar`, `zdjecie`, `id_kategorie`, `dostawa`) VALUES
(8, 'Koszulka Mike Tyson', 'Koszulka zrobiona z pomysłem', '4', '50.00', 89, 'BenoCORP', NULL, 'XL', 'koszulka_mike.png', 1, 12),
(12, 'Spodnie Jeans Master', 'Wykonane z najlepszej jakości materiału Jeans, idealnie dopasowują się do ciała', '5', '100.00', 79, 'Jeans&Jeans', NULL, 'M', 'jeans_m.png', 2, 12),
(14, 'Kubek Studenta', 'Kubek wykonany z porcelany z nadrukowanym napisem, który odźwierciedla brutalną rzeczywistość studentów', '5', '30.00', 88, 'KubekKuba', NULL, NULL, 'kubek_student1.png', 3, 10),
(15, 'Długopis ze ściągą', 'Długopis z miejscem na ściąge, idealny dla ucznia, studenta', '5', '15.00', 85, 'DługiPisak sp. Z o.o', NULL, NULL, 'dlugopis_1.png', 4, 6),
(16, 'Bluza z ziemniakiem', 'Bluza wykonana z tworzywa sztucznego, idealna aby wyróżnić się z tłumu', '3', '70.00', 92, 'Bluzex sp. Z o.o', NULL, 'L', 'bluza_1.png', 5, 12),
(17, 'Naklejka na podłogę Kosmos', 'Kosmiczna naklejka na podłogę, duże nasycenie barw, realistyczna', '5', '60.00', 91, 'Naklejkownia sp. Z o.o', NULL, '100cm x 150cm', 'naklejka_1.png', 6, 15),
(18, 'Koszulka biała KONSTYTUCJA', 'Biała koszulka doskonałej jakości z nadrukowanym napisem KONSTYTUCJA. Ulubiona koszulka Lecha Wałęsy', '5', '75.00', 92, 'LechWałęsaCompany', NULL, 'M', 'koszulka_otua.png', 1, 12),
(51, 'Ramka na zdjęcie', 'Zawieszki i fleksy sprowadzamy od włoskiego producenta. Metale te, są najwyższej jakości – nie wyginają się i nie wyłamują. Będą Ci służyć przez lata bez potrzeby wymiany!', NULL, '19.50', 92, 'RamkiToHajs', NULL, '10x15', 'ramka_15_10.png', 7, 12),
(52, 'Koszulka DESTYLACJA', 'Oryginalna koszulka męska DESTYLACJA z krótkim rękawem firmy S&S. Wykonana z najwyższej jakości bawełny, zapewniającej komfort i wygodę użytkowania.', NULL, '77.50', 92, 'S&S', NULL, 'M', 'koszulka_destylacja.png', 1, 12),
(53, 'Whisky Jack Daniel\'s', 'Whisky Jack Daniel\'s to najpopularniejsza amerykańska whiskey produkowana od 1866 roku, kiedy to Jasper „Jack” Daniel zaufał swojej intuicji i postawił na stworzenie wysokiej jakości trunku. Jej unikalny smak zawdzięczany jest prawie dziesięcio- dniowej filtracji destylatu przez 3- metrową warstwę klonowego węgla drzewnego.', NULL, '100.00', 95, 'Jack Daniel\'s', NULL, '0,7L', 'whisky_jack.png', 10, 15),
(54, 'Smart TV Samsung 55 cali', 'Jakość obrazu, która Cię poruszy, zapewniona przez pojedynczy chip, który zarządza kolorami, optymalizuje współczynnik kontrastu i nadzoruje HDR.', NULL, '1350.00', 4, 'Samsung', NULL, '55 cali', 'tv_samsung_55.png', 8, 30),
(55, 'Smartfon Huawei Y5', 'Wyświetlacz: 5,45 cali\r\nAparat: 8 Mpix\r\nPamięć wewnętrzna [GB]: 16 GB\r\nBateria [mAh]: 3000', NULL, '299.00', 20, 'Huawei', NULL, '5,45 cali', 'huawei_1.png', 8, 15),
(56, 'Kubek Kapłan', 'Kubek idealny na prezent dla księdza, kapłana, ministranta.', NULL, '35.00', 100, 'PolskiKościół', NULL, '', 'kubek_kaplan.png', 3, 8),
(57, 'Kubek niebieski', 'Niebieski kubek wykonany z porcelany, solidna jakość. Idealnie nadaje się do picia herbaty, kawy lub napojów.', NULL, '30.00', 100, 'KubkiPL', NULL, '', 'kubek_niebieski.png', 3, 8),
(58, 'Kubek do kawy', 'Kubek do kawy z zabawnym opisem. Można w nim pić nie tylko kawę.', NULL, '32.00', 75, 'KubkiPL', NULL, '', 'kubek_kawa.png', 3, 8),
(59, 'Kubek Ni ma lekko', 'Kubek Ni ma lekko jest to kubek nietuzinkowy, można w nim pić różnego rodzaju napoje.', NULL, '41.00', 50, 'KubkiPL', NULL, '', 'kubek_ni_ma_lekko.png', 3, 8),
(60, 'Kubek czarny', 'Czarny kubek dla konesera kawy. Można w nim pić różne napoje.', NULL, '28.00', 100, 'KubkiPL', NULL, '', 'kubek_czarny.png', 3, 8),
(61, 'Zabawka Lalka Martynka', 'Zabawka lalka Martynka z nowej serii zabawek Toys&Boys. Odpowiednia dla dzieci powyżej 3 lat.', NULL, '99.00', 100, 'Toys&Boys', NULL, 'mała, wysokość: 20cm', 'zabawka_lalka.png', 11, 10),
(62, 'Zabawka Auto Taxi', 'Zabawka auto taxi, idealna dla dzieci powyżej 5 lat.', NULL, '35.00', 50, 'ZabawkiWorld', NULL, '', 'zabawka_autko_taxi.png', 11, 11),
(63, 'Zabawka Samolot', 'Zabawka Samolot jest idealna dla dzieci, które bujają w obłokach. Samolot wykonany z plastiku, nie nadaje się dla dzieci poniżej 3 roku życia.', NULL, '55.00', 100, 'ZabawkiWorld', NULL, '', 'zabawka_samolot.png', 11, 10),
(64, 'Zabawka kostka rubika', 'Zabawka kostka rubika 3x3, łamigłówka, idealna jako dodatek do prezentu. Zawiera małe elementy, nieodpowiednia dla dzieci poniżej 5 roku życia.', NULL, '20.00', 500, 'ZabawkiWorld', NULL, '3x3', 'kostka_rubika3x3.png', 11, 8),
(65, 'Zabawka piłka kolorowa', 'Zabawka piłka kolorowa, miękka, wykonana z tworzywa sztucznego, w środku wypełniona puchem.', NULL, '25.00', 77, 'ZabawkiWorld', NULL, 'średnica: 30cm', 'zabawka_pilka.png', 11, 10);

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
  `data_wyslania` date NOT NULL,
  `zaplacono` tinyint(4) NOT NULL,
  `id_klienci` int(11) NOT NULL,
  `suma` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id_zamowienia`, `data_zlozenia`, `data_wyslania`, `zaplacono`, `id_klienci`, `suma`) VALUES
(5, '2019-12-05 18:45:49', '0000-00-00', 0, 7, 265),
(6, '2019-12-05 18:50:26', '0000-00-00', 0, 5, 375),
(7, '2019-12-05 20:06:51', '0000-00-00', 0, 5, 75),
(8, '2019-12-05 22:18:42', '0000-00-00', 0, 7, 1550),
(9, '2019-12-05 22:20:44', '2019-12-05', 1, 7, 588),
(10, '2019-12-05 22:24:10', '0000-00-00', 0, 7, 1250),
(11, '2019-12-06 20:59:09', '0000-00-00', 0, 5, 928),
(12, '2019-12-13 15:26:07', '0000-00-00', 0, 5, 77),
(13, '2019-12-13 16:10:28', '0000-00-00', 0, 5, 1480);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie_produkty`
--

CREATE TABLE `zamowienie_produkty` (
  `id_zamowienie_produkty` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `id_produkty` int(11) NOT NULL,
  `id_klienci` int(11) NOT NULL,
  `id_zamowienia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `zamowienie_produkty`
--

INSERT INTO `zamowienie_produkty` (`id_zamowienie_produkty`, `ilosc`, `cena`, `id_produkty`, `id_klienci`, `id_zamowienia`) VALUES
(3, 5, 50, 8, 7, 5),
(4, 1, 15, 15, 7, 5),
(5, 2, 50, 8, 5, 6),
(6, 5, 25, 14, 5, 6),
(7, 2, 75, 18, 5, 6),
(8, 5, 15, 15, 5, 7),
(9, 6, 100, 12, 7, 8),
(10, 4, 30, 14, 7, 8),
(11, 2, 70, 16, 7, 8),
(12, 14, 15, 15, 7, 8),
(13, 16, 30, 14, 7, 8),
(14, 6, 50, 8, 7, 9),
(15, 3, 70, 16, 7, 9),
(16, 2, 15, 15, 7, 9),
(17, 6, 15, 15, 7, 10),
(18, 11, 100, 12, 7, 10),
(19, 5, 100, 53, 5, 11),
(20, 4, 30, 14, 5, 11),
(21, 2, 100, 12, 5, 11),
(22, 1, 60, 17, 5, 11),
(23, 1, 50, 8, 5, 12),
(24, 1, 15, 15, 5, 12),
(25, 2, 50, 8, 5, 13),
(26, 1, 1350, 54, 5, 13);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`id_adres`),
  ADD KEY `id_klienci` (`id_klienci`);

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
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`id_koszyk`),
  ADD KEY `FK_Klient` (`id_klienci`),
  ADD KEY `FK_Produkt` (`id_produkty`);

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
  ADD KEY `fk_produkty_kategorie1_idx` (`id_kategorie`);

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
  ADD KEY `fk_zamowienia_klienci1_idx` (`id_klienci`);

--
-- Indeksy dla tabeli `zamowienie_produkty`
--
ALTER TABLE `zamowienie_produkty`
  ADD PRIMARY KEY (`id_zamowienie_produkty`),
  ADD KEY `id_klienci` (`id_klienci`),
  ADD KEY `id_produkty` (`id_produkty`) USING BTREE,
  ADD KEY `id_zamowienia` (`id_zamowienia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `adres`
--
ALTER TABLE `adres`
  MODIFY `id_adres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id_kategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klienci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `id_koszyk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT dla tabeli `oferta_dnia`
--
ALTER TABLE `oferta_dnia`
  MODIFY `id_oferta_dnia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `opinie`
--
ALTER TABLE `opinie`
  MODIFY `id_opinie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id_produkty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT dla tabeli `promocje`
--
ALTER TABLE `promocje`
  MODIFY `id_promocje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `zamowienie_produkty`
--
ALTER TABLE `zamowienie_produkty`
  MODIFY `id_zamowienie_produkty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD CONSTRAINT `fk_klienci_adres` FOREIGN KEY (`id_adres`) REFERENCES `mydb`.`adres` (`id_adres`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `FK_Klient` FOREIGN KEY (`id_klienci`) REFERENCES `klienci` (`id_klienci`),
  ADD CONSTRAINT `FK_Produkt` FOREIGN KEY (`id_produkty`) REFERENCES `produkty` (`id_produkty`);

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
  ADD CONSTRAINT `fk_produkty_kategorie1` FOREIGN KEY (`id_kategorie`) REFERENCES `mydb`.`kategorie` (`id_kategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `promocje`
--
ALTER TABLE `promocje`
  ADD CONSTRAINT `fk_promocje_produkty1` FOREIGN KEY (`id_produkty`) REFERENCES `mydb`.`produkty` (`id_produkty`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `fk_zamowienia_klienci1` FOREIGN KEY (`id_klienci`) REFERENCES `mydb`.`klienci` (`id_klienci`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `zamowienie_produkty`
--
ALTER TABLE `zamowienie_produkty`
  ADD CONSTRAINT `fk_zamowienie_produkty_produkty1` FOREIGN KEY (`id_produkty`) REFERENCES `mydb`.`produkty` (`id_produkty`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
