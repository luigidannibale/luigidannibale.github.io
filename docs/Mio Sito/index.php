<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Istituto Verdi</title>
        <link rel="stylesheet" href="index.css">
        <link rel="icon" href="img/logo_small_white_background.png">
        <script src="https://kit.fontawesome.com/46a4371c55.js" crossorigin="anonymous"></script>
    </head>
        
    <body>
        <div class="wrapper">
            <!--Barra laterale -->
            <div class="sidebar">
                <h2><img src="img/logo_small.png" alt=""><br>ISTITUTO VERDI</h2>
                <ul>
                    <li><a href="#home"><i class="fas fa-home"></i>Home</a></li>
                    <li><a href="#prestazioni"><i class="fas fa-hospital"></i>Prestazioni</a></li>
                    <li><a href="#contatti"><i class="fas fa-briefcase-medical"></i>Contatti</a></li>
                    <li><a href="registration.php"><i class="fas fa-user-md"></i>Area personale</a></li>
                </ul>
            </div>
        

            <div class="maincontent">
                <!-- Sezione dedicata ai dati della home-->
                <div class="section" id="home">
                        <p>Nato nel 2004, l'istituto Verdi unisce la qualità del privato con la convenienza del pubblico. Forte di un organigramma di qualità, 
                        l’ospedale eroga prestazioni di primo livello in tutte le discipline specialistiche mettendo a disposizione attrezzature all’avanguardia 
                        per la cura e la prevenzione.</p>
                        <p>Affrontiamo ogni giorno una nuova sfida, pronti ad offrire il miglior servizio possibile ai nostri pazienti, rimanendo fedeli alla nostra mission: 
                        la vostra salute. In un mondo in continuo cambiamento, il nostro ospedale si confronta quindi con l’obbligo di rinnovarsi ed adeguarsi, diventando 
                        sempre meno un semplice luogo di cura e sempre di più un sistema finalizzato alla cura del paziente.</p>
                        <p>La nostra mission prosegue quindi nel pieno rispetto dei nostri valori fondanti, che vanno dalla continua ricerca dell’eccellenza al rispetto del 
                        malato, uniti alla competenza e alla ricerca scientifica. Eccellere nel campo medico per garantire dignità al paziente, nel pieno rispetto dei valori
                        etici della persona umana, attenti ai bisogni del malato e delle loro famiglie.</p>

                        <div class="box-info-home-wrapper">
                            <div class="box-info-home">
                                <img src="img/prestazioni.png" alt="">
                                <div class="info-prestazioni">
                                    <div class="numbers">1.800.000</div>
                                    <div class="text">prestazioni erogate</div>
                                </div>
                            </div>
                            <div class="box-info-home">
                                <img src="img/interventi.png" alt="">
                                <div class="info-interventi">
                                    <div class="numbers">30.000</div>
                                    <div class="text">interventi effettuati</div>
                                </div>
                            </div>
                            <div class="box-info-home">
                                <img src="img/medici.png" alt="">
                                <div class="info-medici">
                                    <div class="numbers">65</div>
                                    <div class="text">medici al lavoro</div>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- Sezione con tutte le prestazioni offerte dall'istituto-->
                <div class="section" id="prestazioni">
                        <div class="wrapper-lista-prestazioni">
                            <div class="info-bar">
                                <h3>Prestazioni</h3>
                            </div>
                            <div class="mod-table">
                                <h2>Medicina generale</h2>
                                <ul class="mod-list">
                                    <li><a href="Prestazioni/chirurgia.html">Chirurgia</a></li>
                                    <li><a href="Prestazioni/ortopedia.html">Ortopedia</a></li>
                                    <li><a href="Prestazioni/endocrinologia.html">Endocrinologia</a></li>
                                    <li><a href="Prestazioni/cardiologia.html">Cardiologia</a></li>
                                    <li><a href="Prestazioni/oncologia.html">Oncologia</a></li>
                                    <li><a href="#oftalmologia">Oftalmologia</a></li>
                                    <li><a href="#otorinolangoiatria">Otorinolangoiatria</a></li>
                                    <li><a href="#neurologia">Neurologia</a></li>
                                </ul>
                            </div>
                            <div class="mod-table">
                                <h2>DIAGNOSTICA PER IMMAGINI</h2>
                                <ul class="mod-list">
                                    <li><a href="#cardio-tc">Cardio TC</a></li>
                                    <li><a href="#radiologia-tradizionale">Radiologia tradizionale</a></li>
                                    <li><a href="#risonanza-magnetica">Risonza magnetica</a></li>
                                    <li><a href="#tac">TAC</a></li>
                                </ul>
                            </div>
                        </div>
                </div>

                <!-- Sezione con i contatti dell'istituto-->
                <div class="section" id="contatti">
                        <div class="sezione-box">
                            <br>
                            <h2 class="header">PER PRENOTARE:</h2> <br>

                            • Prenotazioni tramite email: prenotazioni@istitutoverdi.it<br>
                            • Prenotazioni tramite Fax: 06 xxxxxxxx<br>
                            • Prenotazioni tramite WhatsApp: 333 xxxxxxx<br>
                            • Per informazioni, disdette e possibilità di essere ricontattati inviare un WhatsApp al numero 333 xxxxxxx<br>
                            • Cassette Postali all’esterno della struttura H24<br>
                        </div>
                        <div class="wrapper-contatti">
                            <p><img src="img/orari.png" alt=""></p>
                            <p>
                                <span class="arancione">Orari :</span>
                                <br>
                                Lunedì/Venerdì
                                <br>
                                8.30 - 19.30
                            </p>
                            <hr>
                            <p><img src="img/prenotazioni.png" alt=""></p>
                            <p>
                                <span class="arancione">Prenotazioni allo sportello :</span>
                                <br>
                                Lunedì-Mercoledì
                                <br>
                                10.30 - 13.30
                                <br>
                                Martedì-Giovedì-Venerdì
                                <br>
                                14.30 - 17.30
                            </p>
                            <hr>
                            <p><img src="img/ritiro.png" alt=""></p>
                            <p>
                                <span class="arancione">Ritiro referti :</span>
                                <br>
                                Lunedì-Venerdì
                                <br>
                                9.30 - 18.30
                            </p>
                            <hr>
                            <p class="arancione">
                                <br>
                                Per prenotazioni o ritiri online <br>
                                accedere all'area personale <i class="fas fa-user-md"></i>
                            </p>
                        </div>
                </div>
            </div>
        </div>
       
    </body>
</html>
