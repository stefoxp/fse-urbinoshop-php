<?php

//funzione che avvia una connessione con il server db
function dbserver_apri()  {
/*-----------------------------------------------------------------------------
    Scopo:    metodo costruttore della classe. Apre una connessione con il db server
    Argomenti: si aspetta che siano state definite 3 costanti
            1) DB_SERVER
            2) DB_UTENTE
            3) DB_PW
    Data:     15-01-2007
    Stato:    funziona
-----------------------------------------------------------------------------*/
    //apre una connessione con il server
    mysql_connect(DB_SERVER,
                DB_UTENTE_NOME,
                DB_UTENTE_PW)
            or die("Problemi con la connessione al Server DB: " . mysql_error() ."<br>");
                
    //restituisce 0 se va tutto bene
    return 0;
}

function rst_apri($str_query) {
/*-----------------------------------------------------------------------------
    Scopo:    accede ad una tabella e restituisce un recordset
    Argomenti: 
    Data:     15-01-2007
    Stato:    funziona
-----------------------------------------------------------------------------*/
    
    //apre una connessione e ne verifica lo stato
    $stato = dbserver_apri();
    if ($stato != 0) {
        die("<p>Impossibile procedere all'esecuzione della query a causa di problemi con la connessione!</p>");
    }
    
    //seleziona il db (utilizza una costante)
    mysql_select_db(DB_NOME) 
        or die("<p>Problemi durante la selezione del Db: " . mysql_error() . "</p>");
    
    //esegue la query
    $verifica = mysql_query($str_query) or die("Query fallita: " . mysql_error());
     
	//chiude qualsiasi connessione con il server
    mysql_close();
    
	//restituisce il rst alla funzione
    return $verifica;
}
?>