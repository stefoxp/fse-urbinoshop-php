<?php
include("ssi/header.php");

function prodotti_dettagli($prodotto_id) {
    include("ssi/shop_mysql_costanti.php");
    include("ssi/shop_mysqli_funzioni.php");
    
    //inizializzazioni
    $sql = "";
    $dati = null;
    $riga = array();
    $prodotto_codice = 0;
    $prodotto_nome = "";
    $prodotto_descrizione = "";
    $prodotto_foto = "";
    $prodotto_prezzo = 0;
    $prodotto_disponibile = "";
    
    //definisce la stringa SQL
    $sql = "SELECT * FROM " . DB_TABELLA_PRODOTTO 
            . " WHERE IDprodotto = " . $prodotto_id . ";";
    
    // apre il rst
    $dati = rst_apri($sql);
    
    //visualizza i dati recuperati scorrendo tutto il rst
    while ($riga = rst_dati_ass($dati)) {
        //recupera le informazioni necessarie
        $prodotto_codice = $riga["IDprodotto"];
        $prodotto_nome = $riga["Nome"];
        $prodotto_descrizione = $riga["Descrizione"];
        $prodotto_foto = $riga["Foto"];
        $prodotto_prezzo = $riga["Prezzo"];
        $prodotto_disponibile = $riga["Disponibile"];
?>
<table width="90%" border="0" cellspacing="3" cellpadding="2"> 
  
  <tr valign="top" class="sfondo"> 
    <td colspan="2">
        <p><?php echo($prodotto_nome); ?></p>
    </td>
  </tr>
  <tr valign="Top">
    <td width="150" rowspan="6">
        <img src="<?php echo($prodotto_foto); ?>" name="image" 
             width="150" height="180" border="0" 
             alt="Foto di <?php echo($prodotto_nome); ?>">
    </td>
  </tr>
  <tr> 
    <td>
        <p><?php echo($prodotto_descrizione); ?></p>
    </td>
  </tr>
  <tr> 
    <td> 
      <p>Prezzo: <?php echo($prodotto_prezzo); ?> - Disponibilit&agrave;: 
          <strong><?php echo($prodotto_disponibile); ?></strong> - 
      <a href="utente_carrello_aggiorna.php?codiceProdotto=<?php echo($prodotto_codice); ?>
                &txtQuantita=1&cmd=Aggiungi">Aggiungi al carrello </a></p>
    </td>
  </tr>
  <tr> 
    <td align="center">
        <b>Recensioni prodotto
        <br>
        * * * * *</b>
    </td>
  </tr>
  <tr> 
    <td>
      Testo di esempio Testo di esempio Testo di esempio Testo di esempio
      Testo di esempio Testo di esempio Testo di esempio Testo di esempio
      Testo di esempio Testo di esempio Testo di esempio Testo di esempio
      Testo di esempio Testo di esempio Testo di esempio Testo di esempio
      Testo di esempio Testo di esempio
    </td>
  </tr>
  <tr> 
    <td align="center">
        <b>* * * * *</b>
    </td>
  </tr>
  <tr class="sfondo"> 
    <td colspan="2">
		<p>&nbsp;</p>
    </td>
  </tr>
</table>
<?php
    }
}

//verifica la presenza di dati sulla stringa di interrogazione
if ($_GET) {
    //esegue la funzione
    prodotti_dettagli($_GET['IDprodotto']);
} else {
    //informa l'utente
    echo("Attenzione: � possibile accedere alla pagina solo dal Catalogo prodotti!");
}
include("ssi/footer.php");
// ? >