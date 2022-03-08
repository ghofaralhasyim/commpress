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
                Recruitment Result
            </h1>
            <h1 class="home_subtitle">
                COMMPRESS 2022
            </h1>
            <form action="<?= base_url('/oprec-result')?>"  method="POST" class="mt-2">
                <div class="input_group">
                    <input type="number" required id="nim" name="nim" placeholder="Masukkan NIM Tanpa Nol"/>
                </div>
                <button type="submit" class="ml-2 btn btn-blue">Get results!</button>
            </form>
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