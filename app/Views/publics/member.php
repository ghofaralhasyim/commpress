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
    
    <section class="homepage mb-32">
      <div class="homepage-banner full-width flex flex-col h-center">
        <img
          src="<?= base_url().'/uploads/media/web_settings/'.$homepage_banner->media; ?>"
          class="banner-background"
          alt="banner"
        />
        <div class="banner-caption flex flex-col h-center">
          <h1><?= $homepage_banner->title ?></h1>
          <h1><?= $homepage_banner->description ?></h1>
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
          <?php foreach ($lomba as $lomba) : ?>
            <a href="<?= base_url("/member/lomba/$lomba->slug"); ?>" style="text-decoration: none; color:#000;">
              <div class="card">
                <img src="<?= base_url("/uploads/media/lomba/thumbnail/$lomba->media"); ?>" alt="image" />
                <div class="card-text p-16 f--light"><?= $lomba->name; ?></div>
              </div>
            </a>
          <?php endforeach;?>
        </div>
      </div>

      <div class="pesan mt-24 pesan-container">
        <h1 class="full-width">PESAN UNTUK KAMU</h1>
        <div class="flex flex-row">
          <div class="card-container full-width p-16">
            <div class="slick-pesan">
              <div class="card p-16">
                <div class="profile flex flex-row col-gap-8 v-center pb-12">
                  <img src="<?= base_url('assets/img/profile-1.jpg') ?>" alt="pict" />
                  <span>Dev. Commpress</span>
                </div>
                <div class="message pt-12 pb-12">Halo gengs!</div>
              </div>
              <div class="card p-16">
                <div class="profile flex flex-row col-gap-8 v-center pb-12">
                  <img src="<?= base_url('assets/img/profile-1.jpg') ?>" alt="pict" />
                  <span>Dev. Sponsor</span>
                </div>
                <div class="message pt-12 pb-12">Kunjungi kami di Github!</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="video-section">
        <h1 class="full-width">Video unggulan</h1>
        <div class="flex flex-col lg-flex-row col-gap-18 row-gap-18">
          <div class="video-thumbnail flex flex-col full-width fg-1">
            <a href="#">
              <img
                src="<?= base_url('/assets/img/thumbnail-video-1.jpg') ?>"
                alt="video-thumbnail"
              />
              <div
                class="play-button full-width full-height flex flex-col v-center h-center"
              >
                <i class="ri-play-circle-fill text-white f-46"></i>
              </div>
              <div
                class="caption full-width pl-24 pb-24 full-height flex flex-col h-end"
              >
                <span class="f-24">Opening COMMPRESS 2022</span>
              </div>
            </a>
          </div>
          <div class="flex flex-col fg-1">
            <div class="flex flex-row col-gap-18 full-width">
              <div class="video-thumbnail-mini fg-1">
                <a href="#">
                  <img
                    src="<?= base_url('/assets/img/thumnail-video-2.jpg') ?>"
                    alt="video-thumbnail"
                  />
                  <div
                    class="play-button full-width full-height flex flex-col v-center h-center"
                  >
                    <i class="ri-play-circle-fill text-white f-32 pb-48"></i>
                  </div>
                  <div
                    class="caption-mini full-width pl-24 pb-18 full-height flex flex-col h-end"
                  >
                    <span class="f-14">Tips Fotografi</span>
                  </div>
                </a>
              </div>
              <div class="video-thumbnail-mini fg-1">
                <a href="#">
                  <img
                    src="<?= base_url('/assets/img/thumnail-video-2.jpg') ?>"
                    alt="video-thumbnail"
                  />
                  <div
                    class="play-button full-width full-height flex flex-col v-center h-center"
                  >
                    <i class="ri-play-circle-fill text-white f-32 pb-48"></i>
                  </div>
                  <div
                    class="caption-mini full-width pl-24 pb-18 full-height flex flex-col h-end"
                  >
                    <span class="f-14">Opening COMMPRESS 2022</span>
                  </div>
                </a>
              </div>
            </div>
            <div class="main-description full-width">
              <h1 class="f-italiana">Opening COMMPRESS 2022</h1>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque,
                magni in. Harum, assumenda corrupti iure fugiat fugit cupiditate
                voluptas ipsam, qui non laborum nobis consectetur delectus
                reprehenderit quo hic sequi!
              </p>
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