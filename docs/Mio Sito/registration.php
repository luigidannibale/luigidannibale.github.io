<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrati</title>
    <link rel="icon" href="img/logo_small_white_background.png">
    <link rel="stylesheet" href="registration.css">
</head>
<body>

    <div class="wrapper">
        <div class="b-img"></div>
        <div class="form-box">
            <!-- Bottoni che utilizzano le funzioni javascript per cambiare la visuale tra registrazione e accesso  -->
            <div class="buttons">
                <div id="btn"></div>
                    <button type="button" class="toggle-btn" onclick="login()">Login</button>
                    <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <!-- Form di accesso -->
            <form method="POST" action="" id="login" class="input-group">
                <input type="text" name="log_email" id="" class="input-field" placeholder="Email" required 
                oninvalid="this.setCustomValidity('Inserisci l\'email')" oninput="this.setCustomValidity('')"> <br>
                <input type="text" name="log_password" id="" class="input-field" placeholder="Password" required
                oninvalid="this.setCustomValidity('Inserisci la password')" oninput="this.setCustomValidity('')"> <br>
                <input type="checkbox" name="" id="" class="check-box" > <span>Remember password</span>
                <input type="submit" value ="Login" name="login_btn" class="submit-btn" onclick="">
            </form>
            <!-- Form di registrazione-->
            <form method="POST" action="" id="register" class="input-group">
                <input class="input-field" type="text" name="nome" id="nome" placeholder="Nome" required
                oninvalid="this.setCustomValidity('Inserisci il nome')" oninput="this.setCustomValidity('')"> <br>   
                <input class="input-field" type="text" name="cognome" id="cognome" placeholder="Cognome" required
                oninvalid="this.setCustomValidity('Inserisci il cognome')" oninput="this.setCustomValidity('')"> <br>
                <input class="input-field" type="text" name="ddn" id="ddn" placeholder="Data di nascita (aaaa-mm-gg)" required
                oninvalid="this.setCustomValidity('Inserisci la data di nascita  (aaaa-mm-gg)')" oninput="this.setCustomValidity('')"> <br>
                <input class="input-field" type="text" name="ldn" id="ldn" placeholder="Luogo di nascita" required
                oninvalid="this.setCustomValidity('Inserisci il luogo di nascita')" oninput="this.setCustomValidity('')"> <br>
                <input class="input-field" type="text" name="codice" id="cod_fiscale" placeholder="Codice fiscale" required
                oninvalid="this.setCustomValidity('Inserisci il codice fiscale')" oninput="this.setCustomValidity('')" onkeyup="this.value = this.value.toUpperCase();"> <br>
                <input class="input-field" type="text" name="residenza" id="residenza" placeholder="Indirizzo di residenza" required
                oninvalid="this.setCustomValidity('Inserisci l\'indirizzo di residenza')" oninput="this.setCustomValidity('')"> <br>
                <input class="input-field" type="text" name="cellulare" id="cellulare" placeholder="Numero di cellulare" required
                oninvalid="this.setCustomValidity('Inserisci il numero di cellulare')" oninput="this.setCustomValidity('')"> <br>
                <input class="input-field" type="email" name="email" id="email" placeholder="Email" required
                oninvalid="this.setCustomValidity('Assicurati di aver inserito l\'indirizzo email corretto')" oninput="this.setCustomValidity('')"> <br>
                <input class="input-field" type="password" name="password" id="password" placeholder="Password" required
                oninvalid="this.setCustomValidity('Scegli la tua password')" oninput="this.setCustomValidity('')"> <br>

                <input type="checkbox" name="checked" class="check-box" required 
                oninvalid="this.setCustomValidity('Per procedere devi accettare i termini e le condizioni')" oninput="this.setCustomValidity('')"> 
                <span>Accetto i termini e le condizioni</span>
                <button type="submit" name="register_btn" class="submit-btn">Register</button>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("btn");
    //Funzione per spostare la visuale sul form di registrazione
    function register(){
        x.style.left = "-690px";
        y.style.left = "50px";
        z.style.left = "110px";
        
    }
    //Funzione per spostare la visuale sul form di accesso
    function login(){
        x.style.left = "50px";
        y.style.left = "740px";
        z.style.left = "0px";
    }
    //Funzione che reindirizza ad una data pagina
    function to_page(x){
        window.location.href=x;
    }
</script>

<?php 

            include 'funz.php';
            //Codice di registrazione dell'utente
            if (isset ($_POST['register_btn']))
            {
                $nome = $_POST['nome'];
                $cognome = $_POST['cognome'];
                $ddn = $_POST['ddn'];
                $ldn = $_POST['ldn'];
                $cfiscale = $_POST['codice'];
                $residenza = $_POST['residenza'];
                $cellulare = $_POST['cellulare'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $conn = connessione_db("ala_ambulatoriale");
                $istr = "INSERT INTO anagrafiche VALUES ('','$nome', \"$cognome\",'$ddn', '$ldn', '$cfiscale', '$residenza', '$cellulare', '$email', '$password');";
                $risposta= mysqli_query($conn, $istr);
                if(!$risposta) 
                    alert("Qualcosa è andato storto! Riprova");
            }
            
            //Codice di login, vengono verificate le credenziali 
            if(isset($_POST["login_btn"])){
                $email = $_POST["log_email"];
                $password = $_POST["log_password"];
                $conn = connessione_db("ala_ambulatoriale");
                $istr = "SELECT ID_anagrafica FROM anagrafiche WHERE Email = \"$email\" and PW = \"$password\";";
                $risposta=mysqli_query($conn,$istr);
			    $riga=mysqli_fetch_assoc($risposta);
                if ($riga["ID_anagrafica"]>0)
                {
                    $_SESSION["id"] = $riga["ID_anagrafica"]; 
                    echo $riga["ID_anagrafica"];
                    echo "<script>to_page(\"area-personale.php\");</script>";

                }else{
                    alert("Qualcosa è andato storto! Riprova");
                }
            }
        
?>