<!-- Javascript -->
<!-- Latest jQuery -->
<script src="<?php echo site_url() ?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>

<!-- Bootstrap 4x JS  -->
<script src="<?php echo site_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo site_url() ?>assets/bundles/vendorscripts.bundle.js"></script>

<script src="<?php echo site_url() ?>assets/bundles/c3.bundle.js"></script>
<script src="<?php echo site_url() ?>assets/bundles/flotscripts.bundle.js"></script><!-- flot charts Plugin Js -->
<script src="<?php echo site_url() ?>assets/bundles/knob.bundle.js"></script>

<!-- Project Common JS -->
<script src="<?php echo site_url() ?>assets/js/common.js"></script>
<script src="<?php echo site_url() ?>assets/js/index.js"></script>
<script src="<?php echo site_url() ?>assets/js/garlic.min.js"></script>

<script src="<?php echo site_url() ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?php echo site_url() ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?php echo site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?php echo site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?php echo site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?php echo site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="<?php echo site_url() ?>assets/js/jquery-ui.js"></script>

    <?= $this->renderSection('extra-scripts') ?>

<script>

    $('input.number').keyup(function (event) {
        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) {
            event.preventDefault();
        }

        var currentVal = $(this).val();
        var testDecimal = testDecimals(currentVal);
        if (testDecimal.length > 1) {
            //console.log("You cannot enter more than one decimal point");
            currentVal = currentVal.slice(0, -1);
        }
      	$(this).val(replaceCommas(currentVal));

    });

    function testDecimals(currentVal) {
        var count;
        currentVal.match(/\./g) === null ? count = 0 : count = currentVal.match(/\./g);
        return count;
    }

    function replaceCommas(yourNumber) {
        var components = yourNumber.toString().split(".");
        if (components.length === 1)
            components[0] = yourNumber;
        components[0] = components[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if (components.length === 2)
            components[1] = components[1].replace(/\D/g, "");
        return components.join(".");
    }
</script>
</body>

</html>
