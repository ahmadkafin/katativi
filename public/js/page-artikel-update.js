let title_art = document.getElementById('title');
const update_art = document.getElementById('update-artikel');

$('#body').summernote({
    placeholder: "isi artikel disini",
    height: 800,
});

title_art.onblur = ()=> {
    if(title_art.value != '') {
        $.get(
            config.routes.slugs, {
                'title': title_art.value
            },
            function(data) {
                document.getElementById('slugs').value = data.slug;
            }
        );
    }
}

$('#form-artikel-update').submit(function(e){
    e.preventDefault();
    var formDataUpdate = new FormData(this);
    let path = window.location.pathname.split('/');
    let id = path[4];
    var url = config.routes.update_art;
    url = url.replace(':id', id);
    $.ajax({
        url: url,
        type: "POST",
        contentType: false,
        processData: false,
        data: formDataUpdate,
        beforeSend: () => {

        },
        success: (data)=>{
            window.onbeforeunload = null;
            if(data.status === 202) {
                const newline = "\r\n";
                alert(`Success: ${data.status} - ${data.message}${newline}Data telah terupdate`);
                window.location.href = config.routes.index_art;
            } else {
                alert(`Error: ${data.status} - ${data.message}`);
            }
        }
    });
})


$('#artikel-poster').attr('src', '/img/poster-artikel/' + config.data.image);
$('#poster').on('change', function(){
    readImage(this)
});

function readImage(input){
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#artikel-poster").attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}