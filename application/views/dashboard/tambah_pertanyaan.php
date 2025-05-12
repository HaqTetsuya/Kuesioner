<div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center">Tambah Pertanyaan</h1>
    <h2 class="text-xl mb-4 text-center">Kuesioner: <?= htmlspecialchars($kuesioner->judul) ?></h2>

    <?php if (validation_errors()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <?= validation_errors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('pertanyaan/tambah/' . $kuesioner->id) ?>" method="post">
        <div class="mb-4">
            <label for="teks_pertanyaan" class="block mb-2 font-bold">Teks Pertanyaan</label>
            <textarea
                name="teks_pertanyaan"
                id="teks_pertanyaan"
                rows="4"
                class="w-full p-2 border rounded"
                placeholder="Masukkan teks pertanyaan"
                required><?= set_value('teks_pertanyaan') ?></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
                Simpan Pertanyaan
            </button>
            <a href="<?= site_url('dashboard/edit_kuesioner/' . $kuesioner->id) ?>"
                class="ml-4 text-gray-600 hover:underline">
                Batal
            </a>
        </div>
    </form>
</div>