<!-- Resources - Add these links to your header -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js"></script>

<!-- Custom CSS -->
<style>
  .paper-card {
    background-color: white;
    border: 2px solid #333;
    border-radius: 10px;
    box-shadow: 3px 3px 0 rgba(0,0,0,0.1);
    position: relative;
  }
  
  .paper-card::before {
    content: '';
    position: absolute;
    bottom: -10px;
    right: -10px;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.03);
    border: 2px solid #333;
    border-radius: 10px;
    z-index: -1;
  }
  
  .cute-btn {
    border-radius: 50px;
    box-shadow: 2px 2px 0 rgba(0,0,0,0.2);
    transition: all 0.2s;
    font-weight: 600;
  }
  
  .cute-btn:hover {
    transform: translateY(-2px);
    box-shadow: 3px 3px 0 rgba(0,0,0,0.3);
  }
  
  .cute-btn:active {
    transform: translateY(0);
    box-shadow: 1px 1px 0 rgba(0,0,0,0.2);
  }
  
  .radio-likert {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .radio-likert input {
    margin: 0 auto;
  }
  
  .table-cute th {
    background-color: rgba(0,0,0,0.05);
  }
  
  .likert-scale-item {
    border-left: 4px solid transparent;
    transition: all 0.2s;
  }
  
  .likert-scale-item:hover {
    border-left-color: #007bff;
    background-color: rgba(0,0,0,0.02);
  }
  
  .status-badge {
    width: 10px;
    height: 10px;
    display: inline-block;
    border-radius: 50%;
    margin-right: 5px;
  }
  
  .validation-error {
    border-left: 4px solid #dc3545;
  }
</style>

<!-- Views/public/kuesioner_form.php -->
<div class="container py-5">
  <div class="paper-card p-4 p-md-5">
    <div class="mb-4 border-bottom pb-3">
      <h2 class="fw-bold text-center">Kuesioner Likert</h2>
    </div>
    
    <?php if(validation_errors()): ?>
      <div class="alert alert-danger validation-error mb-4" role="alert">
        <?php echo validation_errors(); ?>
      </div>
    <?php endif; ?>
    
    <?php echo form_open('submit'); ?>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label for="nama" class="form-label fw-medium">Nama:</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama'); ?>">
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label fw-medium">Email:</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
        </div>
      </div>
      
      <div class="mb-4 mt-5">
        <h3 class="fs-4 fw-bold mb-3">Pertanyaan</h3>
        <div class="bg-light p-3 rounded-3 mb-4">
          <p class="mb-0"><strong>Skala:</strong> 1 = Sangat Tidak Setuju, 2 = Tidak Setuju, 3 = Netral, 4 = Setuju, 5 = Sangat Setuju</p>
        </div>
      </div>
      
      <div x-data="{ 
        currentQuestion: 0,
        totalQuestions: <?php echo count($pertanyaan); ?>,
        questions: [
          <?php foreach($pertanyaan as $index => $p): ?>
            { id: <?php echo $p->id; ?>, text: '<?php echo $p->pertanyaan; ?>', answer: null }<?php echo ($index < count($pertanyaan) - 1) ? ',' : ''; ?>
          <?php endforeach; ?>
        ],
        updateAnswer(id, value) {
          this.questions.find(q => q.id === id).answer = value;
        },
        nextQuestion() {
          if (this.currentQuestion < this.totalQuestions - 1) {
            this.currentQuestion++;
          }
        },
        prevQuestion() {
          if (this.currentQuestion > 0) {
            this.currentQuestion--;
          }
        },
        isLastQuestion() {
          return this.currentQuestion === this.totalQuestions - 1;
        },
        isFirstQuestion() {
          return this.currentQuestion === 0;
        }
      }">
        <div class="progress mb-4" style="height: 10px;">
          <div class="progress-bar" role="progressbar" x-bind:style="'width: ' + ((currentQuestion + 1) / totalQuestions * 100) + '%'" 
               x-bind:aria-valuenow="currentQuestion + 1" aria-valuemin="0" x-bind:aria-valuemax="totalQuestions"></div>
        </div>
        
        <template x-for="(question, index) in questions" :key="question.id">
          <div class="likert-scale-item mb-3 p-3 rounded shadow-sm" x-show="currentQuestion === index">
            <p class="fs-5 mb-3" x-text="question.text"></p>
            <div class="d-flex justify-content-between">
              <?php for($i = 1; $i <= 5; $i++): ?>
                <div class="text-center radio-likert">
                  <label class="d-flex flex-column align-items-center">
                    <input type="radio" name="jawaban[${question.id}]" value="<?php echo $i; ?>" 
                           @click="updateAnswer(question.id, <?php echo $i; ?>)">
                    <div class="mt-2 fw-medium"><?php echo $i; ?></div>
                    <div class="small text-muted">
                      <?php 
                      if($i == 1) echo 'Sangat Tidak Setuju';
                      elseif($i == 2) echo 'Tidak Setuju';
                      elseif($i == 3) echo 'Netral';
                      elseif($i == 4) echo 'Setuju';
                      elseif($i == 5) echo 'Sangat Setuju';
                      ?>
                    </div>
                  </label>
                </div>
              <?php endfor; ?>
            </div>
          </div>
        </template>
        
        <div class="d-flex justify-content-between mt-4">
          <button type="button" class="btn btn-outline-secondary cute-btn" @click="prevQuestion()" x-bind:disabled="isFirstQuestion()">
            <i class="bi bi-chevron-left"></i> Sebelumnya
          </button>
          
          <template x-if="!isLastQuestion()">
            <button type="button" class="btn btn-primary cute-btn" @click="nextQuestion()">
              Selanjutnya <i class="bi bi-chevron-right"></i>
            </button>
          </template>
          
          <template x-if="isLastQuestion()">
            <button type="submit" class="btn btn-success cute-btn">
              Kirim Jawaban <i class="bi bi-send"></i>
            </button>
          </template>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
