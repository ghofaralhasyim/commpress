
    <header class="navbar-grid">
      <nav class="nav container">
        <div class="flex flex-row v-center nav-left">
          <a href="<?= base_url('/') ?>" class="nav-brand">
            <img
              src="<?= base_url('./assets/icon/compress-white-256.png') ?>"
              width="80px" 
              height="36px"
              alt="commpress-logo"
            />
          </a>
          <?php if(session()->get('logged_in')): ?>
          <ul class="nav-list ml-32 desktop-only">
             <li class="nav-item"><a href="<?= base_url('/member/lomba') ?>" class="nav-link">Lomba</a></li>
          </ul>
          <?php endif; ?>
        </div>

        <div class="nav-toggle" id="nav-toggler">
          <i class="ri-function-line"></i>
        </div>

        <div class="nav-menu nav-right" id="nav-menu">
          <ul class="nav-list">
            <li class="nav-item nav-close">
              <i class="ri-close-line nav-link" id="nav-close"></i>
            </li>
            <?php if(!session()->get('logged_in')): ?>
              <li class="nav-item"><a href="/masuk" class="nav-link">Masuk</a></li>
              <li class="nav-item"><a href="/daftar" class="nav-link">Daftar</a></li>
            <?php else : ?>
              <li class="nav-item"><a href="<?= base_url('/member/lomba') ?>" class="nav-link">Lomba</a></li>
              <li class="nav-item"><a href="/keluar" class="nav-link">Keluar</a></li>
            <?php endif ?>
          </ul>
        </div>
        <div class="nav-menu desktop-only">
            <ul class="nav-list">
              <?php if(!session()->get('logged_in')): ?>
                <li class="nav-item"><a href="/masuk" class="nav-link">Masuk</a></li>
                <li class="nav-item"><a href="/daftar" class="nav-link">Daftar</a></li>
              <?php else: ?>
                <li class="nav-item">
                 <div class="nav-dropdown" >
                    <span id="nav-dropdown" class="cursor-pointer"><img src="<?= session()->get('picture') != null ? base_url("uploads/media/user/profile-picture/".session()->get('picture')) : base_url('assets/images/qr.png')  ?>" class="profile-photo" alt=""></span>
                    <div id="nav-dropdown-content" class="nav-dropdown-content">
                        <a href="<?= base_url('/member/akun') ?>">Akun</a>
                        <a href="/keluar">Keluar</a>
                    </div>
                  </div>
                </li>
              <?php endif; ?>
            </ul>
        </div>
      </nav>
    </header>