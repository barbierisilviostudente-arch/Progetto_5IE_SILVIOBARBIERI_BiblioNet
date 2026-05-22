<!--?php            N.B. Verificare il JWT anche in questa pagina significherebbe rendere la registrazione obbligatoria
    ob_start();
    include_once("../BaseDati/ChiaveSegreta.php");
    require_once("../VerificaJWT.php");

    $Utente = VerificaJWT();
    $Posta = $Utente["posta"];
    $Ruolo = $Utente["ruolo"];

    QUESTA SEZIONE, ANCHE SE NON IMPIEGATA, SERVE PER SPIEGARE LA DIFFERENZA TRA UNA PAGINA CON ACCESSO OBBLIGATORIO E UNA PAGINA LIBERAMENTE CONSULTABILE.
?-->

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cataloghi e media</title>
    <link rel="icon" type="image/x-icon" href="../Icone/Catalogo.png">
    <link rel="stylesheet" href="./Stile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body class="Sfondo-Argento">

<!--INIZIO DEL MENU DI NAVIGAZIONE SUPERIORE-->
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="./PaginaPrincipale.php">Torna all'inizio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./ChiSiamo.php">Chi siamo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Profilo.php">Profilo</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--FINE DEL MENU DI NAVIGAZIONE SUPERIORE-->

    <br><br>

    <form action="PagineContenuti.php" method="GET">

        <div class="form-check">
            <input class="form-check-input" type="radio" name="Formato" value="Testo" checked id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Ottieni un testo
            </label>
        </div>

        <br>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="Formato" value="AudioVideo" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
                Ottieni un audio oppure un video
            </label>
        </div>

        <br>

        <select class="form-select" name="Stato" aria-label="Default select example">
            <option value="" selected disabled>Seleziona uno degli stati presenti nel registro</option>
            <option value="BaliaggioBellinzona">Il Baliaggio di Bellinzona</option>
            <option value="Brandeburgo-Prussia">Il Brandeburgo-Prussia</option>
            <option value="DucatoMantova">Il Ducato di Mantova</option>
            <option value="DucatoModenaReggio">Il Ducato di Modena e Reggio</option>
            <option value="DucatoParmaPiacenza">Il Ducato di Parma e Piacenza</option>
            <option value="ElettoratoBaviera">L'Elettorato della Baviera</option>
            <option value="GranducatoToscana">Il Granducato di Toscana</option>
            <option value="ImperoCinese">L'Impero Cinese</option>
            <option value="ImperoOttomano">L'Impero Ottomano</option>
            <option value="ImperoPortoghese">L'Impero Portoghese</option>
            <option value="ImperoRomanoOriente">L'Impero Romano d'Oriente</option>
            <option value="ImperoRusso">L'Impero Russo</option>
            <option value="ImperoSpagnolo">L'Impero Spagnolo</option>
            <option value="MonarchiaAsburgica">La Monarchia Asburgica</option>
            <option value="RegnoFrancia">Il Regno di Francia</option>
            <option value="RegnoInghilterra">Il Regno d'Inghilterra</option>
            <option value="RegnoItalia">Il Regno d'Italia</option>
            <option value="RepubblicaGenova">La Repubblica di Genova</option>
            <option value="RepubblicaItaliana">La Repubblica Italiana</option>
            <option value="RepubblicaSetteProvincieUnite">La Repubblica delle Sette Provincie Unite</option>
            <option value="RepubblicaVenezia">La Repubblica di Venezia</option>
            <option value="ShogunatoTokugawa">Lo Shogunato Tokugawa</option>
            <option value="StatoChiesa">Lo Stato della Chiesa</option>
            <option value="StatoMilano">Lo Stato di Milano</option>
        </select>

        <br>

        <button type="submit" name="Conferma">Cerca</button>

    </form>

    <br><br><br>

    <!--INIZIO DEL MENU DI NAVIGAZIONE INFERIORE-->
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="./PaginaPrincipale.php">Torna all'inizio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./ChiSiamo.php">Chi siamo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Profilo.php">Profilo</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--FINE DEL MENU DI NAVIGAZIONE INFERIORE-->
    
</body>

</html>

