<?= $this->extend('/media/_layouts/default') ?>

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

    <?php if($content == NULL): ?>
    <div class="row mt-2">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="flex flex-col card">
                <span class="flex mt-2 mb-2"><b><i class="ri-edit-circle-line"></i> Content settings</b></span>
                <form action="<?= base_url("/dashboard-media/content/save"); ?>" id="form" method="POST" 
                enctype="multipart/form-data" class="mt-2 mb-3" autocomplete="off">
                    <input type="hidden" id="id_media" name="id_media" value="<?= session()->get('id'); ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Content title..."
                            value="<?= old('title') ?>"
                        >
                        <?php if (session()->getFlashdata('title')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('title'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-2">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option <?php if(old('status') === 'active'){ echo 'selected'; } ?> value="active">Active</option>
                            <option <?php if(old('status') === 'closed'){ echo 'selected'; } ?> value="closed">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="thumbnail">Thumbnail</label><small> (optional)</small>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                        <small class="form-text text-muted">*Image size recomendation: 300x160</small>
                        <?php if (session()->getFlashdata('thumbnail')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('thumbnail'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-2">
                        <label for="type">Content type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="image" <?php if(old('type') === 'image'){ echo 'selected'; } ?>>Image</option>
                            <option value="video"  <?php if(old('type') === 'video'){ echo 'selected'; } ?>>Video</option>
                        </select>
                    </div>
                    <div id="content-image" class="full-width">
                        <div class="form-group mt-2">
                            <label for="image">Content Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <small class="form-text text-muted">*Image size recomendation: 300x160</small>
                            <?php if (session()->getFlashdata('image')) : ?>
                                <span class="text-red text-small mt-8"><?= session()->getflashdata('image'); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="content-video" class="full-width">
                        <div class="form-group">
                            <label for="url">Youtube video ID</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Youtube video ID" value="<?= old('url') ?>">
                        </div>
                        <?php if (session()->getFlashdata('url')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('url'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="mt-2">
                        <label for="description">Caption :</label>
                        <input type="hidden" name="description" value="<?= old('description') ? old('description') : set_value('description') ?>">
                        <div id="description" style="min-height: 160px;" col="10"></div>
                        <?php if (session()->getFlashdata('description')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('description'); ?></span>
                        <?php endif; ?>
                    </div>
                    <button class="mt-2 btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
    <?php else:?>
        <div class="row mt-2">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="flex flex-col card">
                <span class="flex mt-2 mb-2"><b><i class="ri-edit-circle-line"></i> Content settings</b></span>
                <form action="<?= base_url("/dashboard-media/content/save"); ?>" id="form" method="POST" 
                enctype="multipart/form-data" class="mt-2 mb-3" autocomplete="off">
                    <input type="hidden" id="id_media" name="id_media" value="<?= session()->get('id'); ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $content->title ?>">
                        <?php if (session()->getFlashdata('title')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('title'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-2">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option <?php if($content->status === 'active'){ echo 'selected'; } ?> value="active">Active</option>
                            <option <?php if($content->status === 'closed'){ echo 'selected'; } ?> value="closed">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="type">Content type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="image" <?php if($content->content_type === 'image'){ echo 'selected'; } ?>>Image</option>
                            <option value="video" <?php if($content->content_type === 'video'){ echo 'selected'; } ?>>Video</option>
                        </select>
                    </div>
                    <div id="content-image" class="full-width">
                        <div class="form-group mt-2">
                            <label for="image">Content Thumbnail</label><br>
                            <div class="row mt-2">
                                <?php if($content->thumbnail != null): ?>
                                    <img src="<?= base_url("uploads/media/medrel/thumbnail/$content->thumbnail") ?>" style="max-width:420px" alt="">
                                <?php endif; ?>
                                <div class="col">
                                    <?php if($content->thumbnail != null): ?><label for="thumbnail">Change Thumbnail</label><br><?php endif; ?>
                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control" style="max-width:420px ;">
                                    <small class="form-text text-muted">*Image size recomendation: 300x160</small>
                                    <?php if (session()->getFlashdata('thumbnail')) : ?>
                                        <span class="text-red text-small mt-8"><?= session()->getflashdata('thumbnail'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="image">Content Image</label><br>
                            <div class="row mt-2">
                                <img src="<?= base_url("uploads/media/medrel/content/$content->image") ?>" style="max-width:420px" alt="">
                                <div class="col">
                                    <label for="image">Change Image</label><br>
                                    <input type="file" name="image" id="image" class="form-control" style="max-width:420px ;">
                                    <small class="form-text text-muted">*Image size recomendation: 300x160</small>
                                    <?php if (session()->getFlashdata('image')) : ?>
                                        <span class="text-red text-small mt-8"><?= session()->getflashdata('image'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="content-video" class="full-width">
                        <div class="form-group">
                            <label for="url">Youtube video ID</label>
                            <input type="text" class="form-control" id="url" name="url" value="<?= $content->url ?>">
                        </div>
                        <?php if (session()->getFlashdata('url')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('url'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="mt-2">
                        <label for="description" class="mb-2 mt-2">Caption :</label>
                        <input type="hidden" name="description" value="<? htmlspecialchars($content->description); ?>">
					    <div id="description" style="min-height: 160px;">
                            <?= $content->description; ?>
                        </div>
                        <?php if (session()->getFlashdata('description')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('description'); ?></span>
                        <?php endif; ?>
                    </div>
                    <button class="mt-2 btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
    <?php endif;?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        const contentImg = document.getElementById('content-image');
        const contentVid = document.getElementById('content-video');
        const type = document.getElementById('type');

        $(document).ready(() => {
            if (type.value.toLowerCase() == 'image') {
                contentVid.classList.add('d-none');
                contentImg.classList.remove('d-none');
            }else if(type.value.toLowerCase() == 'video'){
                contentImg.classList.add('d-none');
                contentVid.classList.remove('d-none');
            }
        });

        var quill = new Quill('#description', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='description']").value = quill.root.innerHTML;
        });

        type.addEventListener('change', function (evt) {
            if (this.value.toLowerCase() == 'image') {
                contentVid.classList.add('d-none');
                contentImg.classList.remove('d-none');
            } else if( (this.value.toLowerCase() == 'video')) {
                contentImg.classList.add('d-none');
                contentVid.classList.remove('d-none');
            }
        });
    </script>
<?= $this->endSection() ?>