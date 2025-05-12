<h2 class="mb-4"><?= $title ?></h2>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <h5>Total Kuesioner</h5>
                <h2><?= $total_surveys ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <h5>Kuesioner Aktif</h5>
                <h2><?= $active_surveys ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white mb-4">
            <div class="card-body">
                <h5>Total Responden</h5>
                <h2><?= $total_responses ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fa fa-file-text"></i> Kuesioner Terbaru
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Responden</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_surveys as $survey): ?>
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
                        <td><?= $survey->response_count ?? 0 ?></td>
                        <td>
                            <a href="<?= base_url('surveys/preview/' . $survey->id) ?>" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="<?= base_url('reports/view/' . $survey->id) ?>" class="btn btn-sm btn-primary">
                                <i class="fa fa-bar-chart"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($recent_surveys)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada kuesioner</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="<?= base_url('surveys') ?>" class="btn btn-primary">Lihat Semua Kuesioner</a>
    </div>
</div>