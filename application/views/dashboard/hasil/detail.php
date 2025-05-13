<div class="container" style="margin: 20px auto; max-width: 800px;">
    <div class="card" style="border: 1px solid #000; background: #fff; padding: 20px; border-radius: 5px;">
        <h2 style="margin-bottom: 20px;">Detail Jawaban Responden</h2>
        
        <div style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border: 1px solid #eee;">
            <h3 style="margin-top: 0;">Informasi Responden</h3>
            <table style="width: 100%;">
                <tr>
                    <td style="padding: 5px 0; width: 150px;"><strong>Nama</strong></td>
                    <td>: <?php echo $responden->nama; ?></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;"><strong>Email</strong></td>
                    <td>: <?php echo $responden->email; ?></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;"><strong>Tanggal Pengisian</strong></td>
                    <td>: <?php echo date('d-m-Y H:i', strtotime($responden->tanggal)); ?></td>
                </tr>
            </table>
        </div>
        
        <h3>Jawaban</h3>
        
        <?php if(!empty($jawaban)): ?>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Pertanyaan</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 100px;">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($jawaban as $j): ?>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $j->pertanyaan; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                <?php 
                                    $color = '';
                                    if($j->nilai == 1) $color = '#dc3545';
                                    elseif($j->nilai == 2) $color = '#fd7e14';
                                    elseif($j->nilai == 3) $color = '#ffc107';
                                    elseif($j->nilai == 4) $color = '#28a745';
                                    elseif($j->nilai == 5) $color = '#20c997';
                                ?>
                                <span style="font-weight: bold; color: <?php echo $color; ?>;"><?php echo $j->nilai; ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div style="text-align: center; padding: 20px;">
                <p>Tidak ada data jawaban.</p>
            </div>
        <?php endif; ?>
        
        <div style="margin-top: 20px;">
            <a href="<?php echo base_url('dashboard/hasil'); ?>" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px;">Kembali ke Daftar Hasil</a>
        </div>
    </div>
</div>