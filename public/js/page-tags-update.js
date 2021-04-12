document.getElementById('update-tags').addEventListener('click', (e) => {
    e.preventDefault();
    var formUpdateTags = document.getElementById('form-update-tags');
    let formDataUpdateTags = new FormData(formUpdateTags);
    let path = window.location.pathname.split('/');
    let id = path[4];
    var url = config.routes.update_tags;
    url = url.replace(':id', id);
    $.ajax({
        url: url,
        type: "POST",
        data: formDataUpdateTags,
        contentType: false,
        processData: false,
        beforeSend: function(){

        },
        success: function(data) {
            window.onbeforeunload = null;
            if(data.status === 202) {
                const newline = "\r\n";
                alert(`Success: ${data.status} - ${data.message}${newline}Data telah terupdate`);
                window.location.href = config.routes.index_tags;
            } else {
                $.each(data.validation, function(key, value){
                    $('.'+key+'_err').text(value);
                });
            }
        }
    });
})