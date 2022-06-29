<?php include("ssi/header.php"); ?>
<form name="frmRicerca" method="get" action="prodotto_ricerca.php">
  <table width="90%" border="0" cellspacing="0" cellpadding="1">
    <tr> 
      <td> 
        <table width="100%" border="0" cellspacing="0" cellpadding="4">
          <tr class="sfondo">
            <td colspan="2">
                <b>Ricerca prodotto </b>
            </td>
          </tr>
          <tr> 
            <td align="right">
                Prodotto:
            </td>
            <td>
                <input size="50" type="text" name="keyword" value="" />
            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="butAvvia" id="butAvvia" 
                       value="Avvia ricerca" />
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
<?php

function prodotto_cerca($ricerca_chiave) 
{
    include("ssi/shop_mysql_costanti.php");
    include("ssi/shop_mysqli_funzioni.php");

    //inizializzazioni
    $sql = "SELECT IDprodotto, B_Prodotto.Nome AS Prodotto, 
            A_Categoria.Nome AS Categoria, Prezzo, Disponibile, B_Prodotto.Foto
            FROM " . DB_TABELLA_CATEGORIA . " AS A_Categoria INNER JOIN " 
            . DB_TABELLA_PRODOTTO . " AS B_Prodotto 
            ON A_Categoria.IDcategoria = B_Prodotto.IDcategoria
            WHERE (((B_Prodotto.Nome) Like '%" . $ricerca_chiave . "%'))";
    $dati = null;
    $riga = array();
    $categoria_nome = "";
    $prodotto_codice = 0;
    $prodotto_nome = "";
    $prodotto_foto = "";
    $prodotto_prezzo = 0;
    $prodotto_disponibile = "";
    
    // apre il rst
    $dati = rst_apri($sql);
    
    // verifica le presenza di risultati
    if(rst_righe($dati) == 0) {
        // nessun risultato
        echo("<b>Spiacenti: </b>Nessun prodotto corrisponde ai parametri inseriti.");
        echo("<br><a href='ricercaProdotto.php'>Nuova ricerca</a>");
    } else {
        // ci sono dei risultati
        echo("<p><b>Parametri di ricerca inseriti: </b>" . $ricerca_chiave . "</p>");
        echo("<p><b>Risultati della ricerca: </b></p><hr>");
    }
    
    // visualizza i dati recuperati scorrendo tutto il rst
    while ($riga = rst_dati_ass($dati)) {
        //recupera i valori necessari
        $prodotto_codice = $riga["IDprodotto"];
        $prodotto_nome = $riga["Prodotto"];
        $prodotto_prezzo = $riga["Prezzo"];
        $prodotto_disponibile = $riga["Disponibile"];
        $prodotto_foto = $riga["Foto"];
        $categoria_nome = $riga["Categoria"];
        //visualizza i valori
?>
    <table width="90%" border="0" cellpadding="4">
        <!-- intestazione -->
        <tr class="sfondo"> 
          <td colspan="2">
            <?php echo("<strong>" . $prodotto_nome . " - " . $prodotto_prezzo . "</strong>"); ?>
          </td>
        </tr>
        <!-- corpo -->
        <tr> 
          <td width="100" align="center" valign="top">
            <img src="<?php echo($prodotto_foto); ?>" name="image" 
                 width="100" height="100" border="0" 
                 alt="Foto di <?php echo($prodotto_nome); ?>">
          </td>
          <td valign="top">
              <p>Disponibilit&agrave;: 
                  <strong><?php echo($prodotto_disponibile); ?></strong></p>
              <p>
                 <a href="prodotto_dettagli.php?IDprodotto=<?php echo($prodotto_codice); ?>">
                     Dettagli &gt;&gt;</a>
              </p>
          </td>
        </tr>
      </table>
<?php
    }//fine ciclo while
}//fine funzione prodotto_cerca

//verifica la presenza del parametro di ricerca
if ($_GET) {
    // recupera la chiave da utilizzare per la ricerca
    $chiave = $_GET['keyword'];
    // verifica la consistenza dei dati inseriti
    if ($chiave != "") {
        //esegue la funzione
        prodotto_cerca($chiave);
    }
}
include("ssi/footer.php");
// ? >