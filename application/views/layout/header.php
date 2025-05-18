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
	<script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
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
                            <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>