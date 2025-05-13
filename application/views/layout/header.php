<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Buku</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Tulisan Tangan -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Indie+Flower&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">


    <style>
        :root {
            --main-font: 'Patrick Hand', cursive;
            --accent-font: 'Caveat', cursive;
            --bg-color: #f8f9fa;
            --text-color: #212529;
            --accent-color: #6c757d;
            --border-color: #dee2e6;
        }

        body {
            font-family: var(--main-font);
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: var(--accent-font);
            font-weight: 700;
        }

        .card,
        .btn,
        .form-control,
        .alert {
            border-radius: 15px !important;
        }

        .book-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .book-edge {
            position: absolute;
            top: 10px;
            bottom: 10px;
            width: 20px;
            background-color: #f0f0f0;
            border-radius: 3px;
            box-shadow: inset -2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .book-edge.left {
            left: -10px;
        }

        .header-container {
            border-bottom: 2px solid var(--border-color);
            padding: 15px;
        }

        .sidebar-container {
            border-right: 2px solid var(--border-color);
            min-height: calc(100vh - 140px);
        }

        .content-container {
            min-height: calc(100vh - 140px);
        }

        .footer-container {
            border-top: 2px solid var(--border-color);
            padding: 15px;
        }

        /* Cute elements styling */
        .nav-link {
            position: relative;
        }

        .nav-link:hover::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='8' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0,5 Q10,0 20,5 T40,5 T60,5 T80,5 T100,5' stroke='%23212529' fill='none' stroke-width='2'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
        }

        .paper-card {
            background-color: white;
            border: 2px solid #333;
            border-radius: 10px;
            box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .paper-card::before {
            content: '';
            position: absolute;
            bottom: -10px;
            right: -10px;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.03);
            border: 2px solid #333;
            border-radius: 10px;
            z-index: -1;
        }

        .cute-btn {
            border-radius: 50px;
            box-shadow: 2px 2px 0 rgba(0, 0, 0, 0.2);
            transition: all 0.2s;
            font-weight: 600;
        }

        .cute-btn:hover {
            transform: translateY(-2px);
            box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.3);
        }

        .cute-btn:active {
            transform: translateY(0);
            box-shadow: 1px 1px 0 rgba(0, 0, 0, 0.2);
        }

        .radio-likert {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .radio-likert input {
            margin: 0 auto;
        }

        .table-cute th {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .likert-scale-item {
            border-left: 4px solid transparent;
            transition: all 0.2s;
        }

        .likert-scale-item:hover {
            border-left-color: #007bff;
            background-color: rgba(0, 0, 0, 0.02);
        }

        .status-badge {
            width: 10px;
            height: 10px;
            display: inline-block;
            border-radius: 50%;
            margin-right: 5px;
        }

        .validation-error {
            border-left: 4px solid #dc3545;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <header class="header-container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <img src="/api/placeholder/40/40" alt="Logo" class="rounded-circle me-2">
                        <h1 class="mb-0">Buku App</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <nav class="navbar navbar-expand">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('home'); ?>">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('books'); ?>">Buku</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('authors'); ?>">Penulis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('categories'); ?>">Kategori</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3">
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <!--<img src="/api/placeholder/32/32" alt="User" width="32" height="32" class="rounded-circle">-->
                            <span class="ms-2"><?= $user->nama; ?></span>
                            <span hidden class="ms-2"><?= $user->email; ?></span>
                        </a>
                        <ul class="dropdown-menu rounded-3 text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="<?= base_url('profile'); ?>">Profil</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('settings'); ?>">Pengaturan</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('logout'); ?>">Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>