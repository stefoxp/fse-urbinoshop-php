<?php
    include("ssi/header.php");
    include("ssi/shop_mysql_costanti.php");
    include("ssi/shop_mysql_cls.php");

function login($str_username, $str_pw) {
    //inizializzazioni
	$strUser = "";
    $strPw = "";
    $connessione = null;
    $db_name = "";
    $sql = "";
    $dati = "";
    $riga = null;
    $intCodiceUtente = 0;
	
    //recupera i valori passati dalla pagina precedente
	$strUser = $_POST['txtUserName'];
	$strPw = $_POST['txtPassword'];
    
    /*
    echo("Utente: $strUser<br>");
    echo("Password: $strPw<br>");
    */
    
    //istanzia l'oggetto per le connessioni
    $connessione = new obj_mysql(DB_SERVER, DB_UTENTE, DB_PW);
    
    //nome del db
    $db_name = "urbino_shop";
    
    //definisce la stringa SQL
    $sql = "SELECT IDutente FROM tblUtente WHERE UserName='$str_username' AND Password='$str_pw';";
    
    // apre il rst
    $dati = $connessione->rst_apri($sql, $db_name);
    
    //visualizza i dati recuperati
    if ($riga = mysql_fetch_array($dati)) {
        echo("Login confermato. <B>IDutente</B>: ".$riga["IDutente"]."<BR>");
        $intCodiceUtente = $riga["IDutente"];
        //memorizza il codice utente nella var di Sessione
        //session_register("id_utente");
        $_SESSION['id_utente'] = $intCodiceUtente;
    } else {
        echo("Login annullato: accesso negato. Nome utente o password errati!");
    }
    
    //rilascia l'oggetto utilizzato per la connessione
    $connessione = null;
}

//verifica se è stato inviato il form
if (isset($_POST['log'])) {
    //recupera i valori passati tramite form
    $strUser = $_POST['txtUserName'];
    $strPw = $_POST['txtPassword'];
    
    if($strUser != "") {
        if($strPw != "") {
            login($strUser, $strPw);
        } else {
            echo("Manca la Password ! Impossibile procedere.");
        }
    } else {
        echo("Manca lo UserName! Impossibile procedere.");
    }
}
?>
<table>
    <tr>
        <td>
            <p>Se non sei registrato puoi <a href="reg.php">registrarti</a> ora: &egrave; una procedura semplice e veloce. </p>
            <h4>La procedura di login vi permetterà di procedere all'acquisto
            dei prodotti desiderati.</h4>
        </td>
    </tr>
    <tr>
    <td>
        <form id="frmLogin" action="login.php" method="post">
            <table>
                <tr>
                    <td>UserName: </td>
                    <td>
                        <!-- valore di controllo utilizzato 
                            per verificare l//esecuzione del login -->
                        <input type="hidden" id="log" name="log" value="ok">
                        <input type="text" id="txtUserName" Name="txtUserName">
                    </td>
            </tr>
            <tr>
                <td>Password: </td>
                <td>
                    <input id="txtPassword" name="txtPassword" type="text">
                </td>
            </tr>
            <tr>
                <td align="right" colspan="2">
                    <input type="submit" value="Login" name="butLogin">
                </td>
            </tr>
            </table>
        </form>
    </td>
    </tr>
</table>
<?php include("ssi/footer.php") ?>