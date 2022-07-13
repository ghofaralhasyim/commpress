
    <header class="navbar-grid">
      <nav class="nav container">
        <div>
          <a href="<?php if(!session()->get('logged_in')){ echo '/'; }else{ echo 'member';} ?>" class="nav-brand">
            <img
              src="<?= base_url('./assets/icon/compress-white-256.png') ?>"
              width="80px" 
              height="36px"
              alt="commpress-logo"
            />
          </a>
        </div>

        <div class="nav-toggle" id="nav-toggler">
          <i class="ri-function-line"></i>
        </div>

        <div class="nav-menu" id="nav-menu">
          <ul class="nav-list">
            <li class="nav-item nav-close">
              <i class="ri-close-line nav-link" id="nav-close"></i>
            </li>
            <?php if(!session()->get('logged_in')): ?>
              <li class="nav-item"><a href="/masuk" class="nav-link">Masuk</a></li>
              <li class="nav-item"><a href="/daftar" class="nav-link">Daftar</a></li>
            <?php else : ?>
              <li class="nav-item"><a href="/keluar" class="nav-link">Keluar</a></li>
            <?php endif ?>
          </ul>
        </div>
      </nav>
    </header>