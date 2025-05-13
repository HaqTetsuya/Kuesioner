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