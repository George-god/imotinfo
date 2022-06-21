$(document).ready(function () {

  var btn = document.getElementById('leave');
  btn.addEventListener('click', function() {
    document.location.href = '../PHP/logout.php';
  });

});