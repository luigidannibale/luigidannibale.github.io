
<?php
    include 'funz.php';

    //Gestione dell'id dell'utente corrente tramite sessione
    session_start();
    $id = $_SESSION["id"];
    
    //Stabilisco la connessione con il mio DB
    $conn = connessione_db("ala_ambulatoriale");

    //Prendo dal database i dati anagrafici dell'utente corrente tramite l'id
    $istr = "SELECT * FROM anagrafiche WHERE ID_anagrafica = '$id'";
    $risposta=mysqli_query($conn,$istr);
    $riga=mysqli_fetch_assoc($risposta);
    $nome = $riga['Nome'];
    $cognome = $riga['Cognome'];
    $ddn = $riga['Data_di_nascita'];
    $ldn = $riga['Luogo_di_nascita'];
    $cfiscale = $riga['Codice_fiscale'];
    $residenza = $riga['Indirizzo_di_residenza'];
    $cellulare = $riga['Numero_di_cellulare'];
    $email = $riga['Email'];
    $password = $riga['PW'];
    
    //Creo un array "prenotazioni" che mi servirà per popolare la tabella con tutte le prenotazioni dell'utante corrente tramite l'id
    $istr = "SELECT * FROM visite WHERE Paziente = '$id'";
    $prenotazioni=mysqli_query($conn,$istr);

    //Codice per modificare i dati anagrafici dell'utente corrente
    if (isset ($_POST['save_btn']))
    {   
        $istr = "SELECT PW FROM anagrafiche WHERE ID_anagrafica = '$id';";
        $risposta=mysqli_query($conn,$istr);
        $riga=mysqli_fetch_assoc($risposta);
        if($riga['PW'] = $_POST["password"]){
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $ddn = $_POST['ddn'];
            $ldn = $_POST['ldn'];
            $cfiscale = $_POST['codice'];
            $residenza = $_POST['residenza'];
            $cellulare = $_POST['cellulare'];
            $email = $_POST['email'];
            $istr = "UPDATE anagrafiche SET `Nome` = '$nome', `Cognome` = \"$cognome\", `Data_di_nascita` = '$ddn', `Luogo_di_nascita` = '$ldn', `Codice_fiscale` = '$cfiscale',
            `Indirizzo_di_residenza` = '$residenza', `Numero_di_cellulare` = '$cellulare', `Email` = '$email' WHERE (`ID_anagrafica` = '$id');";
            mysqli_query($conn, $istr); 
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

    //Codice per fare una prenotazione
    if(isset($_POST['fai_prenotazione-btn'])){
        $data_visita = $_POST["data-v"];
        $ora_visita = $_POST["ora-v"];
        $ambulatorio_d = $_POST["ambulatorio"];
        $prestazione_d = $_POST["prestazione"];
        $istr = "SELECT ID_ambulatorio FROM ambulatori WHERE Campo_medico_specialistico = '$ambulatorio_d'";
        $risposta=mysqli_query($conn,$istr);
        $riga=mysqli_fetch_assoc($risposta);
        $ambulatorio = $riga["ID_ambulatorio"];
        $istr = "SELECT ID_prestazione FROM prestazioni WHERE Descrizione = '$prestazione_d'";
        $risposta=mysqli_query($conn,$istr);
        $riga=mysqli_fetch_assoc($risposta);
        $prestazione = $riga["ID_prestazione"];
        //per controllare che la prenotazione non esista già
        $istr = "SELECT ID_visita FROM visite WHERE data_visita = '$data_visita' and ora_visita = '$ora_visita' and paziente = '$id' and ambulatorio = '$ambulatorio'";
        $risposta=mysqli_query($conn,$istr);
        $riga=mysqli_fetch_assoc($risposta);
        if(!isset($riga["ID_visita"])){
            $istr = "INSERT INTO visite VALUES('','$data_visita','$ora_visita','$id','$ambulatorio','$prestazione');";
            $risposta = mysqli_query($conn,$istr);
            $istr = "SELECT ID_visita FROM visite WHERE data_visita = '$data_visita' and ora_visita = '$ora_visita' and paziente = '$id' and ambulatorio = '$ambulatorio'";
            $risposta=mysqli_query($conn,$istr);
            $riga=mysqli_fetch_assoc($risposta);
            $id_v = $riga["ID_visita"];
            alert("Il tuo ID di prenotazione è " . $id_v  );
        }
        else {
            alert("La prenotazione esiste già");
        }
    }

    //Codice per modificare una prenotazione
    if(isset($_POST['modifica_prenotazione-btn'])){
        $data_visita_m = $_POST["data-m"];
        $ora_visita_m = $_POST["ora-m"];
        $ambulatorio_x = $_POST["ambulatorio-m"];
        $prestazione_x = $_POST["prestazione-m"];
        $istr = "SELECT ID_ambualtorio FROM ambulatori WHERE Campo_medico_specialistico = '$ambulatorio_x'";
        $risposta=mysqli_query($conn,$istr);
        $riga=mysqli_fetch_assoc($risposta);
        $ambulatorio_m = $riga["ID_ambulatorio"];
        $istr = "SELECT ID_prestazione FROM prestazioni WHERE Descrizione = '$prestazione_x'";
        $risposta=mysqli_query($conn,$istr);
        $riga=mysqli_fetch_assoc($risposta);
        $prestazione_m = $riga["ID_prestazione"];
        $istr = "UPDATE visite SET `Data_visita` = ' $data_visita_m', `Ora_visita` = '$ora_visita_m', `Ambulatorio` = '$ambulatorio_m', `Prestazione` = '$prestazione_m' 
        WHERE (`ID_visita` = '$id');";
            mysqli_query($conn, $istr); 
            echo "<meta http-equiv='refresh' content='0'>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Istituto Verdi -Area Personale</title>
        <link rel="stylesheet" href="area-personale.css">
        <link rel="icon" href="img/logo_small_white_background.png">
        <script src="https://kit.fontawesome.com/46a4371c55.js" crossorigin="anonymous"></script>
    </head>
        
    <body>
        <div class="wrapper">
            <!-- Barra laterale -->
            <div class="sidebar">
                <h2><img src="img/logo_small.png" alt=""><br>ISTITUTO VERDI</h2>
                <ul>
                    <li id="log-benvenuto"><i class="fas fa-user-md"></i><?php echo " Il tuo ID è:".$id."<br>"."Benvenuto ".$nome; ?></li>
                    <li><a href="#dati-anagrafici"><i class="fas fa-user-md"></i>Dati anagrafici</a></li>
                    <li><a href="#fai-prenotazione"><i class="fas fa-briefcase-medical"></i>Fai una prenotazione</a></li>
                    <li><a href="#mie-prenotazioni"><i class="fas fa-briefcase-medical"></i>Le mie prenotazioni</a></li>
                    <hr>
                    <li id="sidebar-footer"><a href="../IstitutoVerdi/"><i class="fas fa-user-md"></i>Log-out</a></li>
                </ul>
            </div>
        

            <div class="maincontent">
                <!--Sezione dedicata alla visione dei propri data anagrifici, questi posso essere anche modificati -->
                <div class="section" id="dati-anagrafici">
                    <form action="" method="post" id="form-dati-anagrafici">
                        <ul>
                            <li class="header">DATI ANAGRAFICI</li>
                            <li><input class="input-box" type="text" name="nome" id="nome" value="<?php echo $nome;?>" placeholder="Nome" required
                            oninvalid="this.setCustomValidity('Inserisci il nome')" oninput="this.setCustomValidity('')"></li>
                            <li><input class="input-box" type="text" name="cognome" id="cognome" value="<?php echo $cognome;?>" placeholder="Cognome" required
                            oninvalid="this.setCustomValidity('Inserisci il cognome')" oninput="this.setCustomValidity('')"></li>
                            <li><input class="input-box" type="text" name="ddn" id="ddn" value="<?php echo $ddn;?>" placeholder="Data di nascita (aaaa-mm-gg)" required
                            oninvalid="this.setCustomValidity('Inserisci la data di nascita  (aaaa-mm-gg)')" oninput="this.setCustomValidity('')"> </li>
                            <li><input class="input-box" type="text" name="ldn" id="ldn" value="<?php echo $ldn;?>" placeholder="Luogo di nascita" required
                            oninvalid="this.setCustomValidity('Inserisci il luogo di nascita')" oninput="this.setCustomValidity('')"></li>
                            <li><input class="input-box" type="text" name="codice" id="cod_fiscale" value="<?php echo $cfiscale;?>" placeholder="Codice fiscale" required
                            oninvalid="this.setCustomValidity('Inserisci il codice fiscale')" oninput="this.setCustomValidity('')" onkeyup="this.value = this.value.toUpperCase();"> </li>
                            <li><input class="input-box" type="text" name="residenza" id="residenza" value="<?php echo $residenza;?>" placeholder="Indirizzo di residenza" required
                            oninvalid="this.setCustomValidity('Inserisci l\'indirizzo di residenza')" oninput="this.setCustomValidity('')"></li>
                            <li><input class="input-box" type="text" name="cellulare" id="cellulare" value="<?php echo $cellulare;?>" placeholder="Numero di cellulare" required
                            oninvalid="this.setCustomValidity('Inserisci il numero di cellulare')" oninput="this.setCustomValidity('')"></li>
                            <li><input class="input-box" type="email" name="email" id="email" value="<?php echo $email;?>" placeholder="Email" required
                            oninvalid="this.setCustomValidity('Assicurati di aver inserito l\'indirizzo email corretto')" oninput="this.setCustomValidity('')"> </li>
                            
                            <li><input class="input-box" type="submit" name="save_btn" id="save-btn" value="Salva" onclick="reveal(this)"> 
                            <input type="text" class="input-box" name="password" id="password" required placeholder="Password corrente"
                            oninvalid="this.setCustomValidity('Inserisci la password per confermare')" oninput="this.setCustomValidity('')">
                            <input class="input-box" type="submit" name="annulla-btn" id="annulla-btn" value="Annulla" onclick="reveal(this)">
                        </li>
                        </ul>
                    </form>  
                </div>
                <!--Sezione per effettuare una prenotazione -->
                <div class="section" id="fai-prenotazione">
                    
                    <p class="header">FAI UNA PRENOTAZIONE</p>
                    
                    <form action="" method="post">
                            <ul id="fai-prenotazioni">
                                <li><input class="input-box" type="date" name="data-v" id="data-v" placeholder="Data della visita (aaaa-mm-gg)" <?php
                                $oggi = date('Y-m-d');?>value="<?php echo $oggi ?>" min="<?php echo $oggi ?>" required oninvalid="this.setCustomValidity('Inserisci la data della visita')" oninput="this.setCustomValidity('')"></li>
                                <li><input class="input-box" type="time" name="ora-v" id="ora-v" placeholder="Orario della visita" required value="10:00"
                                oninvalid="this.setCustomValidity('Inserisci il cognome')" oninput="this.setCustomValidity('')"
                                min="09:00" max="18:00"> <span class="validity"></span></li>
                                <li><div id="div_ambulatorio"><select name="ambulatorio" id="ambulatorio" class="input-box" placeholder="Scegli l'ambulatorio" required
                                oninvalid="this.setCustomValidity('Scegli un ambulatorio')" oninput="this.setCustomValidity('')">

                                    <option value="all" selected='selected'>--Ambulatorio--</option>
                                    <?php
                                    $istr = "SELECT Campo_medico_specialistico as c FROM ambulatori";
                                    $risposta = mysqli_query($conn, $istr);
                                    while ($row = mysqli_fetch_array($risposta)) {
                                        if ($row['c'] == $ambulatorio_d)
                                            echo "<option selected='selected' value=\"" . $row['c'] . "\">" . $row['c'] . "</option> \n";
                                        else
                                            echo "<option value=\"" . $row['c'] . "\">" . $row['c'] . "</option> \n";
                                    }
                                    ?>
                                </select></div></li>
                                <li><div id="div_prestazione"><select name="prestazione" id="prestazione" class="input-box" placeholder="Scegli la prestazione" required
                                oninvalid="this.setCustomValidity('Scegli una prestazione')" oninput="this.setCustomValidity('')">

                                    <option value="all" selected='selected'>--Prestazione--</option>
                                    <?php
                                    $istr = "SELECT Descrizione as d FROM prestazioni";
                                    $risposta = mysqli_query($conn, $istr);
                                    while ($row = mysqli_fetch_array($risposta)) {
                                        if ($row['d'] == $prestazione_d)
                                            echo "<option selected='selected' value=\"" . $row['d'] . "\">" . $row['d'] . "</option> \n";
                                        else
                                            echo "<option value=\"" . $row['d'] . "\">" . $row['d'] . "</option> \n";
                                    }
                                    ?>
                                </select></div> </li>
                                <li><input class="input-box" type="submit" name="fai_prenotazione-btn" id="fai_prenotazione-btn" value="Effettua la prenotazione" > </li>
                            </ul>
                    </form>
                </div>
                 <!--Sezione che elenca tutte le prenotazioni dell'utente corrente, queste potranno essere modificate oppure cancellate -->
                <div class="section" id="mie-prenotazioni">
                    <p class="header">GESTISCI LE TUE PRENOTAZIONI</p>
                    <table>
                        <form action="" method="post">
                                <tr>
                                    <th class="input-box">Numero prenotazione</th>
                                    <th class="input-box">Data</th>
                                    <th class="input-box">Ora</th>
                                    <th class="input-box">Ambulatorio</th>
                                    <th class="input-box">Prestazione</th>
                                </tr>
                                <?php
                                //Array di appoggio per salvare i vari id delle prenotazioni nel caso si volesse cancellare una prenotazione
                                $preno = array();
                                $i = 0;
                                while ($riga = mysqli_fetch_array($prenotazioni)) {
                                    $preno[$i] = $riga["ID_visita"];
                                    //Nella tabella verrà inserita un riga per ogni prenotazione dell'utente corrente
                                ?>
                                    <tr class="dati">
                                        <?php
                                            $x = $riga["Ambulatorio"];
                                            $istr = "SELECT Campo_medico_specialistico FROM ambulatori where ID_ambulatorio = '$x'";
                                            $risposta = mysqli_query($conn, $istr);
                                            $row = mysqli_fetch_array($risposta);
                                            $ambulatorio_t = $row['Campo_medico_specialistico'];
                                            $x = $riga["Prestazione"];
                                            $istr = "SELECT Descrizione FROM prestazioni where ID_prestazione = '$x'";
                                            $risposta = mysqli_query($conn, $istr);
                                            $row = mysqli_fetch_array($risposta);
                                            $prestazione_t= $row['Descrizione'];
                                        ?>
                                        <td><?php echo $riga["ID_visita"]; ?></td>
                                        <td><?php echo $riga["Data_visita"]; ?></td>
                                        <td><?php echo $riga["Ora_visita"]; ?></td>
                                        <td><?php echo $ambulatorio_t; ?></td>
                                        <td><?php echo $prestazione_t; ?></td>
                                        <!-- Bottone per la cancellazione della prenotazione, viene specificato l'id nel nome-->
                                        <td id="canc"><input type="submit" value="Cancella" class="elim" name="elimpre<?php echo $riga["ID_visita"] ?>"></td>
                                        <!-- Bottone per la modifica della prenotazione, viene specificato l'id nel nome-->
                                        <td id="canc"><input type="submit" value="Modifica" class="elim" name="modipre<?php echo $riga["ID_visita"] ?>"></td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>
                        
                    </table>  

                            
                            <ul id="modifica-prenotazioni">
                                <br>
                                <li class="header">Se si desidera modificare una prenotazione,prima inserire qui i nuovi dati</li>
                                <li><input class="input-box" type="date" name="data-m" id="data-m" placeholder="Data della visita (aaaa-mm-gg)" <?php
                                $oggi = date('Y-m-d');?>value="<?php echo $oggi ?>" min="<?php echo $oggi ?>" required oninvalid="this.setCustomValidity('Inserisci la data della visita')" oninput="this.setCustomValidity('')"></li>
                                <li><input class="input-box" type="time" name="ora-m" id="ora-m" placeholder="Orario della visita" required value="10:00"
                                oninvalid="this.setCustomValidity('Inserisci il cognome')" oninput="this.setCustomValidity('')"
                                min="09:00" max="18:00"> <span class="validity"></span></li>
                                <li><div id="div_ambulatorio">
                                <select name="ambulatorio-m" id="ambulatorio-m" class="input-box" placeholder="Scegli l'ambulatorio" required
                                oninvalid="this.setCustomValidity('Scegli un ambulatorio')" oninput="this.setCustomValidity('')">

                                    <option value="all" selected='selected'>--Ambulatorio--</option>
                                    <?php
                                    $istr = "SELECT Campo_medico_specialistico as c FROM ambulatori";
                                    $risposta = mysqli_query($conn, $istr);
                                    while ($row = mysqli_fetch_array($risposta)) {
                                        if ($row['c'] == $ambulatorio_d)
                                            echo "<option selected='selected' value=\"" . $row['c'] . "\">" . $row['c'] . "</option> \n";
                                        else
                                            echo "<option value=\"" . $row['c'] . "\">" . $row['c'] . "</option> \n";
                                    }
                                    ?>
                                </select></div></li>
                                <li><div id="div_prestazione">
                                <select name="prestazione-m" id="prestazione-m" class="input-box" placeholder="Scegli la prestazione" required
                                oninvalid="this.setCustomValidity('Scegli una prestazione')" oninput="this.setCustomValidity('')">

                                    <option value="all" selected='selected'>--Prestazione--</option>
                                    <?php
                                    $istr = "SELECT Descrizione as d FROM prestazioni";
                                    $risposta = mysqli_query($conn, $istr);
                                    while ($row = mysqli_fetch_array($risposta)) {
                                        if ($row['d'] == $prestazione_d)
                                            echo "<option selected='selected' value=\"" . $row['d'] . "\">" . $row['d'] . "</option> \n";
                                        else
                                            echo "<option value=\"" . $row['d'] . "\">" . $row['d'] . "</option> \n";
                                    }
                                    ?>
                                </select></div> </li>
                            </ul>
                        </form>
                <?php
                //Codice per eliminare una prenotazione, attraverso un ciclo vengono controllati tutti i bottoni
                for ($n = 0; $n < $i; $n++) {
                    if (isset($_POST["elimpre$preno[$n]"])) {
                        $istr = "DELETE FROM visite WHERE ID_visita = $preno[$n]";
                        $ris = mysqli_query($conn, $istr);
                        if ($ris) {
                            alert("Cancellazione avvenuta con successo");
                            reload();
                        } else
                           alert("Errore nella cancellazione!");
                    }
                }
                //Codice per modficare una prenotazione, attraverso un ciclo vengono controllati tutti i bottoni
                for ($n = 0; $n < $i; $n++){
                    if(isset($_POST["modipre$preno[$n]"])){
                        $data_visita_m = $_POST["data-m"];
                        $ora_visita_m = $_POST["ora-m"];
                        $ambulatorio_x = $_POST["ambulatorio-m"];
                        $prestazione_x = $_POST["prestazione-m"];
                        $istr = "SELECT ID_ambulatorio FROM ambulatori WHERE Campo_medico_specialistico = '$ambulatorio_x'";
                        $risposta=mysqli_query($conn,$istr);
                        $riga=mysqli_fetch_assoc($risposta);
                        $ambulatorio_m = $riga["ID_ambulatorio"];
                        $istr = "SELECT ID_prestazione FROM prestazioni WHERE Descrizione = '$prestazione_x'";
                        $risposta=mysqli_query($conn,$istr);
                        $riga=mysqli_fetch_assoc($risposta);
                        $prestazione_m = $riga["ID_prestazione"];
                        $istr = "UPDATE visite SET `Data_visita` = ' $data_visita_m', `Ora_visita` = '$ora_visita_m', `Ambulatorio` = '$ambulatorio_m', 
                        `Prestazione` = '$prestazione_m' WHERE (`ID_visita` = $preno[$n]);";
                        $ris = mysqli_query($conn, $istr);
                        if($ris){
                            alert("Modifica avvenuta con successo!");
                            echo "<meta http-equiv='refresh' content='0'>";
                        }
                        else 
                            alert("I dati non sono stati modificati con successo!");                        
                    }
                }
                ?>
                </div>                
            </div>
        </div>
    </body>
</html>

<script>
    //Funzione javascript che rivela un oggetto che gli viene passato
    function reveal(x){
        if(x.value=="Salva"){
            document.getElementById('password').style.visibility="visible";
            document.getElementById('annulla-btn').style.visibility="visible";
        }
        if (x.value=="Annulla") {
            document.getElementById('password').style.visibility="hidden";
            document.getElementById('annulla-btn').style.visibility="hidden";
        }
    }
</script>



