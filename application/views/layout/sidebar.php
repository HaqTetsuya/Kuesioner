<div class="row g-0">
            <div class="col-md-3 col-lg-2">
                <div class="sidebar-container p-3">
                    <div class="book-edge left"></div>
                    <div class="text-center mb-4">
                        <img src="/api/placeholder/80/80" alt="Avatar" class="rounded-circle mb-2">
                        <h5 class="mb-0">Nama Pengguna</h5>
                        <p class="text-muted small">@username</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="mb-3">Menu Utama</h6>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <a href="<?= base_url('dashboard'); ?>" class="nav-link d-flex align-items-center">
                                    <i class="bi bi-house-door me-2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="<?= base_url('books/list'); ?>" class="nav-link d-flex align-items-center">
                                    <i class="bi bi-book me-2"></i> Daftar Buku
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="<?= base_url('authors/list'); ?>" class="nav-link d-flex align-items-center">
                                    <i class="bi bi-person me-2"></i> Daftar Penulis
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="<?= base_url('borrowing'); ?>" class="nav-link d-flex align-items-center">
                                    <i class="bi bi-arrow-left-right me-2"></i> Peminjaman
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="mb-3">Kategori Populer</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="badge bg-light text-dark text-decoration-none p-2">Novel</a>
                            <a href="#" class="badge bg-light text-dark text-decoration-none p-2">Fiksi</a>
                            <a href="#" class="badge bg-light text-dark text-decoration-none p-2">Sejarah</a>
                            <a href="#" class="badge bg-light text-dark text-decoration-none p-2">Pendidikan</a>
                            <a href="#" class="badge bg-light text-dark text-decoration-none p-2">Teknologi</a>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="mb-3">Statistik</h6>
                        <div class="card mb-2">
                            <div class="card-body py-2 px-3">
                                <div class="d-flex justify-content-between">
                                    <span>Total Buku</span>
                                    <span>123</span>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-body py-2 px-3">
                                <div class="d-flex justify-content-between">
                                    <span>Sedang Dipinjam</span>
                                    <span>14</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-5">
                        <a href="<?= base_url('help'); ?>" class="btn btn-sm btn-outline-secondary rounded-pill">
                            <i class="bi bi-question-circle"></i> Butuh Bantuan?
                        </a>
                    </div>
                </div>
            </div>