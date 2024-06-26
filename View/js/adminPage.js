window.onload = async () => {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../index.php/mostraTutto", true);
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


    var stringa = ``
    for (i = 0; i < data.length; i++) {
        var sonoAdmin;
        if (data[i].isAdmin == 0) sonoAdmin = "";
        else sonoAdmin = "checked";

        stringa += `<div class="utente">
                <form action="../index.php/modifica?id='${data[i].id}'" method="POST">
                    <div class="sopra">
                        <span>${data[i].id} -</span>
                        <input type="text" name="nome" value="${data[i].nome}">
                        <input type="text" name="cognome" value="${data[i].cognome}">
                        <input type="mail" name="email" value="${data[i].email}">
                        <input type="text" name="password" value="${data[i].password}">
                        <label><input type="checkbox" name="isAdmin" id="isAdmin" ${sonoAdmin}>È admin</label>
                    </div>
                    <div class="sotto">
                        <input type="submit" value="modifica"></form>
                        <form action="../index.php/elimina?id='${data[i].id}'" method="POST">
                        <input type="submit" value="elimina utente"></form>
                    </div>
                
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