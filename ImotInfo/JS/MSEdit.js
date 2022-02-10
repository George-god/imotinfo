$(function() { // This code will be executed when DOM is ready
            $('#selectimo').change(function() { // When the value for the Employee_ID element change, this will be triggered
                var $self = $(this); // We create an jQuery object with the select inside
                $.post("../PHP/editmodal.php", { name : $self.val()}, function(json) {
                    if (json && json.status) {
                        $('#cena').val(json.saleprice);
                        $('#renta').val(json.rent);
                    }
                })
            });
        })