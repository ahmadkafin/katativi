var table_visitor = $('#table-visitor').DataTable({
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
    order: [[0, 'desc']],
    columns   : [
        {data : "id"},
        {data : "ip_visitor"},
        {data : "kota"},
    ],
});

table_visitor.on( 'order.dt search.dt', function () {
    table_visitor.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();