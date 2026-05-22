<!--?php            N.B. Verificare il JWT anche in questa pagina significherebbe rendere la registrazione obbligatoria
    ob_start();
    include_once("../BaseDati/ChiaveSegreta.php");
    require_once("./VerificaJWT.php");

    $Utente = VerificaJWT();
    $Posta = $Utente["posta"];
    $Ruolo = $Utente["ruolo"];
    $Provincia = $Utente["provincia"];

    QUESTA SEZIONE, ANCHE SE NON IMPIEGATA, SERVE PER SPIEGARE LA DIFFERENZA TRA UNA PAGINA CON ACCESSO OBBLIGATORIO E UNA PAGINA LIBERAMENTE CONSULTABILE.
?-->

<!-- IMPLEMENTAZIONE DELLA LOCALIZZAZIONE NELLA APPLICAZIONE (GESTIONE DEL MULTI-TENANT)
    <h1 data-i18n="welcome_message">Benvenuto nella nostra applicazione</h1>
    <button data-i18n="login_button">Accedi</button>
-->

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principale</title>
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
                    <a class="nav-link" href="./Catalogo.php">Cataloghi: media e documenti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./ChiSiamo.php">Chi siamo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Profilo.php">Profilo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Ruolo.php">Pannello di ruolo</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--FINE DEL MENU DI NAVIGAZIONE SOPRA-->

    <div class="Sfondo-Presentazione">
        <br>
        <h1 id="Titolo_Principale">BiblioNet</h1>
        <h3 id="Sotto-titolo">"Un archivio grande come il mondo"</h3>

        <h4 id="Sotto-titolo">Accedi a migliaia di manoscritti, trattati e documenti storici provenienti dagli archivi dei più antichi regni, imperi e repubbliche.</h3>
        
        <br>

        <div class="d-flex justify-content-center align-items-start gap-3">
            <button type="button" class="btn btn-warning">
                <a href="./Catalogo.php" class="nav-link" id="Stile-Bottoni">Esplora l'archivio</a>
            </button>

            <button type="button" class="btn btn-light">
                <a href="./ChiSiamo.php" class="nav-link" id="Stile-Bottoni">Cos'è BiblioNet?</a>
            </button>

            <button type="button" class="btn btn-primary">
                <a href="./Media.php" class="nav-link" id="Stile-Bottoni">Audio e video</a>
            </button>
        </div>       

        <br>

        <div class="d-flex justify-content-center align-items-start gap-3">

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Archivio.png" class="card-icon-inline me-3" alt="Archivio">
            <div>
            <h5 class="card-title mb-0">oltre 50.000</h5>
            <p class="card-text mb-0">Volumi</p>
            </div>
        </div>
        </div>


        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Manoscritto.png" class="card-icon-inline me-3" alt="Manoscritto">
            <div>
            <h5 class="card-title mb-0">oltre 125.000</h5>
            <p class="card-text mb-0">Documenti</p>
            </div>
        </div>
        </div>

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Ricercatore.png" class="card-icon-inline me-3" alt="Ricercatore">
            <div>
            <h5 class="card-title mb-0">oltre 10.000</h5>
            <p class="card-text mb-0">Ricerca</p>
            </div>
        </div>
        </div>

    </div>

    <br>

    </div>

    <br>

    <div class="d-flex justify-content-center align-items-start gap-3">

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/CoronaRealeItaliana.png" class="card-icon-inline me-3" alt="Corona del Re d'Italia">
            <div>
            <h5 class="card-title mb-0">Regni</h5>
            <!--<p class="card-text mb-0">Regno d'Italia, Regno di Francia e altri ancora</p>-->
            </div>
        </div>
        </div>

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/CoronaImperialeCarloV.png" class="card-icon-inline me-3" alt="Corona imperiale di Carlo V">
            <div>
            <h5 class="card-title mb-0">Imperi</h5>
            <!--<p class="card-text mb-0">Impero Cinese, Impero Russo e altri ancora</p>-->
            </div>
        </div>
        </div>

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/CoronaPatriziale.png" class="card-icon-inline me-3" alt="Corona patriziale">
            <div>
            <h5 class="card-title mb-0">Repubbliche</h5>
            <!--<p class="card-text mb-0">Repubblica di Genova, Repubblica di Venezia e altre ancora</p>-->
            </div>
        </div>
        </div>

    </div>

    <br>

    <div class="d-flex justify-content-center align-items-start gap-3">

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Manoscritti.png" class="card-icon-inline me-3" alt="Manoscritto">
            <div>
            <h5 class="card-title mb-0">Manoscritti</h5>
            <!--<p class="card-text mb-0">Volumi</p>-->
            </div>
        </div>
        </div>

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Cartografia.png" class="card-icon-inline me-3" alt="Cartografia">
            <div>
            <h5 class="card-title mb-0">Cartografia</h5>
            <!--<p class="card-text mb-0">Volumi</p>-->
            </div>
        </div>
        </div>

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Corrispondenze.png" class="card-icon-inline me-3" alt="Corrispondenze">
            <div>
            <h5 class="Corrispondenze.png">Corrispondenze</h5>
            <!--<p class="card-text mb-0">Volumi</p>-->
            </div>
        </div>
        </div>

    </div>

    <br>

    <div class="Sfondo-Presentazione">
        <br>
        <p id="Altro_Titolo">
            Documenti Recenti
        </p>
        <br>
    </div>

    <!--INIZIO SEZIONE SCHEDE-->

    <div class="Sfondo-Schede">

        <br>

        <div class="d-flex justify-content-center align-items-start gap-3">

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Libreria.png" class="card-icon-inline me-3" alt="Libreria">
            <div>
            <h5 class="card-title mb-0">oltre 50.000</h5>
            <p class="card-text mb-0">Volumi</p>
            </div>
        </div>
        </div>

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Libreria.png" class="card-icon-inline me-3" alt="Libreria">
            <div>
            <h5 class="card-title mb-0">oltre 50.000</h5>
            <p class="card-text mb-0">Volumi</p>
            </div>
        </div>
        </div>

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Libreria.png" class="card-icon-inline me-3" alt="Libreria">
            <div>
            <h5 class="card-title mb-0">oltre 50.000</h5>
            <p class="card-text mb-0">Volumi</p>
            </div>
        </div>
        </div>

    </div>

    </br>
    </div>

    <!--FINE SEZIONE SCHEDE-->

    <div class="Sfondo-Presentazione">
        <br>
        <p id="Altro_Titolo"> 
            Unisciti alla nostra comunità di ricercatori
        </p>
        <br>
    </div>

    <!--INIZIO SEZIONE SCHEDE-->

    <div class="Sfondo-Schede">

        <br>

        <div class="d-flex justify-content-center align-items-center gap-3">

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Registrati.png" class="card-icon-inline me-3" alt="Registrati">
            <div>
                <button type="button" class="btn btn-warning">
                <a href="./Registrazione.php" class="nav-link" id="Stile-Bottoni">Registrati</a>
                </button>
            </div>
        </div>
        </div>

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Salva.png" class="card-icon-inline me-3" alt="Salva">
            <div>
            <h5 class="card-title mb-0">Salava i tuoi</h5>
            <h5 class="card-text mb-0">documenti preferiti</h5>
            </div>
        </div>
        </div>

        <div class="card d-inline-block" style="width: 18rem">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Contribuisci.png" class="card-icon-inline me-3" alt="Contribuisci">
            <div>
            <h5 class="card-title mb-0">Contribuisci anche tu</h5>
            <h5 class="card-text mb-0">aggiungendo fonti</h5>
            </div>
        </div>
        </div>

    </div>

    </br>
    </div>

    <!--FINE SEZIONE SCHEDE-->

    <div class="Sfondo-Presentazione">
        <br><br><br>
    </div>

    <!--INIZIO DEL MENU DI NAVIGAZIONE IN FONDO-->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./Catalogo.php">Cataloghi: media e documenti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./ChiSiamo.php">Chi siamo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Profilo.php">Profilo</a>
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