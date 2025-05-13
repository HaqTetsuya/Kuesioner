<div class="col-md-9 col-lg-10">
                <div class="content-container p-4">
                    <div class="book-container p-4">
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Halaman Utama</li>
                            </ol>
                        </nav>
                        
                        <!-- Page Title -->
                        <div class="mb-4">
                            <h2 class="mb-1">Selamat Datang di Aplikasi Buku</h2>
                            <p class="text-muted">Temukan, catat, dan kelola koleksi bukumu di sini</p>
                        </div>
                        
                        <!-- Alert Message -->
                        <div class="alert alert-success mb-4" role="alert">
                            <i class="bi bi-info-circle me-2"></i> Kamu memiliki 3 buku yang harus segera dikembalikan!
                        </div>
                        
                        <!-- Search Bar -->
                        <div class="mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?= base_url('search'); ?>" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari buku, penulis, atau kategori...">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-book fs-1 mb-2"></i>
                                        <h5>352</h5>
                                        <p class="text-muted">Total Koleksi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-bookmark-check fs-1 mb-2"></i>
                                        <h5>42</h5>
                                        <p class="text-muted">Sudah Dibaca</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-star fs-1 mb-2"></i>
                                        <h5>18</h5>
                                        <p class="text-muted">Favorit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Featured Books -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>Buku Terbaru</h4>
                                <a href="<?= base_url('books/list'); ?>" class="text-decoration-none">Lihat Semua</a>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <img src="/api/placeholder/300/200" class="card-img-top" alt="Book Cover">
                                        <div class="card-body">
                                            <h5 class="card-title">Judul Buku</h5>
                                            <p class="card-text">Penulis: Nama Penulis</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-light text-dark">Fiksi</span>
                                                <small class="text-muted">2023</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <img src="/api/placeholder/300/200" class="card-img-top" alt="Book Cover">
                                        <div class="card-body">
                                            <h5 class="card-title">Judul Buku</h5>
                                            <p class="card-text">Penulis: Nama Penulis</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-light text-dark">Novel</span>
                                                <small class="text-muted">2023</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <img src="/api/placeholder/300/200" class="card-img-top" alt="Book Cover">
                                        <div class="card-body">
                                            <h5 class="card-title">Judul Buku</h5>
                                            <p class="card-text">Penulis: Nama Penulis</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-light text-dark">Sejarah</span>
                                                <small class="text-muted">2023</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Reading Progress -->
                        <div class="mb-4">
                            <h4 class="mb-3">Sedang Dibaca</h4>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="/api/placeholder/60/90" alt="Book Cover" class="me-3">
                                        <div>
                                            <h5 class="mb-0">Judul Buku Sedang Dibaca</h5>
                                            <p class="text-muted mb-0">Penulis: Nama Penulis</p>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Progress</span>
                                            <span>65%</span>
                                        </div>
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar bg-dark" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-end mt-3">
                                        <a href="#" class="btn btn-sm btn-outline-dark">Lanjutkan Membaca</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pagination Example -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Selanjutnya</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>