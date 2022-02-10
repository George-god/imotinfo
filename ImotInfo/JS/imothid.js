$(document).ready(function(){
    var targetBox = $(".imoterinfo");
    if($('#imotda').is(':checked')) { 
        $(targetBox).show(); 
    }
    else {
        $(targetBox).hide();
    }
});