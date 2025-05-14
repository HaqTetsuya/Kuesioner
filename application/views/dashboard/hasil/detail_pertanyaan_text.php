
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Detail Pertanyaan Text</h1>
    
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

    <!-- Statistik Ringkasan -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Statistik Jawaban</h5>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="card border-left-primary shadow-sm h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Responden</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_jawaban ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="card border-left-success shadow-sm h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Rata-Rata Panjang Jawaban</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $total_length = 0;
                                                foreach($jawaban_text as $j) {
                                                    $total_length += strlen($j->jawaban);
                                                }
                                                echo $total_jawaban > 0 ? round($total_length / $total_jawaban) . " karakter" : "0 karakter";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-textarea-t fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="card border-left-info shadow-sm h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Jawaban Terbaru</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                if(!empty($jawaban_text)) {
                                                    usort($jawaban_text, function($a, $b) {
                                                        return strtotime($b->created_at) - strtotime($a->created_at);
                                                    });
                                                    echo date('d M Y', strtotime($jawaban_text[0]->created_at));
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-calendar-check fa-2x text-gray-300"></i>
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
    
    <!-- Analisis Kata Kunci dan Visualisasi -->
    <div class="row mb-4">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Kata Kunci Populer</h5>
                    <div id="wordCloudContainer">
                        <?php if(!empty($kata_kunci)): ?>
                            <div id="wordCloud" style="width: 100%; height: 300px;"></div>
                        <?php else: ?>
                            <div class="alert alert-info">Belum ada data kata kunci yang cukup untuk dianalisis.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Daftar Kata Kunci Populer</h5>
                    <?php if(!empty($kata_kunci)): ?>
                        <div class="row">
                            <?php foreach($kata_kunci as $word => $count): ?>
                                <div class="col-md-4 mb-2">
                                    <div class="d-flex justify-content-between">
                                        <span><?= $word ?></span>
                                        <span class="badge bg-primary rounded-pill"><?= $count ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">Belum ada data kata kunci yang cukup untuk dianalisis.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Tips Analisis Jawaban Text</h5>
                    <div class="alert alert-light border">
                        <h6 class="alert-heading"><i class="bi bi-lightbulb"></i> Analisis Kualitatif</h6>
                        <p class="small mb-0">Jawaban tekstual perlu dianalisis secara kualitatif untuk mendapatkan wawasan mendalam. Beberapa metode yang dapat digunakan:</p>
                        <ul class="small mt-2">
                            <li>Identifikasi tema yang sering muncul</li>
                            <li>Cari pola dalam komentar positif/negatif</li> 
                            <li>Perhatikan saran atau masukan spesifik</li>
                            <li>Kaitkan dengan data kuantitatif (jika ada)</li>
                            <li>Prioritaskan berdasarkan frekuensi kemunculan</li>
                        </ul>
                    </div>
                    
                    <div class="alert alert-light border mt-3">
                        <h6 class="alert-heading"><i class="bi bi-tags"></i> Kategorisasi</h6>
                        <p class="small mb-0">Kategorisasi jawaban dapat membantu mengorganisir data:</p>
                        <div class="row mt-2 small">
                            <div class="col-6">
                                <span class="badge bg-success">Kelebihan</span>
                                <ul class="mt-1">
                                    <li>Fitur yang disukai</li>
                                    <li>Pengalaman positif</li>
                                    <li>Manfaat yang dirasakan</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <span class="badge bg-danger">Kekurangan</span>
                                <ul class="mt-1">
                                    <li>Masalah teknis</li>
                                    <li>Fitur yang kurang</li>
                                    <li>Pengalaman negatif</li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-2 small">
                            <span class="badge bg-info">Saran</span>
                            <ul class="mt-1">
                                <li>Perbaikan yang diusulkan</li>
                                <li>Fitur yang diharapkan</li>
                                <li>Ide pengembangan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabel Jawaban Text -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Daftar Jawaban</h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="btnExportCSV">
                                <i class="bi bi-file-earmark-excel"></i> Export CSV
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="btnPrint">
                                <i class="bi bi-printer"></i> Print
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover" id="tabelJawabanText">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Responden</th>
                                    <th>Jawaban</th>
                                    <th>Tanggal</th>
                                    <th width="120">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($jawaban_text)): ?>
                                    <?php $no = 1; foreach($jawaban_text as $j): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $j->responden_nama ?? 'Unknown' ?></td>
                                            <td>
                                                <?php if(strlen($j->jawaban) > 100): ?>
                                                    <div class="jawaban-collapse">
                                                        <p class="mb-1"><?= substr($j->jawaban, 0, 100) ?>... 
                                                            <a href="#" class="text-primary jawaban-toggle" data-bs-toggle="collapse" data-bs-target="#jawaban<?= $j->id ?>">Selengkapnya</a>
                                                        </p>
                                                        <div class="collapse" id="jawaban<?= $j->id ?>">
                                                            <?= nl2br($j->jawaban) ?>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <?= nl2br($j->jawaban) ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= date('d M Y', strtotime($j->created_at)) ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-success btn-tag" data-tag="kelebihan" data-id="<?= $j->id ?>">
                                                        <i class="bi bi-plus-circle"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-tag" data-tag="kekurangan" data-id="<?= $j->id ?>">
                                                        <i class="bi bi-dash-circle"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-info btn-tag" data-tag="saran" data-id="<?= $j->id ?>">
                                                        <i class="bi bi-lightbulb"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data jawaban</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk analisis text -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // DataTable initialization
    if (document.getElementById('tabelJawabanText')) {
        var table = $('#tabelJawabanText').DataTable({
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
        
        // Export to CSV
        $('#btnExportCSV').on('click', function() {
            var csvContent = "data:text/csv;charset=utf-8,";
            
            // Header
            csvContent += "No,Responden,Jawaban,Tanggal\n";
            
            // Data
            <?php if(!empty($jawaban_text)): ?>
                <?php $no = 1; foreach($jawaban_text as $j): ?>
                    csvContent += '<?= $no++ ?>,';
                    csvContent += '"<?= addslashes($j->responden_nama ?? 'Unknown') ?>",';
                    csvContent += '"<?= addslashes(str_replace(array("\r", "\n"), " ", $j->jawaban)) ?>",';
                    csvContent += '"<?= date('d M Y', strtotime($j->created_at)) ?>"\n';
                <?php endforeach; ?>
            <?php endif; ?>
            
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "jawaban_text_<?= $pertanyaan->id ?>.csv");
            document.body.appendChild(link);
            link.click();
        });
        
        // Print functionality
        $('#btnPrint').on('click', function() {
            window.print();
        });
    }
    
    // Word Cloud
    <?php if(!empty($kata_kunci)): ?>
        var wordCloudData = [
            <?php foreach($kata_kunci as $word => $count): ?>
                { text: "<?= $word ?>", weight: <?= $count ?> },
            <?php endforeach; ?>
        ];
        
        if (typeof(anychart) !== 'undefined') {
            var chart = anychart.tagCloud(wordCloudData);
            chart.angles([0]);
            chart.colorRange(true);
            chart.colorRange().length('80%');
            chart.container("wordCloud");
            chart.draw();
        } else {
            document.getElementById('wordCloudContainer').innerHTML = '<div class="alert alert-warning">AnyChart library tidak tersedia. Silakan tambahkan library ini untuk menampilkan word cloud.</div>';
        }
    <?php endif; ?>
    
    // Tag buttons functionality (for categorizing text responses)
    $('.btn-tag').on('click', function() {
        var id = $(this).data('id');
        var tag = $(this).data('tag');
        
        // This would typically send an AJAX request to save the tag
        // For now, we'll just show a confirmation
        alert('Jawaban #' + id + ' telah ditandai sebagai "' + tag + '"');
        
        // Change button appearance to show it's been tagged
        $(this).removeClass('btn-outline-' + getTagClass(tag)).addClass('btn-' + getTagClass(tag));
    });
    
    function getTagClass(tag) {
        switch(tag) {
            case 'kelebihan': return 'success';
            case 'kekurangan': return 'danger';
            case 'saran': return 'info';
            default: return 'secondary';
        }
    }
});
</script>