</div>

<!-- Views/public/thank_you.php -->
<div class="container py-5">
  <div class="paper-card p-4 p-md-5 text-center">
    <div class="mb-4">
      <div class="display-1 text-success mb-3">
        <i class="bi bi-check-circle"></i>
      </div>
      <h2 class="fw-bold mb-3">Terima Kasih!</h2>
    </div>
    
    <div class="alert alert-success mb-4" role="alert">
      <p><?php echo $message; ?></p>
      <p class="mb-0">Jawaban Anda telah disimpan.</p>
    </div>
    
    <div class="mt-4">
      <a href="<?php echo base_url(); ?>" class="btn btn-primary cute-btn px-4 py-2">
        <i class="bi bi-house"></i> Kembali ke Beranda
      </a>
    </div>
  </div>
</div>

<!-- Views/dashboard/index.php -->
<div class="container py-5">
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
                <th class="text-center">Rata-rata Nilai</th>
                <th class="text-center">Jumlah Responden</th>
                <th class="text-center">Visualisasi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($statistik as $s): ?>
                <tr>
                  <td><?php echo $s->pertanyaan; ?></td>
                  <td class="text-center fw-bold">
                    <?php 
                    $nilai = number_format($s->rata_rata, 2);
                    $class = '';
                    if($nilai < 2) $class = 'text-danger';
                    elseif($nilai < 3) $class = 'text-warning';
                    elseif($nilai < 4) $class = 'text-info';
                    else $class = 'text-success';
                    ?>
                    <span class="<?php echo $class; ?>"><?php echo $nilai; ?></span>
                  </td>
                  <td class="text-center"><?php echo $s->jumlah_jawaban; ?></td>
                  <td>
                    <div class="progress" style="height: 10px;">
                      <div class="progress-bar bg-info" role="progressbar" 
                           style="width: <?php echo ($s->rata_rata / 5) * 100; ?>%" 
                           aria-valuenow="<?php echo $s->rata_rata; ?>" aria-valuemin="0" aria-valuemax="5"></div>
                    </div>
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

<!-- Help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content paper-card border-0">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold" id="helpModalLabel">Bantuan Dashboard</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Kelola Pertanyaan:</strong> Tambah, edit, atau hapus pertanyaan kuesioner.</p>
        <p><strong>Lihat Hasil:</strong> Lihat jawaban yang telah diberikan responden.</p>
        <p><strong>Statistik:</strong> Lihat analisis statistik dari hasil kuesioner.</p>
      </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-secondary cute-btn" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Views/dashboard/pertanyaan/index.php -->
