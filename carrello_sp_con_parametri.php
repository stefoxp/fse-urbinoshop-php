<?php
    include("ssi/header.php");
    include("ssi/shop_mysql_costanti.php");
    include("ssi/shop_mysqli_funzioni.php"); 
    
    // raccoglie il valore per l'id utente (dovrebbe riceverlo dall'esterno
    $user_id = 3;
	
    // inizializzazioni (N.B. MySQL NON supporta le viste a parametro ma le stored procedure SI)
    $sql = "CALL sp_visualizza_carrello(" . $user_id .")";
    $riga = array();
    
    // visualizza i dati recuperati
    $prodotto_codice = 0;
    $prodotto_nome = "";
    $prodotto_descrizione = "";
    $prodotto_foto = "";
    $prodotto_prezzo = 0;
    $prodotto_quantita = 0;
    $spesa_parziale = 0;
    
    // apre il rst
    $dati = rst_apri($sql);
    
    //visualizza i dati recuperati scorrendo tutto il rst
    //while ($riga = mysqli_fetch_array($dati, MYSQLI_ASSOC)) {
    while ($riga = rst_dati_ass($dati)) {
        //recupera le informazioni necessarie
        $prodotto_codice = $riga["IDprodotto"];
        $prodotto_nome = $riga["Nome"];
        $prodotto_descrizione = $riga["Descrizione"];
        $prodotto_foto = $riga["Foto"];
        $prodotto_prezzo = $riga["Prezzo"];
        $prodotto_quantita = $riga["Qta"];
        $spesa_parziale = $prodotto_prezzo * $prodotto_quantita;
?>
<form name="frmCarrello<?php echo($prodotto_codice); ?>" method="get" action="aggiornaCarrello.php">
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr bgcolor="#DCDCDC"> 
        <td width="5%" align="center" bgcolor="#DCDCDC">
            <input type="hidden" name="codiceProdotto" value="<?php echo($prodotto_codice); ?>" />
            <img src="<?php echo($prodotto_foto); ?>" name="image" width="30" height="30" />
        </td>
        <td width="40%">
            <a href="dettagli.php?IDprodotto=<?php echo($prodotto_codice . '">' . $prodotto_nome); ?></a>
            <br>
            <?php echo($prodotto_descrizione); ?>
        </td>
        <td width="10%" align="center">
            <input name="txtQuantita" id="txtQuantita" 
                    type="text" style="text-align:right"
                    value="<?php echo($prodotto_quantita); ?>" size="5" maxlength="4" />
        </td>
        <td width="10%" align="right">
            <?php echo($prodotto_prezzo); ?>
        </td>
        <td width="15%" align="right">
            <?php echo($spesa_parziale); ?>
        </td>
        <td width="20%" align="center">
	        <input name="cmd" type="submit" id="cmd" value="Salva" />
		    &nbsp;
            <input name="cmd" type="submit" id="cmd" value="Elimina" />
        </td>
    </tr>
    </table>
</form>

<?php
    } //fine ciclo while
    include("ssi/footer.php");
// ? >