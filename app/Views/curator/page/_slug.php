<?= $this->extend('/media/_layouts/default') ?>

<?= $this->section('head') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

   <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="card">
                 <?= $breadcrumbs; ?> 
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->endSection() ?>