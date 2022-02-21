var table;

$(document).ready(function () {
    table = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "order": [],
        "ajax": {
            "url": base_url + "/document/ajax_list",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [-1],
            "orderable": false,
        }]
    });
});

function reload_table() {
    $('#table').DataTable().ajax.reload();
}