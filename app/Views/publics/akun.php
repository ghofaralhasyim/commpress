<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="<?= base_url('assets/stylesheets/account.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="container account-container mt-32 pb-32">
        <div class="flex flex-col account-card">
            <img src="<?= base_url('assets/img/banner-1.jpg') ?>" class="bg-card" alt="">
            <div class="header pl-18 flex flex-col md-flex-row v-center col-gap-12">
                <img src="<?= $member->picture == null ? base_url('assets/img/profile-1.png') : base_url("uploads/media/user/profile-picture/$member->picture") ?>" class="photo-profile" alt="">
                <div class="flex flex-col">
                    <h3 class="mb-0 mt-0">Hi, <?= $member->name ?></h3>
                </div>
            </div>
            <form action="<?php echo base_url(); ?>/member/akun/save" autocomplete="off" method="POST" enctype="multipart/form-data">
            <div class="data flex flex-col lg-flex-row col-gap-12">
                <div class="flex flex-col fg-1 ">
                    <div id="change-photo" class="input-group flex flex-col mb-12 d-none">
                        <label for="foto" class="mb-8">Ubah foto profile <span class="text-small text-gray">(Max. size 1Mb)</span></label>
                        <input
                        id="foto" name="foto"
                        type="file"
                        class="form-input full-width"
                        />
                         <?php if (session()->getFlashdata('fotoError')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('fotoError'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="input-group flex flex-col">
                    <label for="name" class="mb-8">Nama<span class="text-red">*</span></label>
                        <input
                            id="name" name="name"
                            type="text"
                            class="form-input full-width"
                            value="<?= old('name')  ? old('name') : $member->name ?>"
                            disabled
                        />
                        <?php if (session()->getFlashdata('nameError')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('nameError'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="input-group flex flex-col mt-12">
                    <label for="email" class="mb-8">Email<span class="text-red">*</span></label>
                        <input
                            id="email" name="email"
                            type="email"
                            class="form-input full-width"
                            value="<?= old('email')  ? old('email') : $member->email ?>"
                            disabled
                        />
                         <?php if (session()->getFlashdata('emailError')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('emailError'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="input-group flex flex-col mt-12">
                        <label for="univ" class="mb-8">Asal Universitas<span class="text-red">*</span></label>
                        <input
                            id="univ" name="univ"
                            type="text"
                            class="form-input full-width"
                            value="<?= old('univ')  ? old('univ') : $member->univ ?>"
                            disabled="disabled"
                        />
                         <?php if (session()->getFlashdata('univError')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('univError'); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if($member->nim != null): ?>
                        <div id="nimInput" class="input-group flex flex-col mt-12 ">
                        <label for="nim" class="mb-8">NIM<span class="text-red">*</span></label>
                        <input
                            id="nim" name="nim"
                            type="number"
                            class="form-input full-width"
                            value="<?= old('nim')  ? old('nim') : $member->nim ?>"
                            disabled="disabled"
                        />
                        <?php if (session()->getFlashdata('nimError')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('nimError'); ?></span>
                        <?php endif; ?>
                        </div>
                    <?php endif;?>
                    <div class="input-group flex flex-col mt-12">
                    <label for="phone" class="mb-8">No. Handphone<span class="text-red">*</span></label>
                        <input
                            id="phone" name="phone"
                            type="number"
                            class="form-input full-width"
                            value="<?= old('phone')  ? old('phone') : $member->phone ?>"
                            placeholder="0812xxxxxxx"
                            disabled="disabled"
                        />
                         <?php if (session()->getFlashdata('phoneError')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('phoneError'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="input-group flex flex-col mt-12">
                    <label for="line" class="mb-8">ID Line<span class="text-red">*</span></label>
                        <input
                            id="line" name="line"
                            type="text"
                            class="form-input full-width"
                             value="<?= old('line')  ? old('line') : $member->id_line ?>"
                            placeholder="@line_id"
                            disabled="disabled"
                        />
                         <?php if (session()->getFlashdata('lineError')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('lineError'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col ktm mobile-only">
                        <img src="<?= base_url("uploads/media/user/ktm/$member->ktm") ?>" class="ktm-image" alt="">
                         <input
                            id="ktm" name="ktm"
                            type="file"
                            class="form-input d-none"
                        />
                        <span name="ktm" class="text-small d-none">Max. size 2Mb</span>
                    </div>
                    <div class="full-width flex flex-row mt-12 col-gap-12">
                        <button id="save-button" type="submit" value="submit" class="button-primary bg-yellow d-none">Simpan</button>
                        <a href="<?= base_url('/member/akun') ?>" id="cancel-button" class="button-primary bg-gray d-none">Batal</a>
                    </div>
                    <button id="edit-button" class="button-primary w-fit-content" type="button">Edit Data</button>
                </div>
                <div class="flex flex-col desktop-only" style="max-width: 200px;">
                    <img src="<?= base_url("uploads/media/user/ktm/$member->ktm") ?>" class="ktm-image" alt="">
                    <input
                        id="ktm" name="ktm"
                        type="file"
                        class="form-input d-none"
                        style="max-width: 200px;"
                    />
                    <span name="ktm" class="text-small d-none">Max. size 2Mb</span>
                </div>
                 <input id="ktmName" name="ktmName" type="hidden" value="<?= $member->ktm ?>"/>
                 <input id="pictName" name="pictName" type="hidden" value="<?= $member->picture ?>"/>
                </form>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    const editButton = document.getElementById('edit-button');
    const saveButton = document.getElementById('save-button');
    const cancelButton = document.getElementById('cancel-button');
    const upload = document.getElementsByName('ktm');
    const formInput = document.getElementsByClassName('form-input');
    const photo = document.getElementById('change-photo');

    document.addEventListener("DOMContentLoaded", function() {
        <?php if(session()->getFlashdata('error')): ?>
            editButton.click()
        <?php endif; ?>
    });

    editButton.addEventListener('click', () => {
        editButton.classList.toggle('d-none');
        saveButton.classList.toggle('d-none');
        cancelButton.classList.toggle('d-none');
        photo.classList.toggle('d-none');
        for(const data of formInput){
            data.disabled = false;
        }
        for(const data of upload){
            data.classList.toggle('d-none');
        }
        formInput[0].focus();
    })

    cancelButton.addEventListener('click', () => {
        editButton.classList.toggle('d-none');
        saveButton.classList.toggle('d-none');
        cancelButton.classList.toggle('d-none');
        photo.classList.toggle('d-none');
        for(const data of formInput){
            data.disabled = true
        }
        upload.classList.toggle('d-none');
    })
</script>
<?= $this->endSection() ?>