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

            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title h5 fw-bold mb-3">Jumlah Responden per Waktu</h3>
                        <canvas id="timelineChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title h5 fw-bold mb-3">Perbandingan Nilai</h3>
                        <canvas id="radarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h3 class="fw-bold fs-4 mb-3">Detail Statistik</h3>

            <?php if (!empty($statistik)): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-cute">
                        <thead>
                            <tr>
                                <th>Pertanyaan</th>
                                <th class="text-center">Min</th>
                                <th class="text-center">Max</th>
                                <th class="text-center">Rata-rata</th>
                                <th class="text-center">Nilai 1</th>
                                <th class="text-center">Nilai 2</th>
                                <th class="text-center">Nilai 3</th>
                                <th class="text-center">Nilai 4</th>
                                <th class="text-center">Nilai 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($statistik as $s): ?>
                                <tr>
                                    <td><?php echo $s->pertanyaan; ?></td>
                                    <td class="text-center"><?php echo $s->min_nilai; ?></td>
                                    <td class="text-center"><?php echo $s->max_nilai; ?></td>
                                    <td class="text-center">
                                        <?php
                                        $nilai = number_format($s->rata_rata, 2);
                                        $class = '';
                                        if ($nilai < 2) $class = 'text-danger';
                                        elseif ($nilai < 3) $class = 'text-warning';
                                        elseif ($nilai < 4) $class = 'text-info';
                                        else $class = 'text-success';
                                        ?>
                                        <span class="<?php echo $class; ?> fw-bold"><?php echo $nilai; ?></span>
                                    </td>
                                    <td class="text-center"><?php echo isset($s->nilai_1) ? $s->nilai_1 : 0; ?></td>
                                    <td class="text-center"><?php echo isset($s->nilai_2) ? $s->nilai_2 : 0; ?></td>
                                    <td class="text-center"><?php echo isset($s->nilai_3) ? $s->nilai_3 : 0; ?></td>
                                    <td class="text-center"><?php echo isset($s->nilai_4) ? $s->nilai_4 : 0; ?></td>
                                    <td class="text-center"><?php echo isset($s->nilai_5) ? $s->nilai_5 : 0; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <button class="btn btn-success cute-btn" id="exportExcelBtn">
                        <i class="bi bi-file-excel me-1"></i> Export ke Excel
                    </button>
                    <button class="btn btn-danger cute-btn" id="exportPdfBtn">
                        <i class="bi bi-file-pdf me-1"></i> Export ke PDF
                    </button>
                </div>
            <?php else: ?>
                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle me-2"></i> Belum ada data statistik.
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-4">
            <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary cute-btn">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>