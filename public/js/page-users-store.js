document.getElementById('submit-users').addEventListener('click', (e)=>{
    e.preventDefault();
    var formUser = document.getElementById('form-user');
    let formDataUsers = new FormData(formUser);
    $.ajax({
        url: config.routes.store,
        type: "POST",
        data: formDataUsers,
        contentType: false,
        processData: false,
        beforeSend: function(){

        },
        success: function(data) {
            window.onbeforeunload = null;
            if(data.status === 201) {
                const newline = "\r\n";
                var cnfrm = confirm(`Success: ${data.status} - ${data.message}${newline}apakah ingin menambahkan user lagi?`);
                if(cnfrm === true) {
                    formTags.reset();
                } else {
                    window.location.href = config.routes.index;
                }
            } else {
                $.each(data.validation, function(key, value){
                    $('.'+key+'_err').text(value);
                });
            }
        }
    });
});


document.getElementById('generate').addEventListener('click', (e)=>{
    e.preventDefault();
    document.getElementById('password').value = randomString(10, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    document.getElementById('password_confirmation').value = document.getElementById('password').value;
});

document.getElementById('show').addEventListener('click', (e)=>{
    e.preventDefault();
    if(document.getElementById('password').type === "password") {
        document.getElementById('password').type = "text";
        document.getElementById('password_confirmation').type = "text";
    } else {
        document.getElementById('password').type = "password"
        document.getElementById('password_confirmation').type = "password"
    }
});

function randomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
}