    <?php
        //Funzione per la connessione ad un database che gli viene passato
        function  connessione_db ($dbname){
            $dbhost = "localhost";
            $dbuser = "root";
            $dbpass = "";
            $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
            return $conn;
        }
        //Funzione php che stampa un alert javascript
        function alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
        //Funzione php che ricarica la pagina tramite javascript
        function reload(){
            echo "<script type='text/javascript'>location.reload();</script>";
        }
        //Funzione che restituisce una sola riga da una query
        function getRiga($conn, $istr){
            $ris = mysqli_query($conn, $istr);
            if (mysqli_num_rows($ris) == 0) {
                return "Nessuna riga";
            } else {
                $riga = mysqli_fetch_assoc($ris);
                return $riga;
            }
        }
    ?>