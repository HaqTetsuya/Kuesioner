<div class="container py-5">
  <div class="paper-card p-4 p-md-5">
    <div class="mb-4 pb-3 border-bottom">
      <h2 class="fw-bold mb-0">Tambah Pertanyaan Baru</h2>
    </div>

    <?php if (validation_errors()): ?>
      <div class="alert alert-danger validation-error" role="alert">
        <?php echo validation_errors(); ?>
      </div>
    <?php endif; ?>

    <?php echo form_open('dashboard/pertanyaan/update/'.$pertanyaan->id); ?>

	<!-- Jenis Pertanyaan -->
	<div class="mb-4">
	  <label class="form-label fw-medium">Tipe Pertanyaan:</label>
	  <div class="form-check form-check-inline">
		<input class="form-check-input"
			   type="radio"
			   name="tipe"
			   id="tipe_likert"
			   value="likert"
			   <?= set_radio('tipe', 'likert', $pertanyaan->type === 'likert'); ?>
			   <?= !$is_radio_editable ? 'disabled' : ''; ?>>
		<label class="form-check-label" for="tipe_likert">Likert</label>
	  </div>
	  <div class="form-check form-check-inline">
		<input class="form-check-input"
			   type="radio"
			   name="tipe"
			   id="tipe_text"
			   value="text"
			   <?= set_radio('tipe', 'text', $pertanyaan->type === 'text'); ?>
			   <?= !$is_radio_editable ? 'disabled' : ''; ?>>
		<label class="form-check-label" for="tipe_text">Teks</label>
	  </div>

	  <?php if (!$is_radio_editable): ?>
		<input type="hidden" name="tipe" value="<?php echo $pertanyaan->type; ?>">
		<div class="form-text text-danger">Tipe pertanyaan tidak dapat diubah karena sudah memiliki jawaban.</div>
	  <?php endif; ?>
	</div>


      <!-- Input Pertanyaan -->
      <div class="mb-4">
        <label for="pertanyaan" class="form-label fw-medium">Pertanyaan:</label>
        <textarea name="pertanyaan" id="pertanyaan" rows="4" class="form-control" placeholder="Masukkan pertanyaan untuk kuesioner skala Likert"><?php echo set_value('pertanyaan', $pertanyaan->pertanyaan); ?></textarea>
        <div class="form-text" id="tipeHint">Masukkan pertanyaan untuk kuesioner skala Likert.</div>
      </div>

      <!-- Tombol Aksi -->
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

<script>
  // Script untuk update placeholder dan hint sesuai pilihan tipe pertanyaan
  document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('pertanyaan');
    const hint = document.getElementById('tipeHint');
    const radios = document.querySelectorAll('input[name="tipe"]');

    radios.forEach(function (radio) {
      radio.addEventListener('change', function () {
        if (this.value === 'likert') {
          textarea.placeholder = "Masukkan pertanyaan untuk kuesioner skala Likert";
          hint.textContent = "Masukkan pertanyaan untuk kuesioner skala Likert.";
        } else if (this.value === 'text') {
          textarea.placeholder = "Masukkan pertanyaan untuk jawaban berupa teks bebas";
          hint.textContent = "Masukkan pertanyaan untuk jawaban berupa teks panjang dari responden.";
        }
      });
    });
  });
</script>
