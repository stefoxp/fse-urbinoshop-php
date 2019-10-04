<?php
//*****************************************************************************
// L'utilizzo di questa classe richiede i seguenti passaggi:
//  $connessione = new obj_mysql(DB_SERVER, DB_UTENTE, DB_PW);
// se si desidera aprire un rst
//   $dati = $connessione->rst_apri($sql, $db_name);
//visualizza i dati recuperati
//    while ($riga = mysql_fetch_array($dati)) {
//        echo("<B>Etichetta</B>: ".$riga["NOME_CAMPO"]."<BR>");
//    }
//
//*****************************************************************************
//   Tutti i metodi sono pubblici
class obj_mysql {

//metodo costruttore della classe
function obj_mysql($db_server,
                $db_user,
                $db_pw)  {
//-----------------------------------------------------------------------------
// Scopo:    metodo costruttore della classe. Apre una connessione con il db server
// Argomenti: 
// Data:     11-01-2007
// Stato:    funziona
//-----------------------------------------------------------------------------
    //apre una connessione con il server
    $mobjConn = mysql_connect($db_server,
                            $db_user,
                            $db_pw)
                or die("Problemi con la connessione al Server DB: " . mysql_error());
                
    //visualizza un msg di conferma
    //echo("Connessione con il server DB avvenuta<br>");
}

//distruttore (da PHP5 in poi)
/*function __destruct(){
    //chiude la connessione con il server
    //mysql_close($mobjConn);
    print("Messaggio di verifica: oggetto clsAdo distrutto");
}*/

function rst_apri($str_query, $db_name) {
//-----------------------------------------------------------------------------
// Scopo:    accede ad una tabella e restituisce un recordset
// Argomenti: 
// Data:     11-01-2007
// Stato:    funziona
//-----------------------------------------------------------------------------
    
    //seleziona il db
    mysql_select_db($db_name) 
        or die("<p>Problemi durante la selezione del Db.</p>");
    
    //esegue la query
    $verifica = mysql_query($str_query) or die("Query fallita: " . mysql_error());
    
    //restituisce il rst alla funzione
    return $verifica;
}
// fine classe
}
?>