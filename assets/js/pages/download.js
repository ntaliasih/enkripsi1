$(document).ready(function() {
    table = $('#list_download').DataTable({
        responsive: true,
        dom: '<"pull-left"f><"pull-right"l>tip'
    });
});

function show_modal(id) {
    $('#form')[0].reset();
    $('#alert_message').html('');

    $('[name="kdRequest"]').val(id);
    $('#modal_form').modal('show');
}

function download_database() {
    var id = document.getElementById("kdRequest").value;
    var url = "download/do_download/" + id;

    $("#loadergif").css('display', 'inline');

    var formData = new FormData($("#form")[0]);

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

                var link = document.createElement("a");
                link.download = data.file;
                link.href = data.url;
                link.click();
                
                $('#alert_message').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
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