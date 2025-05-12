<div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center"><?= htmlspecialchars($kuesioner->judul) ?></h1>

    <?php if (!empty($kuesioner->deskripsi)): ?>
        <div class="mb-6 text-gray-700 text-center">
            <?= htmlspecialchars($kuesioner->deskripsi) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('kuesioner/submit') ?>" method="post">
        <input type="hidden" name="kuesioner_id" value="<?= $kuesioner->id ?>">

        <?php foreach ($kuesioner->pertanyaan as $pertanyaan): ?>
            <div class="mb-6 p-4 border rounded-lg">
                <p class="font-bold mb-3"><?= htmlspecialchars($pertanyaan->teks_pertanyaan) ?></p>

                <div class="flex justify-between items-center">
                    <span class="text-sm">Sangat Tidak Setuju</span>
                    <div class="flex space-x-2">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <label class="inline-flex items-center">
                                <input type="radio"
                                    name="nilai[<?= $pertanyaan->id ?>]"
                                    value="<?= $i ?>"
                                    class="form-radio"
                                    required>
                                <span class="ml-2"><?= $i ?></span>
                            </label>
                        <?php endfor; ?>
                    </div>
                    <span class="text-sm">Sangat Setuju</span>
                </div>

                <textarea
                    name="komentar[<?= $pertanyaan->id ?>]"
                    class="w-full mt-3 p-2 border rounded"
                    placeholder="Komentar tambahan (opsional)"
                    rows="3"></textarea>
            </div>
        <?php endforeach; ?>

        <div class="text-center">
            <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
                Kirim Jawaban
            </button>
        </div>
    </form>
</div>