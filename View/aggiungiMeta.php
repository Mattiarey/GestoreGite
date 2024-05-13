<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/homePage.css">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!--Fine font-->
    <title>Aggiungi Meta</title>
</head>

<body>
    <div class="head">
        <div class="connessione">
            <a onclick="disconnetti()">connesso</a>
            <img src="../View/images/userBianco.png" alt="immagine utente" id="userImage">
        </div>
        <h1 id="titolo">Aggiungi Meta</h1>
        <div class="tastini">
            <a href="./homepage.html"><input type="submit" value="Torna indietro"></a>
        </div>
    </div>
    <div class="corpo">
        <form action="../index.php/aggiungiMeta?mail=<?php echo $_COOKIE['UserConnesso'] ?>" method="POST"
            class="contenitore">
            <div class="inserimento"><input type="text" placeholder="Nome" maxlength="20" name="nome"></div>
            <div class="inserimento"><input type="textarea" placeholder="Descrizione" maxlength="255"
                    name="descrizione"></div>
            <div class="inserimento"><input type="number" placeholder="Durata" name="durata"></div>
            <div class="inserimento"><input type="number" placeholder="Costo" name="costo"></div>
            <div class="inserimento"><input type="text" placeholder="Nome Gita" name="fkMeta"></div>
            <div class="inserimento"><input type="number" placeholder="Partecipanti massimi" name="maxPart"></div>
            <div class="inserimento"><input type="submit" value="Invia"></div>
        </form>
    </div>
</body>

</html>