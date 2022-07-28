<?= $this->extend('/admin/dashboard') ?>

<?= $this->section('head') ?>
    <link href="<?= base_url('assets/stylesheets/base-style.css'); ?>" rel="stylesheet"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="card">
                 <?= $breadcrumbs; ?> 
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-12">
            <div class="card pt-12 pl-12">
                <div class="flex flex-col lg-flex-row col-gap-12 v-center h-center row-gap-12">
                   <div class="flex flex-col">
                        <h5>Participant Data</h5>
                        <table class="table">
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td><?= $regist->member_name ?></td>
                            </tr>
                             <tr>
                                <td>Universitas</td>
                                <td>:</td>
                                <td><?= $regist->univ ?></td>
                            </tr>
                            <?php if($regist->nim != null): ?>
                                <tr>
                                <td>NIM</td>
                                <td>:</td>
                                <td><?= $regist->nim ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><?= $regist->phone ?></td>
                            </tr>
                            <tr>
                                <td>ID Line</td>
                                <td>:</td>
                                <td><?= $regist->id_line ?></td>
                            </tr>
                            <tr>
                                <td>Register At</td>
                                <td>:</td>
                                <td><?= $regist->created_at ?></td>
                            </tr>
                            <tr>
                                <td>Registration Status</td>
                                <td>:</td>
                                <td><?= $regist->regist_status ?></td>
                            </tr>
                        </table>
                   </div>
                   
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-12">
            <div class="card flex flex-col pb-32">
                <div class="flex h-center full-width mt-32">
                    <div class="full-width" style="max-width: 720px;">
                        <h5>Submission</h5>
                        <?php if(strtolower($regist->regist_status) === 'submitted'): ?>
                        <div class="mb-12">
                            Submission title : <?= $submission->title ?>
                        </div>
                    </div>
                </div>
                <?php if(strtolower($regist->type_submission) === 'video'): ?>
                    <div class="full-width mt-12 flex flex-col v-center">
                        <iframe width="100%"
                            class="mt-12"
                            style="aspect-ratio: 16/9; max-width: 720px;"
                            src="https://www.youtube.com/embed/<?= $submission->url ?>" 
                            title="<?= $submission->title ?>" 
                            frameborder="0" allow="accelerometer; 
                            clipboard-write; encrypted-media; 
                            gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    </div>
                    <?php elseif(strtolower($regist->type_submission) === 'image'): ?>
                        <div class="flex flex-col input-group mt-12">
                            <label for="karya" class="mb-8">File karya<span class="text-red">*</span></label>
                            <img src="<?= base_url("uploads/submission/$regist->slug/$submission->media"); ?>" width="100%" height="100%" style="max-width: 720px;" alt="">
                        </div>
                    <?php elseif(strtolower($regist->type_submission) === 'audio'): ?>
                        <audio id="audioPlayer" controls class="full-width">
                            <source src="<?= base_url("uploads/submission/$regist->slug/$submission->media"); ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    <?php endif; ?>
                    <div class="flex full-width v-center h-center">
                        <div class="mt-12" style="max-width: 720px;">
                            <?= $submission->caption ?>
                        </div>
                    </div>
                    <?php else: ?>
                        <div class="full-width bg-yellow p-12">Peserta belum mengunggah karya.</div>
                    <?php endif; ?>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
