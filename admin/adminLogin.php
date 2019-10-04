<?php
    //apro la sessione (N.B. deve precedere il resto del codice)
    session_start();
    
    //include sempre
    include("ssi/header.php");

function login($str_username, $str_pw) {
    // include solo se necessario
    include("../ssi/shop_mysql_costanti.php");
    include("../ssi/shop_mysqli_funzioni.php");
    
    //inizializzazioni
    $sql = "";
    $dati = "";
    $riga = null;
    $intCodiceUtente = 0;
    
    //definisce la stringa SQL
    $sql = "SELECT IDutente, Ruolo FROM " . DB_TABELLA_UTENTE . 
        " WHERE UserName = '$str_username' AND Password = '$str_pw';";
    
    // apre il rst
    $dati = rst_apri($sql);
    
    //visualizza i dati recuperati
    if ($riga = rst_dati_ass($dati)) {
        //verifica che si tratti di un amministratore
        if ($riga["Ruolo"] == 1) {
            //echo("<p>" . $riga["Ruolo"] . "</p>");
            //recupera il codice utente
            $intCodiceUtente = $riga["IDutente"];
            //inizializza la sessione
            echo("<h2>Login confermato.</h2>");
            //session_start();
            //memorizza il codice utente nella var di Sessione
            $_SESSION['id_admin'] = $intCodiceUtente;
        } else {
            echo("<p>Login annullato: accesso negato. L'utente indicato non dispone dei diritti di amministrazione.</p>");
        }
    } else {
        echo("<p>Login annullato: accesso negato. Nome utente o password errati!</p>");
    }
}

function benvenuto() {
    //verifica lo stato di log
    //msg informativo sullo stato di login
    if (isset($_SESSION['id_admin'])) {
        //l'amministratore é già loggato: lo informa
        echo("<p>Amministratore loggato con id_admin = " . $_SESSION['id_admin'] . "</p>");
        //visualizza un filetto orizzontale
        echo("<hr />");
   
?>
<table>
    <tr>
        <td colspan="4">
            <h2>Menu dell'area amministrativa</h2>
        </td>
    </tr>
    <tr>
        <td>
            <b>Amministra:</b>
        </td>
        <td>
            <a href="adminCategoria.php" class="menu">Catalogo</a>            
        </td>
        <td>
            <a href="adminUtenti.php" class="menu">Utenti</a>
        </td>
        <td width="70%">
            &nbsp;
        </td>
    </tr>
</table>
<?php
} else {
        echo("<p>Amministratore non loggato!</p>");
        //visualizza un filetto orizzontale
        echo("<hr />");
    }
}

//verifica se è stato inviato il form
if ($_POST) {
    //recupera i valori passati tramite form
    $strUser = $_POST['txtUserName'];
    $strPw = $_POST['txtPassword'];
    
    if($strUser != "") {
        if($strPw != "") {
            login($strUser, $strPw);
        } else {
            echo("<p>Manca la Password ! Impossibile procedere.</p>");
        }
    } else {
        echo("<p>Manca lo UserName! Impossibile procedere.</p>");
    }
}

//msg di benvenuto
benvenuto();
?>
<table>
    <tr>
        <td>
            <h2>Accesso all'area amministrativa.</h2>
            <h4>L'accesso vi permetter� di amministrare il sito.</h4>
        </td>
    </tr>
    <tr>
    <td>
        <form id="frmLogin" action="adminLogin.php" method="post">
            <table>
                <tr>
                    <td>UserName: </td>
                    <td>
                        <!-- valore di controllo utilizzato 
                            per verificare l'esecuzione del login -->
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