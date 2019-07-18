$(document).ready(function() {
    table = $('#list_user').DataTable({
        responsive: true,
        dom: '<"pull-left"f><"pull-right"l>tip'
    });
});

function tambah_user() {
    save_method = 'add';

    $.ajax({
        url : "user/get_id/",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#form')[0].reset();
            $('[name="kdUser"]').val(parseInt(data.user_id)+1);


            $('#modal_form').modal('show');
            $('.modal-title').text('Tambah User');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function edit_user(id) {
    save_method = 'update';

    $('#form')[0].reset();

    $.ajax({
        url : "user/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="kdUser"]').val(data.user_id);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
            $('[name="nama"]').val(data.nama);
            $('[name="email"]').val(data.email);
            $('#layanan').val(data.layanan_id);
            $('[name="kabkota"]').val(data.kab_kota);
            $('[name="kantorwilayah"]').val(data.kantor_wilayah);
            $('#role').val(data.role_id);

            $('#modal_form').modal('show');
            $('.modal-title').text('Edit User');

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function save() {
    var url;
    
    if(save_method == 'add') {
        url = "user/do_tambah";
    } else {
        url = "user/do_edit";
    }

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
                $('#alert_message').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
                setTimeout(function(){location.reload()}, 1000);
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

function hapus_user(id) {
    if(confirm('Are you sure delete this data?')) {
        $.ajax({
            url : "user/do_hapus/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.error_id === 0) {
                    $('#alert_hapus').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
                    setTimeout(function(){location.reload()}, 1000);
                } else if (data.error_id === 1) {
                    $('#alert_hapus').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
                } else {
                    $('#alert_hapus').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning! </strong><p>' + data.message + '</p></div><div class="clearfix"></div>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
            }
        });
    }
}