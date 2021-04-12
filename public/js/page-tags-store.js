document.getElementById('submit-tags').addEventListener('click', (e)=>{
    e.preventDefault();
    var formTags = document.getElementById('form-tags');
    let formDataTags = new FormData(formTags);
    $.ajax({
        url: config.routes.store_tags,
        type: "POST",
        data: formDataTags,
        contentType: false,
        processData: false,
        beforeSend: function(){

        },
        success: function(data) {
            window.onbeforeunload = null;
            if(data.status === 201) {
                const newline = "\r\n";
                var cnfrm = confirm(`Success: ${data.status} - ${data.message}${newline}apakah ingin menambahkan tags lagi?`);
                if(cnfrm === true) {
                    formTags.reset();
                } else {
                    window.location.href = config.routes.index_tags;
                }
            } else {
                $.each(data.validation, function(key, value){
                    $('.'+key+'_err').text(value);
                });
            }
        }
    });
});

document.getElementById('name').onblur = function(){
    return this.value = this.value.split(' ').join('');
}