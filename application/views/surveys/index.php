<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $title ?></h2>
    <a href="<?= base_url('surveys/create') ?>" class="btn btn-primary">
        <i class="fa fa-plus"></i> Buat Kuesioner Baru
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="surveyTable">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Pertanyaan</th>
                        <th>Responden</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($surveys as $survey): ?>
                    <tr>
                        <td><?= $survey->title ?></td>
                        <td>
                            <?php if ($survey->status == 'active'): ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php elseif ($survey->status == 'draft'): ?>
                                <span class="badge badge-warning">Draft</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d M Y', strtotime($survey->start_date)) ?></td>
                        <td><?= date('d M Y', strtotime($survey->end_date)) ?></td>
                        <td><?= $survey->question_count ?? 0 ?></td>
                        <td><?= $survey->response_count ?? 0 ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('questions/index/' . $survey->id) ?>" class="btn btn-sm btn-secondary" title="Kelola Pertanyaan">
                                    <i class="fa fa-list"></i>
                                </a>
                                <a href="<?= base_url('surveys/preview/' . $survey->id) ?>" class="btn btn-sm btn-info" title="Preview">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <?php if ($survey->status == 'draft'): ?>
                                    <a href="<?= base_url('surveys/edit/' . $survey->id) ?>" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('surveys/change_status/' . $survey->id . '/active') ?>" class="btn btn-sm btn-success" title="Aktifkan" onclick="return confirm('Yakin ingin mengaktifkan kuesioner ini?')">
                                        <i class="fa fa-check"></i>
                                    </a>
                                <?php elseif ($survey->status == 'active'): ?>
                                    <a href="<?= base_url('surveys/share/' . $survey->id) ?>" class="btn btn-sm btn-warning" title="Bagikan">
                                        <i class="fa fa-share-alt"></i>
                                    </a>
                                    <a href="<?= base_url('surveys/change_status/' . $survey->id . '/inactive') ?>" class="btn btn-sm btn-secondary" title="Nonaktifkan" onclick="return confirm('Yakin ingin menonaktifkan kuesioner ini?')">
                                        <i class="fa fa-times"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="<?= base_url('reports/view/' . $survey->id) ?>" class="btn btn-sm btn-primary" title="Lihat Laporan">
                                    <i class="fa fa-bar-chart"></i>
                                </a>
                                <a href="<?= base_url('surveys/delete/' . $survey->id) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus kuesioner ini? Semua data terkait akan ikut terhapus.')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($surveys)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada kuesioner</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#surveyTable').DataTable({
        "order": [[2, "desc"]]
    });
});
</script>