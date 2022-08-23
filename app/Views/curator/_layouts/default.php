<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= base_url('assets/stylesheets/Dashboard.css'); ?>" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <?= $this->renderSection('head'); ?>
    <title>Curator Commpress</title>
</head>
<body>
    <?php $url = uri_string(true);?>

    <div class="bd-grid">
        <div class="sidebar" id="sidebar">
            <div class="sideNav">
                <div class="sideNav__brand">
                    <img class="sideNav__brand--icon" src="<?= base_url('assets/icon/commpress-256.png'); ?>" alt="Comm-press">
                </div>
                
                <?php foreach($pameran as $data): ?>
                    <div class="sideNav__menu">
                        <a style="text-decoration: none;" href="<?= base_url()."/curator/$data->slug"; ?>" class="sideNav__link <?php if(!strcmp($url,"/curator/$data->slug")){echo 'active';} ?>">
                            <div class="sideNav__icon" style="font-size: 80%;"><i class="ri-landscape-line"></i><span> <?= $data->name ?></span></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <section class="bd-dasboard" id="bd-dasboard">
            <nav class="topNav">
                <div class="topNav__toggler">
                    <i class="ri-function-line" id="nav-toggler"></i>
                </div>

                <div class="topNav__menu">
                    <ul class="topNav__list">
                        <li class="topNav__item"><a href="<?= base_url('/keluar') ?>" style="text-decoration: none;" class="topNav__link">Logout</a></li>
                    </ul>
                </div>
            </nav>

            <div class="content pb-32">

                <?= $this->renderSection('content'); ?>
            
            </div>
        </section>
    </div>
</body>
    <style>
        body {
            margin: 0 !important;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
        }
    </style>
    <script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?= $this->renderSection('script'); ?>
    <script language="JavaScript" type="text/javascript">
        const toggler = document.getElementById('nav-toggler'),
                    sidebar = document.getElementById('sidebar'),
                    dasboard = document.getElementById('bd-dasboard')

        toggler.addEventListener('click', ()=>{
            dasboard.classList.toggle('sidebar-toggled');
        });
    </script>
</html>