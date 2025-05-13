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