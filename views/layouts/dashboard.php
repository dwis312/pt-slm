<?php

use app\core\App;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Boostrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Boxicons icon css -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link href="/_assets/css/dashboard.css" rel="stylesheet">

    <title>PT SLM</title>
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/">PT Sinar Lautan Makmur</a>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <form action="/logout" method="POST">
                    <button type="submit" class="nav-link px-3 bg-dark border-0">Log out</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column ms-2">
                        <li class="nav-item">
                            <a class="d-flex gap-2 nav-link <?= (App::$app->controller->action === 'dashboard') ? 'active' : ''; ?>" aria-current="page" href="/dashboard">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Dashboard
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link <?= (App::$app->controller->action === 'barang') ? 'active' : ''; ?>" href="/barang">
                                <span data-feather="file" class="align-text-bottom"></span>
                                Data Barang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (App::$app->controller->action === 'proses') ? 'active' : ''; ?>" href="/proses">
                                <span data-feather="file" class="align-text-bottom"></span>
                                Data Proses
                            </a>
                        </li> -->
                    </ul>

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header " id="panelsStayOpen-headingOne">
                                <button class="accordion-button rounded-0 d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <i class='bx bxs-component'></i>
                                    Barang
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link <?= (App::$app->controller->action === 'barang') ? 'active' : ''; ?>" href="/barang">
                                                <i class='bx bxs-data'></i>
                                                Data Barang
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?= (App::$app->controller->action === 'input') ? 'active' : ''; ?>" href="/input">
                                                <i class='bx bxs-file-plus'></i>
                                                Input barang
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button rounded-0 d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                    <i class='bx bxl-unity'></i>
                                    Produksi
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link <?= (App::$app->controller->action === 'data_product') ? 'active' : ''; ?>" href="/product">
                                                <i class='bx bxs-data'></i>
                                                Data Produksi
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?= (App::$app->controller->action === 'form_product') ? 'active' : ''; ?>" href="/product/item">
                                                <i class='bx bxs-file-plus'></i>
                                                Input produksi
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 pt-5 mt-4 mb-1 text-muted text-uppercase">
                        <span>Saved reports</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle" class="align-text-bottom"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                Data mingguan
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <?php $title = App::$app->controller->action; ?>
                    <h1 class="h3"><?= ucwords(App::$app->title($title)); ?></h1>
                </div>

                {{ content }}

            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="/_assets/js/dashboard.js"></script>
</body>

</html>