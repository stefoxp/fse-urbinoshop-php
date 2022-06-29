<?php
//include sempre
include("ssi/header.php");
?>
<script language="JavaScript" type="text/JavaScript">
    <!--
    function form_convalida(form) {
        //dichiarazioni
        var intero,
            str_nick,
            str_pw,
            str_pw2,
            str_nome,
            str_email,
            strMsgErrore;
	
        // inizializza
        intero = true;
        strMsgErrore = "";
	
        // recupera i valori del form
        str_nick = form.txtUser.value;
        str_pw = form.txtPw.value;
        str_pw2 = form.txtPw2.value;
        str_nome = form.txtNome.value;
        str_email = form.txtEmail.value;
	
        /* effettua le verifiche */
        // NickName
        if(str_nick.length < 3 || str_nick.length > 10)
        {
            strMsgErrore += "Il <b>NickName</b> deve essere una parola di lunghezza compresa tra 3 e 10 caratteri!<br>";
            intero = false;
        };
        
        if(str_nick.search(" ") != -1)
        {
            strMsgErrore += "Il <b>NickName</b> non pu� contenere spazi!<br>";
            intero = false;
        };
    
        // Password
        if(str_pw.length < 5 || str_pw.length > 10)
        {
            strMsgErrore += "La <b>Password</b> deve essere una parola di lunghezza compresa tra 5 e 10 caratteri!<br>";
            intero = false;
        };
        
        if(str_pw.search(" ") != -1)
        {
            strMsgErrore += "La <b>Password</b> non pu� contenere spazi!<br>";
            intero = false;
        };
        
        if(str_pw2 != str_pw)
        {
            strMsgErrore += "Le 2 <b>Password</b> specificate non sono uguali!<br>";
            intero = false;
        };
        
        // Nome e Cognome
        if(str_nome.length < 3)
        {
            strMsgErrore += "E' necessario indicare <b>Nome e Cognome</b>!<br>";
            intero = false;
        };
        
        // email
        if((str_email.search("@") == -1) || (str_email.search(" ") != -1))
        {
            strMsgErrore += "L'<b>E-mail</b> indicata non � valida!<br>";
            intero = false;
        };

        if(intero != true)
            msgErrore(strMsgErrore);
	
        //restituisce il valore di controllo
        return intero;
    };
    
    function msgErrore (strMsg)	{
        // dichiarazioni
        var divHeaderEl;
	
        // verifica del tipo di browser (Ms IE 5 oppure Netscape 5 o superiori)
        if (document.createElement && document.body.style) {
            // accesso al documento tramite HTML DOM (funziona con Ms IE 5 e sup e con Netscape 6 e sup)
            // individua l'elemento attraverso il suo id
            divHeaderEl = document.getElementById("divMsg");
            // inserisce il contenuto della stringa nell'elemento
            divHeaderEl.innerHTML = strMsg;
        } else	{
            // codice alternativo per Msi IE 4 o Netscape 4
        };
    };
    //-->
</script>
<?php
/**
 * Gestisce l'intera pagina di registrazione
 */
function registra() {
    // include solo se necessario
    include("ssi/shop_mysql_costanti.php");
    include("ssi/shop_mysqli_funzioni.php");

    //recupera i valori passati dal form
    $strUser = $_POST['txtUser'];
    $strPw = $_POST['txtPw'];
    $strNome = $_POST['txtNome'];
    $strEmail = $_POST['txtEmail'];

    //definisce la stringa SQL
    $sql = "SELECT UserName FROM " . DB_TABELLA_UTENTE .
            " WHERE UserName='" . $strUser . "'";

    // apre il rst
    $dati = rst_apri($sql);

    if (rst_righe($dati) > 0) {
        //verifica la presenza di record, cioé di utenti con lo stesso username
        echo("<p>Lo <strong>UserName</strong> specificato &egrave; gi&agrave; registrato: 
            non &egrave; possibile procedere con la registrazione.<br />
            Cambiare UserName e riprovare.</p>");
    } else {

        // ora si può procedere con la registrazione
        // ridefinisce la stringa SQL
        $sql = "INSERT INTO " . DB_TABELLA_UTENTE 
                              . " (UserName, Password, Nome, EMail, Ruolo)
            VALUES ('" . $strUser . "', '" 
                    . $strPw . "', '" 
                    . $strNome . "', '" 
                    . $strEmail . "', 2)";

        // esegue la query
        rst_apri($sql);
        // conferma l'avvenuta registrazione
        echo("<p>Registrazione effettuata correttamente</p><p>Utente: " 
             . $strUser . "</p>Password: " . $strPw . "</p>");
    };
}

// verifica la presenza di dati di registrazione
if ($_POST) {
    //esegue la routine
    registra();
}
?>
<div id="divMsg" name="divMsg"></div>
<form action="utente_reg.php" method="post" name="frmRegistra" 
      onSubmit="return form_convalida(this);">
    <table width="90%" border="0" cellpadding="8">
        <tr class="sfondo"> 
            <td colspan="3">
                <b>Registrazione</b>
            </td>
        </tr>
        <tr valign="top"> 
            <td align="right">User Name*</td>
            <td colspan="2">
                <input name="txtUser" type="text" id="txtUser" />
                <br>        
                <font size="-1">* Campi obbligatori</font>
            </td>
        </tr>
        <tr valign="top"> 
            <td align="right">Password*</td>
            <td colspan="2"> 
                <input name="txtPw" type="password" id="txtPw" />
            </td>
        </tr>
        <tr valign="top"> 
            <td align="right">Conferma Password*</td>
            <td colspan="2">
                <input name="txtPw2" type="password" id="txtPw2" />
            </td>
        </tr>
        <tr valign="top">
            <td align="right">Nome e Cognome*</td>
            <td colspan="2">
                <input name="txtNome" type="text" id="txtNome" size="50" />
            </td>
        </tr>
        <tr valign="top"> 
            <td align="right">Email*</td>
            <td colspan="2">        
                <input name="txtEmail" type="text" id="txtEmail2" />
            </td>
        </tr>
        <tr valign="top">
            <td>
                <p>&nbsp; </p>
            </td>
            <td>
                <input name="cmdRegistraInvia" type="submit" value="Registra" />
                <input name="butAnnulla" type="reset" value="Annulla" />
            </td>
        </tr>
    </table>
</form>
<?php include("ssi/footer.php");
// ? >