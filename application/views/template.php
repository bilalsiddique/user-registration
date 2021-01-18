<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/dropzone-5.7.0/dist/dropzone.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
</head>



<body id="page-top" class="home">

<div id="page-wrap" >
    <!-- HEADER -->
    <?php $this->load->view('template/header');?>

    <!-- END / HEADER -->
    <?=$content?>
    <!-- FOOTER -->

<!--    --><?php //$this->load->view("template/footer");?>

    <!-- END / FOOTER -->
</div>
<!-- END / PAGE WRAP -->

<script>
    var tables_pagination_limit = 25;
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/Form-Fields-Repeater/repeater.js"></script>
<script src="<?=base_url()?>assets/main.js"></script>
<script src="<?=base_url()?>assets/dropzone-5.7.0/dist/dropzone.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?=base_url()?>assets/datatables_helpers.js"></script>
<div id="_commonDiv"></div>
<?= Event::get_content("javascript"); ?>
<?php echo $custom_script ?? ''?>

</body>

</html>