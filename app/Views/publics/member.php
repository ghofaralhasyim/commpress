<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comm-press</title>

    <link href="<?= base_url('assets/stylesheets/member-style.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/stylesheets/base-style.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('/assets/slick/slick.css'); ?>" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>

    <?= $this->include('publics/_layouts/navbar') ?>
    
    <section class="homepage">
      <div class="homepage-banner full-width flex flex-col h-center">
        <img
          src="./assets/img/banner-1.jpg"
          class="banner-background"
          alt="banner"
        />
        <div class="banner-caption flex flex-col h-center">
          <h1>Hai jurnalis muda</h1>
          <h1>Siapkah kamu untuk mulai berkarya?</h1>
        </div>
      </div>

      <div
        class="lomba flex flex-col lg-flex-row col-gap-16 mt-48 lomba-container"
      >
        <div class="section-title flex flex-row lg-flex-col fg-1">
          <div class="flex flex-col">
            <span class="f-italiana f-32 f--bold">LOMBA</span>
            <p>
              Pilih diantara <span class="f--bold">6 lomba</span>
              dan jadilah yang terbaik!
            </p>
          </div>
          <div class="button-section">
            <a href="#" class="button-primary">Daftar sekarang</a>
          </div>
        </div>
        <div class="slick-js">
          <div class="card">
            <img src="./assets/img/unsplash_ToUPBCO62Lw.jpg" alt="image" />
            <div class="card-text p-16 f--light">Foto Tunggal</div>
          </div>
          <div class="card">
            <img src="./assets/img/unsplash_FtQE89f3EXA.jpg" alt="image" />
            <div class="card-text p-16 f--light">Video Dokumenter</div>
          </div>
          <div class="card">
            <img src="./assets/img/unsplash_VmtYoE_zeYk.jpg" alt="image" />
            <div class="card-text p-16 f--light">Podcast</div>
          </div>
          <div class="card">
            <img src="./assets/img/unsplash_VmtYoE_zeYk.jpg" alt="image" />
            <div class="card-text p-16 f--light">Podcast</div>
          </div>
        </div>
      </div>

      <div class="pesan mt-24 pesan-container">
        <h1 class="full-width">PESAN UNTUK KAMU</h1>
        <div class="flex flex-row">
          <div class="card-container full-width p-16">
            <div class="slick-pesan">
              <div class="card p-16">
                <div class="profile flex flex-row col-gap-8 v-center pb-12">
                  <img src="./assets/img/profile-1.jpg" alt="pict" />
                  <span>Dev. Commpress</span>
                </div>
                <div class="message pt-12 pb-12">Halo gengs!</div>
              </div>
              <div class="card p-16">
                <div class="profile flex flex-row col-gap-8 v-center pb-12">
                  <img src="./assets/img/profile-1.jpg" alt="pict" />
                  <span>Dev. Commpress</span>
                </div>
                <div class="message pt-12 pb-12">Halo lagi!</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?= $this->include('publics/_layouts/footer') ?>

     <script
      src="https://code.jquery.com/jquery-2.2.4.min.js"
      integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="<?= base_url('assets/slick/slick.min.js') ?>"></script>
    <script type="text/javascript">
      $(document).ready(() => {
        $(".slick-js").slick(
          {
            slidesToShow: 2,
            slidesToShow: 2,
            arrows: false,
            variableWidth: true,
            infinite: true,
            speed: 300,
          },
          {
            breakpoint: 920,
            settings: {
              centerMode: true,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          }
        );
        $(".slick-pesan").slick({
          slidesToShow: 1,
          slidesToShow: 1,
          arrows: false,
          variableWidth: true,
          infinite: false,
          speed: 300,
        });
      });
    </script>
</body>

<script src="<?= base_url('assets/js/navbar.js'); ?>"></script>
<script src="<?= base_url('assets/js/helpers.js'); ?>"></script>
</html>