<div class="container py-5">
  <div class="paper-card p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
      <h2 class="fw-bold mb-0">Daftar Pertanyaan Kuesioner</h2>
      <a href="<?php echo base_url('dashboard/pertanyaan/tambah'); ?>" class="btn btn-success cute-btn">
        <i class="bi bi-plus-circle me-1"></i> Tambah Pertanyaan
      </a>
    </div>
    
    <?php if($this->session->flashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i> <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    
    <?php if(!empty($pertanyaan)): ?>
      <div class="table-responsive">
        <table class="table table-hover table-cute">
          <thead>
            <tr>
              <th width="60">ID</th>
              <th>Pertanyaan</th>
              <th class="text-center" width="200">Tanggal Dibuat</th>
              <th class="text-center" width="150">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($pertanyaan as $p): ?>
              <tr>
                <td><?php echo $p->id; ?></td>
                <td><?php echo $p->pertanyaan; ?></td>
                <td class="text-center"><?php echo date('d-m-Y', strtotime($p->created_at)); ?></td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    <a href="<?php echo base_url('dashboard/pertanyaan/edit/'.$p->id); ?>" class="btn btn-sm btn-warning cute-btn">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-danger cute-btn" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $p->id; ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                  
                  <!-- Delete Confirmation Modal -->
                  <div class="modal fade" id="deleteModal<?php echo $p->id; ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content paper-card border-0">
                        <div class="modal-header border-bottom-0">
                          <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Yakin ingin menghapus pertanyaan ini?</p>
                          <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i> Data yang sudah dihapus tidak dapat dikembalikan.
                          </div>
                        </div>
                        <div class="modal-footer border-top-0">
                          <button type="button" class="btn btn-outline-secondary cute-btn" data-bs-dismiss="modal">Batal</button>
                          <a href="<?php echo base_url('dashboard/pertanyaan/hapus/'.$p->id); ?>" class="btn btn-danger cute-btn">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="text-center py-5">
        <div class="display-3 text-muted mb-3">
          <i class="bi bi-question-circle"></i>
        </div>
        <p class="fs-5">Belum ada pertanyaan. Silakan tambahkan pertanyaan baru.</p>
        <a href="<?php echo base_url('dashboard/pertanyaan/tambah'); ?>" class="btn btn-primary cute-btn mt-3">
          <i class="bi bi-plus-circle me-1"></i> Tambah Pertanyaan Sekarang
        </a>
      </div>
    <?php endif; ?>
    
    <div class="mt-4">
      <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary cute-btn">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
      </a>
    </div>
  </div>
</div>

<!-- Views/dashboard/pertanyaan/tambah.php -->
<div class="container py-5">
  <div class="paper-card p-4 p-md-5">
    <div class="mb-4 pb-3 border-bottom">
      <h2 class="fw-bold mb-0">Tambah Pertanyaan Baru</h2>
    </div>
    
    <?php if(validation_errors()): ?>
      <div class="alert alert-danger validation-error" role="alert">
        <?php echo validation_errors(); ?>
      </div>
    <?php endif; ?>
    
    <?php echo form_open('dashboard/pertanyaan/simpan'); ?>
      <div class="mb-4">
        <label for="pertanyaan" class="form-label fw-medium">Pertanyaan:</label>
        <textarea name="pertanyaan" id="pertanyaan" rows="4" class="form-control" placeholder="Masukkan pertanyaan untuk kuesioner skala Likert"><?php echo set_value('pertanyaan'); ?></textarea>
        <div class="form-text">Masukkan pertanyaan untuk kuesioner skala Likert.</div>
      </div>
      
      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-success cute-btn">
          <i class="bi bi-save me-1"></i> Simpan Pertanyaan
        </button>
        <a href="<?php echo base_url('dashboard/pertanyaan'); ?>" class="btn btn-outline-secondary cute-btn">
          <i class="bi bi-x-circle me-1"></i> Batal
        </a>
      </div>
    <?php echo form_close(); ?>
  </div>
</div>

<!-- Views/dashboard/hasil/index.php -->
<div class="container py-5">
  <div class="paper-card p-4 p-md-5">
    <div class="mb-4 pb-3 border-bottom">
      <h2 class="fw-bold mb-0">Hasil Kuesioner</h2>
    </div>
    
    <?php if(!empty($responden)): ?>
      <div class="mb-4">
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-search"></i>
          </span>
          <input type="text" id="searchResponden" class="form-control" placeholder="Cari berdasarkan nama atau email...">
        </div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-hover table-cute" id="respondenTable">
          <thead>
            <tr>
              <th width="60">ID</th>
              <th>Nama</th>
              <th>Email</th>
              <th class="text-center">Tanggal Pengisian</th>
              <th class="text-center" width="100">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($responden as $r): ?>
              <tr>
                <td><?php echo $r->id; ?></td>
                <td><?php echo $r->nama; ?></td>
                <td><?php echo $r->email; ?></td>
                <td class="text-center"><?php echo date('d-m-Y H:i', strtotime($r->tanggal)); ?></td>
                <td class="text-center">
                  <a href="<?php echo base_url('dashboard/hasil/detail/'.$r->id); ?>" class="btn btn-sm btn-info cute-btn text-white">
                    <i class="bi bi-eye"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="text-center py-5">
        <div class="display-3 text-muted mb-3">
          <i class="bi bi-emoji-dizzy"></i>
        </div>
        <p class="fs-5">Belum ada data responden.</p>
      </div>
    <?php endif; ?>
    
    <div class="mt-4">
      <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary cute-btn">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
      </a>
    </div>
  </div>
</div>

<!-- Table search JavaScript for responden table -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchResponden');
    if (searchInput) {
      searchInput.addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const table = document.getElementById('respondenTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
          const nama = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
          const email = rows[i].getElementsByTagName('td')[2].textContent.toLowerCase();
          
          if (nama.includes(searchValue) || email.includes(searchValue)) {
            rows[i].style.display = '';
          } else {
            rows[i].style.display = 'none';
          }
        }
      });
    }
  });
