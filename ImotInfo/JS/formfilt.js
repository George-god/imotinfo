
 function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("razon");


  if (checkBox.checked == true){
    document.getElementById("raz1").disabled = false;
    document.getElementById("raz2").disabled = false;
    document.getElementById("raz3").disabled = false;
  } else {
    document.getElementById("raz1").disabled = true;
    document.getElementById("raz2").disabled = true;
    document.getElementById("raz3").disabled = true;
  }
}



