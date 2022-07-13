<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="<?= base_url('assets/stylesheets/base-style.css'); ?>" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <div class="sticky-footer-container">
        <div class="sticky-footer-container-item">
            <?= $this->include('publics/_layouts/navbar') ?>
        </div>
        <div class="sticky-footer-container-item --pushed">
            <?= $this->renderSection('content') ?>
        </div>
        <div class="sticky-footer-container-item">
            <?= $this->include('publics/_layouts/footer') ?>
        </div>
    </div>
</body>
    <script src="<?= base_url('assets/js/navbar.js'); ?>"></script>
    <script src="<?= base_url('assets/js/helpers.js'); ?>"></script>
</html>