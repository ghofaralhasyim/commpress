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
        <div class="home__container">
            <div class="form__wrapper">
            <h1 class="home_title clr_yellow-primary" style="text-transform: uppercase;">
                Commpress 2022
            </h1>
            <h1 class="home_subtitle">
                Beyond The Walls
            </h1>
            <br>
            <p>
                COMMPRESS merupakan acara tahunan prodi Jurnalistik Universitas Multimedia Nusantara yang terdiri 
                dari Pameran Ruang Indiependen, Seminar, dan juga malam puncak Young Journalist Award. 
                Kini, COMMPRESS 2022 hadir dengan mengusung tagline "Beyond The Walls" 
                untuk menembus segala hambatan yang ada.
            </p>
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