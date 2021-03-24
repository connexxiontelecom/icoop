<!doctype html>
<html lang="en">

<head>
    <title>iCoop - <?= $this->renderSection('title') ?> </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Connexxion Telecom">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo site_url() ?>assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo site_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo site_url() ?>assets/vendor/animate-css/vivify.min.css">
    <link rel="stylesheet" href="<?php echo site_url() ?>assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="<?php echo site_url() ?>assets/vendor/c3/c3.min.css"/>
    <link rel="stylesheet" href="<?php echo site_url() ?>assets/vendor/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="<?php echo site_url() ?>assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link href="<?php echo site_url();?>assets/third-party/jquery-ui/themes/smoothness/theme.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url();?>assets/third-party/themes/smoothness/jquery-min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url();?>assets/js/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo site_url();?>assets/vendor/selectize/css/selectize.css" rel="stylesheet" />

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo site_url() ?>assets/css/site.min.css">
    <?= $this->renderSection('extra-styles') ?>
	
</head>

<style>

   .simpletable thead {

    }

   thead th, tfoot th {
       /*font-family: 'Calibri bolder', sans-serif;*/
       /*font-weight: 10000;*/
       font: small-caps bolder 16px/40px Calibri, sans-serif;
   }
    </style>
