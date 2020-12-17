<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>


</head>


<body class="fixed-left">
<!-- Begin page -->
<div id="wrapper">

    <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>


    <script type="text/javascript">
        swal({
            title: "",
            text: "<?php echo $msg; ?>",
            type: "<?php echo $type; ?>",
            confirmButtonClass: 'btn btn-confirm mt-2',
            cancelButtonClass: 'btn btn-cancel ml-2 mt-2',

        }, function () {
            window.location="<?php echo $location; ?>";
        });


    </script>

</div>
<!-- END wrapper -->
<!-- Sweet-Alert  -->


</body>
</html>
