<div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center">Edit Kuesioner</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('dashboard/edit_kuesioner/' . $kuesioner->id) ?>" method="post">
        <div class="mb-4">
            <label for="judul" class="block mb-2 font-bold">Judul Kuesioner</label>
            <input
                type="text"
                name="judul"
                id="judul"
                class="w-full p-2 border rounded"
                value="<?= htmlspecialchars($kuesioner->judul) ?>"
                required>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block mb-2 font-bold">Deskripsi</label>
            <textarea
                name="deskripsi"
                id="deskripsi"
                rows="4"
                class="w-full p-2 border rounded"><?= htmlspecialchars($kuesioner->deskripsi ?? '') ?></textarea>
        </div>

        <div class="mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Daftar Pertanyaan</h2>
                <a href="<?= site_url('pertanyaan/tambah/' . $kuesioner->id) ?>"
                    class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                    Tambah Pertanyaan
                </a>
            </div>

            <?php if (empty($kuesioner->pertanyaan)): ?>
                <div class="text-center text-gray-600 py-4">
                    Belum ada pertanyaan. Silakan tambah pertanyaan.
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($kuesioner->pertanyaan as $pertanyaan): ?>
                        <div class="border rounded p-4 flex justify-between items-center">
                            <div class="flex-grow mr-4">
                                <p class="font-semibold"><?= htmlspecialchars($pertanyaan->teks_pertanyaan) ?></p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="<?= site_url('pertanyaan/edit/' . $pertanyaan->id) ?>"
                                    class="text-blue-600 hover:underline">Edit</a>
                                <a href="<?= site_url('pertanyaan/hapus/' . $pertanyaan->id) ?>"
                                    class="text-red-600 hover:underline"
                                    onclick="return confirm('Yakin hapus pertanyaan?')">Hapus</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="flex justify-between items-center">
            <div>
                <a href="<?= site_url('pertanyaan/hasil/' . $kuesioner->id) ?>"
                    class="text-green-600 hover:underline mr-4">
                    Lihat Hasil Kuesioner
                </a>
                <button type="submit"
                    class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
                    Simpan Perubahan
                </button>
            </div>
            <div>
                <input type="text"
                    value="<?= site_url('kuesioner/isi/' . $kuesioner->id) ?>"
                    class="border p-2 rounded w-96"
                    readonly
                    onclick="this.select()">
                <span class="text-sm text-gray-600 block mt-1">
                    Link ini dapat dibagikan ke responden
                </span>
            </div>
        </div>
    </form>
</div>