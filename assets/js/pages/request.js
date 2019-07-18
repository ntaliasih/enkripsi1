function tambah_request() {
    var formData = new FormData($("#formRequest")[0]);

    $.ajax({
        url : 'request/do_tambah',
        type: "POST",
        data: formData,
        dataType: "JSON",
        contentType : false,
        processData : false,
        success: function(data) {
            if (data.error_id === 0) {
                $('#alert_message').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
                $('#formRequest')[0].reset();
            } else if (data.error_id === 1) {
                $('#alert_message').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
            } else {
                $('#alert_message').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
        }
    });
}
