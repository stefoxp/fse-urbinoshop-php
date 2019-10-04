<?php
include("ssi/autentica.php"); 
include("ssi/header.php");
include("ssi/Carrello.php");

/**
 * Visualizza una pagina dopo un certo intervallo di tempo
 * @param string $url é l'indirizzo della pagina da visualizzare
 * (se omesso é la pagina stessa)
 * @param int $tempo é l'intervallo in secondi 
 * (se omesso viene impostato pari a 0)
 */
function redirect($url = '#', $tempo = 0) {
    // scritta di intrattenimento
    echo("<p>Elaborazione in corso: attendere prego...</p>");
    // né header né tempo di attesa   
    if(!headers_sent() && $tempo == 0) {
        // visualizza il carrello
        header('Location:' . $url);
    // non c'é header ma c'é tempo di attesa
    } elseif(!headers_sent() && $tempo != 0) {
        // visualizza il carrello dopo un certo tempo
        header('Refresh:' . $tempo . ';' . $url);
    // c'é un header già impostato
    } else {
        // imposta un'intestazione html lato client
        echo("<meta http-equiv=\"refresh\" content=\"" . 
              $tempo . ";url=" . $url . "\">");
    };
}

/**
 * Gestisce i comandi ricevuti dalla pagina del carrello
 * @param string $comando_ricevuto Comandi di vario tipo
 * @param int $utente_id Codice identificativo utente
 */
function carrello_aggiorna($comando_ricevuto, $utente_id) {
    //recupera i valori passati dalla pag chiamante
    $prodotto_codice = $_GET['codiceProdotto'];
    $prodotto_quantita = $_GET['txtQuantita'];
    
    // istanzia l'oggetto
    $carrello_dettagli_oggetto = new Carrello_dettagli($utente_id, 
                                                       $prodotto_codice, 
                                                       $prodotto_quantita);
    
    //verifica la presenza di tutti i dati richiesti
    if($carrello_dettagli_oggetto->risultato != 0) {
        //interrompe l'esecuzione ed informa l'utente
        die("<p>Impossibile soddisfare la richiesta: 
            manca uno dei parametri richiesti per l'aggiornamento 
            del carrello.</p>");
    };
    
    // istanzia l'oggetto
    $carrello_oggetto = new Carrello();
    
    switch ($comando_ricevuto) {
        case "Aggiungi":            
            //aggiunge un prodotto al carrello
            $carrello_oggetto->prodotto_aggiungi($carrello_dettagli_oggetto);
            //esce
            break;
        case "Salva":
            //modifica un prodotto del carrello
            $carrello_oggetto->prodotto_modifica($carrello_dettagli_oggetto);
            //esce
            break;
        case "Elimina":
            //elimina un prodotto del carrello
            $carrello_oggetto->prodotto_elimina($carrello_dettagli_oggetto);
            //esce
            break;
        default:
            //informa l'utente
            echo("<p>Comando sconosciuto !</p>");
            //nulla
            break;
    };
    //visualizza il carrello aggiornato
    redirect('utente_carrello.php',0);
}

//verifica la presenza di dati sulla stringa di interrogazione
if ($_GET) {
    // recupera il valore presente
    $comando = $_GET['cmd'];
    //esegue la funzione
    carrello_aggiorna($comando, $utente_codice);
} else {
    // informa l'utente
    echo("<p>Attenzione: questa pagina non pu&ograve; essere visualizzata !</p>");
};
?>