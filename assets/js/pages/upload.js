$(document).ready(function() {
    table = $('#list_upload').DataTable({
        responsive: true,
        dom: '<"pull-left"f><"pull-right"l>tip'
    });
});

function upload_database(id) {
    $('#form')[0].reset();

    $.ajax({
        url : "upload/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="kdUpload"]').val(data.request_id);
            $('[name="secretkey"]').val(data.secret_key);

            $('#modal_form').modal('show');
            $('.modal-title').text('Upload Database');

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function save() {
    var url = "upload/do_upload";

    var formData = new FormData($("#form")[0]);

    $("#loadergif").css('display', 'inline');

    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        dataType: "JSON",
        contentType : false,
        processData : false,
        success: function(data) {
            if (data.error_id === 0) {
                $("#loadergif").css('display', 'none');
                $('#alert_message').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
                setTimeout(function(){location.reload()}, 1000);
            } else if (data.error_id === 1) {
                $("#loadergif").css('display', 'none');
                $('#alert_message').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
            } else {
                $("#loadergif").css('display', 'none');
                $('#alert_message').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $("#loadergif").css('display', 'none');
            alert('Error adding / update data');
        }
    });
}
