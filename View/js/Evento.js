function aggiungiMete(data) {
    var gitaElement = document.getElementsByClassName('gitamete')[0];

    for (let i = 0; i < data.length; i++) {
        var gita = document.createElement('div');
        gita.className = "gita"
        gita.innerHTML = `<span id="nomeGita">${data[i].nome}</span>
        <img src="./images/freccinaBianca.png" onclick="rotateIcon(${i})" alt="+" class="icona">`;
        gitaElement.appendChild(gita);


        var meta = document.createElement('div');
        meta.className = 'mete';
        gitaElement.appendChild(meta);

        var metaElement = document.getElementsByClassName('mete')[i];
        prezzoTot = 0;

        for (let j = 0; j < data[i].tours.length; j++) {
            prezzoTot += parseFloat(data[i].tours[j].costo);
            var metina = document.createElement('div');
            metina.className = 'metePiccole';
            metina.innerHTML = ``;
            metaElement.appendChild(metina);
        }
        metaElement.appendChild(costoTot);
    }
}
/*`<div class="inRiga">
            <span id="nomeMeta">${data[i].tours[j].nome}</span>
            <span id="dataMeta">Durata: ${data[i].tours[j].durata} giorni</span></div>
            <div class="bordino">
            <span id="descrioneMeta">${data[i].tours[j].descrizione}</span></div>
            <div class="onRiga">
            <span id="maxpart">Partecipanti: <b>da implementare</b>/${data[i].maxPart}</span>
            <span id="costoMeta">€${data[i].tours[j].costo}</span></div>
            <div class="inMezzo"><span id="modifica" onclick="modificaTour(${data[i].tours[j].id})">modifica</span></div>`*/