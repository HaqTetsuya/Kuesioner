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

    <!-- LIKERT ANSWERS SECTION -->
	<?php if (!empty($jawaban_likert)): ?>
	  <div class="row mb-5">
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
				foreach ($jawaban_likert as $j):
				  $total += $j->jawaban;
				?>
				  <tr>
					<td><?php echo $j->pertanyaan; ?></td>
					<td class="text-center">
					  <?php
					  $bgColor = '';
					  $textColor = 'text-white';
					  if ($j->jawaban == 1) $bgColor = 'bg-danger';
					  elseif ($j->jawaban == 2) $bgColor = 'bg-warning';
					  elseif ($j->jawaban == 3) $bgColor = 'bg-info';
					  elseif ($j->jawaban == 4) $bgColor = 'bg-primary';
					  elseif ($j->jawaban == 5) $bgColor = 'bg-success';
					  ?>
					  <span class="badge rounded-pill <?php echo $bgColor; ?> <?php echo $textColor; ?> px-3 py-2"><?php echo $j->jawaban; ?></span>
					</td>
				  </tr>
				<?php endforeach; ?>
			  </tbody>
			  <tfoot>
				<tr>
				  <th>Rata-rata</th>
				  <th class="text-center">
					<span class="badge rounded-pill bg-dark px-3 py-2">
					  <?php echo number_format($total / count($jawaban_likert), 2); ?></span>
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
	<?php endif; ?>
	<?php if (!empty($jawaban_tekstual)): ?>
	  <div class="mt-4">
		<h4 class="mb-3 fw-bold">Jawaban Teks / Esai</h4>
		<div class="table-responsive">
		  <table class="table table-striped table-bordered">
			<thead>
			  <tr>
				<th width="40%">Pertanyaan</th>
				<th>Jawaban</th>
			  </tr>
			</thead>
			<tbody>
			  <?php foreach ($jawaban_tekstual as $j): ?>
				<tr>
				  <td><?php echo $j->pertanyaan; ?></td>
				  <td><?php echo nl2br(htmlspecialchars($j->jawaban)); ?></td>
				</tr>
			  <?php endforeach; ?>
			</tbody>
		  </table>
		</div>
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