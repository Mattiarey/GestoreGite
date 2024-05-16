function rotateIcon(numero) {
    var icon = document.getElementsByClassName('icona');
    icon[numero].classList.toggle('ruota');

    //aggiungiMete(icon[numero]);
}
function aggiungiMete(data, owner = true) {
    // si bugga perché non metto in coda i risultati, ma li aggiungo usando questo indice
    var gitaElement = document.getElementsByClassName('gitamete')[0];
    for (let i = 0; i < data.length; i++) {

        var stringaHTML = "";
        if (owner) {
            var gita = `<div class="gita"><div class="sopra"><span id="nomeGita" onclick=eliminaGita(${data[i].id})>${data[i].nome}</span>
                        <span id="modifica" onclick="modificaEvento(${data[i].id})">modifica</span>
                        <img src="./images/freccinaBianca.png" onclick="rotateIcon(${i})" alt="+" class="icona"></div><div class="descrizioneGita">
                        <div class="onRiga">
                        <span id="DataInizio">Inizio: ${data[i].data}</span>
                        <span id="Costo">Prezzo gita: €${data[i].costo}</span>
                        </div>
                        <span id="descrizioneGita">${data[i].descrizione}</span>
                        </div></div>
                        <div class="mete">`;
        } else {
            var gita = `<div class="gita"><div class="sopra"><span id="nomeGitaN">${data[i].nome}</span>
                        <img src="./images/freccinaBianca.png" onclick="rotateIcon(${i})" alt="+" class="icona"></div><div class="descrizioneGita">
                        <div class="onRiga">
                        <span id="DataInizio">Inizio: ${data[i].data}</span>
                        <span id="Costo">Prezzo gita: €${data[i].costo}</span>
                        </div>
                        <span id="descrizioneGita">${data[i].descrizione}</span>
                        </div></div>
                        <div class="mete">`;
        }

        stringaHTML += gita;
        prezzoTot = 0;
        prezzoTot += data[i].costo;

        // sarebbe carino caricare i tour ordinati per data, ma forse è meglio farlo dal backend
        for (let j = 0; j < data[i].tours.length; j++) {
            prezzoTot += parseFloat(data[i].tours[j].costo);

            canPartecipate = false;
            if (data[i].tours[j].partAtt < data[i].tours[j].maxPart) canPartecipate = true;
            if (owner) {
                var metina = `<div class="metePiccole"><div class="inRiga">
                              <span id="nomeMeta" onclick="eliminaMeta(${data[i].tours[j].id})">${data[i].tours[j].nome}</span>
                              <span id="dataMeta">Durata: ${data[i].tours[j].durata} minuti</span></div>
                              <div class="bordino">
                              <span id="descrioneMeta">${data[i].tours[j].descrizione}</span></div>
                              <div class="onRiga">
                              <span id="maxpart">Partecipanti: ${data[i].tours[j].partAtt}/${data[i].tours[j].maxPart}</span>
                              <span id="costoMeta">€${data[i].tours[j].costo}</span></div>
                              <div class="inMezzo"><span id="modifica" onclick="modificaTour(${data[i].tours[j].id})">modifica</span>
                              <span id="modifica" onclick="aggiungiPart(${data[i].tours[j].id}, ${canPartecipate})">Aggiungi Partecipanti</span></div></div>`;
                stringaHTML += metina;
            } else {
                var metina = `<div class="metePiccole"><div class="inRigaN">
                              <span id="nomeMeta"">${data[i].tours[j].nome}</span>
                              <span id="dataMeta">Durata: ${data[i].tours[j].durata} minuti</span></div>
                              <div class="bordino">
                              <span id="descrioneMeta">${data[i].tours[j].descrizione}</span></div>
                              <div class="onRiga">
                              <span id="maxpart">Partecipanti: ${data[i].tours[j].partAtt}/${data[i].tours[j].maxPart}</span>
                              <span id="costoMeta">€${data[i].tours[j].costo}</span></div>
                              <div class="inMezzo">
                              </div></div>`;
                stringaHTML += metina;
            }

        }
        var costoTot = `<div class="aggiustaADestra"><span id="costoTotale">Costo totale gita "${data[i].nome}": €${prezzoTot}</span>
                        <!--Mappa infinita pazzesca che unisce tutte le mete--></div></div>`;
        stringaHTML += costoTot;
        gitaElement.innerHTML += stringaHTML
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
    try {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../index.php/rubaGite", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
                console.log(data);
                aggiungiMete(data, false);
            }
        };
        xhr.send();
    } catch (ex) { }
}
function modificaEvento(num) {
    localStorage.setItem('idEvento', num);
    window.location.href = "./modificaGita.html"
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
window.onload = isAdmin();

async function isAdmin() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", `../index.php/isAdmin`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var data = JSON.parse(xhr.responseText);
            valore = data[0]["isAdmin"];
            if ( valore == 0) {
                 prendiDati2();
            } else {
                // se sei amministratore
                 AdminView();
            }
        }
    };
     xhr.send();
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
function AdminView() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../index.php/sonoAdmin", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var data = JSON.parse(xhr.responseText);
            console.log(data);
            aggiungiMete(data, true);
            modificaUtenti();
        }
    };
    xhr.send();
}
function modificaUtenti(){
    var tastiElement = document.getElementsByClassName('tastini')[0];
    stringa = '<a href="./gestisciUtenti.html"><input type="button" value="Gestisti utenti"></a>'
    tastiElement.innerHTML += stringa;
}