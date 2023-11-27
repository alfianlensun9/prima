<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        SITOU-PLAN
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Nucleo Icons -->
    <link href="<?= base_url('assets/css/nucleo-icons.css') ?>" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="<?= base_url('assets/css/black-dashboard.css') ?>" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?= base_url('assets/demo/demo.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/select2.css') ?>" rel="stylesheet" />
    <script src="<?= base_url('assets/js/core/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/select2.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/general.js') ?>"></script>

    <?php if (isset($head)) : ?>
        <?php foreach ($head['css'] as $css) : ?>
            <link rel="stylesheet" href="<?= $css ?>">
        <?php endforeach; ?>
    <?php endif; ?>


    <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.jquery.min.js') ?>"></script>
    <!-- Chart JS -->
    <script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>"></script>
    <!--  Notifications Plugin    -->
    <script src="<?= base_url('assets/js/plugins/bootstrap-notify.js') ?>"></script>
    <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url('assets/js/black-dashboard.min.js') ?>"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <?php if (isset($head)) : ?>
        <?php foreach ($head['js'] as $js) : ?>
            <script src="<?= $js ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>


    <style>
        .nav li p {
            font-weight: bold;
        }

        a {
            color: #efdcfb;
        }

        table tbody {
            font-size: 13px;
        }

        span p {
            color: #fff !important;
        }
    </style>
</head>

<body class="white-content">
    <div class="wrapper">