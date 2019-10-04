-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: 29 giu, 2012 at 11:31 AM
-- Versione MySQL: 5.1.37
-- Versione PHP: 5.2.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `urbino_shop`
--
CREATE DATABASE `urbino_shop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `urbino_shop`;

-- --------------------------------------------------------

--
-- Struttura della tabella `tblcarrello`
--

CREATE TABLE IF NOT EXISTS `tblcarrello` (
  `IDutente` int(11) DEFAULT NULL,
  `IDprodotto` int(11) DEFAULT NULL,
  `Qta` smallint(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tblcarrello`
--

INSERT INTO `tblcarrello` (`IDutente`, `IDprodotto`, `Qta`) VALUES
(3, 1, 5),
(2, 1, 5),
(2, 5, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tblcategoria`
--

CREATE TABLE IF NOT EXISTS `tblcategoria` (
  `IDcategoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nome` varchar(25) DEFAULT NULL,
  `Descrizione` text,
  `Foto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDcategoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `tblcategoria`
--

INSERT INTO `tblcategoria` (`IDcategoria`, `Nome`, `Descrizione`, `Foto`) VALUES
(1, 'Bevande', 'Bibite analcoliche, caffè, tè e birra', 'immagini/bevande.jpg'),
(2, 'Dolci', 'Dessert, caramelle e dolci', 'immagini/dolci.jpg'),
(3, 'Pane', 'Pane tipico da ciascuna regione italiana', 'immagini/pane.jpg'),
(4, 'Formaggi', 'Formaggi tipici italiani, francesi, svizzeri', 'immagini/formaggi.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `tblordine`
--

CREATE TABLE IF NOT EXISTS `tblordine` (
  `IDordine` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IDutente` int(11) DEFAULT NULL,
  `IDprodotto` int(11) DEFAULT NULL,
  `Quantità` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`IDordine`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `tblordine`
--

INSERT INTO `tblordine` (`IDordine`, `IDutente`, `IDprodotto`, `Quantità`) VALUES
(1, 2, 5, 5),
(2, 2, 13, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `tblprodotto`
--

CREATE TABLE IF NOT EXISTS `tblprodotto` (
  `IDprodotto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IDcategoria` int(11) DEFAULT NULL,
  `Nome` varchar(25) DEFAULT NULL,
  `Descrizione` text,
  `Foto` varchar(50) DEFAULT NULL,
  `Prezzo` decimal(10,0) DEFAULT NULL,
  `Disponibile` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IDprodotto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dump dei dati per la tabella `tblprodotto`
--

INSERT INTO `tblprodotto` (`IDprodotto`, `IDcategoria`, `Nome`, `Descrizione`, `Foto`, `Prezzo`, `Disponibile`) VALUES
(1, 1, 'Birra lager', 'Birra chiara 33cl di importazione', 'immagini/birralager.jpg', 2, 'elevata'),
(3, 1, 'Birra black', 'Birra scura 33cl di produzione propria', 'immagini/birrablack.jpg', 3, 'buona'),
(4, 2, 'Gelato artigianale', '3 Gusti frutta 1,5kg', 'immagini/gelato.jpg', 2, 'buona'),
(5, 2, 'Gelato industriale', '3 Gusti crema 2,5kg', 'immagini/gelato.jpg', 2, 'buona'),
(6, 2, 'Cioccolato fondente', '2 tavolette da 300 grammi', 'immagini/cioccofondente.jpg', 5, 'discreta'),
(7, 2, 'Cioccolato al latte', '3 tavolette da 250 grammi', 'immagini/cioccolatte.jpg', 4, 'buona'),
(8, 1, 'Vino rosso novello', '12 bottiglie da 1 litro (Italia)', 'immagini/vinorosso.jpg', 12, 'elevata'),
(9, 1, 'Vino bianco novello', '12 bottiglie da 1 litro (Italia)', 'immagini/vinobianco.jpg', 11, 'buona'),
(10, 1, 'Vino rosso - Merlot', '6 bottiglie da 1 litro (Italia)', 'immagini/vinorosso.jpg', 24, 'discreta'),
(11, 1, 'Vino rosso - Barbera', '6 bottiglie da 1 litro (Italia)', 'immagini/vinorosso.jpg', 22, 'discreta'),
(12, 3, 'Pane comune - Toscano', '2 pagnotte da 500 grammi - Fresco di forno', 'immagini/panetoscano.jpg', 3, 'discreta'),
(13, 3, 'Pane speciale - Olio', '4 pagnotte da 250 grammi - Fresco di forno', 'immagini/panespeciale.jpg', 6, 'discreta'),
(14, 4, 'Pecorino romano', '1 forma da 3 kg', 'immagini/pecorinoromano.jpg', 12, 'buona'),
(15, 4, 'Casciotta urbinate', '1 forma da 2 kg', '', 10, 'buona');

-- --------------------------------------------------------

--
-- Struttura della tabella `tblruolo`
--

CREATE TABLE IF NOT EXISTS `tblruolo` (
  `IDruolo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Ruolo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`IDruolo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `tblruolo`
--

INSERT INTO `tblruolo` (`IDruolo`, `Ruolo`) VALUES
(1, 'amministratore'),
(2, 'cliente'),
(3, 'servizio');

-- --------------------------------------------------------

--
-- Struttura della tabella `tblutente`
--

CREATE TABLE IF NOT EXISTS `tblutente` (
  `IDutente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserName` varchar(10) DEFAULT NULL,
  `Password` varchar(10) DEFAULT NULL,
  `Ruolo` int(11) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Indirizzo` varchar(50) DEFAULT NULL,
  `Telefono` varchar(50) DEFAULT NULL,
  `EMail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDutente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dump dei dati per la tabella `tblutente`
--

INSERT INTO `tblutente` (`IDutente`, `UserName`, `Password`, `Ruolo`, `Nome`, `Indirizzo`, `Telefono`, `EMail`) VALUES
(2, 'primo', 'primo', 2, 'Primo Utente', 'piazza', '', 'primo@urbinoshop.it'),
(3, 'admin', 'admin', 1, 'Amministratore del sito', 'viale', '6597', 'secondo@urbinoshop.it'),
(7, 'quarto', 'quarto', 2, 'Quarto utente', 'rio', '5555', 'quarto@urbinoshop.it'),
(11, 'caio', 'tizio', 2, 'Signor Caio', 'via', '1111', 'caio@errore.it');
