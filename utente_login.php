<?php
    //apro la sessione (N.B. deve precedere il resto del codice)
    session_start();
    
    //include sempre
    include("ssi/header.php");

/**
 * Gestisce l'intera pagina
 * @param string $str_username UserName
 * @param string $str_pw Password
 */
function login($str_username, $str_pw) {
    // include solo se necessario
    include("ssi/shop_mysql_costanti.php");
    include("ssi/shop_mysqli_funzioni.php");
    
    //inizializzazioni
    $sql = "";
    $dati = "";
    $riga = null;
    $intCodiceUtente = 0;
    
    //definisce la stringa SQL
    $sql = "SELECT IDutente FROM " . DB_TABELLA_UTENTE . 
        " WHERE UserName='" . $str_username 
            . "' AND Password='" . $str_pw . "';";
    
    // apre il rst
    $dati = rst_apri($sql);
    
    //visualizza i dati recuperati
    if ($riga = rst_dati_ass($dati)) {
        echo("<p>Login confermato. <B>IDutente</B>: " . $riga["IDutente"] . "</p>");
        //recupera il codice utente
        $intCodiceUtente = $riga["IDutente"];
        //inizializza la sessione
        //session_start();
        //memorizza il codice utente nella var di Sessione
        $_SESSION['id_utente'] = $intCodiceUtente;
    } else {
        echo("<p>Login annullato: accesso negato. Nome utente o password errati!</p>");
    };
};// fine funzione login

//verifica se é stato inviato il form
if ($_POST) {
    //recupera i valori passati tramite form
    $strUser = $_POST['txtUserName'];
    $strPw = $_POST['txtPassword'];
    
    //UserName presente ?
    if($strUser != "") {
        //Password presente ?
        if($strPw != "") {
            //sono entrambi presenti procede con il login
            login($strUser, $strPw);
        } else {
            //visualizza un messaggio esplicativo
            echo("<p>Manca la Password ! Impossibile procedere.</p>");
        };
    } else {
        //visualizza un messaggio esplicativo
        echo("<p>Manca lo UserName! Impossibile procedere.</p>");
    };
};

//msg informativo sullo stato di login
if (isset($_SESSION['id_utente']))
    //conferma avvenuto login
    echo("<p>Utente loggato con id_utente = " . $_SESSION['id_utente'] . "</p>");
else
    //login non effettuato
    echo("<p>Utente non loggato!</p>");
?>
<table>
    <tr>
        <td>
            <p>Se non sei registrato puoi 
                <a href="utente_reg.php">registrarti</a> ora: &egrave; 
                una procedura semplice e veloce. </p>
            <h4>La procedura di login vi permetter&agrave; di procedere all'acquisto
            dei prodotti desiderati.</h4>
        </td>
    </tr>
    <tr>
    <td>
        <form id="frmLogin" action="utente_login.php" method="post">
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