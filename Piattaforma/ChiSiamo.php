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
    <title>Chi Siamo</title>
    <link rel="icon" type="image/x-icon" href="../Icone/Domanda.png">
    <link rel="stylesheet" href="./Stile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body id="Sfondo-ChiSiamo">

<!--INIZIO DEL MENU DI NAVIGAZIONE -->
    
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
                    <a class="nav-link" href="./Catalogo.php">Cataloghi: media e documenti</a>
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

    <!--FINE DEL MENU DI NAVIGAZIONE -->
    
    <div class="Sfondo-Presentazione">
        <br>
        <h1 id="Titolo_Principale">Che cos'è BiblioNet?</h1>
        <br>
        <h3 id="Sotto-titolo">Un progetto che unisce la passione per la storia con le potenzialità dell'informatica...</h3>

        <h4 id="Sotto-titolo">...il presente che si unisce con il passato</h3>        
        <br>

    </div>

    <br>

    <div class="panel panel-default">
        <div class="panel-body">A Basic Panel</div>
    </div>

    <br>

    <div class="Sfondo-Presentazione">
        <br>
        <p id="Altro_Titolo">
            BiblioNet in tre parole:
        </p>
        <br>
    </div>

    <!--INIZIO SEZIONE SCHEDE-->

    <div class="Sfondo-Schede">

        <br>

        <div class="d-flex justify-content-center align-items-start gap-3">

        <div class="card" style="width: 18rem;">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Uno.png" class="card-icon-inline me-3" alt="Uno">
            <div>
            <h5 class="card-title mb-0">oltre 50.000</h5>
            <p class="card-text mb-0">Volumi</p>
            </div>
        </div>
        </div>

        <div class="card" style="width: 18rem;">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Due.png" class="card-icon-inline me-3" alt="Due">
            <div>
            <h5 class="card-title mb-0">oltre 50.000</h5>
            <p class="card-text mb-0">Volumi</p>
            </div>
        </div>
        </div>

        <div class="card" style="width: 18rem;">
        <div class="card-body d-flex align-items-center">
            <img src="../Icone/Tre.png" class="card-icon-inline me-3" alt="Tre">
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
                    <a class="nav-link" href="./AltrePagine/Catalogo.php">Cataloghi: media e documenti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./AltrePagine/Profilo.php">Profilo</a>
                </li>
            </ul>
        </div>

        <div>
            <p>
                BiblioNet Versione 26w4b - 26/01/ AD 2026 - Silvio Barbieri
            </p>
        </div>
    </nav>

    <!--FINE DEL MENU DI NAVIGAZIONE IN FONDO-->
</body>
</html>