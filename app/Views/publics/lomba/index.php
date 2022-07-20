<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('head') ?>
    <link href="<?= base_url('assets/stylesheets/member-style.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/stylesheets/lomba-style.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('/assets/slick/slick.css'); ?>" rel="stylesheet"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="pb-64">

            <section class="homepage" style="min-height: auto;">
                <div class="lomba flex flex-col lg-flex-row col-gap-16 mt-48 lomba-container">
                <div class="section-title flex flex-row lg-flex-col fg-1">
                <div class="flex flex-col">
                    <span class="f-italiana f-32 f--bold">LOMBA</span>
                    <p>
                    Kamu masih bisa mendaftar <span class="f--bold"><?= 3-$count_regist ?> lomba lagi.</span>
                    Daftar segera!
                    </p>
                </div>
                </div>
                <div class="slick-js">
                    <?php foreach ($lomba as $lomba) : ?>
                        <?php if($lomba->status != 'closed'): ?>
                          <a href="<?= base_url("/member/lomba/$lomba->slug"); ?>" style="text-decoration: none; color:#000;">
                          <div class="card">
                            <img src="<?= base_url("/uploads/media/lomba/thumbnail/$lomba->media"); ?>" alt="image" />
                            <div class="card-text p-16 f--light"><?= $lomba->name; ?></div>
                          </div>
                          </a>
                        <?php endif; ?>
                    <?php endforeach;?>
                    </div>
                </div>

            </section>
            <?php if($count_regist > 0): ?>
            <section class="container mt-32 p-8">
                <?php foreach ($regist as $data) : ?> 
                  <div class="flex flex-col card p-16 v-center--spread ">
                      <div class="flex flex-row v-center--spread">
                        <span class="f-18"><?= $data->name; ?></span>
                        <a href="<?= base_url("/member/daftar/$data->slug") ?>" class="button-primary pl-12 pr-12 pt-0 pb-0">Detail</a>
                      </div>
                      <div class="progress-container mt-16">
                        <progress class="progress-lomba" 
                          value="<?php if($data->regist_status === 'pending'){ echo 1;}elseif($data->regist_status === 'confirmed'){echo 3;}
                          else{echo 6;}?>" max="6">
                        </progress>
                        <div class="icon-list">
                          <span class="text-small">
                            <img src="<?= base_url('/assets/icon/circle-add.png') ?>" alt="">
                            Pendaftaran
                          </span>
                          <span class="text-small">
                            <img src="<?= base_url('/assets/icon/circle-checklist.png') ?>" alt="">
                            Verifikasi
                          </span>
                          <span class="text-small">
                            <img src="<?= base_url('/assets/icon/circle-upload.png') ?>" alt="">
                            Submit karya
                          </span>
                        </div>
                      </div>
                  </div>
                 <?php endforeach; ?> 
            </section>
            <?php else: ?>
              <section class="container mt-32">
                <div class="bg-yellow p-12 text-small" style="color:#ad782a; border-radius:4px;">Kamu belum terdaftar dalam lomba apapun.</div>
              </section>
            <?php endif; ?>

</section>

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

<?= $this->endSection() ?>
<?= $this->section('script') ?>

<?= $this->endSection() ?>