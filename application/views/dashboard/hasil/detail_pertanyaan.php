

<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Detail Pertanyaan</h1>
    
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-3">Informasi Pertanyaan</h5>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">ID</th>
                                <td>: <?= $pertanyaan->id ?></td>
                            </tr>
                            <tr>
                                <th>Tipe</th>
                                <td>: <?= ucfirst($pertanyaan->type) ?></td>
                            </tr>
                            <tr>
                                <th>Pertanyaan</th>
                                <td>: <?= $pertanyaan->pertanyaan ?></td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>: <?= date('d M Y H:i', strtotime($pertanyaan->created_at)) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($pertanyaan->type == 'likert'): ?>
        <!-- Statistik Ringkasan -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Statistik Jawaban</h5>
                        <div class="row">
                            <?php 
                            $total_responden = count($jawaban_likert);
                            $total_nilai = 0;
                            $nilai_terendah = $total_responden > 0 ? 5 : 0;
                            $nilai_tertinggi = $total_responden > 0 ? 1 : 0;
                            
                            foreach ($jawaban_likert as $j) {
                                $total_nilai += $j->nilai;
                                if ($j->nilai < $nilai_terendah) $nilai_terendah = $j->nilai;
                                if ($j->nilai > $nilai_tertinggi) $nilai_tertinggi = $j->nilai;
                            }
                            
                            $rata_rata = $total_responden > 0 ? $total_nilai / $total_responden : 0;
                            ?>
                            
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card border-left-primary shadow-sm h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Total Responden</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_responden ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card border-left-success shadow-sm h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Rata-Rata Nilai</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($rata_rata, 2) ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-bar-chart-fill fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card border-left-info shadow-sm h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Nilai Tertinggi</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $nilai_tertinggi ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-arrow-up-circle-fill fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card border-left-warning shadow-sm h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Nilai Terendah</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $nilai_terendah ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-arrow-down-circle-fill fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel dan Visualisasi -->
        <div class="row mb-5">
            <div class="col-md-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Daftar Jawaban</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-cute" id="tabelJawaban">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Responden</th>
                                        <th class="text-center" width="100">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($jawaban_likert)): ?>
                                        <?php $no = 1; foreach($jawaban_likert as $j): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $j->responden_nama ?? 'Unknown' ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    $bgColor = '';
                                                    $textColor = 'text-white';
                                                    if ($j->nilai == 1) $bgColor = 'bg-danger';
                                                    elseif ($j->nilai == 2) $bgColor = 'bg-warning';
                                                    elseif ($j->nilai == 3) $bgColor = 'bg-info';
                                                    elseif ($j->nilai == 4) $bgColor = 'bg-primary';
                                                    elseif ($j->nilai == 5) $bgColor = 'bg-success';
                                                    ?>
                                                    <span class="badge rounded-pill <?= $bgColor ?> <?= $textColor ?> px-3 py-2"><?= $j->nilai ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Belum ada data jawaban</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Rata-rata</th>
                                        <th class="text-center">
                                            <?php if(!empty($jawaban_likert)): ?>
                                                <span class="badge rounded-pill bg-dark px-3 py-2">
                                                    <?= number_format($rata_rata, 2) ?>
                                                </span>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Distribusi Jawaban</h5>
                        <canvas id="jawabanChart"></canvas>
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Interpretasi Nilai</h5>
                        <table class="table">
                            <tr>
                                <td width="60"><span class="badge bg-danger text-white px-3 py-2">1</span></td>
                                <td>Sangat Tidak Setuju</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-warning text-white px-3 py-2">2</span></td>
                                <td>Tidak Setuju</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-info text-white px-3 py-2">3</span></td>
                                <td>Netral</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-primary text-white px-3 py-2">4</span></td>
                                <td>Setuju</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-success text-white px-3 py-2">5</span></td>
                                <td>Sangat Setuju</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script untuk chart -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data untuk chart dari PHP
            var distribusiData = <?= json_encode($distribusi) ?>;
            
            // Persiapkan data untuk Chart.js
            var labels = ['Sangat Tidak Setuju (1)', 'Tidak Setuju (2)', 'Netral (3)', 'Setuju (4)', 'Sangat Setuju (5)'];
            var data = [
                distribusiData[1], 
                distribusiData[2], 
                distribusiData[3], 
                distribusiData[4], 
                distribusiData[5]
            ];
            var backgroundColors = [
                '#dc3545', // danger
                '#ffc107', // warning
                '#17a2b8', // info
                '#007bff', // primary
                '#28a745'  // success
            ];
            
            // Buat chart
            var ctx = document.getElementById('jawabanChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Jawaban',
                        data: data,
                        backgroundColor: backgroundColors,
                        borderColor: backgroundColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.raw + ' responden';
                                }
                            }
                        }
                    }
                }
            });
        });
        </script>
    <?php elseif ($pertanyaan->type == 'text'): ?>
        <!-- Logic untuk menampilkan jawaban text -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Jawaban Text</h5>
                        <p class="card-text">Tipe pertanyaan text belum diimplementasikan pada halaman ini.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- DataTables -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('tabelJawaban')) {
        $('#tabelJawaban').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    }
});
</script>