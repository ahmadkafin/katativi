let title_art = document.getElementById('title');
const submit_art = document.getElementById('submit-artikel');
const form_art = document.getElementById('form-artikel');

$('#body').summernote({
    placeholder: "isi artikel disini",
    height: 200,
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


$('#form-artikel').submit(function(e){
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        url: config.routes.store_art,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {

        },
        success: function(data){
            window.onbeforeunload = null;
            if(data.status === 201) {
                const newline = "\r\n";
                var cnfrm = confirm(`Success: ${data.status} - ${data.message}${newline}apakah ingin menambahkan artikel lagi?`);
                if(cnfrm === true) {
                    document.getElementById('form-artikel').reset();
                    $('#body').summernote('code', '');
                } else {
                    window.location.href = config.routes.index_art;
                }
            } else {
                $.each(data.validation, function(key, value){
                    $('.'+key+'_err').text(value);
                });
                alert(`Error: ${data.status}`);
            } 
        }
    });
})

// submit_art.addEventListener('click', (e)=> {
//     e.preventDefault();
//     var files = $('#poster').prop("files");
//     var names = $.map(files, function(val) { return val.name; });
//     console.log(files)
//     var status = document.getElementsByName('status');
//     for(var i = 0; i < status.length; i++) {
//         if(status[i].checked) {
//             var check = status[i].value;
//         }
//     }
//     $.ajax({
//         url: config.routes.store_art,
//         method: "POST",
//         dataType: 'json',
//         enctype: 'multipart/form-data',
//         processData: true,  // Important!
//         cache: false,
//         data: {
//             _token: config.data._token,
//             title: document.getElementById('title').value,
//             slugs: document.getElementById('slugs').value,
//             body: document.getElementById('body').value,
//             poster: files,
//             status: check
//         },
//         beforeSend: function() {

//         },
//         success: function(data){
//             if(data.status === 201) {
//                 const newline = "\r\n";
//                 var cnfrm = confirm(`Success: ${data.status} - ${data.message}${newline}apakah ingin menambahkan artikel lagi?`);
//                 if(cnfrm === true) {
//                     document.getElementById('form-artikel').reset();
//                     $('#body').summernote('code', '');
//                 } else {
//                     window.location.href = config.routes.index_art;
//                 }
//             } else {
//                 $.each(data.validation, function(key, value){
//                     $('.'+key+'_err').text(value);
//                 });
//                 alert(`Error: ${data.status}`);
//             } 
//         }
//     });
// });