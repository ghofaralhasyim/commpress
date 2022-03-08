<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comm-press Recruitment</title>

    <link href="<?= base_url('assets/stylesheets/Oprec.css'); ?>" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    
    <?= $this->include('publics/oprec/navbar') ?>

    <section class="home">
        <div class="home__container" style="top: -10%;">
            <div class="form__wrapper">
                <?php if($dataPanit != null): ?>
                <h1 class="home_title clr_yellow-primary">
                    Congratulation
                </h1>
                <h1 class="home_subtitle" style="margin-top: -.5rem; text-transform:capitalize;">
                    <?= $dataPanit['name']; ?>!
                </h1>
                <p>
                    Kamu lolos ke tahap <strong> wawancara! </strong> <br> <br> Untuk informasi lebih lanjut mengenai tahap wawancara, silakan periksa email student-mu.
                </p>
                <?php else: ?>
                    <h1 class="home_title clr_yellow-primary">
                    Dont Give Up!
                    </h1>
                    <br>
                    <p>
                            Terima kasih telah mendaftar dan mempercayai Comm-press UMN sebagai wadah berproses dan berkembang. <br> Mohon maaf kamu <b>belum diterima</b>. 
                            Jangan berkecil hati dan tetap semangat!!
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?= $this->include('publics/oprec/footer') ?>
</body>
    <script>
        //*======== MENU SHOW Y HIDDEN ======= */
        const navMenu = document.getElementById('nav-menu'),
            toggler = document.getElementById('nav-toggler'),
            closeMenu = document.getElementById('nav-close')

        // SHOW NAVBAR MOBILE
        toggler.addEventListener('click', ()=>{
            navMenu.classList.toggle('show')
            toggler.classList.add('d-none')
        })
        // HIDDEN NAVBAR MOBILE
        closeMenu.addEventListener('click', ()=>{
            navMenu.classList.remove('show')
            toggler.classList.remove('d-none')
        })
    </script>
</html>