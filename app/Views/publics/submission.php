<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('head') ?>
    <link href="<?= base_url('assets/stylesheets/member-style.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/stylesheets/lomba-style.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('/assets/slick/slick.css'); ?>" rel="stylesheet"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="pb-64">

            <section class="container p-8 text-small mt-32">
              <div class="card flex flex-col p-12">
                <h2 class="mt-8 mb-0">Informasi!</h2>
                <p>
                  Hai hai hai, jurnalis muda! Buat kalian yang sudah mendaftar dan mengirimkan karya, 
                  siapkan catatan dan kalender kalian untuk tanggal-tanggal penting di bawah ini ya!
                </p>
                <h4 class="mt-0 mb-0">> Road to Young Journalist Award</h4>
                <p>
                  Rangkaian ini penting untuk kalian karena akan ada <b>pembacaan nominasi 5 karya terbaik</b> dari tiap kategori pameran dan lomba. <br>
                  Hari/tanggal: <br>
                  - Kamis, 22 September 2022; Pukul 11.00 WIB dan 14.00 WIB untuk nominasi pameran Ruang Indiependen <br>
                  - Jumat, 23 September 2022; Pukul 11.00 WIB dan 14.00 WIB untuk nominasi lomba <br>
                  Tempat: Instagram Live @commpressumn
                </p>
                <h4 class="mt-0 mb-0">> Young Journalist Award</h4>
                <p>
                  Yang ditunggu-tunggu, nih. <b>Malam penganugerahan</b> bagi para peserta lomba dan pameran Ruang Indiependen. 
                  Pastinya akan ada reveal pemenang dan after party bareng guest star juga lho. <br>
                  Hari/tanggal: Sabtu, 24 September 2022 <br>
                  Tempat: Zoom Meeting (tautan menyusul) <br> <br>

                  Sekian informasi dari divisi Acara. Terima kasih untuk perhatiannya. Semangat dan sukses untuk para peserta!
                </p>
              </div>
            </section>


            <section class="container p-12 " style="min-height: auto;">
               <div class="flex full-width flex flex-col lg-flex-row v-center--spread mt-12 h-center">
                    <span class="f-italiana f-32 f--bold">Lomba</span>
                    <p>
                    Kamu masih bisa mendaftar <span class="f--bold"><?= 3-$count_lomba ?> lomba lagi.</span>
                    Daftar segera!
                    </p>
                </div>
            </section>

            <?php if($count_lomba > 0): ?>
            <section class="container p-8">
                <?php foreach ($lomba_regist as $data) : ?> 
                  <div class="flex flex-col card p-16 v-center--spread mb-12">
                      <div class="flex flex-row v-center--spread">
                        <span class="f-18"><?= $data->name; ?></span>
                        <a href="<?= base_url("/member/daftar/lomba/$data->slug") ?>" class="button-primary pl-12 pr-12 pt-0 pb-0">Detail</a>
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

            <section class="container mt-32 p-12 " style="min-height: auto;">
                <div class="flex full-width flex flex-col lg-flex-row v-center--spread mt-12 h-center">
                    <span class="f-italiana f-32 f--bold">Ruang Indiependen</span>
                    <p>
                    Kamu masih bisa mendaftarkan <span class="f--bold"><?= 3-$count_pameran ?> karya lagi.</span>
                    Daftar segera!
                    </p>
                </div>
            </section>

            <?php if($count_pameran > 0): ?>
            <section class="container p-8">
                <?php foreach ($pameran_regist as $data) : ?> 
                  <div class="flex flex-col card p-16 v-center--spread mb-12">
                      <div class="flex flex-row v-center--spread">
                        <span class="f-18"><?= $data->name; ?></span>
                        <a href="<?= base_url("/member/daftar/pameran/$data->slug") ?>" class="button-primary pl-12 pr-12 pt-0 pb-0">Detail</a>
                      </div>
                      <div class="progress-container mt-16">
                        <progress class="progress-lomba" 
                          value="<?php if($data->regist_status === 'confirmed'){echo 5;}
                          else{echo 7;}?>" max="7">
                        </progress>
                        <div class="icon-list">
                            <span class="text-small">
                          </span>
                          <span class="text-small">
                            <img src="<?= base_url('/assets/icon/circle-add.png') ?>" alt="">
                            Pendaftaran
                          </span>
                          <span class="text-small">
                          </span>
                          <span class="text-small">
                            <img src="<?= base_url('/assets/icon/circle-upload.png') ?>" alt="">
                            Submit karya
                          </span>
                          <span class="text-small">
                          </span>
                        </div>
                      </div>
                  </div>
                 <?php endforeach; ?> 
            </section>
            <?php else: ?>
              <section class="container mt-32">
                <div class="bg-yellow p-12 text-small" style="color:#ad782a; border-radius:4px;">Kamu belum terdaftar untuk mengikuti Ruang Indiependen.</div>
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