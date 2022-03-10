var table;

$(document).ready(function () {
    table = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "order": [],
        "ajax": {
            "url": base_url + "/document/ajax_list",
            "type": "POST"
        },
        
	    "dom":
            "<'row'<'col-sm-12'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>", 
        "buttons": [
            {
                "text": '<i class="fa fa-upload"></i> Upload', 
                "className": "btn btn-primary",
                // action: function ( e, dt, node, config ) {
                //     alert( 'Button activated' );
                // }
            }
        ],
        // buttons: [
        //     {
        //         text: 'My button',
        //         action: function ( e, dt, node, config ) {
        //             alert( 'Button activated' );
        //         }
        //     }
        // ],
        "columnDefs": [{
            "targets": [-1],
            "orderable": false,
        }]
    });
});

function reload_table() {
    $('#table').DataTable().ajax.reload();
}

function hapus_doc(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Dokumen yang Anda upload sebelumnya akan hilang",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
				url: base_url + "document/delete/" + id,
				method: "GET",
				dataType: 'json',
				success: function (data) {
					if (data.status) {

                        Swal.fire(
                            'Deleted!',
                            'Dokumen telah dihapus.',
                            'success'
                        ).then((result) => {
							if (result.isConfirmed) {
								reload_table();
							}
						});
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
					alert('Error get data from ajax' + jqXHR + textStatus + errorThrown);
				}
			});
        }
    })
}