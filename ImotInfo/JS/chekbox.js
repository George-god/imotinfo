$(document).ready(function(){
    if(document.getElementById("Tok").checked) {
    document.getElementById('Tokhidden').disabled = true;
}

if(document.getElementById("Gas").checked) {
    document.getElementById('Gashidden').disabled = true;
}

if(document.getElementById("voda").checked) {
    document.getElementById('vodahidden').disabled = true;
}
});