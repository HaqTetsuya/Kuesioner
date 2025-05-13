<div class="container" style="margin: 20px auto; max-width: 1000px;">
    <div class="card" style="border: 1px solid #000; background: #fff; padding: 20px; border-radius: 5px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Daftar Pertanyaan Kuesioner</h2>
            <a href="<?php echo base_url('dashboard/pertanyaan/tambah'); ?>" style="background: #28a745; color: white; text-decoration: none; padding: 8px 15px;">Tambah Pertanyaan</a>
        </div>
        
        <?php if($this->session->flashdata('success')): ?>
            <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        
        <?php if(!empty($pertanyaan)): ?>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left; width: 50px;">ID</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Pertanyaan</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 200px;">Tanggal Dibuat</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pertanyaan as $p): ?>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $p->id; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $p->pertanyaan; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;"><?php echo date('d-m-Y', strtotime($p->created_at)); ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                <a href="<?php echo base_url('dashboard/pertanyaan/edit/'.$p->id); ?>" style="background: #ffc107; color: black; text-decoration: none; padding: 5px 10px; margin-right: 5px;">Edit</a>
                                <a href="<?php echo base_url('dashboard/pertanyaan/hapus/'.$p->id); ?>" onclick="return confirm('Yakin ingin menghapus pertanyaan ini?');" style="background: #dc3545; color: white; text-decoration: none; padding: 5px 10px;">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div style="text-align: center; padding: 20px;">
                <p>Belum ada pertanyaan. Silakan tambahkan pertanyaan baru.</p>
            </div>
        <?php endif; ?>
        
        <div style="margin-top: 20px;">
            <a href="<?php echo base_url('dashboard'); ?>" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px;">Kembali ke Dashboard</a>
        </div>
    </div>
</div>
