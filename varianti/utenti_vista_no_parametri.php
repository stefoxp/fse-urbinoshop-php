<?php
    include("ssi/header.php");
    include("ssi/shop_mysql_costanti.php");
	// utilizza la libreria tradizionale mysql
    include("ssi/shop_mysql_funzioni.php"); 
    
    // inizializzazioni (N.B. MySQL NON supporta le viste a parametro)
    $sql = "SELECT * FROM vw_visualizza_utente";
    $dati = null;
    $riga = array();
    $utente_id = 0;
    $utente_user = "";
    
    // apre il rst
    $dati = rst_apri($sql);
    
    // visualizza i dati recuperati
    while ($riga = mysql_fetch_array($dati)) {
        $utente_id = $riga["IDutente"];
        $utente_user = $riga["UserName"];

?>
<table width="100%" border="0" cellpadding="2">
    <!-- intestazione -->
    <tr class="sfondo">
        <td colspan="2">
            <!-- ci va il nome della categoria -->
            <strong>UserName: <?php echo($utente_user); ?></strong>
        </td>
    </tr>
    <!-- corpo -->
    <tr>
        <td width="100" align="center" valign="top">
            
        </td>
        <td valign="top">
            <p><!-- ci va la descrizione della categoria --></p>
            IDutente:<?php echo($utente_id); ?>
        </td>
    </tr>
</table>
<?php
    } 
    include("ssi/footer.php");
?>