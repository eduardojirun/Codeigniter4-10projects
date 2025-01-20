<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simple Sidebar - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/assets/img/favicon.png') ?>" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="<?= base_url('public/assets/css/styles.css') ?>" rel="stylesheet" />
    <style>
        #body {
            background-color: #2951c9;
            width: 100%;
            overflow-x: hidden;
        }
    </style>
</head>

<body id="page-top" class="sidebar-toggled">
  <div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="border-end bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-light">Start Bootstrap</div>
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Dashboard
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                SCRUD REST
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Form Validation
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Datatables
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Upload Files
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                API Restful
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                POO PHP
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                POO Javascript
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Algoritmos
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Auth y Roles y permisos
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Consumo API Restful c/s JWT
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                UX
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Tema Bootstrap y API
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Base de datos, JSON y XML
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Frameworks y librerías PHP
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Frameworks y librerías Javascript
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                Shoping cart
            </a>
        </div>
    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
        <!-- Top navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item active"><a class="nav-link" href="#!">
                            Inicio</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#!">Desarrollador Web</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#!">Action</a>
                                <a class="dropdown-item" href="#!">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Something else here</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <?= $this->renderSection('content') ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function () {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    });


    /*!
    * Start Bootstrap - Simple Sidebar v6.0.6 (https://startbootstrap.com/template/simple-sidebar)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-simple-sidebar/blob/master/LICENSE)
    */
    // 
    // Scripts
    // 

    window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    });
  </script>

  <!-- Page content-->
  <?= $this->renderSection('script') ?>

</body>
</html>
