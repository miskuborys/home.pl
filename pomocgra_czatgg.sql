-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 24 Maj 2013, 12:09
-- Wersja serwera: 5.0.91-log
-- Wersja PHP: 5.3.21

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `pomocgra_czatgg`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ban`
--

CREATE TABLE IF NOT EXISTS `ban` (
  `id` int(11) NOT NULL auto_increment,
  `numergg` int(11) NOT NULL,
  `databana` date NOT NULL,
  `loginban` varchar(10) NOT NULL,
  `powodban` tinytext NOT NULL,
  `numer_c` int(11) NOT NULL,
  `czas` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=315 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `baza`
--

CREATE TABLE IF NOT EXISTS `baza` (
  `id` int(11) NOT NULL auto_increment,
  `uzytk_online` varchar(15) NOT NULL,
  `numergg` int(11) NOT NULL,
  `data` date NOT NULL,
  `ilosckick` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1669 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE IF NOT EXISTS `konta` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(20) NOT NULL,
  `haslo` varchar(40) NOT NULL,
  `nr_czatu` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL auto_increment,
  `numer` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `tresc` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `data2` date NOT NULL,
  `kanal` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=310916 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `numery_czat`
--

CREATE TABLE IF NOT EXISTS `numery_czat` (
  `id` int(11) NOT NULL auto_increment,
  `num_c` int(11) NOT NULL,
  `nazwa_c` varchar(30) NOT NULL,
  `temat` varchar(80) NOT NULL,
  `admin` int(11) NOT NULL,
  `regulamin` text NOT NULL,
  `prywatny` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=118 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `opis`
--

CREATE TABLE IF NOT EXISTS `opis` (
  `id` int(11) NOT NULL auto_increment,
  `status` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `opis`
--

INSERT INTO `opis` (`id`, `status`) VALUES
(1, 'Aby wejsc do czatu wpisz start, aby wyjsc koniec . Zapraszamy na www.Pomoc-Gracza.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rangi`
--

CREATE TABLE IF NOT EXISTS `rangi` (
  `id` int(11) NOT NULL auto_increment,
  `numergg` int(11) NOT NULL,
  `ranga` int(1) NOT NULL,
  `kolor` varchar(10) NOT NULL,
  `num_c2` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=306 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy_online`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy_online` (
  `id` int(11) NOT NULL auto_increment,
  `numergg` int(11) NOT NULL,
  `data3` datetime NOT NULL,
  `num_c` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16107 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
