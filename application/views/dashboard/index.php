<div class="container" style="margin: 20px auto; max-width: 1000px;">
    <div class="card" style="border: 1px solid #000; background: #fff; padding: 20px; border-radius: 5px;">
        <h2 style="margin-bottom: 20px;">Dashboard Kuesioner</h2>
        
        <div style="margin-bottom: 20px;">
            <div style="display: flex; gap: 10px;">
                <a href="<?php echo base_url('dashboard/pertanyaan'); ?>" style="background: #007bff; color: white; text-decoration: none; padding: 10px 15px;">Kelola Pertanyaan</a>
                <a href="<?php echo base_url('dashboard/hasil'); ?>" style="background: #28a745; color: white; text-decoration: none; padding: 10px 15px;">Lihat Hasil</a>
                <a href="<?php echo base_url('dashboard/statistik'); ?>" style="background: #6c757d; color: white; text-decoration: none; padding: 10px 15px;">Statistik</a>
            </div>
        </div>
        
        <div style="margin-top: 30px;">
            <h3>Statistik Singkat</h3>
            
            <?php if(!empty($statistik)): ?>
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Pertanyaan</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Rata-rata Nilai</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Jumlah Responden</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($statistik as $s): ?>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $s->pertanyaan; ?></td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;"><?php echo number_format($s->rata_rata, 2); ?></td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;"><?php echo $s->jumlah_jawaban; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>Belum ada data kuesioner.</p>
            <?php endif; ?>
        </div>
    </div>
</div>