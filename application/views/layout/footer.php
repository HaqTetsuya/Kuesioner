		</div>
    </div>
<footer class="footer-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h5>Aplikasi Buku</h5>
                <p class="mb-0">Kelola koleksi bukumu dengan mudah dan menyenangkan.</p>
            </div>
            <div class="col-md-4">
                <h5>Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= base_url('about'); ?>" class="text-decoration-none">Tentang Kami</a></li>
                    <li><a href="<?= base_url('privacy'); ?>" class="text-decoration-none">Kebijakan Privasi</a></li>
                    <li><a href="<?= base_url('terms'); ?>" class="text-decoration-none">Ketentuan Layanan</a></li>
                    <li><a href="<?= base_url('contact'); ?>" class="text-decoration-none">Hubungi Kami</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Tetap Terhubung</h5>
                <div class="d-flex gap-3 mb-3">
                    <a href="#" class="text-decoration-none"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-decoration-none"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="text-decoration-none"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-decoration-none"><i class="bi bi-pinterest fs-5"></i></a>
                </div>
                <p class="mb-0">Berlangganan newsletter:</p>
                <div class="input-group mt-2">
                    <input type="email" class="form-control" placeholder="Email kamu">
                    <button class="btn btn-outline-secondary" type="button">Langganan</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0">&copy; <?= date('Y'); ?> Aplikasi Buku. Hak cipta dilindungi.</p>
            <p class="mb-0">Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> oleh Pengembang</p>
        </div>
    </div>
</footer>
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content paper-card border-0">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold" id="helpModalLabel">Bantuan Dashboard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Kelola Pertanyaan:</strong> Tambah, edit, atau hapus pertanyaan kuesioner.</p>
                <p><strong>Lihat Hasil:</strong> Lihat jawaban yang telah diberikan responden.</p>
                <p><strong>Statistik:</strong> Lihat analisis statistik dari hasil kuesioner.</p>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary cute-btn" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/main.js'); ?>"></script>

<?php if (!empty($jawaban_likert)): ?>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const labels = [];
		const values = [];
		const backgroundColors = [
			'rgba(220, 53, 69, 0.7)',
			'rgba(253, 126, 20, 0.7)',
			'rgba(255, 193, 7, 0.7)',
			'rgba(40, 167, 69, 0.7)',
			'rgba(32, 201, 151, 0.7)'
		];

		<?php foreach ($jawaban_likert as $j): ?>
			labels.push("Q<?php echo $j->id; ?>");
			values.push(<?php echo $j->jawaban; ?>);
		<?php endforeach; ?>

		const ctx = document.getElementById('jawabanChart').getContext('2d');
		const myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: labels,
				datasets: [{
					label: 'Nilai Jawaban',
					data: values,
					backgroundColor: backgroundColors,
					borderColor: backgroundColors.map(c => c.replace('0.7', '1')),
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				scales: {
					y: {
						beginAtZero: true,
						max: 5,
						ticks: {
							stepSize: 1
						}
					}
				}
			}
		});

		const printBtn = document.getElementById('printResultBtn');
		if (printBtn) {
			printBtn.addEventListener('click', function() {
				window.print();
			});
		}
	});
</script>
<?php endif; ?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchResponden');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const table = document.getElementById('respondenTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                for (let i = 0; i < rows.length; i++) {
                    const nama = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
                    const email = rows[i].getElementsByTagName('td')[2].textContent.toLowerCase();

                    if (nama.includes(searchValue) || email.includes(searchValue)) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            });
        }
    });
</script>
<script>
    // Contoh JavaScript sederhana
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle sidebar pada tampilan mobile
        const toggleSidebarBtn = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('.sidebar-container');

        if (toggleSidebarBtn) {
            toggleSidebarBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }

        // Tooltip initialization
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (!empty($statistik)): ?>
            // Data preparation for average chart
            const pertanyaanLabels = [];
            const rataRataData = [];
            const jumlahData = [];

            <?php foreach ($statistik as $s): ?>
                pertanyaanLabels.push("<?php echo substr($s->pertanyaan, 0, 30) . (strlen($s->pertanyaan) > 30 ? '...' : ''); ?>");
                rataRataData.push(<?php echo $s->rata_rata; ?>);
                jumlahData.push(<?php echo $s->jumlah_jawaban; ?>);
            <?php endforeach; ?>

            // Average chart
            const avgCtx = document.getElementById('avgChart').getContext('2d');
            const avgChart = new Chart(avgCtx, {
                type: 'bar',
                data: {
                    labels: pertanyaanLabels,
                    datasets: [{
                        label: 'Rata-rata Nilai',
                        data: rataRataData,
                        backgroundColor: 'rgba(13, 110, 253, 0.7)',
                        borderColor: 'rgba(13, 110, 253, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Rata-rata Nilai Per Pertanyaan'
                        }
                    }
                }
            });

            // Distribution chart
            const distData = [0, 0, 0, 0, 0];
            <?php foreach ($statistik as $s): ?>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    distData[<?php echo $i - 1; ?>] += <?php echo isset($s->{'nilai_' . $i}) ? $s->{'nilai_' . $i} : 0; ?>;
                <?php endfor; ?>
            <?php endforeach; ?>

            const distCtx = document.getElementById('distributionChart').getContext('2d');
            const distChart = new Chart(distCtx, {
                type: 'pie',
                data: {
                    labels: ['Sangat Tidak Setuju', 'Tidak Setuju', 'Netral', 'Setuju', 'Sangat Setuju'],
                    datasets: [{
                        data: distData,
                        backgroundColor: [
                            'rgba(220, 53, 69, 0.7)',
                            'rgba(253, 126, 20, 0.7)',
                            'rgba(255, 193, 7, 0.7)',
                            'rgba(40, 167, 69, 0.7)',
                            'rgba(32, 201, 151, 0.7)'
                        ],
                        borderColor: [
                            'rgba(220, 53, 69, 1)',
                            'rgba(253, 126, 20, 1)',
                            'rgba(255, 193, 7, 1)',
                            'rgba(40, 167, 69, 1)',
                            'rgba(32, 201, 151, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        title: {
                            display: true,
                            text: 'Distribusi Jawaban'
                        }
                    }
                }
            });

            // Timeline chart (mock data - replace with actual data in your implementation)
            const timelineCtx = document.getElementById('timelineChart').getContext('2d');
            const timelineChart = new Chart(timelineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{
                        label: 'Jumlah Responden',
                        data: [12, 19, 3, 5, 2, 3],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Responden Per Bulan'
                        }
                    }
                }
            });

            // Radar chart
            const radarCtx = document.getElementById('radarChart').getContext('2d');
            const radarChart = new Chart(radarCtx, {
                type: 'radar',
                data: {
                    labels: pertanyaanLabels,
                    datasets: [{
                        label: 'Rata-rata Nilai',
                        data: rataRataData,
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        pointBackgroundColor: 'rgb(54, 162, 235)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(54, 162, 235)'
                    }]
                },
                options: {
                    elements: {
                        line: {
                            borderWidth: 3
                        }
                    },
                    scales: {
                        r: {
                            angleLines: {
                                display: true
                            },
                            suggestedMin: 0,
                            suggestedMax: 5
                        }
                    }
                }
            });

            // Export functionality (mock implementation)
            document.getElementById('exportExcelBtn').addEventListener('click', function() {
                alert('Fitur export Excel sedang dalam pengembangan');
            });

            document.getElementById('exportPdfBtn').addEventListener('click', function() {
                alert('Fitur export PDF sedang dalam pengembangan');
            });
        <?php endif; ?>
    });
</script>
</body>

</html>

</html>