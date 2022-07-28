<?= $this->extend('publics/_layouts/default') ?>

<?= $this->section('head') ?>
        <link href="<?= base_url('assets/stylesheets/media-content.css'); ?>" rel="stylesheet"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="flex flex-col container">
        <div class="flex flex-col">
            <h1><?= $content->title ?></h1>
            <span class="text-grey text-small"><?= $content->created_at ?></span>
        </div>
        <?php if($content->content_type === 'image'): ?>
        <div class="flex flex-col full-width h-center">
            <img src="<?= base_url("/uploads/media/medrel/content/$media->image") ?>" alt="">
        </div>
        <?php endif; ?>
        <?php if($content->content_type === 'video'): ?>
        <div class="flex flex-col full-width h-center media-video mt-32">
             <iframe src="https://www.youtube.com/embed/<?= $content->url ?>" 
                controls=0 rel=0 title="<?= $content->title ?>" frameborder="0"  
                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        </div>
        <?php endif; ?>
        <div class="flex flex-col pb-64 media-description">
            <?= $content->description ?>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    
<?= $this->endSection() ?>