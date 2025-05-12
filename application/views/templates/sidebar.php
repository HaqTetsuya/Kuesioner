<div class="list-group">
    <a href="<?= base_url('dashboard') ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
        <i class="fa fa-dashboard"></i> Dashboard
    </a>
    <a href="<?= base_url('surveys') ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(1) == 'surveys' ? 'active' : '' ?>">
        <i class="fa fa-file-text"></i> Kelola Kuesioner
    </a>
    <a href="<?= base_url('reports') ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(1) == 'reports' ? 'active' : '' ?>">
        <i class="fa fa-bar-chart"></i> Laporan
    </a>
</div>