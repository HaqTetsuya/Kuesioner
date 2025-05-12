<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $title ?></h2>
    <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?= form_open('surveys/edit/' . $survey->id) ?>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Judul Kuesioner <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="title" class="form-control" value="<?= set_value('title', $survey->title) ?>" required>
                    <?= form_error('title', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" rows="4" required><?= set_value('description', $survey->description) ?></textarea>
                    <?= form_error('description', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="date" name="start_date" class="form-control" value="<?= set_value('start_date', date('Y-m-d', strtotime($survey->start_date))) ?>" required>
                    <?= form_error('start_date', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="date" name="end_date" class="form-control" value="<?= set_value('end_date', date('Y-m-d', strtotime($survey->end_date))) ?>" required>
                    <?= form_error('end_date', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            
            <h4 class="mt-4 mb-3">Skala Likert</h4>
            <?php foreach ($likert_scales as $scale): ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nilai <?= $scale->scale_value ?></label>
                    <div class="col-sm-9">
                        <input type="hidden" name="scale_id[]" value="<?= $scale->id ?>">
                        <input type="hidden" name="scale_value[]" value="<?= $scale->scale_value ?>">
                        <input type="text" name="scale_label[]" class="form-control" value="<?= set_value('scale_label', $scale->scale_label) ?>" required>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        <?= form_close() ?>
    </div>
</div>