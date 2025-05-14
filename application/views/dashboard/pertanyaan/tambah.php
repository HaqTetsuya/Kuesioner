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