<!--?php            N.B. Verificare il JWT anche in questa pagina significherebbe rendere la registrazione obbligatoria
    ob_start();
    include_once("../BaseDati/Connessione.php");
    include_once("../BaseDati/ChiaveSegreta.php");
    include_once("./Pesca.php");
    require_once("../VerificaJWT.php");

    $Utente = VerificaJWT();
    $Posta = $Utente["posta"];
    $Ruolo = $Utente["ruolo"];
-->
<?php
    if(isset($_GET["Conferma"]))
    {
        $StatoSelezionato = $_GET["Stato"];
        $Formato = $_GET["Formato"];
    }

    else
    {
        header("Location: Catalogo.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="icon" type="image/x-icon" href="../Icone/Catalogo.png">
    <link rel="stylesheet" href="../Stile.css">
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
                    <a class="nav-link" href="../PaginaPrincipale.php">Torna all'inizio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./Catalogo&Media.php">Torna indietro ai cataloghi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Accedi.php">Accedi oppure registrati</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./ChiSiamo.php">Chi siamo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profilo</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--FINE DEL MENU DI NAVIGAZIONE SUPERIORE-->
    
    <?php
        $imgPath = "../RicercaStati/" . $StatoSelezionato . ".jpg";
        $imgSrc = file_exists($imgPath) ? $imgPath : "../RicercaStati/default.jpg";
    ?>
    <img src="<?php echo $imgSrc; ?>" alt="Immagine di copertina" class="img-fluid">

    <p>
        <?php
            if($Formato == "AudioVideo")
            {
                $Interrogazione = $connessione->prepare("SELECT Collegamento_Multimediale FROM Elemento WHERE Nome = ?");
                $Interrogazione->bind_param("s", $StatoSelezionato);
                $Interrogazione->execute();
                $Risultato = $Interrogazione->get_result();
                $Riga = $Risultato->fetch_assoc();
                if ($Riga) 
                {
                    echo "<a href='" . $Riga["Collegamento_Multimediale"] . "' target='_blank'>Clicca qui</a>";
                } 
                
                else 
                {
                    error_log("Contenuto multimediale non disponibile.");
                }
                $Interrogazione->close();
            }

            else if($Formato == "Testo")
            {
                $Interrogazione = $connessione->prepare("SELECT TestoElemento FROM Elemento WHERE Nome = ?");
                $Interrogazione->bind_param("s", $StatoSelezionato);
                $Interrogazione->execute();
                $Risultato = $Interrogazione->get_result();
                $Riga = $Risultato->fetch_assoc();
                if ($Riga) #Se è stato trovato un risultato, allora mostralo, altrimenti mostra un messaggio di errore
                {
                    echo $Riga["TestoElemento"];
                } 
                
                else
                {
                    error_log("Contenuto non disponibile.");
                }
                $Interrogazione->close();
            }
        ?>
    </p>

    <!--INIZIO DEL MENU DI NAVIGAZIONE INFERIORE-->
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../PaginaPrincipale.php">Torna all'inizio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./Catalogo&Media.php">Torna indietro ai cataloghi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Accedi.php">Accedi oppure registrati</a>
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