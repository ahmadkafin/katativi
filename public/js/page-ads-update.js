$('#image_iklan').attr('src', '/img/image-iklan/' + config.data.image);
$('#image_brand').on('change', function(){
    readImage(this)
});

function readImage(input){
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#image_iklan").attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('update-ads').addEventListener('click', (e)=> {
    e.preventDefault();
    var formUpdateAds = document.getElementById('form-update-ads');
    let formDataAds = new FormData(formUpdateAds);
    let path = window.location.pathname.split('/');
    let id = path[4];
    var url = config.routes.update;
    url = url.replace(':id', id);
    $.ajax({
        url: url,
        type: "POST",
        contentType: false,
        processData: false,
        data: formDataAds,
        beforeSend: function(){

        },
        success: function(data) {
            window.onbeforeunload = null;
            if(data.status === 202) {
                const newline = "\r\n";
                alert(`Success: ${data.status} - ${data.message}${newline}Data telah terupdate`);
                window.location.href = config.routes.index;
            } else {
                alert(`Error: ${data.status} - ${data.message}`);
            }
        }
    })
})