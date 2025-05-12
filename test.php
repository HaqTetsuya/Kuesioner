# Struktur View untuk Sistem Kuesioner

## 1. Template Views

### templates/header.php
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Sistem Kuesioner</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
</head>
<body>
    <?php if ($this->session->userdata('logged_in')): ?>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">Sistem Kuesioner</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                            <i class="fa fa-user-circle"></i> <?= $this->session->userdata('name') ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php endif; ?>
    
    <div class="container-fluid mt-4">
        <div class="row">
            <?php if ($this->session->userdata('logged_in')): ?>
                <div class="col-md-3">
                    <!-- Sidebar akan di-include di sini -->
                </div>
                <div class="col-md-9">
                    <!-- Flash Messages -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $this->session->flashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <!-- Flash Messages untuk halaman login -->
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>
            <?php endif; ?>
```

### templates/sidebar.php
```php
<div class="list-group">
    <a href="<?= base_url('dashboard') ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
        <i class="fa fa-dashboard"></i> Dashboard
    </a>
    <a href="<?= base_url('surveys') ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(1) == 'surveys' ? 'active' : '' ?>">
        <i class="fa fa-file-text"></i> Kelola Kuesioner
    </a>
    <a href="<?= base_url('reports') ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(1) == 'reports' ? 'active' : '' ?>">
        <i class="fa fa-bar-chart"></i> Laporan
    </a>
</div>
```

### templates/footer.php
```php
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container -->

    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>
</html>
```

## 2. Auth Views

### auth/login.php
```php
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Login Sistem Kuesioner</h4>
            </div>
            <div class="card-body">
                <?= form_open('auth/login') ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username') ?>" autofocus>
                        <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
```

## 3. Dashboard Views

### dashboard/index.php
```php
<h2 class="mb-4"><?= $title ?></h2>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <h5>Total Kuesioner</h5>
                <h2><?= $total_surveys ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <h5>Kuesioner Aktif</h5>
                <h2><?= $active_surveys ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white mb-4">
            <div class="card-body">
                <h5>Total Responden</h5>
                <h2><?= $total_responses ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fa fa-file-text"></i> Kuesioner Terbaru
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Responden</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_surveys as $survey): ?>
                    <tr>
                        <td><?= $survey->title ?></td>
                        <td>
                            <?php if ($survey->status == 'active'): ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php elseif ($survey->status == 'draft'): ?>
                                <span class="badge badge-warning">Draft</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d M Y', strtotime($survey->start_date)) ?></td>
                        <td><?= date('d M Y', strtotime($survey->end_date)) ?></td>
                        <td><?= $survey->response_count ?? 0 ?></td>
                        <td>
                            <a href="<?= base_url('surveys/preview/' . $survey->id) ?>" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="<?= base_url('reports/view/' . $survey->id) ?>" class="btn btn-sm btn-primary">
                                <i class="fa fa-bar-chart"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($recent_surveys)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada kuesioner</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="<?= base_url('surveys') ?>" class="btn btn-primary">Lihat Semua Kuesioner</a>
    </div>
