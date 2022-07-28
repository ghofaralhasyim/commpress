<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('head') ?>
<link href="<?= base_url('assets/stylesheets/lomba-style.css'); ?>" rel="stylesheet"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="lomba pb-64">
        <div class="container">
            <img src="<?= base_url("uploads/media/lomba/banner/$lomba->banner"); ?>" class="lomba-image mt-12" alt="image">
            <?php if($regist > 0): ?>
                <div class="full-width">
                    <p class="full-width bg-gray notif p-12 f-14 ">
                        Kamu telah terdaftar pada lomba ini. <a href="<?= base_url('/member/submission')?>" class="text-red">Lihat detail registrasi.</a>
                    </p>
                </div>
            <?php endif; ?>
            <?= $lomba->description; ?>
            <?php if(!$regist > 0) :?>
            <h1 class="uppercase">DAFTAR </h1>
            <form action="<?php echo base_url(); ?>/member/lomba/regist" autocomplete="off" method="POST" enctype="multipart/form-data">
                <input
                    id="id_member" name="id_member"
                    type="hidden"
                    class="form-input full-width"
                    value=" <?= $user->id_member ?>"
                />
                <input
                    id="id_lomba" name="id_lomba"
                    type="hidden"
                    class="form-input full-width"
                    value="<?= $lomba->id_lomba ?>"
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
                <div id="ktm" class="input-group flex flex-col lg-flex-row mt-12 row-gap-12">
                    <?php if($user->ktm): ?>
                        <div class="flex fg-1 flex-col">
                            <span>KTM</span>
                            <img src="<?= base_url('uploads/media/user/ktm/').'/'.$user->ktm ?>" class="payment-img" alt="">
                        </div>
                    <?php endif; ?>
                    <div class="flex fg-1 flex-col">
                        <label for="ktm" class="mb-8"><?= $user->ktm ? 'Ubah foto ktm' : 'Foto KTM<span class="text-red">*</span>' ?></label>
                        <input
                            id="ktm" name="ktm"
                            type="file"
                            class="form-input full-width"
                        />
                        <?php if (session()->getFlashdata('ktm')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('ktm'); ?></span>
                        <?php endif; ?>
                    </div>
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
                <div class="flex flex-col lg-flex-row mt-12 col-gap-12">
                   <div class="flex fg-1" >
                    <img src="<?= base_url("assets/img/qr-airin.jpg") ?>" class="qr-payment"  alt="">
                   </div>
                   <div class="flex flex-col fg-1">
                    <p>
                        Biaya registrasi dapat dilakukan melalui transfer bank <br>
                        <b>BCA - 7615313262 (a/n NISRINA KHAIRUNNISA)</b>. <br><br>
                        Dengan format berita: <b>Nama Lomba_Nama</b> <br>
                        Contoh: <b>Photostory_Nadia</b>
                    </p>
                    <div class="flex flex-col input-group">
                        <label for="payment" class="mb-8">Bukti Pembayaran<span class="text-red">*</span></label>
                        <input
                            id="payment" name="payment"
                            type="file"
                            class="form-input full-width"
                        />
                        <?php if (session()->getFlashdata('payment')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('payment'); ?></span>
                        <?php endif; ?>
                    </div>
                   </div>
                </div>
                <button class="button-primary mt-12" type="submit">Daftar</button>
            </form>    
            <?php endif;?>       
        </div>
   </section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script src="<?= base_url('assets/js/detailLomba.js'); ?>"></script>
<?= $this->endSection() ?>