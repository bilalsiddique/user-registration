<div class="container mt-5">
    <div class="col-sm-12">
        <a class="btn btn-primary" href="<?= base_url('home') ?>" style="margin-bottom:10px;">
            Add User</a>
        <?php if($this->session->flashdata('success_msg') != "") {?>
            <div class="alert alert-success alert-block fade in">
                <button type="button" class="close close-sm" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <h4> <i class="icon-ok-sign"></i> Success!</h4>
                <p><?php echo $this->session->flashdata('success_msg'); ?></p>
            </div>
            <?php
            $this->session->set_flashdata('success_msg', "");
        } ?>
        <section class="panel">
            <header class="panel-heading">
                <span class="tools pull-right" style="display:none;">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-cog"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table  style="table-layout: fixed" class="display table table-bordered tbl-users table-striped" id="">
                        <thead>
                        <tr>
                            <th style="width: 30px">Sr #</th>
                            <th>Name</th>
                            <th >Date Of Birth</th>
                            <th>Address</th>
                            <th>Date added</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>

                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<?php ob_start() ?>
<script>
    $('document').ready(function () {
        initDataTable('.tbl-users', '<?= base_url() ?>'+'users/table/', [3], [] , {} , 'desc');
    });

    function delete_user(user_id) {
        swal({
            title: 'Are you sure delete user #'+user_id+'?',
            text: "Once deleted, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '<?php echo base_url()?>users/destroy',
                    type: 'POST',
                    data: {"user_id": user_id},
                    success: function (response) {
                        response = JSON.parse(response);
                        if (response.success)
                        {
                            swal({
                                title: 'Deleted!',
                                text: 'User Deleted successfully',
                                icon: 'success'
                            }).then(function() {
                                $('.tbl-users').DataTable().ajax.reload(null, false);
                            });
                        }
                    }
                });

            } else {
                swal("Cancelled", "Your imaginary section is safe :)", "error");
            }
        })


    }
    function preview_user(user_id) {
        $.ajax({
            url: '<?php echo base_url()?>/users/preview',
            type: 'POST',
            data: {"user_id": user_id},
            success: function (response) {
                $('#_commonDiv').html(response);
                $("body").find('#myModal').modal('show');
            }
        });


    }

</script>

<?php Event::add_content(ob_get_clean() , 'javascript'); ?>