window.onload = async () => {
    idEvento = localStorage.getItem('idTour');
    var xhr = new XMLHttpRequest();
    xhr.open("GET", `../index.php/mostraMetina?id='${idEvento}'`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var data = JSON.parse(xhr.responseText);
            console.log(data);
            visualizzaGita(data);
        }
    };
    xhr.send();

}
function visualizzaGita(data) {
    var listaElement = document.getElementsByClassName("listaUtenti")[0];

    var stringa = ``;
    for (i = 0; i < data.length; i++) {

        stringa += `<div class="utente">
                <form action="../index.php/modificaMeta?id='${data[i].id}'" method="POST">
                    <div class="sopra">
                        <span>${data[i].id} -</span>
                        <input type="text" name="nome" value="${data[i].nome}">
                        <input type="text" name="descrizione" value="${data[i].descrizione}">
                        <input type="mail" name="durata" value="${data[i].durata}">
                        <input type="text" name="costo" value="${data[i].costo}">
                        <input type="text" name="maxPart" value="${data[i].maxPart}">
                    </div>
                    <div class="sotto">
                        <input type="submit" value="modifica">
                    </div>
                </form>
                
            </div>`;
        if (i != data.length - 1) {
            stringa += '<div class="intermezzo"></div>';
        }
    }
    listaElement.innerHTML = stringa;
}
function disconnetti() {
    document.cookie = "UserConnesso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.location.replace("./UserLogIn.php");
}