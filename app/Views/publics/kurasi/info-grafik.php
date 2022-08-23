<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('head') ?>
   <link href="<?= base_url('assets/stylesheets/rin-foto-tunggal-style.css'); ?>" rel="stylesheet"/>
   <link href="<?= base_url('assets/slick/slick.css'); ?>" rel="stylesheet"/>
   <script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
      <div id="overlay" class="overlay d-none"></div>
 <?php foreach($data as $popup):?>
      <div id="<?= $popup['id_submission'] ?>" class="popup pb-64" >
         <div class="container">
            <div class="karya pt-24">
               <div class="flex flex-row full-width">
                  <div class="flex v-center col-gap-12 back-button" onclick="toggleDetails(<?= $popup['id_submission']; ?>)">
                     <i class="ri-arrow-left-line"></i><span>Back</span>
                 </div>
               </div>
               <hr class="mt-18">
               <div class="flex flex-col title">
                  <h1 class="mt-0 mb-0"><?= $popup['title'] ?></h1>
                  <span class="text-small">Oleh <?= $popup['name'] ?></span>
               </div>
                <hr class="mt-18">

                <div class="col" style="text-align: right;">
                  <span>Qualified for exhibition</span><br>
                  <form action="<?= base_url('/curator/qualified/').'/'.$popup['id_submission'] ?>" id="form-<?= $popup['id_submission'] ?>" method="POST">
                  <label class="switch">
                  <input id="<?= $popup['id_submission']; ?>" type="checkbox" onchange="toggleQualified(<?= $popup['id_submission'] ?>)"
                  <?php if($popup['qualified']) echo 'checked'  ?>
                  >
                  <span class="slider round"></span>
                  </label>
                  </form>
               </div>

               <div class="karya-image mt-24 flex h-center">
                     <img src="<?= base_url('/uploads/submission/info-grafik/').'/'.$popup['media'] ?>" loading="lazy" alt="">
               </div>
               <div class="caption">
                  <?= $popup['caption'] ?>
               </div>
            </div>
         </div>
      </div>
   <?php endforeach; ?>
   <section class="foto-tunggal">
      <div class="banner">
        <div class="container">
            <h1 class="mt-0 mb-0 uppercase f-32 title">Ruang Indiependen</h1>
            <h1 class="subtitle mt-0">INFO GRAFIK</h1>
        </div>
      </div>

     <?= $this->include('publics/kurasi/list-category') ?>

      <div class="container pb-12 pt-32">
         <div class="flex flex-col md-flex-row pt-24 photo-wrapper row-gap-18">
            <?php foreach($data as $data):?>
            <div class="photo-card" onclick="toggleDetails(<?= $data['id_submission']; ?>)">
                  <img src="<?= base_url('/uploads/submission/info-grafik/').'/'.$data['thumbnail_karya'] ?>" loading="lazy" alt="">
                  <div class="photo-text pl-12 pr-12 pb-18 pt-12">
                     <p><?= $data['title'] ?></p>
                     <span class="text-small text-grey"><?= $data['name'] ?></span>
                  </div>
            </div>
            <?php endforeach; ?>
         </div>
      </div>
      <div class="container flex v-center h-center mb-32">
          <?= $pager->links('data', 'bootstrap_pagination'); ?>
      </div>
   </section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
   <script
      src="https://code.jquery.com/jquery-2.2.4.min.js"
      integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="<?= base_url('assets/slick/slick.min.js') ?>"></script>
   <script>
       $(document).ready(() => {
          <?php if(session()->getFlashdata('qualifier')): ?>
            toggleDetails(<?= session()->getFlashdata('qualifier') ?>);
         <?php endif;?>
        $("#slide-category").slick(
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
       });
      function toggleDetails(id){
         var karya = document.getElementById(id);
         var overlay = document.getElementById('overlay');
         karya.classList.toggle('show');
         overlay.classList.toggle('d-none');
         $(document.body).hasClass('hide-scroll') ?  $(document.body).removeClass('hide-scroll overflow-hidden') : $(document.body).addClass('hide-scroll overflow-hidden')
      }
   </script>
<?= $this->endSection() ?>