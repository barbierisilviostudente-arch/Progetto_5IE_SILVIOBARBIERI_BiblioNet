<?php
    // È necessario, evidentemente, aver effettuato l'accesso per poter accedere alla pagina del proprio profilo.
    ob_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    include_once("../BaseDati/ChiaveSegreta.php");
    include_once("../BaseDati/Connessione.php");
    require_once("../VerificaJWT.php");

    $Utente = VerificaJWT();
    $Posta = $Utente["posta"];
    $Ruolo = $Utente["ruolo"];

    if(isset($_POST["ConfermaOpzioni"]))
    {
        $OpzioneSelezionata = $_POST["OpzioniProfilo"];
    }

    else
    {
        header("Location: Profilo.php");
        exit();
    }
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
    </nav>

    <!--FINE DEL MENU DI NAVIGAZIONE SOPRA-->

    <?php
        if($Ruolo == "Pubblicatore")
        {
            if($OpzioneSelezionata == "CreaNuovePagine")
            {
                /*
                    Pagina per la creazione guidata di un nuovo articolo
                */
            }

            elseif($OpzioneSelezionata == "ModificaPagine")
            {
                /*
                    Pagina per la modifica di un articolo:

                    1) Elenco testuale delle pagine selezionabili.

                    2) Premendo su una di queste sarà possibile modificarla.
                */

                ?>
                <form action="Funzione_Profilo.php">
                    <table>
                        <?php
                        $Interrogazione = $Cacciatorpediniere->prepare("SELECT Codice_Pagina, Categoria, Nome, Stato_Riferimento, Compendio, Collegamento_Multimediale FROM Pagina");
                        $Interrogazione->execute();
                        $Pagine = $Interrogazione->fetchAll(PDO::FETCH_ASSOC);

                        foreach($Pagine as $Pagina):
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($Pagina['Codice_Pagina']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Categoria']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Nome']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Stato_Riferimento']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Compendio']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Collegamento_Multimediale']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </form>              
            <?php
            }

            elseif($OpzioneSelezionata == "AggiungiCommenti")
            {
                /*
                    Simile a come funziona una applicazione di posta elettronica,
                    bisognerà inserire il destinatario (il mittente, ovvero l'utente medesimo, è inserito automaticamente),
                    il titolo e il testo del messaggio.
                */

                ?>
                <form action="Funzione_Profilo.php">
                    <table>
                        <?php
                        $Interrogazione = $Cacciatorpediniere->prepare("SELECT Codice_Pagina, Categoria, Nome, Stato_Riferimento, Compendio, Collegamento_Multimediale FROM Pagina");
                        $Interrogazione->execute();
                        $Pagine = $Interrogazione->fetchAll(PDO::FETCH_ASSOC);

                        foreach($Pagine as $Pagina):
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($Pagina['Codice_Pagina']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Categoria']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Nome']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Stato_Riferimento']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Compendio']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Collegamento_Multimediale']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </form>
                <?php
            }

            elseif($OpzioneSelezionata == "AvvisaModeratore")
            {
                /*
                    Simile a come funziona una applicazione di posta elettronica,
                    bisognerà inserire il destinatario (il mittente, ovvero l'utente medesimo, è inserito automaticamente),
                    il titolo e il testo del messaggio.

                    Non è possibile, per un pubblicatore, eliminare direttamente una pagina o un commento.
                    Se vuole farlo, dovrà passare per un moderatore, il quale valuterà caso per caso cosa fare.
                */

                ?>
                    <div>
                        <div class="form-group">
                            <label for="exampleInputText">Oggetto</label>
                            <input type="text" class="form-control" id="exampleInputText">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Indirizzo del destinatario</label>
                            <input type="email" class="form-control" id="exampleInputEmail1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputNumber">Testo dell'avviso</label>
                            <input type="number" data-bs-input class="form-control" id="exampleInputNumber">
                        </div>
                    </div>
                <?php
            }

            elseif($OpzioneSelezionata == "VisualizzaSegnalazioni")
            {
                /*
                    Elenco di tutti gli avvisi ricevuti:

                    1) Titolo della segnalazione.

                    2) Mittente.

                    3) Testo del messaggio.
                */
            }

            elseif($OpzioneSelezionata == "VotazioneAmministratori")
            {
                /*
                    Quando non è periodo di votazioni, semplicemente si visualizza un
                    messaggio che recita "Non ci sono votazioni pianificate per questo periodo"

                    Alternativamente, sarà visualizzata una scheda con il nome dei candidati e
                    la casella di spunta per poter votare il candidato.
                */

                $giorno = (int) date('d');
                $mese   = (int) date('m');

                if ($mese === 5 && $giorno >= 22 && $giorno <= 31) 
                {
                    // MESSAGGIO ANCORA DA INSERIRE
                }

                else
                {//SCHEDE DI VOTAZIONE ANCORA DA FARE
                    ?>
                        <form action="Funzione_Profilo.php">
                        <table>
                            <?php
                                $Interrogazione = $Cacciatorpediniere->prepare("SELECT Codice_Pagina, Categoria, Nome, Stato_Riferimento, Compendio, Collegamento_Multimediale FROM Pagina");
                                $Interrogazione->execute();
                                $Pagine = $Interrogazione->fetchAll(PDO::FETCH_ASSOC);

                                foreach($Pagine as $Pagina):
                            ?>

                            <tr>
                                <td><?php echo htmlspecialchars($Pagina['Codice_Pagina']); ?></td>
                                <td><?php echo htmlspecialchars($Pagina['Categoria']); ?></td>
                                <td><?php echo htmlspecialchars($Pagina['Nome']); ?></td>
                                <td><?php echo htmlspecialchars($Pagina['Stato_Riferimento']); ?></td>
                                <td><?php echo htmlspecialchars($Pagina['Compendio']); ?></td>
                                <td><?php echo htmlspecialchars($Pagina['Collegamento_Multimediale']); ?></td>
                            </tr>

                            <?php endforeach; ?>
                        </table>
                        </form>
                    <?php
                }
            }

            elseif($OpzioneSelezionata == "VisualizzaPreferiti")
            {
                /*
                    Viene visualizzata la lista degli elementi salvati tra i preferiti.
                    Premendo su uno di questi sarà possibile aprire il contenuto direttamente.
                */

                ?>

                <table>
                    <?php
                    $Interrogazione = $Cacciatorpediniere->prepare("SELECT Codice_Pagina, Categoria, Nome, Stato_Riferimento, Compendio, Collegamento_Multimediale FROM Pagina");
                    $Interrogazione->execute();
                    $Pagine = $Interrogazione->fetchAll(PDO::FETCH_ASSOC);

                    foreach($Pagine as $Pagina):
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($Pagina['Codice_Pagina']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Categoria']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Nome']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Stato_Riferimento']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Compendio']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Collegamento_Multimediale']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>                
            <?php
            }

            else
            {
                error_log("Contenuto non disponibile.");
                header("location: Profilo.php");
                exit();
            }
        }

        elseif($Ruolo == "Moderatore")
        {
            if($OpzioneSelezionata == "CreaNuovePagine")
            {
                // Funzionamento analogo alla omonima funzione dei pubblicatori.
            }

            elseif($OpzioneSelezionata == "ModificaPagine")
            {
                // Funzionamento analogo alla omonima funzione dei pubblicatori.
            }

            elseif($OpzioneSelezionata == "EliminaPagine")
            {
                // Funzionamento analogo alla omonima funzione dei pubblicatori.
            }

            elseif($OpzioneSelezionata == "AggiungiCommenti")
            {
                // Funzionamento analogo alla omonima funzione dei pubblicatori.
            }

            elseif($OpzioneSelezionata == "EliminaCommenti")
            {
                // Funzionamento analogo alla omonima funzione dei pubblicatori.
            }

            elseif($OpzioneSelezionata == "InviaSegnalazioni")
            {
                /*
                    Concettualmente simile a come si inserisce un commento, ma con una particolarità:
                    la possibilità di selezionare una "Categoria di avvisi", che identifichi come mai
                    è stato inviata una segnalazione ad un utente. Una segnalazione porta con sè una punizione, ovvero
                    una limitazione (temporanea) di alcune funzionalità del profilo.
                    
                    Gli amministratori godono di una parziale immunità in quanto non è sufficiente
                    una sola segnalazione per colpirli, ma tre dello stesso tipo afficnhè scatti la pena.
                */

                ?>
                    <div>
                        <div class="form-group">
                            <label for="exampleInputText">Oggetto</label>
                            <input type="text" class="form-control" id="exampleInputText">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Indirizzo del destinatario</label>
                            <input type="email" class="form-control" id="exampleInputEmail1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputNumber">Testo dell'avviso</label>
                            <input type="number" data-bs-input class="form-control" id="exampleInputNumber">
                        </div>

                        <div>
                            <fieldset>
                                <legend>Seleziona la categoria della segnalazione.</legend>

                                <div class="form-check">
                                    <input name="gruppo1" type="radio" id="radio1" checked>
                                    <label for="radio1">Spam</label>
                                </div>

                                <div class="form-check">
                                    <input name="gruppo1" type="radio" id="radio2">
                                    <label for="radio2">Violazione copyright</label>
                                </div>

                                <div class="form-check">
                                    <input name="gruppo1" type="radio" id="radio2">
                                    <label for="radio2">Commenti volgari</label>
                                </div>

                                <div class="form-check">
                                    <input name="gruppo1" type="radio" id="radio2">
                                    <label for="radio2">Abuso di potere</label>
                                </div>

                                <div class="form-check">
                                    <input name="gruppo1" type="radio" id="radio2">
                                    <label for="radio2">Manomissione della piattaforma</label>
                                </div>

                                <div class="form-check">
                                    <input name="gruppo1" type="radio" id="radio2">
                                    <label for="radio2">Uso inappropriato della piattaforma</label>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                <?php
            }

            elseif($OpzioneSelezionata == "VisualizzaSegnalazioni")
            {
                // Funzionamento analogo alla omonima funzione dei pubblicatori.

                ?>
                    <table>
                        <?php
                        $Interrogazione = $Cacciatorpediniere->prepare("SELECT Codice_Pagina, Categoria, Nome, Stato_Riferimento, Compendio, Collegamento_Multimediale FROM Pagina");
                        $Interrogazione->execute();
                        $Pagine = $Interrogazione->fetchAll(PDO::FETCH_ASSOC);

                        foreach($Pagine as $Pagina):
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($Pagina['Codice_Pagina']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Categoria']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Nome']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Stato_Riferimento']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Compendio']); ?></td>
                            <td><?php echo htmlspecialchars($Pagina['Collegamento_Multimediale']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                <?php
            }

            elseif($OpzioneSelezionata == "VotazioneAmministratori")
            {
                // Funzionamento analogo alla omonima funzione dei pubblicatori.
            }

            elseif($OpzioneSelezionata == "VisualizzaPreferiti")
            {
                /*
                    Viene visualizzata la lista degli elementi salvati tra i preferiti.
                    Premendo su uno di questi sarà possibile aprire il contenuto direttamente.
                */

                ?>

                <table>
                    <?php
                    $Interrogazione = $Cacciatorpediniere->prepare("SELECT Codice_Pagina, Categoria, Nome, Stato_Riferimento, Compendio, Collegamento_Multimediale FROM Pagina");
                    $Interrogazione->execute();
                    $Pagine = $Interrogazione->fetchAll(PDO::FETCH_ASSOC);

                    foreach($Pagine as $Pagina):
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($Pagina['Codice_Pagina']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Categoria']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Nome']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Stato_Riferimento']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Compendio']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Collegamento_Multimediale']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>                
            <?php
            }

            else
            {
                error_log("Contenuto non disponibile.");
                header("location: Profilo.php");
                exit();
            }
        }

        elseif($Ruolo == "Amministratore")
        {
            if($OpzioneSelezionata == "CreaNuovePagine")
            {
                // Funzionamento analogo alla omonima funzione di pubblicatori e moderatori.
            }

            elseif($OpzioneSelezionata == "ModificaPagine")
            {
                // Funzionamento analogo alla omonima funzione di pubblicatori e moderatori.
            }

            elseif($OpzioneSelezionata == "EliminaPagine")
            {
                // Funzionamento analogo alla omonima funzione di pubblicatori e moderatori.
            }

            elseif($OpzioneSelezionata == "AggiungiCommenti")
            {
                // Funzionamento analogo alla omonima funzione di pubblicatori e moderatori.
            }

            elseif($OpzioneSelezionata == "EliminaCommenti")
            {
                // Funzionamento analogo alla omonima funzione di pubblicatori e moderatori.
            }

            elseif($OpzioneSelezionata == "InviaSegnalazioni")
            {
                // Funzionamento analogo alla omonima funzione di pubblicatori e moderatori.
            }

            elseif($OpzioneSelezionata == "VisualizzaSegnalazioni")
            {
                // Funzionamento analogo alla omonima funzione di pubblicatori e moderatori.
            }

            elseif($OpzioneSelezionata == "PromozioniDeclassamenti")
            {
                // Funzionamento analogo alla omonima funzione di pubblicatori e moderatori.
            }

            elseif($OpzioneSelezionata == "Statistiche")
            {
                // Controllo statistiche piattaforma (tempo medio di utilizzo etc etc).
                // Parte che utilizza MQTT.
                // Tutti i dati raccolti vengono visualizzati in una tabella.
            }

            elseif($OpzioneSelezionata == "VisualizzaPreferiti")
            {
                /*
                    Viene visualizzata la lista degli elementi salvati tra i preferiti.
                    Premendo su uno di questi sarà possibile aprire il contenuto direttamente.
                */

                ?>

                <table>
                    <?php
                    $Interrogazione = $Cacciatorpediniere->prepare("SELECT Codice_Pagina, Categoria, Nome, Stato_Riferimento, Compendio, Collegamento_Multimediale FROM Pagina");
                    $Interrogazione->execute();
                    $Pagine = $Interrogazione->fetchAll(PDO::FETCH_ASSOC);

                    foreach($Pagine as $Pagina):
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($Pagina['Codice_Pagina']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Categoria']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Nome']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Stato_Riferimento']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Compendio']); ?></td>
                        <td><?php echo htmlspecialchars($Pagina['Collegamento_Multimediale']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>                
            <?php
            }

            else
            {
                error_log("Contenuto non disponibile.");
                header("location: Profilo.php");
                exit();
            }
        }

        else
        {
            // Se il ruolo non corrisponde a nessuno dei tre, allora vuol dire che l'intero dato sulla base di dati, per come è stato letto, non è corretto, oppure un utente malintenzionato ha operato sulla pagina.
            // La soluzione, drastica ma efficace, è quella di rimuovere l'utente dalla base di dati e obbligarlo a effettuare nuovamente la registrazione.
            $Successo = false;
            
            $Tentativi = 0;
            while(!$Successo && $Tentativi < 3)
            {
                $Tentativi++;
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

<?php
    ob_end_flush()
?>