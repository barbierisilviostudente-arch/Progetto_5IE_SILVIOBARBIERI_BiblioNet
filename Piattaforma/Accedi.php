<!-- NOTA SUL COMPORTAMENTO

    Questa pagina, essendo quella dedicata all'accesso dell'utente,
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
    <title>Accedi</title>
    <link rel="icon" type="image/x-icon" href="../Icone/Ricercatore.png">
</head>

<body>

    <div class="Corpo-Accesso">
        <div class="Sfondo-Presentazione">
            <br>
            <h1 id="Titolo_Principale">Accedi</h1>
            <br>
            <h5 id="Sotto-titolo">Ricomincia esattamente da dove avevi lasciato...</h5>
            <h5 id="Sotto-titolo">...tutto in pochi e semplici passaggi</h5>
            <hr>
        </div>

        <form action="Accedi_Registrati.php" id="Modulo-Accesso" method="post">
            <h3 id="Sotto-titolo">Compilare il modulo per accedere</h3>
            <br>
            <input type="email" name="Posta" placeholder="Indirizzo di posta elettronica" required>
            <br><br>
            <input type="password" name="Chiave" placeholder="Password" required>
            <br><br>
            <input type="text" name="Stato" placeholder="Stato (Italia or España)" required>
            <br><br>
            <button type="submit" name="Accedi">Accedi</button>
            <br><br>
            <p id="Sotto-titolo">Non hai un profilo? <a href="./Registrazione.php" id="Accedi-Registrati">Registrati ora</a></p>
        </form>
    </div>
    
</body>
</html>