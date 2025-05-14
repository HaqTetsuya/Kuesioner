<!-- Views/dashboard/index.php -->
<div class="container py-5 main-content">
  <div class="paper-card p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
      <h2 class="fw-bold mb-0">Dashboard Kuesioner</h2>
      <div class="d-flex">
        <button class="btn btn-outline-secondary cute-btn" data-bs-toggle="modal" data-bs-target="#helpModal">
          <i class="bi bi-question-circle"></i>
        </button>
      </div>
    </div>
    
    <div class="row g-3 mb-5">
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="display-6 text-primary mb-3">
              <i class="bi bi-question-circle"></i>
            </div>
            <h3 class="card-title h5">Kelola Pertanyaan</h3>
            <p class="card-text text-muted">Tambah, edit, atau hapus pertanyaan kuesioner</p>
            <a href="<?php echo base_url('dashboard/pertanyaan'); ?>" class="btn btn-primary cute-btn stretched-link">
              Kelola Pertanyaan
            </a>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="display-6 text-success mb-3">
              <i class="bi bi-clipboard-data"></i>
            </div>
            <h3 class="card-title h5">Lihat Hasil</h3>
            <p class="card-text text-muted">Lihat jawaban yang telah diberikan responden</p>
            <a href="<?php echo base_url('dashboard/hasil'); ?>" class="btn btn-success cute-btn stretched-link">
              Lihat Hasil
            </a>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="display-6 text-secondary mb-3">
              <i class="bi bi-bar-chart"></i>
            </div>
            <h3 class="card-title h5">Statistik</h3>
            <p class="card-text text-muted">Lihat analisis statistik dari hasil kuesioner</p>
            <a href="<?php echo base_url('dashboard/statistik'); ?>" class="btn btn-secondary cute-btn stretched-link">
              Statistik
            </a>
          </div>
        </div>
      </div>
    </div>
    
	<div class="mt-5">
      <h3 class="fw-bold fs-4 mb-3">Statistik Singkat</h3>
      
      <?php if(!empty($statistik)): ?>
        <div class="table-responsive">
          <table class="table table-hover table-cute">
            <thead>
              <tr>
                <th>Pertanyaan</th>
                <th class="text-center">Tipe</th>
                <th class="text-center">Rata-rata Nilai</th>
                <th class="text-center">Jumlah Responden</th>
                <th class="text-center">Visualisasi</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($statistik as $s): ?>
                <tr>
                  <td><?php echo $s->pertanyaan; ?></td>
                  <td class="text-center">
                    <?php echo ($s->type == 'likert') ? 'Likert' : 'Tekstual'; ?>
                  </td>
                  <td class="text-center fw-bold">
                    <?php if($s->type == 'likert'): ?>
                      <?php 
                      $nilai = number_format($s->rata_rata, 2);
                      $class = '';
                      if($nilai < 2) $class = 'text-danger';
                      elseif($nilai < 3) $class = 'text-warning';
                      elseif($nilai < 4) $class = 'text-info';
                      else $class = 'text-success';
                      ?>
                      <span class="<?php echo $class; ?>"><?php echo $nilai; ?></span>
                    <?php else: ?>
                      <span class="text-muted">-</span>
                    <?php endif; ?>
                  </td>
                  <td class="text-center"><?php echo $s->jumlah_jawaban; ?></td>
                  <td>
                    <?php if($s->type == 'likert'): ?>
                      <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-info" role="progressbar" 
                             style="width: <?php echo ($s->rata_rata / 5) * 100; ?>%" 
                             aria-valuenow="<?php echo $s->rata_rata; ?>" aria-valuemin="0" aria-valuemax="5"></div>
                      </div>
                    <?php else: ?>
                      <span class="text-muted">-</span>
                    <?php endif; ?>
                  </td>
                  <td class="text-center">
				  <?php if($s->type == 'likert'): ?>
                    <a href="<?= base_url('dashboard/detail_pertanyaan/' . $s->id); ?>" class="btn btn-sm btn-info cute-btn text-white">
                      <i class="bi bi-eye"></i>
                    </a>
					<?php elseif($s->type == 'text'): ?>
					<a href="<?= base_url('dashboard/detail_pertanyaan_text/' . $s->id); ?>" class="btn btn-sm btn-info cute-btn text-white">
                      <i class="bi bi-eye"></i>
                    </a>
					<?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="alert alert-info" role="alert">
          <i class="bi bi-info-circle me-2"></i> Belum ada data kuesioner.
        </div>
      <?php endif; ?>
    </div>	
    
  </div>
</div>