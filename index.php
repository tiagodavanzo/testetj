<?php
	ob_start();
	session_start();
	require_once(__DIR__ . "/source/autoload.php");
	
    $pag = (isset($_GET['pag']) && file_exists(mb_strtolower($_GET['pag']).'.php')) ? mb_strtolower($_GET['pag']).'.php' : 'home.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Cadastro de Livros | <?= ucfirst($_GET['pag']); ?></title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="./assets/css/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <!-- THEME STYLES-->
    <link href="./assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
        div.dataTables_filter
        {
            text-align:left !important;
        }
        .dataTables_length
        {
            text-align: right !important;
        }

        div.dataTables_wrapper div.dataTables_processing
        {
            font-weight:bold;
            color: white;
            background-color: #e74c3c;
        }

        #authors, #subjects, #books
        { 
            width: 40% !important; 
        }

        #authors_wrapper .dataTables_scrollHead,
        #subjects_wrapper .dataTables_scrollHead,
        #books_wrapper .dataTables_scrollHead
        { 
            width: 98.8% !important; 
        }

        #authors_wrapper th, #authors td,
        #subjects_wrapper th, #subjects td,
        #books_wrapper th, #books td
        { 
            white-space: nowrap;
            padding-top: 0.1rem !important;
            padding-bottom: 0.1rem !important;
            font-size:13px;
        }

    </style>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <?php
            require_once 'header.php';

            require_once 'nav.php';
        ?>
        
        <div class="content-wrapper" style="min-height:100vh !important;">
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <?php require_once $pag; ?>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>

    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
	<script src="./assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/DataTables/moment.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/DataTables/datetime-moment.js" type="text/javascript"></script>
    <script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jquery.maskedinput/dist/jquery.maskedinput.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <script src="assets/js/<?= mb_strtolower($_GET['pag']).'.js'; ?>" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">

        $.fn.dataTable.moment('DD/MM/YYYY');

        function removeMoedas(numero){
        
            numero = numero.replace('R$', '');
            numero = numero.replace('&pound;', '');
            numero = numero.replace('US$', '');
            numero = numero.replace('€', '');
            numero = numero.replace('&euro;', '');
            numero = numero.replace('GBP', '');
            numero = numero.replaceAll('&nbsp;', '');
            numero = numero.replaceAll(' ', '');
            
            numero = numero.replaceAll('.', '');
            numero = numero.replaceAll(',', '.');

            return numero
        }

    </script>
</body>
</html>