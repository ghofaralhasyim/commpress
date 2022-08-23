<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('head') ?>
<link href="<?= base_url('assets/stylesheets/member-style.css'); ?>" rel="stylesheet"/>
<link href="<?= base_url('assets/stylesheets/landing-style.css'); ?>" rel="stylesheet"/>
<link href="<?= base_url('assets/slick/slick.css'); ?>" rel="stylesheet"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="landing">
        <section class="section-1">
            <div class="container">
                <div class="title flex flex-col">
                    <h1 class="mb-0">COMMPRESS UMN 2022 <br> BEYOND THE WALLS</h1>
                    <p>
                        COMMPRESS merupakan acara tahunan yang digelar oleh program studi 
                        Jurnalistik, Universitas Multimedia Nusantara (UMN) sejak tahun 2012.
                    </p>
                    <a href="/masuk" class="button-primary">
                        Ikuti Acara
                    </a>
                </div>
                <div class="content-1 flex flex-col lg-flex-row full-width v-center--spread">
                    <div class="flex flex-col c-1">
                        <h1 class="mt-0 mb-0">IT'S TIME TO MAKE A CHANGE WITH US!</h1>
                        <span class="flex flex-row v-center"><i class="ri-instagram-fill"></i>&nbsp;
                            <a href="https://www.instagram.com/commpressumn/" target="blank">
                                commpressumn
                            </a>
                        </span>
                    </div>
                    <div class="flex flex-col h-end">
                        <span>
                             <a href="#" target="blank">
                                Sponsorship & Media Relation
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <section class="media ">
            <div class="container pt-18 pb-18">
            <div id="media-slide-homepage" class="media-wrapper flex flex-row col-gap-12">
                <?php foreach($media_sponsor as $media_sponsor): ?>
                    <div class="media-card flex flex-row">
                        <img src="<?= base_url("/uploads/media/media_sponsor/$media_sponsor->media") ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
            </div>
        </section>

        <section class="section-2 container pb-18">
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
                    <a href="<?= base_url('/member/submission') ?>" class="button-primary">Daftar Sekarang</a>
                </div>
                </div>
                <div id="lomba-slide-homepage" class="slick-js">
                <?php foreach ($lomba as $lomba) : ?>
                    <a href="<?= base_url("/member/lomba/$lomba->slug"); ?>" style="text-decoration: none; color:#000;">
                    <div class="card mr-12">
                        <img src="<?= base_url("/uploads/media/lomba/thumbnail/$lomba->media"); ?>" alt="image" />
                        <div class="card-text p-16 f--light"><?= $lomba->name; ?></div>
                    </div>
                    </a>
                <?php endforeach;?>
                </div>
            </div>
        </section>

        <section class="section-3 container">
            <?php if($media[0]): ?>
            <div class="flex flex-col full-width lg-flex-row mt-32 col-gap-12 row-gap-12 media-container h-center">
                <?php if($media[0]->content_type === 'video'): ?>
                <a href="<?= base_url("/member/media/").'/'.$media[0]->slug ?>" class="video-thumbnail full-width">
                <div class="flex flex-col full-width" >
                    <div class="overlay flex h-center v-center f-46 text-white"><i class="ri-play-circle-fill"></i></div>
                    <img src="<?= base_url("/uploads/media/medrel/thumbnail").'/'.$media[0]->thumbnail ?>" width="100%" height="100%" class="media-thumbnail full-width" alt="" style="overflow: hidden; max-width:none;">
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
        </section>

        <section id="trailer" class="section-4 mt-48 ">
            <div class="flex full-height flex-col v-center h-center container">
                <iframe src="https://www.youtube.com/embed/UEiiZDK6_EY" 
                    controls=0 rel=0 title="Trailer COMMPRESS 2022" frameborder="0"  
                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
        </section>
    </div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
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
            speed: 100,
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
      });
</script>       
<?= $this->endSection() ?>