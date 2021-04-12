var table_ads = $('#tabel-ads').DataTable({
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
    language: {
        decimal:        ",",
        thousands:      ".",
    },
    order: [[1, 'asc']],
    columns   : [
        {data : "id"},
        {data : "nama_brand"},
        {data : "jenis_iklan", render: function(data) {
            switch(data) {
                case 'platinum' : return '<span class="badge bg-black">'+data+'</span>'; break; 
                case 'gold' : return '<span class="badge bg-warning">'+data+'</span>'; break;
                case 'silver' : return '<span class="badge bg-secondary">'+data+'</span>'; break;
                case 'bronze' : return '<span class="badge bg-white">'+data+'</span>'; break;
            }
        }},
        {data: "status", render: function(data) {
            if(data === 1) {
                return '<span class="badge bg-success">Iklan Aktif</span>';
            } else {
                return '<span class="badge bg-warning">Iklan tidak aktif</span>';
            }
        }},
        {data: "harga_iklan", render: $.fn.dataTable.render.number( ',', '.', 0, 'IDR ' )},
        {data : "masa_waktu", render: function(data){
            return moment(data).format("MM-DD-YYYY");
        }},
        {data : "id", render: function(data) {
            var url_edit = config.routes.edit;
            url_edit = url_edit.replace(':id', data);
            return '<div id="buttons" class="d-grid gap-2 d-md-block"><a href="'+url_edit+'" class="btn btn-info btn-block btn-sm" type="button"><i class="fas fa-pencil-alt"></i>&nbsp; Edit</a><button class="delete-artikel btn btn-danger my-2 btn-block btn-sm" onclick="destroy('+data+');" type="button"><i class="fas fa-trash-alt"></i>&nbsp; Delete</button>';
        }}
    ],
});

table_ads.on( 'order.dt search.dt', function () {
    table_ads.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();

function destroy(id){
    var url_delete = config.routes.destroy;
    url_delete = url_delete.replace(':id', id);
    var cnfrm = confirm("Apakah iklan ini akan di hapus? Jika di hapus tidak bisa di kembalikan lagi.");
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
                    table_ads.ajax.reload();
                }
            }
        });
    }
}