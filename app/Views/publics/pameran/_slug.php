<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('head') ?>
<link href="<?= base_url('assets/stylesheets/lomba-style.css'); ?>" rel="stylesheet"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="lomba pb-64">
        <div class="container">
            <img src="<?= base_url("uploads/media/pameran/banner/$pameran->banner"); ?>" class="lomba-image mt-12" alt="image">
            <?php if($regist > 0): ?>
                <div class="full-width">
                    <p class="full-width bg-gray notif p-12 f-14 ">
                        Kamu telah terdaftar sebagai peserta <?= $pameran->name ?>. <a href="<?= base_url('/member/submission')?>" class="text-red">
                        Upload karya kamu disini.
                        </a>
                    </p>
                </div>
            <?php endif; ?>
            <div class="q-content">
                <?= $pameran->description; ?>
            </div>
            <?php if(!$regist > 0 && $pameran->status !== 'closed') :?>
            <h1 class="uppercase">DAFTAR </h1>
            <form action="<?php echo base_url(); ?>/member/pameran/regist" autocomplete="off" method="POST" enctype="multipart/form-data">
                <input
                    id="id_member" name="id_member"
                    type="hidden"
                    class="form-input full-width"
                    value="<?= $user->id_member ?>"
                />
                <input
                    id="id_pameran" name="id_pameran"
                    type="hidden"
                    class="form-input full-width"
                    value="<?= $pameran->id_pameran ?>"
                />
                <div class="input-group flex flex-col">
                <label for="name" class="mb-8">Nama<span class="text-red">*</span></label>
                    <input
                        id="name" name="name"
                        type="text"
                        class="form-input full-width"
                        value=" <?= $user->name ?>"
                        disabled
                    />
                </div>
                <div class="input-group flex flex-col">
                <label for="email" class="mb-8">Email<span class="text-red">*</span></label>
                    <input
                        id="email" name="email"
                        type="email"
                        class="form-input full-width"
                        value=" <?= $user->email ?>"
                        disabled
                    />
                </div>
                <div class="input-group flex flex-col mt-12">
                    <label for="univ" class="mb-8">Asal Universitas<span class="text-red">*</span></label>
                    <input
                        id="univ" name="univ"
                        type="text"
                        class="form-input full-width"
                        value="<?php if($user->univ){echo $user->univ;}else{echo old('univ');} ?>"
                        placeholder="Universitas Multimedia Nusantara"
                    />
                    <?php if (session()->getFlashdata('univ')) : ?>
                        <span class="text-red text-small mt-8"><?= session()->getflashdata('univ'); ?></span>
                    <?php endif; ?>
                </div>
                <div id="nimInput" class="input-group flex flex-col mt-12  d-none">
                    <label for="nim" class="mb-8">NIM<span class="text-red">*</span></label>
                    <input
                        id="nim" name="nim"
                        type="number"
                        class="form-input full-width"
                        value="<?php if($user->nim){echo $user->nim;}else{echo old('nim');} ?>"
                        placeholder="00000012345"
                    />
                </div>
                <div class="input-group flex flex-col mt-12">
                <label for="phone" class="mb-8">No. Handphone<span class="text-red">*</span></label>
                    <input
                        id="phone" name="phone"
                        type="number"
                        class="form-input full-width"
                        value="<?php if($user->phone){echo "0".$user->phone;}else{echo old('phone');} ?>"
                        placeholder="0812xxxxxxx"
                    />
                    <?php if (session()->getFlashdata('phone')) : ?>
                        <span class="text-red text-small mt-8"><?= session()->getflashdata('phone'); ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-group flex flex-col mt-12">
                <label for="line" class="mb-8">ID Line<span class="text-red">*</span></label>
                    <input
                        id="line" name="line"
                        type="text"
                        class="form-input full-width"
                        value="<?php if($user->id_line){echo $user->id_line;}else{echo old('line');} ?>"
                        placeholder="@line_id"
                    />
                    <?php if (session()->getFlashdata('line')) : ?>
                        <span class="text-red text-small mt-8"><?= session()->getflashdata('line'); ?></span>
                    <?php endif; ?>
                </div>
                <button class="button-primary mt-12" type="submit">Daftar</button>
            </form>    
            <?php endif;?>       
            <?php if($pameran->status === 'closed'): ?>
            <div class="full-width">
                    <p class="full-width bg-gray notif p-12 f-14 ">
                        Pendaftaran Ruang Indiependen: <?= $pameran->name ?> belum dibuka. Untuk informasi lebih lanjut 
                        <a href="https://www.instagram.com/ruang.indiependen/" targe="blank" class="text-red"> hubungi kami.</a>
                    </a>
                </p>
            </div>
            <?php endif; ?>
        </div>
   </section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="<?= base_url('assets/js/detailLomba.js'); ?>"></script>
<?= $this->endSection() ?>