</script>

<!-- Views/dashboard/hasil/detail.php -->
<div class="container py-5">
  <div class="paper-card p-4 p-md-5">
    <div class="mb-4 pb-3 border-bottom">
      <h2 class="fw-bold mb-0">Detail Jawaban Responden</h2>
    </div>
    
    <div class="card bg-light border-0 mb-4">
      <div class="card-body">
        <h3 class="card-title h5 mb-3 fw-bold">Informasi Responden</h3>
        <div class="row">
          <div class="col-md-6">
            <table class="table table-borderless mb-0">
              <tr>
                <td style="width: 150px;"><strong>Nama</strong></td>
                <td>: <?php echo $responden->nama; ?></td>
              </tr>
              <tr>
                <td><strong>Email</strong></td>
                <td>: <?php echo $responden->email; ?></td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <table class="table table-borderless mb-0">
              <tr>
                <td style="width: 150px;"><strong>Tanggal Pengisian</strong></td>
                <td>: <?php echo date('d-m-Y H:i', strtotime($responden->tanggal)); ?></td>
              </tr>
              <tr>
                <td><strong>ID Responden</strong></td>
                <td>: <?php echo $responden->id; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    
    <h3 class="fw-bold fs-4 mb-3">Jawaban</h3>
    
    <?php if(!empty($jawaban)): ?>
      <div class="row">
        <div class="col-md-8">
          <div class="table-responsive">
            <table class="table table-hover table-cute">
              <thead>
                <tr>
                  <th>Pertanyaan</th>
                  <th class="text-center" width="100">Nilai</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $total = 0;
                foreach($jawaban as $j): 
                $total += $j->nilai;
                ?>
                  <tr>
                    <td><?php echo $j->pertanyaan; ?></td>
                    <td class="text-center">
                      <?php 
                        $bgColor = '';
                        $textColor = 'text-white';
                        if($j->nilai == 1) $bgColor = 'bg-danger';
                        elseif($j->nilai == 2) $bgColor = 'bg-warning';
                        elseif($j->nilai == 3) $bgColor = 'bg-info';
                        elseif($j->nilai == 4) $bgColor = 'bg-primary';
                        elseif($j->nilai == 5) $bgColor = 'bg-success';
                      ?>
                      <span class="badge rounded-pill <?php echo $bgColor; ?> <?php echo $textColor; ?> px-3 py-2"><?php echo $j->nilai; ?></span>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Rata-rata</th>
                  <th class="text-center">
                    <span class="badge rounded-pill bg-dark px-3 py-2">
                      <?php echo number_format($total / count($jawaban), 2); ?></span>
                    </th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="card border-0 shadow-sm">
              <div class="card-body">
                <h4 class="card-title h6 fw-bold mb-3">Visualisasi Jawaban</h4>
                <canvas id="jawabanChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="alert alert-info" role="alert">
          <i class="bi bi-info-circle me-2"></i> Tidak ada data jawaban.
        </div>
      <?php endif; ?>
      
      <div class="mt-4">
        <a href="<?php echo base_url('dashboard/hasil'); ?>" class="btn btn-secondary cute-btn">
          <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Hasil
        </a>
        
        <div class="float-end">
          <button class="btn btn-primary cute-btn" id="printResultBtn">
            <i class="bi bi-printer me-1"></i> Cetak
          </button>
        </div>
      </div>
    </div>
  </div>
  
