<!-- Views/dashboard/pertanyaan/edit.php -->
<div class="container" style="margin: 20px auto; max-width: 800px;">
    <div class="card" style="border: 1px solid #000; background: #fff; padding: 20px; border-radius: 5px;">
        <h2 style="margin-bottom: 20px;">Edit Pertanyaan</h2>
        
        <?php if(validation_errors()): ?>
            <div style="background: #ffe6e6; border: 1px solid #ff0000; padding: 10px; margin-bottom: 15px;">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        
        <?php echo form_open('dashboard/pertanyaan/update/'.$pertanyaan->id); ?>
            <div style="margin-bottom: 15px;">
                <label for="pertanyaan" style="display: block; margin-bottom: 5px;">Pertanyaan:</label>
                <textarea name="pertanyaan" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ccc;"><?php echo set_value('pertanyaan', $pertanyaan->pertanyaan); ?></textarea>
                <small style="display: block; margin-top: 5px; color: #666;">Edit pertanyaan untuk kuesioner skala Likert.</small>
            </div>
            
            <div style="margin-top: 20px;">
                <button type="submit" style="background: #007bff; color: white; border: none; padding: 10px 15px; cursor: pointer; margin-right: 10px;">Update Pertanyaan</button>
                <a href="<?php echo base_url('dashboard/pertanyaan'); ?>" style="background: #6c757d; color: white; text-decoration: none; padding: 10px 15px;">Batal</a>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>