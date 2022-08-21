<?= $this->extend('/admin/dashboard') ?>

<?= $this->section('head') ?>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
        <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="card pd-1" style="padding-left: 1rem;">
        <div class="row pt-2">
            <div class="col">
                 <h5 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-chat-check-line"></i> Edit Media & Sponsor</h5>
            </div>
        </div>
        <form action="<?= base_url("/dashboard/media-sponsor/update"); ?>" id="form" method="POST" 
        enctype="multipart/form-data" class="mb-4" autocomplete="off">
            <input type="hidden" name="id" id="id" value="<?= $media->id_media_sponsor; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value="<?= $media->name; ?>" name="name" placeholder="Sponsor / media name">
                <?php if (session()->getFlashdata('name')) : ?>
                    <span class="text-red text-small mt-8"><?= session()->getflashdata('name'); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group mt-4 mb-4">
                <div class="row">
                    <div class="col-3">
                        <img src="<?= base_url('uploads/media/media_sponsor/')."/$media->media" ?>" style="max-width:150px;" alt="">
                    </div>
                    <div class="col-9">
                        <label for="image">Change Logo</label>
                        <input type="file" class="form-control" id="image" name="image" placeholder="Image">
                        <?php if (session()->getFlashdata('image')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('image'); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group mt-1">
                <label for="url">Redirect url</label>
                <input type="text" class="form-control" id="url" name="url" value="<?= $media->url; ?>" placeholder="Redirect url">
                <?php if (session()->getFlashdata('url')) : ?>
                    <span class="text-red text-small mt-8"><?= session()->getflashdata('url'); ?></span>
                <?php endif; ?>
            </div>
            <div class="mt-2">
                <button class="mt-2 btn btn-primary" type="submit">Save</button>
                <a href="<?= base_url('/dashboard/media-sponsor/'); ?>" class="mt-2 btn btn-outline-danger">Cancel</a>
            </div>
        </form>
        </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script>

    </script>
<?= $this->endSection() ?>