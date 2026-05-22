<?php
    /*
    VECCHIA SOLUZIONE CON MYSQLI, SOSTITUITO DA PDO.

    $NomeServer = "localhost";
    $NomeUtente = "root";
    $Chiave = "";
    $NomeBaseDati = "BiblioNet_Tipo053";
    $Connessione = "";

    try
    {
        $Connessione = new mysqli($NomeServer, $NomeUtente, $Chiave, $NomeBaseDati);
    }
    catch(mysqli_sql_exception $Errore)
    {
        error_log($Errore->getMessage()); // Salva l'errore nei registri del server
        echo "Errore interno del server."; // Messaggio generico per l'utente
        exit();
    }*/

    // VERSIONE AGGIORNATA CON L'UTILIZZO DI PDO PER UNA GESTIONE MIGLIORE DEGLI ERRORI E DELLE CONNESSIONI.

    $NomeServer = "localhost";
    $NomeUtente = "root";
    $Chiave = "";
    $NomeBaseDati = "BiblioNet_Tipo053";
    $Connessione = "mysql:host={$NomeServer};dbname={$NomeBaseDati}";

    try
    {
        $Cacciatorpediniere = new PDO($Connessione, $NomeUtente, $Chiave);
    }

    catch(PDOException $Eccezione)
    {
        error_log($Eccezione->getMessage());
        exit();
    }
?>