<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $title ?></h2>
    <div>
        <a href="<?= base_url('questions/index/' . $survey->id) ?>" class="btn btn-primary">
            <i class="fa fa-list"></i> Kelola Pertanyaan
        </a>
        <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h4 class="mb-0"><?= $survey->title ?></h4>
    </div>
    <div class="card-body">
        <p><?= nl2br($survey->description) ?></p>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Tanggal Mulai:</strong> <?= date('d M Y', strtotime($survey->start_date)) ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Tanggal Selesai:</strong> <?= date('d M Y', strtotime($survey->end_date)) ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Pertanyaan</h5>
    </div>
    <div class="card-body">
        <form id="previewForm">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="name" disabled placeholder="Nama Responden">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" disabled placeholder="Email Responden">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Telepon</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="phone" disabled placeholder="Nomor Telepon">
                </div>
            </div>
            
            <hr>
            
            <h5 class="mb-3">Skala Penilaian:</h5>
            <div class="mb-4">
                <?php foreach ($likert_scales as $scale): ?>
                    <span class="badge badge-info p-2 mr-2 mb-2"><?= $scale->scale_value ?> = <?= $scale->scale_label ?></span>
                <?php endforeach; ?>
            </div>
            
            <?php if (!empty($questions)): ?>
                <?php foreach ($questions as $question): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= $question->question_order ?>. <?= $question->question_text ?></h5>
                            <div class="form-group mt-3">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <?php foreach ($likert_scales as $scale): ?>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="answer[<?= $question->id ?>]" value="<?= $scale->scale_value ?>" disabled> <?= $scale->scale_value ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning">
                    Belum ada pertanyaan untuk kuesioner ini. 
                    <a href="<?= base_url('questions/create/' . $survey->id) ?>" class="alert-link">Tambahkan pertanyaan sekarang</a>.
                </div>
            <?php endif; ?>
            
            <div class="form-group mt-4">
                <button type="button" class="btn btn-primary" disabled>Submit (Preview)</button>
            </div>
        </form>
    </div>
</div>