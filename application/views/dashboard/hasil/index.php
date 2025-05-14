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