<?php include("ssi/shop_mysql_cls.php"); ?>
<?php
    //costanti
    define("DB_SERVER", "localhost");
    define("DB_UTENTE","root");
    define("DB_PW","");
    
    $connessione = new obj_mysql(DB_SERVER, DB_UTENTE, DB_PW);
    
    //nome del db
    $db_name = "urbino_shop";
    
    //definisce la stringa SQL
    $sql = "SELECT UserName FROM tblutente WHERE UserName='primo';";
    
    // apre il rst
    $dati = $connessione->rst_apri($sql, $db_name);
    
    //visualizza i dati recuperati
    while ($riga = mysql_fetch_array($dati)) {
        echo("<B>Nome utente</B>: ".$riga["UserName"]."<BR>");
    }
    
    //rilascia l'oggetto utilizzato per la connessione
    $connessione = null;
?>