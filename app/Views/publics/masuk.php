<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comm-press</title>

    <link href="<?= base_url('assets/stylesheets/signin-user-style.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/stylesheets/base-style.css'); ?>" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>

    <?= $this->include('publics/_layouts/navbar') ?>
    
    <div class="login bg-grain">
      <div class="container flex flex-col v-center text-center">
        <div class="login-wrapper">
          <h1>SELAMAT DATANG</h1>
          <form autocomplete="off" action="<?php echo base_url(); ?>/masuk" method="POST" class="flex flex-col full-width text-left">
            <div class="input-group flex flex-col">
              <label for="email" class="mb-8"
                >Email <span class="text-red">*</span></label
              >
              <input
                id="email" name="email"
                type="email"
                class="form-input full-width"
                placeholder="email@address.com"
                value="<?= old('email') ?>"
              />
              <?php if (session()->getFlashdata('email')) : ?>
                <span class="text-red text-small mt-8"><?= session()->getflashdata('email'); ?></span>
              <?php endif; ?>
            </div>
            <div class="input-group flex flex-col mt-16">
              <label for="password"  class="mb-8"
                >Kata Sandi <span class="text-red">*</span></label
              >
              <input
                id="password" name="password"
                type="password"
                class="form-input full-width"
                placeholder="Kata Sandi"
                value="<?= old('password') ?>"
              />
                <?php if (session()->getFlashdata('password')) : ?>
                  <span class="text-red text-small mt-8"><?= session()->getflashdata('password'); ?></span>
                <?php endif; ?>
                <span class="text-small mt-8 "><input type="checkbox" id="passView" class="cursor-pointer" onclick="passEye('password')">
                  <label for="passView" class="cursor-pointer">Tampilkan kata sandi.</label>
                </span>
            </div>
            <div class="flex flex-col v-center mt-32">
              <button type="submit" class="button-badge flex v-center h-center">
                MASUK
              </button>
            </div>
          </form>
          <div class="full-width text-center mt-12 text-small">
            Belum punya akun? Daftar <span class="text-red">disini</span>
          </div>
        </div>
      </div>
    </div>

    <?= $this->include('publics/_layouts/footer') ?>

</body>

<script src="<?= base_url('assets/js/navbar.js'); ?>"></script>
<script src="<?= base_url('assets/js/helpers.js'); ?>"></script>
</html>