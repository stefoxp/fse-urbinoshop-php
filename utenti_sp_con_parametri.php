<?php
    include("ssi/header.php");
    include("ssi/shop_mysql_costanti.php");
    include("ssi/shop_mysqli_funzioni.php"); 
    
	// raccoglie il valore per l'id utente (dovrebbe riceverlo dall'esterno
	$user_id = 11;
    // inizializzazioni (N.B. MySQL NON supporta le viste a parametro ma le stored procedure SI)
    $sql = "CALL sp_visualizza_utente(" . $user_id .")";
    $dati = null;
    $riga = array();
    $utente_id = 0;
    $utente_user = "";
    
    // apre il rst
    $dati = rst_apri($sql);
    
    // visualizza i dati recuperati
    while ($riga = rst_dati_ass($dati)) {
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
    } // fine ciclo 
    include("ssi/footer.php");
// ? >