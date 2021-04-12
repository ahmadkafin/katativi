var table_trash = $('#trash-artikel').DataTable({
    processing: true,
    serverSide: false,
    ajax: config.routes.data_trash,
    responsive: true,
    lengthChange: true, 
    autoWidth: false, 
    columnDefs: [ {
        searchable: false,
        orderable: false,
        targets: 0
    }],
    order: [[3, 'desc']],
    columns   : [
        {data : "id"},
        {data : "title"},
        {data : "slugs", render: function(data) {
            return '<a href="http://127.0.0.1:8000/'+data+'" class="text-white">'+data+'</a>'
        }},
        {data : "deleted_at", render: function(data){
            return moment(data).format("MM-DD-YYYY/HH:mm");
        }},
        {data : "id", render: function(data) {
            return '<div id="buttons" class="d-grid gap-2 d-md-block"><button class="btn btn-info btn-block btn-sm" onclick="restore('+data+');" type="button"><i class="fas fa-trash-restore-alt"></i>&nbsp; Kembalikan</button><button class="delete-artikel btn btn-danger my-2 btn-block btn-sm" onclick="destroy('+data+');" type="button"><i class="fas fa-trash-alt"></i>&nbsp; Delete</button>';
        }}
    ],
});

table_trash.on( 'order.dt search.dt', function () {
    table_trash.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();

function destroy(id){
    var url_delete = config.routes.destroy;
    url_delete = url_delete.replace(':id', id);
    var cnfrm = confirm("Apakah artikel ini akan di hapus?");
    if(cnfrm === true) {
        $.ajax({
            url: url_delete,
            method: "DELETE",
            data: {
                _token: config.data._token
            },
            dataType: 'json',
            beforeSend: ()=> {
    
            },
            success: (data)=> {
                if(data.status === 200) {
                    alert(`Sukses! ${data.message} dengan status : ${data.status}`);
                    table_trash.ajax.reload();
                }
            }
        });
    }
}

function restore(id) {
        var url_restore = config.routes.restore;
        url_restore = url_restore.replace(':id', id);
        var cnfrm = confirm("Apakah artikel ini akan di kembalikan?");
        if(cnfrm === true) {
            $.ajax({
                url: url_restore,
                method: "GET",
                data: {
                    _token: config.data._token
                },
                dataType: 'json',
                beforeSend: ()=> {
        
                },
                success: (data)=> {
                    if(data.status === 200) {
                        alert(`Sukses! ${data.message} dengan status : ${data.status}`);
                        table_trash.ajax.reload();
                    }
                }
            });
    }
}

function restores(){
    var cnfrm = confirm("Apakah data akan dikembalikan semua?");
    if(cnfrm === true) {
        $.ajax({
            url: config.routes.restores,
            method: "GET",
            dataType: "json",
            beforeSend: function(){

            },
            success: function(data){
                if(data.status === 200) {
                    alert(`Sukses! ${data.message} dengan status : ${data.status}`);
                    window.location.href = config.routes.index;
                }
            }
        })
    }
}

function shreds(){
    var cnfrm = confirm("Apakah data akan dihapus semua?");
    if(cnfrm === true) {
        $.ajax({
            url: config.routes.shreds,
            method: "DELETE",
            dataType: "json",
            data: {
                _token: config.data._token
            },
            beforeSend: function(){

            },
            success: function(data){
                if(data.status === 200) {
                    alert(`Sukses! ${data.message} dengan status : ${data.status}`);
                    table_trash.ajax.reload();
                }
            }
        })
    }
}