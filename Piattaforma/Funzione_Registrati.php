<?php
    ob_start(); //Il contenuto viene memorizzato in una memoria di transito, venedno trattenuto temporaneamente, fino a quando non viene inviato al browser. Questo permette di eseguire operazioni come il reindirizzamento (header) anche dopo aver generato del contenuto, evitando errori di "headers already sent".
    require_once("./AltrePagine/Registrazione.php");
    include_once("../BaseDati/Connessione.php");
    include_once("../BaseDati/ChiaveSegreta.php");

    $Successo = false;

    if ($Cacciatorpediniere instanceof PDO && isset($_POST['invio'])) 
    {
        $Nome    = trim($_POST['Nome']);
        
        if (empty($Nome) || strlen($Nome) > 100) 
        {
            $Successo = false;
        }

        $Cognome = trim($_POST['Cognome']);
        $Posta   = filter_var($_POST['Posta'], FILTER_VALIDATE_EMAIL);
        $Chiave  = trim($_POST['Chiave']);
        $ChiaveHash = password_hash($Chiave, PASSWORD_ARGON2ID); # Nella base di dati, invece di memorizzare la password in chiaro, si memorizza un hash della password. Questo è un processo unidirezionale, il che significa che non è possibile risalire alla password originale a partire dall'hash. Quando un utente tenta di accedere, si confronta l'hash della password inserita con l'hash memorizzato nel database utilizzando la funzione password_verify().
        $Stato = trim($_POST['Stato']);
        $Ruolo = "Nessuno"; # Ogni nuovo utente registrato non avrà alcun ruolo, pertanto è necessario inserire direttamente "Nessuno" (la cella non può rimanere vuota).

        if (!$Posta) 
        {
            $Successo = false;
        }        
        
        else
        {
            /*
                PER RAGIONI DIMOSTRATIVE, SI MOSTRA ANCHE L'ALTERNATIVA SOLUZIONE CON MySQLi.

                $Interrogazione = $Connessione->prepare("INSERT INTO Utente (Chiave, Nome, Cognome, Posta, Ruolo) VALUES (?, ?, ?, ?, ?)");
                $Interrogazione->bind_param("sssss", $ChiaveHash, $Nome, $Cognome, $Posta, $Ruolo);
                $Successo = $Interrogazione->execute(); # La funzione execute() restituisce true se l'inserimento è avvenuto con successo, altrimenti restituisce false. Il risultato viene assegnato alla variabile $Successo, che viene utilizzata successivamente per determinare se la registrazione è stata completata con successo o meno.
                $Interrogazione->close();

                Questo era anche il codice fino alla precedente versione, senza try-catch e con MySQLi.
            */
            try
            {
                $Cacciatorpediniere->beginTransaction();
                $Interrogazione = $Cacciatorpediniere->prepare("INSERT INTO Utente (Stato, Nome, Cognome, Chiave, Ruolo) VALUES (:stato, :nome, :cognome, :chiave, :ruolo)");
                $Interrogazione->bindParam(":stato", $Stato);
                $Interrogazione->bindParam(":nome", $Nome);
                $Interrogazione->bindParam(":cognome", $Cognome);
                $Interrogazione->bindParam(":chiave", $ChiaveHash);
                $Interrogazione->bindParam(":ruolo", $Ruolo);
                $Successo = $Interrogazione->execute(); # La funzione execute() restituisce true se l'inserimento è avvenuto con successo, altrimenti restituisce false. Il risultato viene assegnato alla variabile $Successo, che viene utilizzata successivamente per determinare se la registrazione è stata completata con successo o meno.
                
                if ($Successo)
                {
                    $Cacciatorpediniere->commit();
                }
            }

            catch(PDOException $Errore)
            {
                error_log($Errore->getMessage()); // Salva l'errore nei registri del server
                $Cacciatorpediniere->rollBack(); // Annulla la transazione in caso di errore
                $Successo = false; // Imposta successo a false in caso di errore
            }
        }
    }

    if($Successo) // Gestione del JWT. Questa parte non è stata modificata nel passaggio da MySQLi a PDO.
    {
        // 1. INTESTAZIONE
        $Intestazione = [
            "alg" => "HS256",  // Algoritmo di hashing
            "typ" => "JWT"     // Tipo di token
        ];

        // 2. CORPO
        $Corpo = [
            "iat" => time(),          // Issued At: quando è stato emesso
            "exp" => time() + 3600,   // Expiration: scade dopo 1 ora
            "posta" => $Posta,        // Dati dell'utente
            "stato" => $Stato
        ];

        // 3. Funzione di codifica a Base64URL, una versione sicura di Base64 per URL e cookie
        function CodificaBase64URL($dati) 
        {
            return rtrim(strtr(base64_encode($dati), '+/', '-_'), '='); // Sostituisce + con -, / con _, e rimuove i padding =
            //di norma, la codifica Base64 aggiunge dei caratteri "=" alla fine della stringa per assicurare che la lunghezza sia un multiplo di 4. Tuttavia, in un contesto come i cookie o le URL, questi caratteri possono causare problemi, quindi vengono rimossi con rtrim.
        }

        // 4. Codifica intestazione e corpo con l'utilizzo della funzione definita sopra
        $IntestazioneCodificata = CodificaBase64URL(json_encode($Intestazione));
        $CorpoCodificato        = CodificaBase64URL(json_encode($Corpo));

        // 5. FIRMA, che corrisponde all'hash HMAC-SHA256 dell'intestazione e del corpo, utilizzando una chiave segreta
        $Firma = CodificaBase64URL(hash_hmac(
            "sha256", //algoritmo utilizzato per la firma
            "$IntestazioneCodificata.$CorpoCodificato", //dati da firmare, che sono l'intestazione e il corpo codificati, separati da un punto
            ChiaveSegreta, //la chiave da utilizzare per la firma, che deve essere mantenuta segreta e sicura
            true  // Output binario, poi codificato in Base64URL
        ));

        // 6. Costruzione del gettone JWT
        $JWT = "$IntestazioneCodificata.$CorpoCodificato.$Firma";

        // 7. Invio al cliente tramite cookie
        setcookie("jwt", $JWT, [
            "expires"  => time() + 3600,
            "httponly" => true,   // Non accessibile da JavaScript
            "secure"   => true,   // Solo HTTPS
            "samesite" => "Strict"
        ]);

        header("Location: ./PaginaPrincipale.php");
    }

    else
    {
        // L'utente rimane alla pagina di registrazione
        header("Location: ./Registrati.php");
    }

?>