</div>
```

## 4. Survey Views

### surveys/index.php
```php
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $title ?></h2>
    <a href="<?= base_url('surveys/create') ?>" class="btn btn-primary">
        <i class="fa fa-plus"></i> Buat Kuesioner Baru
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="surveyTable">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Pertanyaan</th>
                        <th>Responden</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($surveys as $survey): ?>
                    <tr>
                        <td><?= $survey->title ?></td>
                        <td>
                            <?php if ($survey->status == 'active'): ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php elseif ($survey->status == 'draft'): ?>
                                <span class="badge badge-warning">Draft</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d M Y', strtotime($survey->start_date)) ?></td>
                        <td><?= date('d M Y', strtotime($survey->end_date)) ?></td>
                        <td><?= $survey->question_count ?? 0 ?></td>
                        <td><?= $survey->response_count ?? 0 ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('questions/index/' . $survey->id) ?>" class="btn btn-sm btn-secondary" title="Kelola Pertanyaan">
                                    <i class="fa fa-list"></i>
                                </a>
                                <a href="<?= base_url('surveys/preview/' . $survey->id) ?>" class="btn btn-sm btn-info" title="Preview">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <?php if ($survey->status == 'draft'): ?>
                                    <a href="<?= base_url('surveys/edit/' . $survey->id) ?>" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('surveys/change_status/' . $survey->id . '/active') ?>" class="btn btn-sm btn-success" title="Aktifkan" onclick="return confirm('Yakin ingin mengaktifkan kuesioner ini?')">
                                        <i class="fa fa-check"></i>
                                    </a>
                                <?php elseif ($survey->status == 'active'): ?>
                                    <a href="<?= base_url('surveys/share/' . $survey->id) ?>" class="btn btn-sm btn-warning" title="Bagikan">
                                        <i class="fa fa-share-alt"></i>
                                    </a>
                                    <a href="<?= base_url('surveys/change_status/' . $survey->id . '/inactive') ?>" class="btn btn-sm btn-secondary" title="Nonaktifkan" onclick="return confirm('Yakin ingin menonaktifkan kuesioner ini?')">
                                        <i class="fa fa-times"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="<?= base_url('reports/view/' . $survey->id) ?>" class="btn btn-sm btn-primary" title="Lihat Laporan">
                                    <i class="fa fa-bar-chart"></i>
                                </a>
                                <a href="<?= base_url('surveys/delete/' . $survey->id) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus kuesioner ini? Semua data terkait akan ikut terhapus.')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($surveys)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada kuesioner</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#surveyTable').DataTable({
        "order": [[2, "desc"]]
    });
});
</script>
```

### surveys/create.php
```php
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $title ?></h2>
    <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?= form_open('surveys/create') ?>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Judul Kuesioner <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="title" class="form-control" value="<?= set_value('title') ?>" required>
                    <?= form_error('title', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" rows="4" required><?= set_value('description') ?></textarea>
                    <?= form_error('description', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="date" name="start_date" class="form-control" value="<?= set_value('start_date', date('Y-m-d')) ?>" required>
                    <?= form_error('start_date', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="date" name="end_date" class="form-control" value="<?= set_value('end_date', date('Y-m-d', strtotime('+30 days'))) ?>" required>
                    <?= form_error('end_date', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Simpan & Lanjutkan</button>
                    <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        <?= form_close() ?>
    </div>
</div>
```

### surveys/edit.php
```php
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $title ?></h2>
    <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?= form_open('surveys/edit/' . $survey->id) ?>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Judul Kuesioner <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="title" class="form-control" value="<?= set_value('title', $survey->title) ?>" required>
                    <?= form_error('title', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" rows="4" required><?= set_value('description', $survey->description) ?></textarea>
                    <?= form_error('description', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="date" name="start_date" class="form-control" value="<?= set_value('start_date', date('Y-m-d', strtotime($survey->start_date))) ?>" required>
                    <?= form_error('start_date', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="date" name="end_date" class="form-control" value="<?= set_value('end_date', date('Y-m-d', strtotime($survey->end_date))) ?>" required>
                    <?= form_error('end_date', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            
            <h4 class="mt-4 mb-3">Skala Likert</h4>
            <?php foreach ($likert_scales as $scale): ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nilai <?= $scale->scale_value ?></label>
                    <div class="col-sm-9">
                        <input type="hidden" name="scale_id[]" value="<?= $scale->id ?>">
                        <input type="hidden" name="scale_value[]" value="<?= $scale->scale_value ?>">
                        <input type="text" name="scale_label[]" class="form-control" value="<?= set_value('scale_label', $scale->scale_label) ?>" required>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        <?= form_close() ?>
    </div>
</div>
```

### surveys/preview.php
```php
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $title ?></h2>
    <div>
        <a href="<?= base_url('questions/index/' . $survey->id) ?>" class="btn btn-primary">
            <i class="fa fa-list"></i> Kelola Pertanyaan
        </a>
        <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h4 class="mb-0"><?= $survey->title ?></h4>
    </div>
    <div class="card-body">
        <p><?= nl2br($survey->description) ?></p>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Tanggal Mulai:</strong> <?= date('d M Y', strtotime($survey->start_date)) ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Tanggal Selesai:</strong> <?= date('d M Y', strtotime($survey->end_date)) ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Pertanyaan</h5>
    </div>
    <div class="card-body">
        <form id="previewForm">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="name" disabled placeholder="Nama Responden">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" disabled placeholder="Email Responden">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Telepon</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="phone" disabled placeholder="Nomor Telepon">
                </div>
            </div>
            
            <hr>
            
            <h5 class="mb-3">Skala Penilaian:</h5>
            <div class="mb-4">
                <?php foreach ($likert_scales as $scale): ?>
                    <span class="badge badge-info p-2 mr-2 mb-2"><?= $scale->scale_value ?> = <?= $scale->scale_label ?></span>
                <?php endforeach; ?>
            </div>
            
            <?php if (!empty($questions)): ?>
                <?php foreach ($questions as $question): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= $question->question_order ?>. <?= $question->question_text ?></h5>
                            <div class="form-group mt-3">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <?php foreach ($likert_scales as $scale): ?>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="answer[<?= $question->id ?>]" value="<?= $scale->scale_value ?>" disabled> <?= $scale->scale_value ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning">
                    Belum ada pertanyaan untuk kuesioner ini. 
                    <a href="<?= base_url('questions/create/' . $survey->id) ?>" class="alert-link">Tambahkan pertanyaan sekarang</a>.
                </div>
            <?php endif; ?>
            
            <div class="form-group mt-4">
                <button type="button" class="btn btn-primary" disabled>Submit (Preview)</button>
            </div>
        </form>
    </div>
</div>
```

### surveys/share.php
```php
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $title ?></h2>
    <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="mb-0"><?= $survey->title ?></h4>
    </div>
    <div class="card-body">
        <p><?= nl2br($survey->description) ?></p>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Tanggal Mulai:</strong> <?= date('d M Y', strtotime($survey->start_date)) ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Tanggal Selesai:</strong> <?= date('d M Y', strtotime($survey->end_date)) ?></p>
            </div>
        </div>
        
        <hr>
        
        <h5>Link Kuesioner:</h5>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="surveyUrl" value="<?= $survey_url ?>" readonly>
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="copyToClipboard()">
                    <i class="fa fa-copy"></i> Copy
                </button>
            </div>
        </div>
        
        <div class="mt-4">
            <h5>Share di:</h5>
            <a href="https://wa.me/?text=<?= urlencode('Mohon isi kuesioner berikut: ' . $survey_url) ?>" target="_blank" class="btn btn-success mr-2">
                <i class="fa fa-whatsapp"></i> WhatsApp
            </a>
            <a href="mailto:?subject=<?= urlencode($survey->title) ?>&body=<?= urlencode('Mohon isi kuesioner berikut: ' . $survey_url) ?>" class="btn btn-info mr-2">
                <i class="fa fa-envelope"></i> Email
            </a>
            <a href="https://t.me/share/url?url=<?= urlencode($survey_url) ?>&text=<?= urlencode('Mohon isi kuesioner berikut: ') ?>" target="_blank" class="btn btn-primary">
                <i class="fa fa-telegram"></i> Telegram
            </a>
        </div>