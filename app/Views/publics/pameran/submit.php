<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('head') ?>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url('assets/stylesheets/lomba-style.css'); ?>" rel="stylesheet"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <section class="lomba container">
        <img src="<?= base_url("uploads/media/lomba/banner/$pameran->banner"); ?>" class="lomba-image" loading="lazy" alt="">
        <h1>Pendaftaran Ruang Indiependen: <?= $pameran->name ?></h1>
   </section>
   <section class="container">
        <p class="full-width bg-pink notif p-12 f-14">
            <?php 
                if($regist->regist_status === 'confirmed'){
                    echo 'Pendaftaran kamu telah terverifikasi. Silakan upload karyamu.';
                }elseif($regist->regist_status === 'submitted'){
                    echo 'Yeay! Karyamu berhasil dikumpulkan. Tunggu pengumuman berikutnya.';
                }
            ?>
        </p>
   </section>
   <section class="container mb-32 mt-32">
        <div class="progress-container mt-16">
            <progress class="progress-lomba" 
                value="<?php if($regist->regist_status === 'confirmed'){echo 5;}
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
   </section>
   
   <section class="container">
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'data')" id="tabData">Data</button>
        <button class="tablinks" onclick="openTab(event, 'submit')" id="tabSubmit">Submission</button>
    </div>
   </section>
   <section class="container tab-content mt-12 pb-32" id="data"> 
                <div class="input-group flex flex-col">
                <label for="name" class="mb-8">Nama<span class="text-red">*</span></label>
                    <input
                        id="name" name="name"
                        type="text"
                        class="form-input full-width"
                        value=" <?= $user->name ?>"
                        disabled
                    />
                </div>
                <div class="input-group flex flex-col mt-12">
                <label for="email" class="mb-8">Email<span class="text-red">*</span></label>
                    <input
                        id="email" name="email"
                        type="email"
                        class="form-input full-width"
                        value=" <?= $user->email ?>"
                        disabled
                    />
                </div>
                <div class="input-group flex flex-col mt-12">
                    <label for="univ" class="mb-8">Asal Universitas<span class="text-red">*</span></label>
                    <input
                        id="univ" name="univ"
                        type="text"
                        class="form-input full-width"
                        value="<?= $user->univ ?>"
                        disabled="disabled"
                    />
                </div>
                <div id="nimInput" class="input-group flex flex-col mt-12  d-none">
                    <label for="nim" class="mb-8">NIM<span class="text-red">*</span></label>
                    <input
                        id="nim" name="nim"
                        type="number"
                        class="form-input full-width"
                        value="<?= $user->nim ?>"
                        disabled="disabled"
                    />
                </div>
                <div class="input-group flex flex-col mt-12">
                <label for="phone" class="mb-8">No. Handphone<span class="text-red">*</span></label>
                    <input
                        id="phone" name="phone"
                        type="number"
                        class="form-input full-width"
                        value="<?= $user->phone ?>"
                        placeholder="0812xxxxxxx"
                        disabled="disabled"
                    />
                </div>
                <div class="input-group flex flex-col mt-12">
                <label for="line" class="mb-8">ID Line<span class="text-red">*</span></label>
                    <input
                        id="line" name="line"
                        type="text"
                        class="form-input full-width"
                        value="<?= $user->id_line ?>"
                        placeholder="@line_id"
                        disabled="disabled"
                    />
                </div>
   </section>

   <?php if(strtolower($regist->regist_status) === 'confirmed'): ?>
   <section class="container tab-content pb-32" id="submit">
        <div class="flex flex-col">
            <form action="<?php echo base_url(); ?>/member/pameran/submit" autocomplete="off" method="POST" enctype="multipart/form-data">
                <input id="id_regist" name="id_regist" type="hidden" value="<?= $regist->id_regist ?>"/>
                <input id="slug" name="slug" type="hidden" value="<?= $pameran->slug ?>"/>
                <input id="type" name="type" type="hidden" value="<?= $pameran->type_submission ?>"/>
                <div class="input-group flex flex-col mt-12">
                <label for="title" class="mb-8">Judul Karya<span class="text-red">*</span></label>
                    <input
                        id="title" name="title"
                        type="text"
                        class="form-input full-width"
                        placeholder="judul karya"
                        value="<?= old('title'); ?>"
                    />
                    <?php if (session()->getFlashdata('title')) : ?>
                        <span class="text-red text-small mt-8"><?= session()->getflashdata('title'); ?></span>
                    <?php endif; ?>
                </div>
                <?php if(strtolower($pameran->type_submission) === 'video' || strtolower($pameran->type_submission) === 'pdf' || 
                    strtolower($pameran->type_submission) === 'audio' || strtolower($pameran->slug) === 'info-grafik'):?>
                 <div class="flex flex-col input-group mt-12">
                        <label for="thumbnail" class="mb-8">Thumbnail<span class="text-red">*</span></label>
                        <input
                            id="thumbnail" name="thumbnail"
                            type="file"
                            class="form-input full-width"
                            value="<?= old('thumbnail'); ?>"
                        />
                        <span class="text-small">File size max. 1MB</span>
                        <?php if (session()->getFlashdata('thumbnail')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('thumbnail'); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if(strtolower($pameran->type_submission) === 'video'): ?>
                    <div class="input-group flex flex-col mt-12">
                    <label for="url" class="mb-8">ID video youtube<span class="text-red">*</span></label>
                        <input
                            id="url" name="url"
                            type="text"
                            class="form-input full-width"
                            placeholder="ID video youtube"
                            value="<?= old('url'); ?>"
                        />
                        <span class="text-small mt-8">Lihat cara mendapatkan ID Video Youtube <a href="#" class="text-primary">disini.</a></span>
                        <?php if (session()->getFlashdata('url')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('url'); ?></span>
                        <?php endif; ?>
                    </div>
                <?php elseif(strtolower($pameran->type_submission) === 'image' || strtolower($pameran->type_submission) === 'audio'): ?>
                    <div class="flex flex-col input-group mt-12">
                        <label for="karya" class="mb-8">File karya<span class="text-red">*</span></label>
                        <input
                            id="karya" name="karya"
                            type="file"
                            class="form-input full-width"
                            value="<?= old('karya'); ?>"
                        />
                        <?php if (session()->getFlashdata('karya')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('karya'); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="input-group flex flex-col mt-12">
                    <label for="caption">Caption :</label>
                    <input type="hidden" name="caption" value="<?= set_value('caption') ?>">
                    <div id="caption" style="min-height: 160px;" col="10"></div>
                    <?php if (session()->getFlashdata('caption')) : ?>
                        <span class="text-red text-small mt-8"><?= session()->getflashdata('caption'); ?></span>
                    <?php endif; ?>
                </div>
                <button type="submit" class="button-primary mt-12">Submit</button>
            </form>
        </div>
   </section>
   <?php elseif(strtolower($regist->regist_status) === 'pending'): ?>
        <section class="container tab-content pb-32" id="submit">
            <p class="text-center text-small full-width bg-pink notif p-12">Submission akan dibuka setelah berkas kamu terverifikasi. Tunggu ya..</p>
        </section>
    <?php elseif(strtolower($regist->regist_status) === 'submitted' && $submission != null): ?>
        <section class="container tab-content" id="submit">
                <div class="input-group flex flex-col mt-12">
                <label for="title" >Judul Karya<span class="text-red">*</span></label>
                    <h1 class="mt-8 mb-0"><?= $submission->title ?></h1>
                </div>
                <?php if(strtolower($pameran->type_submission) === 'video'): ?>
                    <div class="full-width mt-12 flex flex-col">
                        <label for="karya" >Karya<span class="text-red">*</span></label>
                        <iframe width="100%"
                            class="mt-12"
                            style="aspect-ratio: 16/9; "
                            src="https://www.youtube.com/embed/<?= $submission->url ?>" 
                            title="<?= $submission->title ?>" 
                            frameborder="0" allow="accelerometer; 
                            clipboard-write; encrypted-media; 
                            gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    </div>
                <?php elseif(strtolower($pameran->type_submission) === 'image'): ?>
                    <div class="flex flex-col input-group mt-12" style="max-width:720px;">
                        <label for="karya" class="mb-8">File karya<span class="text-red">*</span></label>
                       <img src="<?= base_url("/uploads/submission/$pameran->slug/$submission->media"); ?>" alt="">
                    </div>
                <?php elseif(strtolower($pameran->type_submission) === 'audio'): ?>
                    <audio id="audioPlayer" controls class="full-width">
                        <source src="<?= base_url("/uploads/submission/$pameran->slug/$submission->media"); ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                <?php endif; ?>
                <div class="full-width">
                    <?= $submission->caption ?>
                </div>
        </section>
    <?php endif; ?>

   <script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
   <?php if(strtolower($regist->regist_status) != 'submitted'): ?>
    <script>
        $(document).ready(function() {
            var quill = new Quill('#caption', {
                theme: 'snow'
            });
            let realHTML = $('<textarea />').html("<?php old('caption') != NULL ? old('caption') : "" ?>").text()
            let initialContent = quill.clipboard.convert(realHTML)
            quill.setContents(initialContent, 'silent');
            quill.on('text-change', function(delta, oldDelta, source) {
                document.querySelector("input[name='caption']").value = quill.root.innerHTML;
            });
        });
    </script>
   <?php endif; ?>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="<?= base_url('assets/js/detailLomba.js'); ?>"></script>
    <script>
    <?php 
        if($regist->regist_status === 'pending'){
            echo 'document.getElementById("tabData").click();';
        }else{
            echo 'document.getElementById("tabSubmit").click();';
        }
    ?>
    function openTab(evt, tab) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(tab).style.display = "block";
        evt.currentTarget.className += " active";
    }
   </script>
<?= $this->endSection() ?>