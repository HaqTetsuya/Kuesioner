<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $title ?></h2>
    <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?= form_open('surveys/create') ?>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Judul Kuesioner <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="title" class="form-control" value="<?= set_value('title') ?>" required>
                    <?= form_error('title', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" rows="4" required><?= set_value('description') ?></textarea>
                    <?= form_error('description', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="date" name="start_date" class="form-control" value="<?= set_value('start_date', date('Y-m-d')) ?>" required>
                    <?= form_error('start_date', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="date" name="end_date" class="form-control" value="<?= set_value('end_date', date('Y-m-d', strtotime('+30 days'))) ?>" required>
                    <?= form_error('end_date', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Simpan & Lanjutkan</button>
                    <a href="<?= base_url('surveys') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        <?= form_close() ?>
    </div>
</div>