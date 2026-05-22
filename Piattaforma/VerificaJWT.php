<?php

    require_once("./BaseDati/ChiaveSegreta.php");

    function VerificaJWT()
    {
        // 1. Controlla che il cookie esista
        if(!isset($_COOKIE["jwt"]))
        {
            header("Location: ./AltrePagine/Accedi.php");
            exit();
        }

        // 2. Separa le tre parti del token
        $Parti = explode(".", $_COOKIE["jwt"]); // Parti è un array con tre elementi.
        if(count($Parti) !== 3) // Un token JWT valido deve avere esattamente tre parti: intestazione, corpo e firma, separate da punti. Se il token non ha esattamente tre parti, è considerato malformato e quindi non valido. In questo caso, il codice reindirizza l'utente alla pagina di accesso, presumibilmente perché un token malformato non può essere verificato correttamente e potrebbe essere un tentativo di accesso non autorizzato.
        {
            header("Location: ./AltrePagine/Accedi.php");
            exit();
        }

        /* questo tipo di assegnazione qui sotto prende il nome di "destructuring assignment" (o destrutturazione degli array):
            è la stessa cosa di scrivere, separatamente:

            1) $IntestazioneCodificata = $Parti[0];
            2) $CorpoCodificato = $Parti[1];
            3) $FirmaRicevuta = $Parti[2];
            Ricordando che "Parti" è un array che contiene 3 elementi, ovvero le 3 parti del JWT
        */
        
        [$IntestazioneCodificata, $CorpoCodificato, $FirmaRicevuta] = $Parti;

        // 3. Ricalcola la firma e confronta
        $FirmaAttesa = rtrim(strtr(base64_encode(hash_hmac(
            "sha256",
            "$IntestazioneCodificata.$CorpoCodificato",
            ChiaveSegreta,
            true
        )), '+/', '-_'), '=');

        if(!hash_equals($FirmaAttesa, $FirmaRicevuta)) //hash_equals è una funzione che confronta due stringhe in modo sicuro contro attacchi di timing, restituendo true se sono identiche e false altrimenti.
        //È possibile che un attaccante possa misurare il tempo impiegato per confrontare due stringhe e dedurre informazioni sulla loro somiglianza. hash_equals è progettata per mitigare questo rischio, restituendo sempre lo stesso tempo di esecuzione indipendentemente dal punto in cui le stringhe differiscono.
        {
            header("Location: ./AltrePagine/Accedi.php");
            exit();
        }

        // 4. Decodifica il corpo e controlla la scadenza
        $Corpo = json_decode(base64_decode(strtr($CorpoCodificato, '-_', '+/')), true);

        if(!$Corpo || !isset($Corpo["exp"]) || $Corpo["exp"] < time())
        {
            header("Location: ./AltrePagine/Accedi.php");
            exit();
        }

        // 5. Restituisce i dati dell'utente
        return $Corpo;
    }
    
?>