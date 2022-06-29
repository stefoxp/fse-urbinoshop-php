<?php
    include("ssi/header.php");
    include("ssi/shop_mysql_costanti.php");
    include("ssi/shop_mysqli_funzioni.php"); 
    
    // inizializzazioni
    $sql = "SELECT * FROM ". DB_TABELLA_CATEGORIA . " ORDER BY Nome;";
    $riga = array();
    $codiceCategoria = 0;
    $nomeCategoria = "";
    $descrizioneCategoria = "";
    $fotoCategoria = "";

    // apre il rst
    $dati = rst_apri($sql);
    
    // visualizza i dati recuperati
    while ($riga = rst_dati_ass($dati)) {
        //recupera e memorizza i valori dei campi
        $codiceCategoria = $riga["IDcategoria"];
        $nomeCategoria = $riga["Nome"];
        $descrizioneCategoria = $riga["Descrizione"];
        $fotoCategoria = $riga["Foto"];
?>
<table width="100%" border="0" cellpadding="2">
    <!-- intestazione -->
    <tr class="sfondo">
        <td colspan="2">
            <!-- ci va il nome della categoria -->
            <strong><?php echo($nomeCategoria); ?></strong>
        </td>
    </tr>
    <!-- corpo -->
    <tr>
        <td width="100" align="center" valign="top">
            <img src="<?php echo($fotoCategoria); ?>" name="immagine" 
                 width="100" height="100" 
                 border="0" alt="Foto di <?php echo($nomeCategoria); ?>">
        </td>
        <td valign="top">
            <p><?php echo($descrizioneCategoria); ?>
                <!-- ci va la descrizione della categoria --></p>
            <a href="prodotto_catalogo.php?IDcategoria=<?php echo($codiceCategoria); ?>">
                Visualizza prodotti &gt;&gt;</a>
        </td>
    </tr>
</table>
<?php
    } //fine ciclo while
    include("ssi/footer.php");
// ? >
