<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('publics/meta') ?>
    <link href="<?= base_url('assets/stylesheets/homepage-style.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/stylesheets/base-style.css'); ?>" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>

    <?= $this->include('publics/_layouts/navbar') ?>
    <?= $this->include('publics/homepage/section/section_1') ?>
    <?= $this->include('publics/homepage/section/section_2') ?>
    <?= $this->include('publics/homepage/section/section_3') ?>
    <?= $this->include('publics/_layouts/footer') ?>

</body>

<script src="<?= base_url('assets/js/navbar.js'); ?>"></script>
</html>