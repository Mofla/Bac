// image preview in forms
var imgPreview = function(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function(){
        var dataURL = reader.result;
        var output = document.getElementById('file');
        output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
};

$('.form-confirm').submit(function() {
    var pass = $('input[name=password]').val();
    var confirm = $('input[name=confirm_password]').val();
    console.log(pass);
    console.log(confirm);
    if (pass === confirm) {
        return true;
    }
    else
    {
        alert('Les mots de passe ne correspondent pas.')
        return false;
    }
});