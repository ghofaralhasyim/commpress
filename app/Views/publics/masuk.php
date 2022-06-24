<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comm-press</title>

    <link href="<?= base_url('assets/stylesheets/sign-in-style.css'); ?>" rel="stylesheet" def/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>

    <?= $this->include('publics/_layouts/navbar') ?>
    
    <div class="login bg-grain">
      <div class="container flex flex-col v-center text-center">
        <div class="login-wrapper">
          <h1>SELAMAT DATANG</h1>
          <form action="#" class="flex flex-col full-width text-left">
            <div class="input-group flex flex-col">
              <label for="email" class="mb-8"
                >Email <span class="text-red">*</span></label
              >
              <input
                type="email"
                class="form-input full-width"
                placeholder="email@address.com"
              />
            </div>
            <div class="input-group flex flex-col mt-24">
              <label for="password" class="mb-8"
                >Kata Sandi <span class="text-red">*</span></label
              >
              <input
                type="email"
                class="form-input full-width"
                placeholder="email@address.com"
              />
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

<script src="<?= base_url('assets/js/homepage.js'); ?>"></script>
</html>