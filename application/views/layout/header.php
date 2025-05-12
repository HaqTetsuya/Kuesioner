<?php
// application/views/layout/header.php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Aplikasi Kuesioner' ?></title>
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Chart.js untuk grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body {
            font-family: 'Comic Sans MS', cursive;
            background-color: #f4f4f4;
        }
        
        /* Styling tambahan untuk Comic Sans dan black & white theme */
        .btn-primary {
            background-color: black !important;
            color: white !important;
        }
        
        .card {
            border: 2px solid black;
            border-radius: 8px;
        }
        
        input, textarea, select {
            border: 1px solid black !important;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-black text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="<?= site_url('dashboard') ?>" class="text-2xl font-bold">
                Kuesioner App
            </a>
            
            <div class="space-x-4">
                <?php if($this->session->userdata('logged_in')): ?>
                    <a href="<?= site_url('dashboard') ?>" class="text-white hover:underline">Dashboard</a>
                    <a href="<?= site_url('dashboard/profil') ?>" class="text-white hover:underline">Profil</a>
                    <a href="<?= site_url('auth/logout') ?>" class="text-white hover:underline">Logout</a>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>" class="text-white hover:underline">Login</a>
                    <a href="<?= site_url('register') ?>" class="text-white hover:underline">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">