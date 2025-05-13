<div class="container" style="margin: 20px auto; max-width: 1000px;">
    <div class="card" style="border: 1px solid #000; background: #fff; padding: 20px; border-radius: 5px;">
        <h2 style="margin-bottom: 20px;">Hasil Kuesioner</h2>
        
        <?php if(!empty($responden)): ?>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left; width: 50px;">ID</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Nama</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Email</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Tanggal Pengisian</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($responden as $r): ?>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $r->id; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $r->nama; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $r->email; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;"><?php echo date('d-m-Y H:i', strtotime($r->tanggal)); ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                <a href="<?php echo base_url('dashboard/hasil/detail/'.$r->id); ?>" style="background: #17a2b8; color: white; text-decoration: none; padding: 5px 10px;">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div style="text-align: center; padding: 20px;">
                <p>Belum ada data responden.</p>
            </div>
        <?php endif; ?>
        
        <div style="margin-top: 20px;">
            <a href="<?php echo base_url('dashboard'); ?>" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px;">Kembali ke Dashboard</a>
        </div>
    </div>
</div>