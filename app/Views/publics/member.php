<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comm-press</title>

    <link href="<?= base_url('assets/stylesheets/member-style.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/stylesheets/base-style.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/slick/slick.css'); ?>" rel="stylesheet"/>
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
      
      <?php if($media_sponsor != null): ?>
      <div class="media mt-32">
          <div class="container pt-18 pb-18">
          <div id="media-slide-homepage" class="media-wrapper flex flex-row col-gap-12">
              <?php foreach($media_sponsor as $media_sponsor): ?>
                  <div class="media-card flex flex-row">
                      <img src="<?= base_url("/uploads/media/media_sponsor/$media_sponsor->media") ?>" alt="">
                  </div>
              <?php endforeach; ?>
          </div>
          </div>
      </div>
      <?php endif; ?>

      <?php if($pameran != null): ?>
      <div
        class="lomba flex flex-col lg-flex-row col-gap-16 mt-32 lomba-container"
      >
        <div class="section-title flex flex-row lg-flex-col fg-1">
          <div class="flex flex-col">
            <span class="f-italiana f-32 f--bold">Ruang Indiependen</span>
            <p>
              Tunjukan karya terbaikmu!
            </p>
          </div>
          <div class="button-section">
            <a href="<?= base_url('/member/submission') ?>" class="button-primary">Lihat Pendaftaran</a>
          </div>
        </div>
        <div id="pameran-slide-homepage" class="slick-js">
          <?php foreach ($pameran as $pameran) : ?>
              <a href="<?= base_url("/member/pameran/$pameran->slug"); ?>" style="text-decoration: none; color:#000;">
              <div class="card">
                <img src="<?= base_url("/uploads/media/pameran/thumbnail/$pameran->thumbnail"); ?>" alt="image" />
                <div class="card-text p-16 f--light"><?= $pameran->name; ?></div>
              </div>
              </a>
          <?php endforeach;?>
        </div>
      </div>
      <?php endif;?>

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
                <div class="message pt-12 pb-12 text-small">Beberapa fitur web sedang dalam perbaikan. Mohon maaf atas ketidaknyamanannya.</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php if($media[0]): ?>
      <div class="flex flex-col lg-flex-row mt-32 col-gap-12 row-gap-12 media-container">
        <?php if($media[0]->content_type === 'video'): ?>
          <a href="<?= base_url("/member/media/").'/'.$media[0]->slug ?>" class="video-thumbnail">
          <div class="flex flex-col full-width" >
              <div class="overlay flex h-center v-center f-46 text-white"><i class="ri-play-circle-fill"></i></div>
              <img src="<?= base_url("/uploads/media/medrel/thumbnail").'/'.$media[0]->thumbnail ?>" width="100%" height="100%" class="media-thumbnail full-width" alt="">
          </div>
          </a>
        <?php endif; ?>
        <div class="flex flex-col media-description fg-1 full-width" style="">
          <h1 class="f-italiana mt-0 mb-0"><?= $media[0]->title ?></h1>
          <div class="full-width content">
            <?= $media[0]->description ?>
          </div>
          <a href="<?= base_url("/member/media/").'/'.$media[0]->slug ?>" class="text-red mt-8 read-more">Baca lebih lengkap...</a>
        </div>
      </div>
      <?php endif; ?>

      <?php if($lomba != null): ?>
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
            <a href="<?= base_url('/member/submission') ?>" class="button-primary">Lihat Pendaftaran</a>
          </div>
        </div>
        <div id="lomba-slide-homepage" class="slick-js">
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
      <?php endif; ?>

    </section>
    

    <?= $this->include('publics/_layouts/footer') ?>
</body>
<script
      src="https://code.jquery.com/jquery-2.2.4.min.js"
      integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="<?= base_url('assets/slick/slick.min.js') ?>"></script>
    <script type="text/javascript">
      $(document).ready(() => {
        $("#lomba-slide-homepage").slick(
          {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            variableWidth: true,
            infinite: true,
            speed: 300,
            responsive: [
              {
              breakpoint: 920,
              settings: {
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
              }
              },{
              breakpoint: 480,
              settings: {
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
              }
            }
            ]
          }
        );
        $("#pameran-slide-homepage").slick(
          {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            variableWidth: true,
            infinite: true,
            speed: 300,
            responsive: [
              {
              breakpoint: 920,
              settings: {
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
              }
              },{
              breakpoint: 480,
              settings: {
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
              }
            }
            ]
          }
        );
        $("#media-slide-homepage").slick(
          {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            variableWidth: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
              {
              breakpoint: 920,
              settings: {
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
              }
              },{
              breakpoint: 480,
              settings: {
                infinite: true,
                slidesToShow: 1,
                centerMode: true,
                centerPadding: '40px',
                slidesToScroll: 1,
              }
            }
            ]
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

<script src="<?= base_url('assets/js/navbar.js'); ?>"></script>
<script src="<?= base_url('assets/js/helpers.js'); ?>"></script>
</html>