<!-- Views/public/kuesioner_form.php -->
<div class="container" style="margin: 20px auto; max-width: 800px;">
    <div class="card" style="border: 1px solid #000; background: #fff; padding: 20px; border-radius: 5px;">
        <h2 style="margin-bottom: 20px;">Kuesioner Likert</h2>
        
        <?php if(validation_errors()): ?>
            <div style="background: #ffe6e6; border: 1px solid #ff0000; padding: 10px; margin-bottom: 15px;">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        
        <?php echo form_open('submit'); ?>
            <div style="margin-bottom: 15px;">
                <label for="nama" style="display: block; margin-bottom: 5px;">Nama:</label>
                <input type="text" name="nama" value="<?php echo set_value('nama'); ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
                <input type="email" name="email" value="<?php echo set_value('email'); ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc;">
            </div>
            
            <h3 style="margin: 20px 0 10px 0;">Pertanyaan</h3>
            <p>Skala: 1 = Sangat Tidak Setuju, 2 = Tidak Setuju, 3 = Netral, 4 = Setuju, 5 = Sangat Setuju</p>
            
            <?php foreach($pertanyaan as $p): ?>
                <div style="margin-bottom: 15px; padding: 10px; border: 1px solid #eee;">
                    <p><?php echo $p->pertanyaan; ?></p>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <label style="text-align: center;">
                                <input type="radio" name="jawaban[<?php echo $p->id; ?>]" value="<?php echo $i; ?>" <?php echo set_radio('jawaban['.$p->id.']', $i); ?>>
                                <br><?php echo $i; ?>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div style="margin-top: 20px;">
                <button type="submit" style="background: #007bff; color: white; border: none; padding: 10px 15px; cursor: pointer;">Kirim Jawaban</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Views/public/thank_you.php -->
<div class="container" style="margin: 20px auto; max-width: 600px; text-align: center;">
    <div class="card" style="border: 1px solid #000; background: #fff; padding: 30px; border-radius: 5px;">
        <h2 style="margin-bottom: 20px;">Terima Kasih!</h2>
        
        <div style="margin: 20px 0;">
            <p><?php echo $message; ?></p>
            <p>Jawaban Anda telah disimpan.</p>
        </div>
        
        <div style="margin-top: 30px;">
            <a href="<?php echo base_url(); ?>" style="background: #007bff; color: white; text-decoration: none; padding: 10px 15px;">Kembali ke Beranda</a>
        </div>
    </div>
</div>


<!-- Views/dashboard/index.php -->
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

<!-- Views/dashboard/pertanyaan/index.php -->
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

<!-- Views/dashboard/pertanyaan/tambah.php -->
<div class="container" style="margin: 20px auto; max-width: 800px;">
    <div class="card" style="border: 1px solid #000; background: #fff; padding: 20px; border-radius: 5px;">
        <h2 style="margin-bottom: 20px;">Tambah Pertanyaan Baru</h2>
        
        <?php if(validation_errors()): ?>
            <div style="background: #ffe6e6; border: 1px solid #ff0000; padding: 10px; margin-bottom: 15px;">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        
        <?php echo form_open('dashboard/pertanyaan/simpan'); ?>
            <div style="margin-bottom: 15px;">
                <label for="pertanyaan" style="display: block; margin-bottom: 5px;">Pertanyaan:</label>
                <textarea name="pertanyaan" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ccc;"><?php echo set_value('pertanyaan'); ?></textarea>
                <small style="display: block; margin-top: 5px; color: #666;">Masukkan pertanyaan untuk kuesioner skala Likert.</small>
            </div>
            
            <div style="margin-top: 20px;">
                <button type="submit" style="background: #28a745; color: white; border: none; padding: 10px 15px; cursor: pointer; margin-right: 10px;">Simpan Pertanyaan</button>
                <a href="<?php echo base_url('dashboard/pertanyaan'); ?>" style="background: #6c757d; color: white; text-decoration: none; padding: 10px 15px;">Batal</a>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Views/dashboard/hasil/index.php -->
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

<!-- Views/dashboard/hasil/detail.php -->
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

