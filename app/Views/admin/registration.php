<?= $this->extend('/admin/dashboard') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12 center">
        <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_4s3kvfcn.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
    </div>
</div>


<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<style>
    .center {
        display: flex;
        height: 80vh;
        width: 100%;
        max-width: 100%;
        justify-content: center;
        align-items: center;
    }
</style>

<?= $this->endSection() ?>