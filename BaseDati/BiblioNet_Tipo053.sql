-- CONFIGURAZIONI DI BASE DI SQL

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Dic 19, 2025 alle 10:36
-- Versione del server: 10.1.10-MariaDB
-- Versione PHP: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BiblioNet_Tipo053`
--

CREATE DATABASE BiblioNet_Tipo053;
USE BiblioNet_Tipo053;

-- --------------------------------------------------------
-- 1 ELEMENTO
-- Struttura della tabella `Elemento`

CREATE TABLE `Elemento` (
  `Codice_Elemento` INT NOT NULL AUTO_INCREMENT,
  `Data_Elemento` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Territorio_Riferimento` varchar(255) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Collegamento_Testo` varchar(2083) NOT NULL, 
  `Stato` ENUM('IT','ES') NOT NULL DEFAULT 'IT',
  PRIMARY KEY (`Codice_Elemento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Nota Bene: 2083 è il limite di Internet Explorer per gli indirizzi, de facto la norma per gli URL (in questo caso viene generalizzato e preso come limite per il percorso assoluto della risorsa).
--
-- Indici per le tabelle scaricate
--

--
-- Dati inseriti all'interno della tabella Elemento
--

-- --------------------------------------------------------
-- 2 UTENTE
-- Struttura della tabella `Utente`
-- NON USA CHIAVI ESTERNE

