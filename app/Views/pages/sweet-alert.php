
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="<?php echo base_url(); ?>/assets/third-party/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">


    <!--	--><?php //include('stylesheet.php'); ?>
</head>


<body class="fixed-left">
<!-- Begin page -->
<div id="wrapper">
    <script src="<?php echo base_url(); ?>/assets/vendor/jquery/jquery-3.3.1.min.js"></script>

    <script src="<?php echo base_url(); ?>/assets/third-party/sweet-alert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/third-party/sweet-alert2/sweet-alert.init.js"></script>


    <script type="text/javascript">

        swal({
            title: ' ',
            text: "<?php echo $msg; ?>",
            type: "<?php echo $type; ?>",
            confirmButtonClass: 'btn btn-confirm mt-2',
            cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
        }). then(function ()  {
            window.location="<?php echo $location; ?>";

        });

        //swal({
        //    title: "",
        //    text: "nul",
        //    type: "<?php //echo $type; ?>//",
        //    showCancelButton: true,
        //    confirmButtonColor: "#dc3545",
        //    confirmButtonText: "Yes, delete it!",
        //    cancelButtonText: "No, cancel plx!",
        //    closeOnConfirm: false,
        //    closeOnCancel: false
        //}, function (isConfirm) {
        //    if (isConfirm) {
        //        window.location="<?php //echo $location; ?>//";
        //    } else {
        //        window.location="<?php //echo $location; ?>//";
        //    }
        //});


    </script>

</div>
<!-- END wrapper -->
<!-- Sweet-Alert  -->


</body>
</html>