<!-- Chart JS for visualizing responses -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    <?php if(!empty($jawaban)): ?>
      // Prepare data for chart
      const labels = [];
      const values = [];
      const backgroundColors = [
        'rgba(220, 53, 69, 0.7)',  // danger
        'rgba(253, 126, 20, 0.7)',  // warning
        'rgba(255, 193, 7, 0.7)',   // yellow
        'rgba(40, 167, 69, 0.7)',   // success
        'rgba(32, 201, 151, 0.7)'   // teal
      ];
      
      <?php foreach($jawaban as $j): ?>
        labels.push("Q<?php echo $j->id; ?>");
        values.push(<?php echo $j->nilai; ?>);
      <?php endforeach; ?>
      
      // Create chart
      const ctx = document.getElementById('jawabanChart').getContext('2d');
      const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Nilai Jawaban',
            data: values,
            backgroundColor: backgroundColors,
            borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              max: 5,
              ticks: {
                stepSize: 1
              }
            }
          }
        }
      });
      
      // Print functionality
      document.getElementById('printResultBtn').addEventListener('click', function() {
        window.print();
      });
    <?php endif; ?>
  });
</script>

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
      
      <?php if(!empty($statistik)): ?>
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
              <?php foreach($statistik as $s): ?>
                <tr>
                  <td><?php echo $s->pertanyaan; ?></td>
                  <td class="text-center"><?php echo $s->min_nilai; ?></td>
                  <td class="text-center"><?php echo $s->max_nilai; ?></td>
                  <td class="text-center">
                    <?php 
                    $nilai = number_format($s->rata_rata, 2);
                    $class = '';
                    if($nilai < 2) $class = 'text-danger';
                    elseif($nilai < 3) $class = 'text-warning';
                    elseif($nilai < 4) $class = 'text-info';
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

