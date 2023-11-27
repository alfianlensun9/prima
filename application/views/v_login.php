<!DOCTYPE html>
<html lang="en">

<head>

    <title>SITOUPLAN</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="<?= site_url('assets/dist/assets/') ?>images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/nucleo-icons.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .image-size {
            height: 130%;
            width: 130%;
        }

        .masking {
            filter: blur(20px);
        }

        .masking-image {
            margin-top: -50px;
            margin-left: -15%;
        }

        .input-text {
            background-color: #ffffff3b;
        }

        .input-text::placeholder {
            /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #f6f6f6;
            opacity: 1;
            /* Firefox */
        }
    </style>

    <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);

            var tahun = today.getFullYear();
            var bulan = today.getMonth();
            var tanggal = today.getDate();
            var hari = today.getDay();

            switch (hari) {
                case 0:
                    hari = "Minggu";
                    break;
                case 1:
                    hari = "Senin";
                    break;
                case 2:
                    hari = "Selasa";
                    break;
                case 3:
                    hari = "Rabu";
                    break;
                case 4:
                    hari = "Kamis";
                    break;
                case 5:
                    hari = "Jum'at";
                    break;
                case 6:
                    hari = "Sabtu";
                    break;
            }
            switch (bulan) {
                case 0:
                    bulan = "Januari";
                    break;
                case 1:
                    bulan = "Februari";
                    break;
                case 2:
                    bulan = "Maret";
                    break;
                case 3:
                    bulan = "April";
                    break;
                case 4:
                    bulan = "Mei";
                    break;
                case 5:
                    bulan = "Juni";
                    break;
                case 6:
                    bulan = "Juli";
                    break;
                case 7:
                    bulan = "Agustus";
                    break;
                case 8:
                    bulan = "September";
                    break;
                case 9:
                    bulan = "Oktober";
                    break;
                case 10:
                    bulan = "November";
                    break;
                case 11:
                    bulan = "Desember";
                    break;
            }

            var tampilTanggal = hari + ", " + tanggal + " " + bulan + " " + tahun;

            document.getElementById('txt').innerHTML =
                tampilTanggal + " " + h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
    </script>
</head>
<?php $bgname = "assets/images/ios4.jpg"; ?>

<body onload="startTime()" class="bg-cover bg-center bg-no-repeat h-screen flex justify-center items-center" style="background-image: url(<?= site_url($bgname) ?>);">
    <div class="h-screen w-full absolute overflow-hidden animate__animated animate__fadeIn animate__slower">
        <div class="bg-cover bg-center z-10 masking h-full w-full masking-image image-size" style="background-image: url(<?= site_url($bgname) ?>);"></div>
    </div>

    <form class="text-center z-20 animate__animated animate__fadeIn animate__slower" action="<?= site_url('C_auth/login') ?>" method="post">
        <div class="text-center flex justify-center items-center text-white px-5 py-4 text-2xl uppercase font-bold  ">
            Sitou Plan
        </div>
        <div class="text-xs text-white">
            Silahkan login untuk melanjutkan
        </div>
        <!-- <h4 class="">Login Toska</h4> -->
        <div class="mt-5">
            <input autocomplete="off" type="text" class="bg-gray-200 appearance-none border-2 border-none rounded-md w-full py-2 px-4 leading-tight focus:outline-none focus:border-purple-500 mt-4 mb-2 input-text text-gray-200 placeholder-gray-200 text-xs" name="identity" id="username" placeholder="No Handphone">
        </div>
        <div class="">
            <input type="password" class="bg-gray-200 appearance-none border-2 border-none rounded-md w-full py-2 px-4 leading-tight focus:outline-none focus:border-purple-500 mb-4 input-text text-gray-200 placeholder-gray-200 text-xs" name="password" id="password" placeholder="Password">
        </div>
        <button class="outline-none focus:outline-none hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full input-text text-xs" type="submit">
            <i class="fa fa-arrow-right"></i>
        </button>

    </form>
    <style>
        .text-gray-cust {
            color: #88959d;
        }

        .text-red-cust {
            color: #cc5656;
        }
    </style>
    <p id="txt" class=" absolute top-0 inset-10 mt-5 text-gray-500 right-0 mr-10 text-sm"></p>
    <?php if ($this->session->flashdata('errmessage')) { ?>
        <div class="absolute bottom-0 inset-10 mb-10 text-red-300 text-sm"><?php echo $this->session->flashdata('errmessage'); ?></div>
    <?php } else { ?>
        <!-- <p class="absolute bottom-0 inset-10 mb-5 text-gray-cust text-sm"> Masukan username dan password Anda.</p> -->
    <?php } ?>





</body>

</html>