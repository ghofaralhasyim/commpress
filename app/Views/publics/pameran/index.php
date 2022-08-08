<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('head') ?>
    <link href="<?= base_url('assets/stylesheets/rin-style.css'); ?>" rel="stylesheet"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="rin-container">
            <div class="container pt-32 flex flex-col v-center h-center">
                <h1 class="mt-0 mb-0 main-title f-italiana">RUANG INDIEPENDEN</h1>
                <span>COMMPRESS UMN 2022</span>

                <div class="flex flex-col lg-flex-row mt-64 row-gap-24 col-gap-24">
                    <?php foreach($lomba as $data): ?>
                          <a href="/member/ruang-indiependen/<?= $data->slug ?>" class="btn"><?= $data->name; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
    </section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->endSection() ?>