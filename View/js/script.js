function rotateIcon(numero) {
    var icon = document.getElementsByClassName('icona');
    icon[numero].classList.toggle('ruota');
    // avessi un modo per capire che indice dell'array icona è non dovrei fare sto casino
    // con i numerini

    //aggiungiMete(icon[numero]);
}
function premi() {
    aggiungiMete();
}
function aggiungiMete() {
    var gitaElement = document.getElementsByClassName('gitamete')[0];

    for (let i = 0; i < 5; i++) {
        var gita = document.createElement('div');
        gita.className = "gita"
        gita.innerHTML = `<span id="nomeGita">Gita ${i}</span>
                        <span id="modifica">modifica</span>
        <img src="./images/freccinaBianca.png" onclick="rotateIcon(${i})" alt="+" class="icona">`;
        gitaElement.appendChild(gita);


        var meta = document.createElement('div');
        meta.className = 'mete';
        gitaElement.appendChild(meta);

        var metaElement = document.getElementsByClassName('mete')[i]
        for (let j = 0; j < 3; j++) {
            var metina = document.createElement('div');
            metina.className = 'metePiccole';
            metina.innerHTML = `<div class="inRiga">
            <span id="nomeMeta">Meta ${j}</span>
            <span id="dataMeta">21/11/2021</span></div>
            <div class="bordino">
            <span id="descrioneMeta">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
            ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
            nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,</span></div>
            <div class="onRiga">
            <span id="maxpart">Partecipanti: 23/55</span>
            <span id="costoMeta">€23</span></div>
            <div class="inMezzo"><span id="modifica">modifica</span></div>`;
            metaElement.appendChild(metina);
        }
        var costoTot = document.createElement('div');
        costoTot.className = 'aggiustaADestra';
        costoTot.innerHTML = ` <span id="costoTotale">Costo totale gita ${i}: €46</span>
        <!--Mappa infinita pazzesca che unisce tutte le mete-->`;
        metaElement.appendChild(costoTot);
    }
}
function disconnetti() {
    document.cookie = "UserConnesso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.location.replace("./UserLogIn.php");
}