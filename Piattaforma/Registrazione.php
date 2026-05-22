<!-- NOTA SUL COMPORTAMENTO

    Questa pagina, essendo quella dedicata alla registrazione dell'utente,
    deve essere, evidentemente, raggiungibile senza alcun controllo
    sulla sessione.

-->

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Stile_RegistrazioneAccesso.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Registrazione</title>
    <link rel="icon" type="image/x-icon" href="../Icone/Ricercatore.png">
</head>

<body>

    <div class="Corpo-Accesso">
        <div class="Sfondo-Presentazione">
            <br>
            <h1 id="Titolo_Principale">Registrazione</h1>
            <br>
            <h5 id="Sotto-titolo">Sfrutta tutte le possibilità della piattaforma BiblioNet...</h5>
            <h5 id="Sotto-titolo">...diventa anche tu un membro</h5>
            <hr>
        </div>

        <form action="Funzione_Registrati.php" id="Modulo-Accesso" method="post">
            <br>
            <h4 id="Sotto-titolo-Registrazione">Compilare il modulo per registrarsi</h4>
            <br>
            <input type="text" name="Nome" placeholder="Nome" required>
            <br><br>
            <input type="text" name="Cognome" placeholder="Cognome" required>
            <br><br>
            <input type="email" name="Posta" placeholder="Indirizzo di posta elettronica" required>
            <br><br>
            <input type="password" name="Chiave" placeholder="Password" required>
            <br><br>
            <h4 id="Sotto-titolo-Registrazione">Seleziona il tuo stato:</h4>
            <br>
            <select name="Stato" id="Stato">   
                <option value="IT">Italia</option>
                <option value="ES">España</option>
            </select>
            <br><br>
            <button type="submit" name="Registrati">Registra il profilo</button>
            <br><br>
            <p id="Sotto-titolo">Hai già un profilo? <a href="./Accedi.php" id="Accedi-Registrati">Accedi</a></p>
        </form>
    </div>
    
</body>
</html>