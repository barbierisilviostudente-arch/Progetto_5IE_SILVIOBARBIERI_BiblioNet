<?php
    // È necessario, evidentemente, aver effettuato l'accesso per poter accedere alla pagina del proprio profilo.
    ob_start();
    include_once("../BaseDati/ChiaveSegreta.php");
    include_once("../BaseDati/Connessione.php");
    require_once("../VerificaJWT.php");

    $Utente = VerificaJWT();
    $Posta = $Utente["posta"];
    $Ruolo = $Utente["ruolo"];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo</title>
    <link rel="icon" type="image/x-icon" href="./Icone/Manoscritto.png">
    <link rel="stylesheet" href="./Stile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body id="Sfondo-Pagina">

    <!--INIZIO DEL MENU DI NAVIGAZIONE SOPRA-->
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./PaginaPrincipale.php">Torna all'inizio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Catalogo.php">Cataloghi: media e documenti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./ChiSiamo.php">Chi siamo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Ruolo.php">Pannello di ruolo</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--FINE DEL MENU DI NAVIGAZIONE SOPRA-->

    <?php
        if($Ruolo == "Pubblicatore")
        {
            // Viene mostrata la pagina riservata al pubblicatore.
            /* un pubblicatore può:
                
                - Creare nuove pagine
                - Modificare delle pagine già presenti.
                - Aggiungere dei commenti alle pagine.
                - Avvisare un moderatore o un provveditore.
                - Ricevere delle segnalazioni da un moderatore, da un provveditore o dall'amministratore.
                - Votare un amministratore durante le elezioni (la carica di Amministratore dura 36 mesi).
                    N.B. un Amministratore può essere un autore proveniente da un qualsiasi ruolo (pubblicatore o moderatore).
                         La carica di Provveditore (moderatore elevato ad assistente dell'Amministratore) esiste dipendentemente 
                         dall'amministratore.
                - Visualizzare gli elementi salvati tra i preferiti.

            */

            ?> 
            <form action="./Funzione_Profilo.php" method="POST">
                <select class="form-select" name="OpzioniProfilo" aria-label="Default select example">
                    <option value="" selected disabled>Seleziona una delle seguenti operazioni:</option>
                    <option value="CreaNuovePagine">Crea nuove pagine</option>
                    <option value="ModificaPagine">Modifica delle pagine esistenti</option>
                    <option value="AggiungiCommenti">Aggiungi dei commenti alle pagine</option>
                    <option value="AvvisaModeratore">Avvisa un moderatore o inviagli messaggi</option>
                    <option value="VisualizzaSegnalazioni">Visualizza segnalazioni e messaggi ricevuti</option>
                    <option value="VotazioneAmministratori">Pagina delle votazioni</option>
                    <option value="VisualizzaPreferiti">Pagina dei preferiti</option>
                </select>

                <button type="submit" name="ConfermaOpzioni">VAI</button>
            </form>
            <?php
        }

        elseif($Ruolo == "Moderatore")
        {
            // Viene mostrata la pagina riservata al Moderatore.
            /* un moderatore può:
                
                - Modificare delle pagine già presenti.
                - Eliminare delle pagine già presenti.
                - Aggiungere dei commenti alle pagine.
                - Eliminare dei commenti alle pagine.
                - Inviare delle segnalazioni agli utenti.
                    Regola per le segnalazioni:
                    1) Per un pubblicatore basta una sola segnalazione per far scattare la punizione.
                    2) Per un moderatore servono tre segnalazioni per far scattare la punizione.
                    3) Per un provveditore servono sette segnalazioni per far scattare la punizione.
                    4) Per l'amministratore servono nove segnalazioni, di cui almeno una per ogni ruolo.
                - Ricevere e visualizzare delle segnalazioni da un moderatore, da un provveditore o dall'amministratore.
                - Visualizzare gli elementi salvati tra i preferiti.
                - Essere eletto a provveditore dall'amministratore. La carica di provveditore ha una durata di 18 mesi.
            */

            ?> 
            <form action="./Funzione_Profilo.php" method="POST">
                <select class="form-select" name="OpzioniProfilo" aria-label="Default select example">
                    <option value="" selected disabled>Seleziona una delle seguenti operazioni:</option>
                    <option value="ModificaPagine">Modifica delle pagine esistenti</option>
                    <option value="EliminaPagine">Elimina delle pagine</option>
                    <option value="AggiungiCommenti">Aggiungi dei commenti alle pagine</option>
                    <option value="EliminaCommenti">Elimina dei commenti</option>
                    <option value="InviaSegnalazioni">Invia avvisi e messaggi ad altri utenti</option>
                    <option value="VisualizzaSegnalazioni">Visualizza segnalazioni e messaggi ricevuti</option>
                    <option value="VisualizzaPreferiti">Pagina dei preferiti</option>
                </select>

                <button type="submit" name="ConfermaOpzioni">VAI</button>
            </form>
            <?php
        }

        elseif($Ruolo == "Provveditore")
        {
            // Viene mostrata la pagina riservata al Provveditore (Moderatore promosso ad assistente dell'Amministratore).
            /* un provveditore può:
                
                - Modificare delle pagine già presenti.
                - Eliminare delle pagine già presenti.
                - Aggiungere dei commenti alle pagine.
                - Eliminare dei commenti alle pagine.
                - Inviare delle segnalazioni agli utenti.
                - Inviare avvisi a: 
                    pubblicatori e moderatori tramite il normale canale di comunicazione.
                    provveditori e amministratore tramite un canale separato, in una sezione dedicata della piattaforma.
                - Ricevere e visualizzare delle segnalazioni da un moderatore, da un provveditore o dall'amministratore.
                - Visualizzare gli elementi salvati tra i preferiti.
                - Votare l'eliminazione di un utente (servono i voti di almeno 11 provveditori).
                - Bloccare un utente per massimo tre giorni, con l'approvazione di almeno 11 provveditori.
                - La carica di provveditore ha una durata di 18 mesi (dopo tornerà ad essere un normale moderatore).
            */
        }

        elseif($Ruolo == "Amministratore")
        {
            // Viene mostrata la pagina riservata all'Amministratore.
            /* un amministratore può:
                
                - Creare nuove pagine
                - Modificare delle pagine già presenti.
                - Eliminare delle pagine già presenti.
                - Aggiungere dei commenti alle pagine.
                - Eliminare dei commenti alle pagine.
                - Inviare delle segnalazioni agli utenti.
                - Ricevere e visualizzare delle segnalazioni da un moderatore o da un amministratore.
                - Promuovere o declassare un utente.
                - Bloccare un utente, indipendentemente dal suo ruolo, per un massimo di due settimane.
                - Eliminare un utente, se ricevuta l'approvazione da almeno 11 provveditori, se la stessa violazione viene comessa almeno tre volte in un anno.
                - Controllare statistiche della piattaforma (tempo medio di utilizzo etc etc) 
                - Visualizzare gli elementi salvati tra i preferiti.

            */

            ?> 
            <form action="./Funzione_Profilo.php" method="POST">
                <select class="form-select" name="OpzioniProfilo" aria-label="Default select example">
                    <option value="" selected disabled>Seleziona una delle seguenti operazioni:</option>
                    <option value="CreaNuovePagine">Crea nuove pagine</option>
                    <option value="ModificaPagine">Modifica delle pagine esistenti</option>
                    <option value="EliminaPagine">Elimina delle pagine</option>
                    <option value="AggiungiCommenti">Aggiungi dei commenti alle pagine</option>
                    <option value="EliminaCommenti">Elimina dei commenti</option>
                    <option value="InviaSegnalazioni">Invia avvisi e messaggi ad altri utenti</option>
                    <option value="VisualizzaSegnalazioni">Visualizza segnalazioni e messaggi ricevuti</option>
                    <option value="PromozioniDeclassamenti">Promuovi o declassa un utente</option>
                    <option value="Statistiche">Controlla le statistiche della piattaforma</option>
                    <option value="VisualizzaPreferiti">Pagina dei preferiti</option>
                </select>

                <button type="submit" name="ConfermaOpzioni">VAI</button>
            </form>
            <?php
        }

        else
        {
            // Se il ruolo non corrisponde a nessuno dei tre, allora vuol dire che l'intero dato sulla base di dati, per come è stato letto, non è corretto, oppure un utente malintenzionato ha operato sulla pagina.
            // La soluzione, drastica ma efficace, è quella di rimuovere l'utente dalla base di dati e obbligarlo a effettuare nuovamente la registrazione.
            $Successo = false;
            
            while(!$Successo)
            {
                try
                {
                    $Cacciatorpediniere->beginTransaction();
                    $Interrogazione = $Cacciatorpediniere->prepare("DELETE FROM Utenti WHERE posta = :posta");
                    $Interrogazione->bindParam(':posta', $Posta);
                    $Interrogazione->execute();
                    header("Location: ./Registrati.php");
                    $Successo = true;
                }

                catch(PDOException $Eccezione)
                {
                    error_log($Eccezione->getMessage()); // Salva l'errore nei registri del server.
                    $Cacciatorpediniere->rollBack(); // Annulla la transazione in caso di errore
                    $Successo = false; // Impostazione per ricominciare l'esecuzione.
                }
            }            
        }
    ?>

    <!--INIZIO DEL MENU DI NAVIGAZIONE IN FONDO-->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../PaginaPrincipale.php">Torna all'inizio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Catalogo.php">Cataloghi: media e documenti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./ChiSiamo.php">Chi siamo</a>
                </li>
            </ul>
        </div>

        <div>
            <p>
                BiblioNet Versione 26w19b - 16/03/ AD 2026 - Silvio Barbieri
            </p>
        </div>
    </nav>

    <!--FINE DEL MENU DI NAVIGAZIONE IN FONDO-->
</body>
</html>