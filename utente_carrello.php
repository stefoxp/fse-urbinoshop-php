<?php include("ssi/autentica.php"); ?>
<?php include("ssi/header.php"); ?>
<html>
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr class="sfondo">
		<td colspan="2">
		    Carrello della spesa
        </td>
		<td align="center">
			Quantit&agrave;
		</td>
		<td align="right">
		    Prezzo unitario
		</td>
        <td align="right">
		    Parziale spesa
		</td>
        <td align="center" class="Titolo">Azione</td>
    </tr> 
	<tr> 
        <td align="center" colspan="6">
            <hr noshade>
        </td>
    </tr>
 </table>
<?php
/**
 * Visualizza i record presenti nel carrello
 * @param int $utente_id Codice identificativo utente
 */
function carrello_visualizza($utente_id) {
    include("ssi/shop_mysql_costanti.php");
    include("ssi/shop_mysqli_funzioni.php");
    
    //inizializzazioni
    $sql = "SELECT A_Carrello.IDutente, A_Carrello.IDprodotto, A_Carrello.Qta,
                B_Prodotto.Nome, B_Prodotto.Descrizione, B_Prodotto.Foto, 
                B_Prodotto.Prezzo
            FROM " . DB_TABELLA_PRODOTTO . " As B_Prodotto INNER JOIN " 
                . DB_TABELLA_CARRELLO . " As A_Carrello 
            ON B_Prodotto.IDprodotto = A_Carrello.IDprodotto
            WHERE A_Carrello.IDutente = $utente_id
            ORDER BY B_Prodotto.Nome";
    
    $dati = null;
    $riga = array();
    $prodotto_codice = 0;
    $prodotto_nome = "";
    $prodotto_descrizione = "";
    $prodotto_foto = "";
    $prodotto_prezzo = 0;
    $prodotto_quantita = 0;
    $spesa_parziale = 0;
    $spesa_totale = 0;
    $quantita_totale = 0;
    
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
        $prodotto_quantita = $riga["Qta"];
        $spesa_parziale = $prodotto_prezzo * $prodotto_quantita;
?>
<form name="frmCarrello<?php echo($prodotto_codice); ?>" method="get" 
      action="utente_carrello_aggiorna.php">
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr bgcolor="#DCDCDC"> 
        <td width="5%" align="center" bgcolor="#DCDCDC">
            <input type="hidden" name="codiceProdotto" value="<?php echo($prodotto_codice); ?>" />
            <img src="<?php echo($prodotto_foto); ?>" name="image" width="30" height="30" />
        </td>
        <td width="40%">
            <a href="prodotto_dettagli.php?IDprodotto=<?php echo($prodotto_codice . '">' . $prodotto_nome); ?></a>
            <br>
            <?php echo($prodotto_descrizione); ?>
        </td>
        <td width="10%" align="center">
            <input name="txtQuantita" id="txtQuantita" 
                    type="text" style="text-align:right"
                    value="<?php echo($prodotto_quantita); ?>" 
                    size="5" maxlength="4" />
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
    }; //fine ciclo while

    // nuova stringa SQL
    $sql = "SELECT spParzialiCarrello.IDutente, 
                    Sum(spParzialiCarrello.Qta) AS TotaleQta, 
                    Sum(spParzialiCarrello.Parziale) AS TotaleSpesa
            FROM (SELECT IDutente, Qta, Prezzo, Prezzo*Qta AS Parziale 
            FROM " . DB_TABELLA_PRODOTTO . " As B_Prodotto INNER JOIN " 
                    . DB_TABELLA_CARRELLO . " As A_Carrello 
                    ON B_Prodotto.IDprodotto = A_Carrello.IDprodotto) 
                    AS spParzialiCarrello
            GROUP BY spParzialiCarrello.IDutente
            HAVING spParzialiCarrello.IDutente = $utente_id";

    // apre il rst
    $dati = rst_apri($sql);
    
     //visualizza i dati recuperati scorrendo tutto il rst
    if ($riga = rst_dati_ass($dati)) {
        //recupera i valori
        $spesa_totale = $riga["TotaleSpesa"];
        $quantita_totale = $riga["TotaleQta"];
    }
?>
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
   <tr valign="middle" bgcolor="#cccccc"> 
        <td width="60%" colspan="2" align="center" bgcolor="#cccccc">
            <strong>Totale</strong>:
        </td>
        <td width="10%" align="center">
            <strong><?php echo($quantita_totale); ?></strong>
        </td>
        <td width="15%" align="right" colspan="2">
            <strong><?php echo($spesa_totale); ?></strong>
        </td>
        <td width="15%" align="center">
            <a href="elaboraOrdine.asp" class="menu">Ordina</a>
        </td>
    </tr>
  </table>
<?php  
}

//esegue la routine
carrello_visualizza($utente_codice);

include("ssi/footer.php");
// ? >