<?php
    // Inizializza la sessione.
    session_start();
    // Desetta tutte le variabili di sessione.
    $_SESSION = array();
    // Infine distrugge la sessione.
    session_destroy();
    
    // sposta l'utente sulla pagina di login
    header("Location: adminLogin.php");
?>

