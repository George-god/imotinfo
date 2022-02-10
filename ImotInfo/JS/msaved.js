$(document).ready(function(){
    $(".buttonadd").click(function(){
        var htmlAppend = '<div class="icard" id="edit"><img src="../Pictures/img_avatar.png" alt="Avatar" style="width:100%" id="iimg"><div class="icontainer"><form method="post" action="" onsubmit="return modal()"><label class="cenlab uno">ImenaImot</label><br><label class="cenlab dos">Gradddz</label><br><input type="submit" value="Edit" id="editbtn"><input type="button" value="Save" onclick="saveEdits()"></form></div></div>';
        $("#edit").after(htmlAppend);
        //After appropriate checks that local storage is supported...
        localStorage.setItem("htmlAppend", htmlAppend);
    });

    var htmlAppend = localStorage.getItem("htmlAppend");
    if (htmlAppend) {
        $("#edit").after(htmlAppend);
    }
});


function AppendElements(htmlStringList)
{
  for (let i = 0;i < htmlStringList.length;++i)
  {
    var div = document.createElement('div');
    div.innerHTML = htmlString.trim();

    document.body.appendChild(div);
  }
}