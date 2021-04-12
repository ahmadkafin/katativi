document.getElementById('jenis_iklan').addEventListener('change', function(e){
    switch(this.value) {
        case 'platinum' : $('#ads-platinum').modal('show'); break;
        case 'gold' : $('#ads-gold').modal('show'); break;
        case 'silver' : $('#ads-silver').modal('show'); break;
        case 'bronze' : $('#ads-bronze').modal('show'); break;
    }
});


document.getElementById('submit-ads').addEventListener('click', (e)=>{
    e.preventDefault();
    var formAds = document.getElementById('form-ads');
    let formDataAds = new FormData(formAds);
    $.ajax({
        url: config.routes.store,
        type: "POST",
        data: formDataAds,
        contentType: false,
        processData: false,
        beforeSend: function(){

        },
        success: function(data) {
            window.onbeforeunload = null;
            if(data.status === 201) {
                const newline = "\r\n";
                var cnfrm = confirm(`Success: ${data.status} - ${data.message}${newline}apakah ingin menambahkan ads lagi?`);
                if(cnfrm === true) {
                    formAds.reset();
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