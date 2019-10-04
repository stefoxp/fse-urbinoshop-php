<?php

include("ssi/shop_mysql_costanti.php");
include("ssi/shop_mysqli_funzioni.php");

/**
 * Gestisce i dettagli di un record del carrello
 * @version 2012
 * @author Stefano
 */
class Carrello_dettagli {

    // dichiara le proprietà di classe
    
    /**
     * Codice utente
     * @var int 
     */
    var $utente_id;
    /**
     * Codice prodotto
     * @var int 
     */
    var $prodotto_id;
    /**
     * Quantità del prodotto
     * @var int 
     */
    var $prodotto_quantita;
    //proprietà speciale: é utilizzata per testare il risultato della verifica
    var $risultato;

    /**
     * Costruttore della classe
     * @param int $utente_codice Codice utente
     * @param int $prodotto_codice Codice prodotto
     * @param int $prodotto_quant 
     * @version 20070119
     * @return 0 in caso di presenza di tutti i dati, 1 altrimenti
     */
    function Carrello_dettagli($utente_codice, $prodotto_codice, $prodotto_quant) {

        //inizializza la proprietà
        $this->risultato = 0;

        if (!(isset($utente_codice)) or !(isset($prodotto_codice)) or !(isset($prodotto_quant))
                or ($utente_codice == 0) or ($prodotto_codice == 0) or ($prodotto_quant == 0)) {
            //restituisce un codice di errore
            // si potrebbe utilizzare uno swith per differenziare il codice di errore
            $this->risultato = 1;
        } else {
            //imposta i valori per le proprietà della classe
            $this->utente_id = $utente_codice;
            $this->prodotto_id = $prodotto_codice;
            $this->prodotto_quantita = $prodotto_quant;
        };
    }//fine costruttore carrello_dettagli_obj
}//fine classe Carrello_dettagli

/**
 * Classe Carrello: gestisce le azioni applicate al carrello
 */
class Carrello {

    //proprietà di classe
    //metodo costruttore
    /**
     * Costruttore della classe
     * @version 20070119
     */
    function Carrello() { 
      //vuoto       
    }

    /**
     * Aggiunge un prodotto al carrello dell'utente
     * @param object $dettagli_obj Istanza della classe carrello_dettagli_obj
     * @version 20070119
     */
    function prodotto_aggiungi($dettagli_obj) {
        //inizializzazioni
        $sql = "INSERT INTO " . DB_TABELLA_CARRELLO 
                    . " ( IDutente, IDprodotto, Qta )
                VALUES (" . $dettagli_obj->utente_id . ", " 
                        . $dettagli_obj->prodotto_id . ", " 
                        . $dettagli_obj->prodotto_quantita . ")";

        // esegue la query
        rst_apri($sql, "Classe Carrello, metodo prodotto_aggiungi");
    } //fine metodo prodotto_aggiungi

    /**
     * Modifica i dettagli relativi ad un prodotto del carrello
     * @param object $dettagli_obj Istanza della classe carrello_dettagli_obj
     * @version 20070119
     */
    function prodotto_modifica($dettagli_obj) {
        //inizializzazioni
        $sql = "UPDATE " . DB_TABELLA_CARRELLO . " SET Qta =" 
                        . $dettagli_obj->prodotto_quantita . "
                WHERE IDutente=" . $dettagli_obj->utente_id 
                    . " AND IDprodotto=" . $dettagli_obj->prodotto_id . "";

        // esegue la query
        rst_apri($sql, "Classe Carrello, metodo prodotto_modifica");
    } //fine metodo prodotto_modifica

    /**
     * Elimina un prodotto del carrello
     * @param object $dettagli_obj Istanza della classe carrello_dettagli_obj
     * @version 20070119
     */
    function prodotto_elimina($dettagli_obj) {
        //inizializzazioni
        $sql = "DELETE FROM " . DB_TABELLA_CARRELLO .
                " WHERE IDutente=" . $dettagli_obj->utente_id 
                    . " AND IDprodotto=" . $dettagli_obj->prodotto_id . "";

        // esegue la query
        rst_apri($sql, "Classe Carrello, metodo prodotto_elimina");
    } //fine metodo prodotto_elimina
} //fine classe Carrello
?>