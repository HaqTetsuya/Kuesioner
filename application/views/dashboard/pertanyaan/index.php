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
              <th width="50">ID</th>
              <th>Pertanyaan</th>
			  <th class="text-center" width="70">Tipe</th>
              <th class="text-center" width="200">Tanggal Dibuat</th>
              <th class="text-center" width="150">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($pertanyaan as $p): ?>
              <tr>
                <td><?php echo $p->id; ?></td>
                <td><?php echo $p->pertanyaan; ?></td>
				<td class="text-center"><?php echo $p->type; ?></td>
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