<!-- Chart JS for statistics page -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    <?php if(!empty($statistik)): ?>
      // Data preparation for average chart
      const pertanyaanLabels = [];
      const rataRataData = [];
      const jumlahData = [];
      
      <?php foreach($statistik as $s): ?>
        pertanyaanLabels.push("<?php echo substr($s->pertanyaan, 0, 30) . (strlen($s->pertanyaan) > 30 ? '...' : ''); ?>");
        rataRataData.push(<?php echo $s->rata_rata; ?>);
        jumlahData.push(<?php echo $s->jumlah_jawaban; ?>);
      <?php endforeach; ?>
      
      // Average chart
      const avgCtx = document.getElementById('avgChart').getContext('2d');
      const avgChart = new Chart(avgCtx, {
        type: 'bar',
        data: {
          labels: pertanyaanLabels,
          datasets: [{
            label: 'Rata-rata Nilai',
            data: rataRataData,
            backgroundColor: 'rgba(13, 110, 253, 0.7)',
            borderColor: 'rgba(13, 110, 253, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              max: 5,
              ticks: {
                stepSize: 1
              }
            }
          },
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Rata-rata Nilai Per Pertanyaan'
            }
          }
        }
      });
      
      // Distribution chart
      const distData = [0, 0, 0, 0, 0];
      <?php foreach($statistik as $s): ?>
        <?php for($i = 1; $i <= 5; $i++): ?>
          distData[<?php echo $i-1; ?>] += <?php echo isset($s->{'nilai_'.$i}) ? $s->{'nilai_'.$i} : 0; ?>;
        <?php endfor; ?>
      <?php endforeach; ?>
      
      const distCtx = document.getElementById('distributionChart').getContext('2d');
      const distChart = new Chart(distCtx, {
        type: 'pie',
        data: {
          labels: ['Sangat Tidak Setuju', 'Tidak Setuju', 'Netral', 'Setuju', 'Sangat Setuju'],
          datasets: [{
            data: distData,
            backgroundColor: [
              'rgba(220, 53, 69, 0.7)',
              'rgba(253, 126, 20, 0.7)',
              'rgba(255, 193, 7, 0.7)',
              'rgba(40, 167, 69, 0.7)',
              'rgba(32, 201, 151, 0.7)'
            ],
            borderColor: [
              'rgba(220, 53, 69, 1)',
              'rgba(253, 126, 20, 1)',
              'rgba(255, 193, 7, 1)',
              'rgba(40, 167, 69, 1)',
              'rgba(32, 201, 151, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'right',
            },
            title: {
              display: true,
              text: 'Distribusi Jawaban'
            }
          }
        }
      });
      
      // Timeline chart (mock data - replace with actual data in your implementation)
      const timelineCtx = document.getElementById('timelineChart').getContext('2d');
      const timelineChart = new Chart(timelineCtx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
          datasets: [{
            label: 'Jumlah Responden',
            data: [12, 19, 3, 5, 2, 3],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Responden Per Bulan'
            }
          }
        }
      });
      
      // Radar chart
      const radarCtx = document.getElementById('radarChart').getContext('2d');
      const radarChart = new Chart(radarCtx, {
        type: 'radar',
        data: {
          labels: pertanyaanLabels,
          datasets: [{
            label: 'Rata-rata Nilai',
            data: rataRataData,
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            pointBackgroundColor: 'rgb(54, 162, 235)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(54, 162, 235)'
          }]
        },
        options: {
          elements: {
            line: {
              borderWidth: 3
            }
          },
          scales: {
            r: {
              angleLines: {
                display: true
              },
              suggestedMin: 0,
              suggestedMax: 5
            }
          }
        }
      });
      
      // Export functionality (mock implementation)
      document.getElementById('exportExcelBtn').addEventListener('click', function() {
        alert('Fitur export Excel sedang dalam pengembangan');
      });
      
      document.getElementById('exportPdfBtn').addEventListener('click', function() {
        alert('Fitur export PDF sedang dalam pengembangan');
      });
    <?php endif; ?>
  });
</script>

<!-- Login page (BONUS: Adding a login page) -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="paper-card p-4 p-md-5">
        <div class="text-center mb-4">
          <div class="display-5 mb-3">📝</div>
          <h2 class="fw-bold">Login Admin</h2>
          <p class="text-muted">Masuk untuk mengakses dashboard kuesioner</p>
        </div>
        
        <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger validation-error" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
        
        <?php echo form_open('auth/login'); ?>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-person"></i>
              </span>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
          </div>
          
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-lock"></i>
              </span>
              <input type="password" class="form-control" id="password" name="password" required>
              <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>
          
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary cute-btn py-2">
              <i class="bi bi-box-arrow-in-right me-2"></i> Login
            </button>
          </div>
        <?php echo form_close(); ?>
        
        <div class="text-center mt-4">
          <p class="mb-0">
            <a href="<?php echo base_url(); ?>" class="text-decoration-none">
              <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    if (togglePassword && passwordInput) {
      togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('bi-eye');
        this.querySelector('i').classList.toggle('bi-eye-slash');
      });
    }
  });
</script>

<!-- Example code to include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- Example Media Print CSS for better printing -->
<style media="print">
  .no-print {
    display: none !important;
  }
  
  .paper-card::before {
    display: none !important;
  }
  
  body {
    background-color: white !important;
  }
  
  .container {
    width: 100% !important;
    max-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  
  .paper-card {
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
  }
</style>