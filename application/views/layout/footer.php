<footer class="footer-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <h5>Aplikasi Buku</h5>
                        <p class="mb-0">Kelola koleksi bukumu dengan mudah dan menyenangkan.</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Tautan Cepat</h5>
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url('about'); ?>" class="text-decoration-none">Tentang Kami</a></li>
                            <li><a href="<?= base_url('privacy'); ?>" class="text-decoration-none">Kebijakan Privasi</a></li>
                            <li><a href="<?= base_url('terms'); ?>" class="text-decoration-none">Ketentuan Layanan</a></li>
                            <li><a href="<?= base_url('contact'); ?>" class="text-decoration-none">Hubungi Kami</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Tetap Terhubung</h5>
                        <div class="d-flex gap-3 mb-3">
                            <a href="#" class="text-decoration-none"><i class="bi bi-facebook fs-5"></i></a>
                            <a href="#" class="text-decoration-none"><i class="bi bi-twitter fs-5"></i></a>
                            <a href="#" class="text-decoration-none"><i class="bi bi-instagram fs-5"></i></a>
                            <a href="#" class="text-decoration-none"><i class="bi bi-pinterest fs-5"></i></a>
                        </div>
                        <p class="mb-0">Berlangganan newsletter:</p>
                        <div class="input-group mt-2">
                            <input type="email" class="form-control" placeholder="Email kamu">
                            <button class="btn btn-outline-secondary" type="button">Langganan</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">&copy; <?= date('Y'); ?> Aplikasi Buku. Hak cipta dilindungi.</p>
                    <p class="mb-0">Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> oleh Pengembang</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/main.js'); ?>"></script>	
    <script>
        // Contoh JavaScript sederhana
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar pada tampilan mobile
            const toggleSidebarBtn = document.getElementById('toggleSidebar');
            const sidebar = document.querySelector('.sidebar-container');
            
            if (toggleSidebarBtn) {
                toggleSidebarBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Tooltip initialization
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });				
    </script>
</body>
</html>
</html>