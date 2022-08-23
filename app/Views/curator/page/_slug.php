<?= $this->extend('/curator/_layouts/default') ?>

<?= $this->section('head') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

   <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="card">
                 <?= $breadcrumbs; ?> 
            </div>
        </div>
    </div>
    
    <?= $pager->links('data_submit', 'bootstrap_pagination'); ?>

    <div class="row pb-5">
        <div class="col-sm-12 col-md-12 col-xl-12">
            
            <?php foreach($data_submit as $data): ?>
                <div class="card mt-2 pt-3 " style="padding: 0 1em; max-width:1024; margin:0 auto;">
                    <div class="row">
                        <div class="col">
                            <h5><?= $data['title'] ?></h5>
                            <span>Oleh <?= $data['participant'] ?></span>
                        </div>
                        <div class="col" style="text-align: right;">
                            <span>Qualified for exhibition</span><br>
                            <form action="<?= base_url('/curator/qualified/').'/'.$data['id_submission'] ?>" id="form-<?= $data['id_submission'] ?>" method="POST">
                                <label class="switch">
                                <input id="<?= $data['id_submission']; ?>" type="checkbox" onchange="toggleQualified(<?= $data['id_submission'] ?>)"
                                <?php if($data['qualified']) echo 'checked'  ?>
                                >
                                <span class="slider round"></span>
                                </label>
                            </form>
                        </div>
                    </div>
                    <?php if($data['type_submission'] === 'video'): ?>
                    <div class="col-12 mt-2">
                          <iframe width="100%"
                            class="mt-12"
                            style="aspect-ratio: 16/9; max-width:1024;"
                            src="https://www.youtube.com/embed/<?= $data['url'] ?>" 
                            title="<?= $data['title'] ?>" 
                            frameborder="0" allow="accelerometer; 
                            clipboard-write; encrypted-media; 
                            gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    </div>
                    <?php elseif($data['type_submission'] === 'image'):?>
                        <div class="col-12 mt-2">
                            <img src="<?= base_url("uploads/submission/").'/'.$data['slug'].'/'.$data['media'] ?>" alt="" width="100%" >
                        </div>
                    <?php endif;?>
                    <div class="mt-2" style="max-width:1024; margin:0 auto; text-align:justify;">
                        <?= $data['caption'] ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="text/javascript">
    function toggleQualified(id){
        $("#form-"+id).submit();
    }
</script>
<?= $this->endSection() ?>