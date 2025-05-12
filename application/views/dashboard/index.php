<div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center">Dashboard Kuesioner</h1>

    <div class="mb-4">
        <a href="<?= site_url('dashboard/tambah_kuesioner') ?>"
            class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
            Buat Kuesioner Baru
        </a>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Judul</th>
                <th class="border p-2">Tanggal Dibuat</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kuesioner as $k): ?>
                <tr>
                    <td class="border p-2"><?= htmlspecialchars($k->judul) ?></td>
                    <td class="border p-2"><?= date('d M Y', strtotime($k->created_at)) ?></td>
                    <td class="border p-2 text-center">
                        <a href="<?= site_url('dashboard/edit_kuesioner/' . $k->id) ?>"
                            class="text-blue-600 mr-2">Edit</a>
                        <a href="<?= site_url('dashboard/hapus_kuesioner/' . $k->id) ?>"
                            class="text-red-600"
                            onclick="return confirm('Yakin hapus kuesioner?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>