<?php
/*
 * visualizza tutti gli errori (utile in fase di sviluppo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
/*
 * Utilizza la libreria msqli (con approccio procedurale) 
 * al posto della precedente msql
*/

/**
 * Accede ad una tabella e restituisce un recordset
 * @param string $str_query é una stringa SQL valida o il nome di una tbl
 * @param string $contesto (opzionale = di default) é una stringa che descrive
 *                           il contesto (file, funzione o classe) all'interno 
 *                           del quale si é verificato l'errrore
 *                          funziona anche con le stored procedure a parametro 
 *                          "CALL nome_sp(parametro1, parametro2,...)"
 *                          si aspetta che siano state definite 4 costanti
 *                          a) DB_SERVER
 *                          b) DB_UTENTE
 *                          c) DB_PW
 *                          d) DB_NOME
 * @return type 
 * @version 2009-11-15
 * @author Stefano P
 */
function rst_apri($str_query, $contesto = "") {
    //evidenzia il contesto
    $contesto = "<strong>" . $contesto . "</strong> - ";

    //apre una connessione con il server e la memorizza
    $connessione = mysqli_connect(DB_SERVER,
                                    DB_UTENTE_NOME,
                                    DB_UTENTE_PW,
                                    DB_NOME,
                                    3306)
                    or die($contesto
                            . "Problemi con la connessione al Server DB: " 
                            . mysqli_connect_error() ."<br />");
    
            // mysqli_connect($contesto, $str_query, $password, $database, $port)
    
    //esegue la query
    $rst = mysqli_query($connessione, 
			$str_query) 
            or die($contesto 
                    . "Query fallita: " 
                    . mysqli_error($connessione));
    
    //chiude la connessione specificata con il server
    mysqli_close($connessione);

    //restituisce il rst alla funzione
    return $rst;   
}

/**
 * recupera i dati, una riga alla volta dal rst indicato
 * @param resource $rst_aperto é un recordset aperto
 * @return resource Un record del rst 
 * @version 2009-11-15
 * @author Stefano P
 */
function rst_dati_ass($rst_aperto) {
	// recupera il record successivo
	$riga_dati = mysqli_fetch_array($rst_aperto,
					MYSQLI_ASSOC);
	
	// restituisce il record
	return $riga_dati;
}

/**
 * verifica e restituisce il numero di record all'interno del rst
 * @param resource $rst_aperto é un recordset aperto
 * @return type 
 * @version 2009-11-15
 * @author Stefano P
 */
function rst_righe($rst_aperto) {
    // recupera il numero di righe (valore intero)
	$verifica = mysqli_num_rows($rst_aperto);
	
	// restituisce il risultato della verifica
	return $verifica;
}
?>