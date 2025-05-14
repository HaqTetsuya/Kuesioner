<!-- Views/dashboard/statistik.php (BONUS: Adding a statistics page) -->
<div class="container py-5">
    <div class="paper-card p-4 p-md-5">
        <div class="mb-4 pb-3 border-bottom">
            <h2 class="fw-bold mb-0">Statistik Kuesioner</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title h5 fw-bold mb-3">Rata-rata Jawaban Per Pertanyaan</h3>
                        <canvas id="avgChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title h5 fw-bold mb-3">Distribusi Jawaban</h3>
                        <canvas id="distributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
		

        <div class="mt-4">
            <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary cute-btn">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>