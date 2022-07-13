<?= $this->extend('/admin/dashboard') ?>
<?= $this->section('content') ?>

    <link href="<?= base_url('assets/stylesheets/base-style.css'); ?>" rel="stylesheet"/>

   <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="card pd-1" style="padding-left: 1em;">
                <h3 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-tools-fill"></i> Commpress Web Settings</h3>
            </div>
        </div>
    </div>

     <div class="flex flex-col lg-flex-row col-gap-16 full-width mt-12 ">
        <div class="flex flex-col card fg-1 web-settings pb-32 pl-16 pr-16">
            <h3 style="font-weight: 400;">Homepage Banner</h3>
            <span class="text-small mb-8">Current banner :</span>
            <div class="homepage-banner">
                <img src="<?= base_url().'/uploads/media/web_settings/'.$homepage_banner->media; ?>"
                class="full-width" alt="banner"/>
                <div class="description flex flex-col h-center full-height p-16">
                    <h1><?= $homepage_banner->title; ?></h1>
                    <h1><?= $homepage_banner->description; ?></h1>
                </div>
            </div>
            
            <form autocomplete="off" action="<?= base_url('dashboard/web-settings/save') ?>" method="POST" enctype="multipart/form-data" class="flex flex-col full-width">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="text-red">
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <div class="input-group mt-12">
                    <label for="title">Title</label>
                    <input type="text" class="form-input full-width" id="title" name="title" 
                    placeholder="Banner title" value="<?= $homepage_banner->title; ?>">
                </div>
                <div class="input-group mt-12">
                    <label for="description">Description</label>
                    <input type="text" class="form-input full-width" id="description" name="description" 
                    placeholder="Banner title" value="<?= $homepage_banner->description; ?>">
                </div>
                <div class="input-group mt-12 flex flex-col">
                     <label for="Media">Background Image :</label>
                    <input type="file" id="media" name="media" class="mt-8">
                    <span class="text-small">Image size recomendation : 1200 x 250</span>
                </div>
                <button class="button-primary mt-16" type="submit" style="width: fit-content;">Uploads</button>
            </form>
        </div>
         <div class="flex flex-col v-center h-center full-width card fg-1">
            <span class="text-gray">Other web setting is under development.</span>
        </div>
     </div> 

<?= $this->endSection() ?>