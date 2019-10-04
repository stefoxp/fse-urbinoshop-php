<?php
    //costanti
    define("DB_SERVER", "localhost");
    define("DB_UTENTE","root");
    define("DB_PW","");
    
    //prova
    $nome_utente = $_GET['utente'];
    //print("<p>inizio$prova fine</p>");
    //$utente = "Primo";
    
    //apre una connessione con il server
    $objCon = mysql_connect(DB_SERVER, DB_UTENTE, DB_PW)
            or die("Problemi con la connessione al Server DB");
    //visualizza un msg di conferma
    echo("Connessione con il server DB avvenuta<br>");
    
    //definisce la stringa SQL
    $sql = "SELECT UserName FROM tblutente WHERE UserName='$nome_utente';";
    
    //esegue la query(è in grado di selezionare anche il db
    // al contrario di mysql_query)
    $verifica = mysql_db_query("urbino_shop", $sql, $objCon);
    
    //visualizza i dati recuperati
    while ($riga = mysql_fetch_array($verifica)) {
        echo("<B>Nome utente</B>: <A HREF=\"".$riga["UserName"]."\">".$riga["UserName"]."</A><BR>");
    }
    
    //chiude la connessione con il server
    mysql_close($objCon);
    
?>