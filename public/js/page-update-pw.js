document.getElementById('update-password-users').addEventListener('click', (e) => {
    e.preventDefault();
    var formUpdateUser = document.getElementById('form-update-password-user');
    let formDataUpdateUser = new FormData(formUpdateUser);
    let path = window.location.pathname.split('/');
    let username = path[3];
    var url = config.routes.update;
    url = url.replace(':username', username);
    $.ajax({
        url: url,
        type: "POST",
        data: formDataUpdateUser,
        contentType: false,
        processData: false,
        beforeSend: function(){

        },
        success: function(data) {
            window.onbeforeunload = null;
            if(data.status === 202) {
                const newline = "\r\n";
                alert(`Success: ${data.status} - ${data.message}${newline}Data telah terupdate`);
                window.location.href = config.routes.index;
            } else if(data.status === 406) {
                const newline = "\r\n";
                alert(`Success: ${data.status} - ${data.message}${newline}!`);
                formUpdateUser.reset();
            } else {
                $.each(data.validation, function(key, value){
                    $('.'+key+'_err').text(value);
                });
            }
        }
    });
})


document.getElementById('show-old').addEventListener('click', (e)=>{
    e.preventDefault();
    if(document.getElementById('old_password').type === "password") {
        document.getElementById('old_password').type = "text";
    } else {
        document.getElementById('old_password').type = "password"
    }
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