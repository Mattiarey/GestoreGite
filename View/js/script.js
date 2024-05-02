function rotateIcon(numero) {
    var icon = document.getElementsByClassName('icona');
    icon[numero].classList.toggle('ruota');
    // avessi un modo per capire che indice dell'array icona è non dovrei fare sto casino
    // con i numerini

    //aggiungiMete(icon[numero]);
}
function aggiungiMete(oggettoIcona) {
    // prendo il parent
    var gitaElement = oggettoIcona.closest('.gitamete');

    var testo = document.createElement('div');
    testo.textContent = "<div>:P</div>";
    gitaElement.appendChild(testo);
}
function prendiGite(){
    // leggere per bene questo
    // https://codereview.stackexchange.com/questions/273542/using-php-and-js-to-fetch-data-for-an-entry
}
function disconnetti(){
    document.cookie = "UserConnesso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.location.replace("./UserLogIn.php");
}