CREATE TABLE `Utente` (
  `Codice_Utente` INT NOT NULL AUTO_INCREMENT,
  `Stato` ENUM('IT','ES') NOT NULL DEFAULT 'IT',
  `Nome` varchar(100) NOT NULL,
  `Cognome` varchar(100) NOT NULL,
  `Chiave` varchar(255) NOT NULL,
  `Ruolo` ENUM('Nessuno','Pubblicatore','Moderatore','Provveditore','Amministratore') NOT NULL DEFAULT 'Nessuno',
  PRIMARY KEY (`Codice_Utente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dati inseriti all'interno della tabella Utente
--

--  Nota importante: 
--  ogni esecuzione produce hash diversi perché Argon2 genera un salt casuale a ogni chiamata
--  questo è il comportamento corretto e sicuro. Per la verifica si usa sempre la funzione verify(), non un confronto diretto tra stringhe.

-- --------------------------------------------------------
-- 3 MODIFICA ELEMENTO
-- Struttura della tabella `Modifica Elemento`
-- USA CHIAVI ESTERNE

CREATE TABLE `ModificaElemento` (
  `Codice_ModificaElemento` INT NOT NULL AUTO_INCREMENT,
  `Codice_Elemento` INT NOT NULL,
  `Codice_Utente` INT NOT NULL,
  `Testo_Modifica_Elemento` TEXT NOT NULL,
  `Data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Stato` ENUM('IT','ES') NOT NULL DEFAULT 'IT',
  PRIMARY KEY (`Codice_ModificaElemento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Aggiunta della chiave esterna con riferimento al codice dell'utente
--

ALTER TABLE `ModificaElemento`
  ADD CONSTRAINT `CE_ModificaElemento_Utente`
  FOREIGN KEY (`Codice_Utente`)
  REFERENCES `Utente` (`Codice_Utente`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;

--
-- Aggiunta della chiave esterna con riferimento al codice dell'elemento
--

ALTER TABLE `ModificaElemento`
  ADD CONSTRAINT `CE_ModificaElemento_Elemento`
  FOREIGN KEY (`Codice_Elemento`)
  REFERENCES `Elemento` (`Codice_Elemento`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;

--
-- Dati inseriti all'interno della tabella ModificaElemento
--

-- --------------------------------------------------------
-- 4 COMMENTO
-- Struttura della tabella `Commento`
-- USA CHIAVI ESTERNE

CREATE TABLE `Commento` (
  `Codice_Commento` INT NOT NULL AUTO_INCREMENT,
  `Codice_Utente` INT NOT NULL,
  `Data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Testo_Commento` TEXT NOT NULL,
  `Codice_Elemento` INT NOT NULL,
  `Stato` ENUM('IT','ES') NOT NULL DEFAULT 'IT',
   PRIMARY KEY (`Codice_Commento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Aggiunta della chiave esterna con riferimento al codice dell'utente
--

ALTER TABLE `Commento`
  ADD CONSTRAINT `CE_Commento_Utente`
  FOREIGN KEY (`Codice_Utente`) REFERENCES `Utente` (`Codice_Utente`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Aggiunta della chiave esterna con riferimento al codice dell'elemento
--

ALTER TABLE `Commento`
  ADD CONSTRAINT `CE_Commento_Elemento`
  FOREIGN KEY (`Codice_Elemento`) REFERENCES `Elemento` (`Codice_Elemento`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Dati inseriti all'interno della tabella Commento
--

-- --------------------------------------------------------
-- 5 SEGNALAZIONE
-- Struttura della tabella `Segnalazione`
-- USA CHIAVI ESTERNE

CREATE TABLE `Segnalazione` (
  `Codice_Segnalazione` INT NOT NULL AUTO_INCREMENT,
  `Codice_Mittente` INT NOT NULL,
  `Codice_Destinatario` INT NOT NULL,
  `Testo_Segnalazione` TEXT NOT NULL,
  `Data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Categoria` ENUM('Spam','Contenuto inappropriato', 'Abuso di ruolo istituzionale') NOT NULL DEFAULT 'Spam',
  `Stato` ENUM('IT','ES') NOT NULL DEFAULT 'IT',
  PRIMARY KEY (`Codice_Segnalazione`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Aggiunta della chiave esterna con riferimento al codice dell'utente mittente
--

ALTER TABLE `Segnalazione`
  ADD CONSTRAINT `CE_Segnalazione_Mittente`
  FOREIGN KEY (`Codice_Mittente`)
  REFERENCES `Utente` (`Codice_Utente`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;

--
-- Aggiunta della chiave esterna con riferimento al codice dell'utente destinatario
--

ALTER TABLE `Segnalazione`
  ADD CONSTRAINT `CE_Segnalazione_Destinatario`
  FOREIGN KEY (`Codice_Destinatario`)
  REFERENCES `Utente` (`Codice_Utente`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;

ALTER TABLE `Segnalazione`
  ADD CONSTRAINT `CHK_no_auto_segnalazione`
  CHECK (`Codice_Mittente` <> `Codice_Destinatario`);

--
-- Dati inseriti all'interno della tabella Segnalazione
--

-- --------------------------------------------------------
-- 6 AVVISO
-- Struttura della tabella `Avviso`
-- USA CHIAVI ESTERNE

CREATE TABLE `Avviso` (
  `Codice_Avviso` INT NOT NULL AUTO_INCREMENT,
  `Codice_Mittente` INT NOT NULL,
  `Codice_Destinatario` INT NOT NULL,
  `Testo_Avviso` TEXT NOT NULL,
  `Data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Stato` ENUM('IT','ES') NOT NULL DEFAULT 'IT',
  PRIMARY KEY (`Codice_Avviso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Aggiunta della chiave esterna con riferimento al codice dell'utente mittente
--

ALTER TABLE `Avviso`
  ADD CONSTRAINT `CE_Avviso_Mittente`
  FOREIGN KEY (`Codice_Mittente`)
  REFERENCES `Utente` (`Codice_Utente`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;

--
-- Aggiunta della chiave esterna con riferimento al codice dell'utente destinatario
--

ALTER TABLE `Avviso`
  ADD CONSTRAINT `CE_Avviso_Destinatario`
  FOREIGN KEY (`Codice_Destinatario`)
  REFERENCES `Utente` (`Codice_Utente`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;

--
-- Dati inseriti all'interno della tabella Avviso
--

-- --------------------------------------------------------
-- 7 PREFERITI
-- Tabella per gestire i preferiti

CREATE TABLE `Preferiti_Utente` (
  `Codice_Utente` INT NOT NULL,
  `Codice_Elemento` INT NOT NULL,
  `Data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Codice_Utente`, `Codice_Elemento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `Preferiti_Utente`
  ADD CONSTRAINT `CE_pref_utn`
  FOREIGN KEY (`Codice_Utente`)
  REFERENCES `Utente` (`Codice_Utente`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;


ALTER TABLE `Preferiti_Utente`
  ADD CONSTRAINT `CE_pref_pag`
  FOREIGN KEY (`Codice_Elemento`)
  REFERENCES `Elemento` (`Codice_Elemento`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

--
-- Dati inseriti all'interno della tabella Preferiti_Utente
--

-- --------------------------------------------------------
-- 8 POSTA ELETTRONICA
-- Tabella per gestire i diversi indirizzi di posta elettronica

CREATE TABLE `Posta_Elettronica` (
  `IndirizzoPE` varchar(255) NOT NULL,
  `Codice_Utente` INT NOT NULL,
  PRIMARY KEY (`IndirizzoPE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `Posta_Elettronica`
  ADD CONSTRAINT `CE_pe_utn`
  FOREIGN KEY (`Codice_Utente`)
  REFERENCES `Utente` (`Codice_Utente`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

--
-- Dati inseriti all'interno della tabella Posta_Elettronica
--