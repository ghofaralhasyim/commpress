<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('content') ?>
    <link href="<?= base_url('assets/stylesheets/lomba-style.css'); ?>" rel="stylesheet"/>
    <section class="lomba">
        <div class="container mt-32">
            <img src="<?= base_url("uploads/media/lomba/banner/$data->banner"); ?>" class="lomba-image" alt="image">
            <?= $data->description; ?>
            <h1 class="uppercase">DAFTAR</h1>
            <form action="#">
                 <div class="input-group flex flex-col">
                <label for="email" class="mb-8">NIM<span class="text-red">*</span></label>
                    <input
                        id="nim" name="nim"
                        type="number"
                        class="form-input full-width"
                        placeholder="00000012345"
                    />
                </div>
                <button class="button-primary mt-12">Daftar</button>
            </form>           
        </div>
   </section>
<?= $this->endSection() ?>