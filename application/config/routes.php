<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Routes untuk Aplikasi Kuesioner Likert
| -------------------------------------------------------------------------
| Definisi route untuk public facing dan dashboard admin
|
*/

// Routes untuk public
$route['default_controller'] = 'publics';
$route['submit'] = 'publics/submit';
$route['thank-you'] = 'publics/thank_you';

// Routes untuk dashboard admin
$route['dashboard'] = 'dashboard';

// Routes untuk manajemen pertanyaan
$route['dashboard/pertanyaan'] = 'dashboard/pertanyaan';
$route['dashboard/pertanyaan/tambah'] = 'dashboard/tambah_pertanyaan';
$route['dashboard/pertanyaan/simpan'] = 'dashboard/simpan_pertanyaan';
$route['dashboard/pertanyaan/edit/(:num)'] = 'dashboard/edit_pertanyaan/$1';
$route['dashboard/pertanyaan/update/(:num)'] = 'dashboard/update_pertanyaan/$1';
$route['dashboard/pertanyaan/hapus/(:num)'] = 'dashboard/hapus_pertanyaan/$1';

// Routes untuk hasil dan statistik
$route['dashboard/hasil'] = 'dashboard/hasil';
$route['dashboard/hasil/detail/(:num)'] = 'dashboard/detail_jawaban/$1';
$route['dashboard/statistik'] = 'dashboard/statistik';