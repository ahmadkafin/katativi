var table_users = $('#tabel_users').DataTable({
    processing: true,
    serverSide: false,
    ajax: config.routes.index,
    responsive: true,
    lengthChange: true, 
    autoWidth: false, 
    columnDefs: [ {
        searchable: false,
        orderable: false,
        targets: 0
    }],
    order: [[5, 'desc']],
    columns   : [
        {data : "id"},
        {data : "name"},
        {data : "username"},
        {data : "roles", render: function(data) {
            return '<span class="badge bg-info">'+data+'</span>';
        }},
        {data : "permission", render: function(data) {
            if(data == 1) {
                return '<span class="badge bg-info">Full Access</span>';
            } else {
                return '<span class="badge bg-warning">Read Only</span>';
            }
        }},
        {data : "id", render: function(data) {
            var url_edit = config.routes.edit;
            url_edit = url_edit.replace(':id', data);
            return '<div id="buttons" class="d-grid gap-2 d-md-block"><a href="'+url_edit+'" class="btn btn-info btn-block btn-sm" type="button"><i class="fas fa-pencil-alt"></i>&nbsp; Edit</a><button class="delete-artikel btn btn-danger my-2 btn-block btn-sm" onclick="destroy('+data+');" type="button"><i class="fas fa-trash-alt"></i>&nbsp; Delete</button>';
        }}
    ],
});

table_users.on( 'order.dt search.dt', function () {
    table_users.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();

function destroy(id){
    var url_delete = config.routes.destroy;
    url_delete = url_delete.replace(':id', id);
    var cnfrm = confirm("Apakah user ini akan di hapus? Jika di hapus akun akan hilang.");
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
                if(data.status === 202) {
                    alert(`Sukses! ${data.message} dengan status : ${data.status}`);
                    table_users.ajax.reload();
                }
            }
        });
    }
}