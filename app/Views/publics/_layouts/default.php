<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('publics/meta') ?>
    <link href="<?= base_url('assets/stylesheets/base-style.css'); ?>" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <?= $this->renderSection('head') ?>
</head>
<body>
    <div class="sticky-footer-container">
        <div class="sticky-footer-container-item">
            <?= $this->include('publics/_layouts/navbar') ?>
        </div>
        <div class="sticky-footer-container-item --pushed pb-32">
            <?= $this->renderSection('content') ?>
        </div>
        <div class="sticky-footer-container-item">
            <?= $this->include('publics/_layouts/footer') ?>
        </div>
    </div>
</body>
    <?= $this->renderSection('script') ?>
    <script src="<?= base_url('assets/js/navbar.js'); ?>"></script>
    <script src="<?= base_url('assets/js/helpers.js'); ?>"></script>
</html>