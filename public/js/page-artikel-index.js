var table_artikel = $('#example2').DataTable({
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
        {data : "title"},
        {data : "slugs", render: function(data) {
            return '<a href="http://127.0.0.1:8000/'+data+'" class="text-white">'+data+'</a>'
        }},
        {data : "counting_klik"},
        {data : "status", render: function(data) {
            if(data == 1) {
                return '<span class="badge bg-info">published</span>';
            } else {
                return '<span class="badge bg-warning">unpublished</span>';
            }
        }},
        {data : "created_at", render: function(data){
            return moment(data).format("MM-DD-YYYY/HH:mm");
        }},
        {data : "id", render: function(data) {
            var url_edit = config.routes.edit;
            url_edit = url_edit.replace(':id', data);
            return '<div id="buttons" class="d-grid gap-2 d-md-block"><a href="'+url_edit+'" class="btn btn-info btn-block btn-sm" type="button"><i class="fas fa-pencil-alt"></i>&nbsp; Edit</a><button class="delete-artikel btn btn-danger my-2 btn-block btn-sm" onclick="destroy('+data+');" type="button"><i class="fas fa-trash-alt"></i>&nbsp; Delete</button>';
        }}
    ],
});

table_artikel.on( 'order.dt search.dt', function () {
    table_artikel.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
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
                if(data.status === 202) {
                    alert(`Sukses! ${data.message} dengan status : ${data.status}`);
                    table_artikel.ajax.reload();
                }
            }
        });
    }
}