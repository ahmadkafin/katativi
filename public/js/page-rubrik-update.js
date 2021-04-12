let name_rubr = document.getElementById('name');
name_rubr.onblur = ()=> {
    if(name_rubr.value != '') {
        $.get(
            config.routes.slugs, {
                'name': name_rubr.value
            },
            function(data) {
                document.getElementById('slugs').value = data.slug;
            }
        );
    }
}

document.getElementById('update-rubrik').addEventListener('click', (e) => {
    e.preventDefault();
    var formUpdateRubr = document.getElementById('form-update-rubrik');
    let formDataUpdateRubr = new FormData(formUpdateRubr);
    let path = window.location.pathname.split('/');
    let id = path[4];
    var url = config.routes.update_rubr;
    url = url.replace(':id', id);
    $.ajax({
        url: url,
        type: "POST",
        data: formDataUpdateRubr,
        contentType: false,
        processData: false,
        beforeSend: function(){

        },
        success: function(data) {
            window.onbeforeunload = null;
            if(data.status === 202) {
                const newline = "\r\n";
                alert(`Success: ${data.status} - ${data.message}${newline}Data telah terupdate`);
                window.location.href = config.routes.index_rubr;
            } else {
                $.each(data.validation, function(key, value){
                    $('.'+key+'_err').text(value);
                });
            }
        }
    });
})