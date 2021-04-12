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


document.getElementById('submit-rubrik').addEventListener('click', (e)=>{
    e.preventDefault();
    var formRubrik = document.getElementById('form-rubrik');
    let formDataRubrik = new FormData(formRubrik);
    $.ajax({
        url: config.routes.store_rubr,
        type: "POST",
        data: formDataRubrik,
        contentType: false,
        processData: false,
        beforeSend: function(){

        },
        success: function(data) {
            window.onbeforeunload = null;
            if(data.status === 201) {
                const newline = "\r\n";
                var cnfrm = confirm(`Success: ${data.status} - ${data.message}${newline}apakah ingin menambahkan rubrik lagi?`);
                if(cnfrm === true) {
                    formRubrik.reset();
                } else {
                    window.location.href = config.routes.index_rubr;
                }
            } else {
                $.each(data.validation, function(key, value){
                    $('.'+key+'_err').text(value);
                });
            }
        }
    });
});
