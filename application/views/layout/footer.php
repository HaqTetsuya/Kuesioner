
    </div>

    <footer class="bg-black text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; <?= date('Y') ?> Kuesioner App. All Rights Reserved.</p>
            <small>Dibuat dengan ❤️ menggunakan CodeIgniter 3</small>
        </div>
    </footer>

    <!-- Custom JavaScript -->
    <script>
        // Fungsi konfirmasi hapus umum
        function konfirmasiHapus(pesan = 'Yakin ingin menghapus?') {
            return confirm(pesan);
        }

        // Tambahkan event listener untuk konfirmasi
        document.addEventListener('DOMContentLoaded', function() {
            const hapusLinks = document.querySelectorAll('.btn-hapus');
            hapusLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!konfirmasiHapus()) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>