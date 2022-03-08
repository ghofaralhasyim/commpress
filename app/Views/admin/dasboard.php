<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= base_url('assets/stylesheets/Dasboard.css'); ?>" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <title>Comm-press Dasboard</title>
</head>
<body>
    <?php $url = uri_string(true);?>

    <div class="bd-grid">
        <div class="sidebar" id="sidebar">
            <div class="sideNav">
                <div class="sideNav__brand">
                    <img class="sideNav__brand--icon" src="<?= base_url('assets/icon/commpress-256.png'); ?>" alt="Comm-press">
                </div>
                
                <div class="sideNav__menu">
                    <a style="text-decoration: none;" href="<?php base_url() ?>/dasboard/oprec" class="sideNav__link <?php if(!strcmp($url,"dasboard/oprec")){echo 'active';} ?>">
                        <div class="sideNav__icon"><i class="ri-user-3-line"></i><span> Oprec</span></div>
                    </a>
                    <a style="text-decoration: none;" href="<?php base_url() ?>/dasboard" class="sideNav__link <?php if(!strcmp($url,"dasboard")){echo 'active';} ?>">
                        <div class="sideNav__icon"><i class="ri-edit-2-line"></i><span> Registration</span></div>
                    </a>
                </div>
            </div>
        </div>

        <section class="bd-dasboard" id="bd-dasboard">
            <nav class="topNav">
                <div class="topNav__toggler">
                    <i class="ri-function-line" id="nav-toggler"></i>
                </div>

                <div class="topNav__menu">
                    <ul class="topNav__list">
                        <li class="topNav__item"><a href="<?= base_url('/logout') ?>" style="text-decoration: none;" class="topNav__link">Logout</a></li>
                    </ul>
                </div>
            </nav>

            <div class="content">

                <?= $this->renderSection('content'); ?>
            
            </div>
        </section>
    </div>
</body>
    
    <script language="JavaScript" type="text/javascript">
        const toggler = document.getElementById('nav-toggler'),
                    sidebar = document.getElementById('sidebar'),
                    dasboard = document.getElementById('bd-dasboard')

        toggler.addEventListener('click', ()=>{
            dasboard.classList.toggle('sidebar-toggled');
        });
    </script>
</html>