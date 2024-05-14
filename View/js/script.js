function rotateIcon(numero) {
    var icon = document.getElementsByClassName('icona');
    icon[numero].classList.toggle('ruota');

    //aggiungiMete(icon[numero]);
}
function aggiungiMete(data) {
    var gitaElement = document.getElementsByClassName('gitamete')[0];

    for (let i = 0; i < data.length; i++) {
        var gita = document.createElement('div');
        gita.className = "gita"
        gita.innerHTML = `<div class="sopra"><span id="nomeGita" onclick=eliminaGita(${data[i].id})>${data[i].nome}</span>
                        <span id="modifica" onclick="modificaEvento(${data[i].id})">modifica</span>
        <img src="./images/freccinaBianca.png" onclick="rotateIcon(${i})" alt="+" class="icona"></div><div class="descrizioneGita">
        <div class="onRiga">
            <span id="DataInizio">Inizio: ${data[i].data}</span>
            <span id="Costo">Prezzo gita: ${data[i].costo}</span>
        </div>
        <span id="descrizioneGita">${data[i].descrizione}</span>
    </div>`;
        gitaElement.appendChild(gita);


        var meta = document.createElement('div');
        meta.className = 'mete';
        gitaElement.appendChild(meta);

        var metaElement = document.getElementsByClassName('mete')[i];
        prezzoTot = 0;
        prezzoTot += data[i].costo;

        // sarebbe carino caricare i tour ordinati per data, ma forse è meglio farlo dal backend
        for (let j = 0; j < data[i].tours.length; j++) {
            prezzoTot += parseFloat(data[i].tours[j].costo);

            canPartecipate = false;
            if (data[i].tours[j].partAtt < data[i].tours[j].maxPart) canPartecipate = true;

            var metina = document.createElement('div');
            metina.className = 'metePiccole';
            metina.innerHTML = `<div class="inRiga">
            <span id="nomeMeta" onclick="eliminaMeta(${data[i].tours[j].id})">${data[i].tours[j].nome}</span>
            <span id="dataMeta">Durata: ${data[i].tours[j].durata} minuti</span></div>
            <div class="bordino">
            <span id="descrioneMeta">${data[i].tours[j].descrizione}</span></div>
            <div class="onRiga">
            <span id="maxpart">Partecipanti: ${data[i].tours[j].partAtt}/${data[i].tours[j].maxPart}</span>
            <span id="costoMeta">€${data[i].tours[j].costo}</span></div>
            <div class="inMezzo"><span id="modifica" onclick="modificaTour(${data[i].tours[j].id})">modifica</span>
            <span id="modifica" onclick="aggiungiPart(${data[i].tours[j].id}, ${canPartecipate})">Aggiungi Partecipanti</span></div>`;
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
async function prendiDati() {
    try {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../index.php/prendiGita", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
                console.log(data);
                aggiungiMete(data);
            }
        };
        xhr.send();
    } catch (ex) { }
}
async function prendiDati2() {
    // questa cosa fa implodere tutto quanto 
    // aggiungi anche le mete dove sei stato aggiunto
    await prendiDati();
    /*try {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../index.php/rubaGite", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
                console.log(data);
                aggiungiMete(data);
            }
        };
        xhr.send();
    } catch (ex) { }*/
}
function modificaEvento(num) {
    localStorage.setItem('idEvento', num);
    window.location.href = "./modificaEvento.php"
}
function modificaTour(num) {
    localStorage.setItem('idTour', num);
    window.location.href = "./modificaTour.php"
}
function aggiungiPart(num, si) {
    if (si) {
        var mail = prompt("Inserisci la mail dell'utente che vuoi aggiungere a questo tour");
        var xhr = new XMLHttpRequest();
        xhr.open("GET", `../index.php/aggiungiTizio?mail=${mail}&idTour=${num}`, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
                aggiungiMete(data);
            }
        };
        xhr.send();

        // ricarica pagina
        location.reload();
    } else {
        alert("Non puoi aggiungere più partecipanti");
    }
}
window.onload = async () => {
    await prendiDati2();
}
function eliminaMeta(id) {
    if (window.confirm("Sicuro di voler eliminare questa meta?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", `../index.php/eliminaMeta?id='${id}'`, true);
        xhr.send();
        window.location.href = "./homepage.html"
    }
}
function eliminaGita(id) {
    if (window.confirm("Sicuro di voler eliminare questa gita e tutte le mete che comprende?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", `../index.php/eliminaGita?id='${id}'`, true);
        xhr.send();
        window.location.href = "./homepage.html"
    }
}