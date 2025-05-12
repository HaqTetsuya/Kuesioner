<div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Hasil Kuesioner</h1>
        <h2 class="text-2xl text-center mb-4"><?= htmlspecialchars($kuesioner->judul) ?></h2>

        <?php foreach($kuesioner->pertanyaan as $pertanyaan): ?>
        <div class="mb-8 p-4 border rounded-lg">
            <h3 class="text-xl font-semibold mb-4"><?= htmlspecialchars($pertanyaan->teks_pertanyaan) ?></h3>
            
            <div class="flex items-center mb-4">
                <div class="w-1/2">
                    <p class="text-lg">Statistik Jawaban</p>
                    <ul class="list-disc pl-5">
                        <li>Total Responden: <?= $pertanyaan->total_jawaban ?></li>
                        <li>Rata-rata Skor: <?= $pertanyaan->rata_rata ?></li>
                    </ul>
                </div>
                <div class="w-1/2">
                    <canvas id="chart-<?= $pertanyaan->id ?>"></canvas>
                </div>
            </div>

            <?php if(!empty($pertanyaan->jawaban)): ?>
            <div class="mt-4">
                <h4 class="font-semibold mb-2">Komentar Responden</h4>
                <div class="space-y-2">
                    <?php foreach($pertanyaan->jawaban as $jawaban): ?>
                        <?php if(!empty($jawaban->komentar)): ?>
                        <div class="border p-2 rounded bg-gray-50">
                            <p class="text-sm">
                                <strong>Skor:</strong> <?= $jawaban->nilai ?> 
                                | 
                                <strong>Komentar:</strong> <?= htmlspecialchars($jawaban->komentar) ?>
                            </p>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <script>
            // Buat grafik untuk setiap pertanyaan
            var ctx = document.getElementById('chart-<?= $pertanyaan->id ?>').getContext('2d');
            var skorCounts = [0, 0, 0, 0, 0];
            
            <?php 
            // Hitung jumlah jawaban untuk setiap skor
            $skorCounts = array_fill(0, 5, 0);
            foreach($pertanyaan->jawaban as $jawaban) {
                $skorCounts[$jawaban->nilai - 1]++;
            }
            ?>

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['1', '2', '3', '4', '5'],
                    datasets: [{
                        label: 'Jumlah Jawaban',
                        data: [
                            <?= implode(', ', $skorCounts) ?>
                        ],
                        backgroundColor: 'rgba(0, 0, 0, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Distribusi Skor'
                        }
                    }
                }
            });
        </script>
        <?php endforeach; ?>

        <div class="text-center mt-6">
            <a href="<?= site_url('dashboard/edit_kuesioner/'.$kuesioner->id) ?>" 
               class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
                Kembali ke Edit Kuesioner
            </a>
        </div>
    </div>
