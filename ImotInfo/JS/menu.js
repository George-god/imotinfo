
//$(document).ready(function(){
  //$("#Testbtn").click(function () {
    //$(".LeftCol").append('<div class="ImotCard"><img src="../Pictures/Imot.png"><div class="ImotBody"><h3 id="ImeImt">Tirana TEST</h3><hr><button class="button">Edit</button></div></div>');
    //$("#ImeImt").hide();
  //});
//});

$(document).ready(function () {
    //@naresh action dynamic childs
    var next = 0;
    $("#add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = ' <div id="field'+ next +'" name="field'+ next +'"><div class="test"><label class="col-md-4 control-label" for="action_id">Ime na imot:</label>  <div class="col-md-5"><label class="col-md-6 control-label" for="action_id">---------------------</label></div></div><br><br><div class="test"><label class="col-md-4 control-label" for="action_name">Kvadratura</label>  <div class="col-md-5"><label class="col-md-10 control-label" for="action_name">---------------------</label>  </div></div><br><br></div></div>';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });

});


