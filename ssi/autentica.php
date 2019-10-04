<?php
    /*
     * Gestisce l'accesso alle pagine riservate
     */

    //apro la sessione (N.B. deve precedere il resto del codice)
    session_start();
    
    // inizializzazione
    $utente_codice = 0;
    
    // verifica la presenza dei dati di login per l'utente corrente
    if (isset($_SESSION['id_utente'])) {
        //recupera il codice dalla var di sessione
        $utente_codice = $_SESSION['id_utente'];
    } else {
        // l'utente non é loggato lo manda alla pagina di login
        header("Location: utente_login.php");
    };
?>