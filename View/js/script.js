function rotateIcon(numero) {
    var icon = document.getElementsByClassName('icona');
    icon[numero].classList.toggle('ruota');

    //aggiungiMete(icon[numero]);
}
function premi() {
    aggiungiMete();
}
function aggiungiMete(data) {
    var gitaElement = document.getElementsByClassName('gitamete')[0];

    for (let i = 0; i < data.length; i++) {
        var gita = document.createElement('div');
        gita.className = "gita"
        gita.innerHTML = `<span id="nomeGita">${data[i].nome}</span>
                        <span id="modifica">modifica</span>
        <img src="./images/freccinaBianca.png" onclick="rotateIcon(${i})" alt="+" class="icona">`;
        gitaElement.appendChild(gita);


        var meta = document.createElement('div');
        meta.className = 'mete';
        gitaElement.appendChild(meta);

        var metaElement = document.getElementsByClassName('mete')[i];
        prezzoTot = 0;

        // sarebbe carino caricare i tour ordinati per data, ma forse è meglio farlo dal backend
        for (let j = 0; j < data[i].tours.length; j++) {
            prezzoTot += parseFloat(data[i].tours[j].costo);
            var metina = document.createElement('div');
            metina.className = 'metePiccole';
            metina.innerHTML = `<div class="inRiga">
            <span id="nomeMeta">${data[i].tours[j].nome}</span>
            <span id="dataMeta">Durata: ${data[i].tours[j].durata} giorni</span></div>
            <div class="bordino">
            <span id="descrioneMeta">${data[i].tours[j].descrizione}</span></div>
            <div class="onRiga">
            <span id="maxpart">Partecipanti: <b>da implementare</b>/${data[i].maxPart}</span>
            <span id="costoMeta">€${data[i].tours[j].costo}</span></div>
            <div class="inMezzo"><span id="modifica">modifica</span></div>`;
            metaElement.appendChild(metina);
        }
        var costoTot = document.createElement('div');
        costoTot.className = 'aggiustaADestra';
        costoTot.innerHTML = ` <span id="costoTotale">Costo totale gita "${data[i].nome}": €${prezzoTot}</span>
        <!--Mappa infinita pazzesca che unisce tutte le mete-->`;
        metaElement.appendChild(costoTot);
    }
}
function disconnetti() {
    document.cookie = "UserConnesso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.location.replace("./UserLogIn.php");
}
function prendiDati(){
    var xhr = new XMLHttpRequest();
            xhr.open("GET", "../index.php/prendiGita", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    aggiungiMete(data);
                }
            };
            xhr.send();
}
function modificaEvento(){

}
function modificaTour(){

}