<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= base_url('assets/stylesheets/Login.css'); ?>" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <!-- HEADER | NAVIGATION -->
        <nav class="nav bd-grid">
            <div>
                <a href="<?= base_url('/') ?>" class="nav__brand"><img src="<?= base_url('assets/icon/compress-white-256.png'); ?>" alt="Comm-press"></a>
            </div>
            <div class="nav__toggle" id="nav-toggler">
                <i class="ri-function-line"></i>
            </div>
            <div class="nav__menu" id="nav-menu">
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line nav__close" id="nav-close"></i>
                </div>

                <ul class="nav__list">
                    <li class="nav__item"><a href="<?= base_url('/') ?>" class="nav__link">Home</a></li>
                </ul>
            </div>
        </nav>
    </div>
    
    <div class="bd-container">
        <div class="bd-box box-white">
            <div class="bd-box-title">Sign In</div>
            <p>Hi, Have a nice day!</p>
            <p class="alert">
                <?php if (session()->getFlashdata('error')){
                    echo session()->getflashdata('error');
                }?>
            </p>
            <form action="<?php echo base_url(); ?>/hooman" method="POST">
                <div class="input-group">
                    <label for="username"><i class="ri-mail-line"></i></label>
                    <input type="text" id="username" name="username" placeholder="username" value="<?= old('username') ?>"/>
                </div>
                <div class="input-group">
                    <label for="passwd"><i class="ri-lock-line"></i></label>
                    <input type="password" id="password" name="password" placeholder="password"/>
                </div>
                <button type="submit" class="ml-2 btn btn-blue">Sign In</button>
            </form>
        </div>
    </div>
    
</body>
    <script>
        const navMenu = document.getElementById('nav-menu'),
        toggler = document.getElementById('nav-toggler'),
        closeMenu = document.getElementById('nav-close')

        toggler.addEventListener('click', ()=>{
            navMenu.classList.toggle('show')
            toggler.classList.add('d-none')
        })
 
        closeMenu.addEventListener('click', ()=>{
            navMenu.classList.remove('show')
            toggler.classList.remove('d-none')
        })
    </script>
</html>