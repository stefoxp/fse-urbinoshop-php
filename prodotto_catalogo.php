<?php include("ssi/header.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
  <meta name="generator" content=
  "HTML Tidy for Windows (vers 1st February 2005), see www.w3.org">

  <title></title>
</head>

<body>
  <table width="90%" border="0" cellpadding="1">
    <?php
    function prodotti_visualizza($categoria_id) {
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
                . " WHERE IDcategoria = " . $categoria_id . "";
        
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

    <tr>
      <td>
        <table width="100%" border="0" cellpadding="4">
          <!-- intestazione -->

          <tr class="sfondo">
            <td colspan="2">
            <?php echo($prodotto_nome . " - " .  $prodotto_prezzo); ?></td>
          </tr><!-- corpo -->

          <tr>
            <td width="100" align="center" valign="top"><img src=
            "%3C?php%20echo($prodotto_foto);%20?%3E" name="image"
            width="100" height="100" border="0" alt=
            "Foto di &lt;?php echo($prodotto_nome); ?&gt;" id=
            "image"></td>

            <td valign="top">
              <p><?php echo($prodotto_nome); ?></p>

              <p>disponibilit&agrave;:
              <strong><?php echo($prodotto_disponibile); ?></strong></p>

              <p><a href=
              "prodotto_dettagli.php?IDprodotto=%3C?php%20echo($prodotto_codice);%20?%3E">
              Dettagli &gt;&gt;</a></p>
            </td>
          </tr>
        </table>
      </td>
    </tr><?php
        }//fine ciclo while
    }//fine funzione prodotti_visualizza

    //verifica la presenza di dati sulla stringa di interrogazione
    if ($_GET) {
        //esegue la funzione
        prodotti_visualizza($_GET['IDcategoria']);
    } else {
        //informa l'utente
        echo("Attenzione: é possibile accedere alla pagina solo dal Catalogo delle categorie!");
    }
    echo("</table>");
    include("ssi/footer.php");
    ?>
  </table>
</body>
</html>
