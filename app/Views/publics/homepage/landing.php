<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comm-press Recruitment</title>

    <link href="<?= base_url('assets/stylesheets/homepage.css'); ?>" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>

    <?= $this->include('publics/_layouts/navbar') ?>
    <?= $this->include('publics/homepage/section/section_1') ?>
    <?= $this->include('publics/homepage/section/section_2') ?>
    <?= $this->include('publics/homepage/section/section_3') ?>
    <?= $this->include('publics/_layouts/footer') ?>

</body>

<script src="<?= base_url('assets/js/homepage.js'); ?>"></script>
</html>