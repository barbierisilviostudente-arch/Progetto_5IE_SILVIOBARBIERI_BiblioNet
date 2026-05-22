<?php
    ob_start(); //Il contenuto viene memorizzato in una memoria di transito, venedno trattenuto temporaneamente, fino a quando non viene inviato al browser. Questo permette di eseguire operazioni come il reindirizzamento (header) anche dopo aver generato del contenuto, evitando errori di "headers already sent".
    require_once("./AltrePagine/Registrazione.php");
    include_once("../BaseDati/Connessione.php");
    include_once("../BaseDati/ChiaveSegreta.php");

    $Successo = false;

    if ($Cacciatorpediniere instanceof PDO && isset($_POST['invio'])) 
    {
        $Stato = trim($_POST['Stato']);
        $Posta   = filter_var($_POST['Posta'], FILTER_VALIDATE_EMAIL);
        $Chiave  = $_POST['Chiave']; 

        if (!$Posta) 
        {
            $Successo = false;
        }
        
        else
        {
            try
            {
                /*
                    PER RAGIONI DIMOSTRATIVE, SI MOSTRA ANCHE L'ALTERNATIVA SOLUZIONE CON MySQLi.

                    $Interrogazione = $Connessione->prepare("SELECT * FROM Utente WHERE Posta = ?");
                    $Interrogazione->bind_param("s", $Posta);
                    $Interrogazione->execute();
                    $Risultato = $Interrogazione->get_result();
                    $Utente = $Risultato->fetch_assoc();

                    if(Utente === null)
                    {
                        $Successo = false;
                    }

                    else
                    {
                        $Ruolo = $Utente["Ruolo"];
                        $ChiaveUtente = $Utente["Chiave"];
                        $Successo = password_verify($Chiave, $ChiaveUtente);
                    }

                    $Interrogazione->close();

                    Questo era anche il codice fino alla precedente versione, senza try-catch e con MySQLi.
                */

                $Interrogazione = $Cacciatorpediniere->prepare("SELECT * FROM Utente WHERE Posta = :posta");
                $Interrogazione->bindParam(":posta", $Posta);
                $Interrogazione->execute();

                // Estrai la riga come array associativo

                $Utente = $Interrogazione->fetch(PDO::FETCH_ASSOC);
                
                if($Utente === false)
                {
                    $Successo = false;
                }

                else
                {
                    $Ruolo = $Utente["Ruolo"];
                    $ChiaveUtente = $Utente["Chiave"];
                    $Successo = password_verify($Chiave, $ChiaveUtente);
                }
            }

            catch(PDOException $Eccezione)
            {
                error_log($Eccezione->getMessage()); // Salva l'errore nei registri del server.
                $Successo = false;
            }
                
        }
    }

    /*
        Oltre ai cookie, gli altri modi per memorizzare il JWT sono:

        1) Archiviazione locale.

        2) Archiviazione di sessione.

        N.B. JWT si basa sempre sul concetto che deve essere il cliente a memorizzare le informazioni,
             sollevando il server dall'onere di memorizzare le informazioni. 

    */

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
            "ruolo" => $Ruolo
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
            "samesite" => "Strict" // Impedisce l'invio del cookie in contesti di terze parti, riducendo il rischio di attacchi CSRF
        ]);

        header("Location: ./PaginaPrincipale.php");
    }

    else
    {
        // L'utente rimane alla pagina di registrazione
        header("Location: ./Registrati.php");
    }

?>