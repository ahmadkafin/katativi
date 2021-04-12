document.getElementById('update-users').addEventListener('click', (e) => {
    e.preventDefault();
    var formUpdateUser = document.getElementById('form-update-user');
    let formDataUpdateUser = new FormData(formUpdateUser);
    let path = window.location.pathname.split('/');
    let id = path[4];
    var url = config.routes.update;
    url = url.replace(':id', id);
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
            } else {
                $.each(data.validation, function(key, value){
                    $('.'+key+'_err').text(value);
                });
            }
        }
    });
})