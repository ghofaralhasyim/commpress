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
            <div class="card pd-1" style="padding-left: 1em;">
                <div class="row pt-2">
                    <div class="col">
                        <h5 class="mt-1" style="font-weight: 400;"><i class="ri-chat-check-line"></i> Settings <?= $pameran->name; ?></h5>
                    </div>
                    <div class="col" style="text-align: right;">
                        <button id="buttonShow" class="btn btn-outline-primary" onclick="toggleForm()">Show</button>
                    </div>
                </div>
                <form id="formBanner" action="<?= base_url("/dashboard/pameran/$pameran->slug/save-banner-pameran") ?>" class="mb-4 d-none" 
                enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label for="banner">Banner Image
                             <small class="form-text">| Current thumbnail: 
                                <a href="<?= base_url("uploads/media/pameran/banner/$pameran->banner"); ?>"
                                target="blank"
                                ><?= $pameran->banner; ?></a>
                            </small>
                        </label>
                        <input type="file" name="banner" id="banner" class="form-control">
                        <small class="form-text text-muted">*Image size recomendation: 1200x250</small>
                        <?php if (session()->getFlashdata('banner')) : ?>
                            <span class="text-red text-small mt-8"><?= session()->getflashdata('banner'); ?></span>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-primary mt-2" type="submit">Update Banner</button>
                </form>
                <form id="form" action="<?= base_url("/dashboard/pameran/$pameran->slug/save-pameran") ?>" class="d-none"
                autocomplete="off" method="POST" class="mb-4" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="<?= $pameran->name; ?>" class="form-control" placeholder="Nama lomba" disabled="true">
                        </div>
                        <div class="col-6">
                            <label for="slug">slug</label>
                            <input type="text" name="slug" id="slug" value="<?= $pameran->slug; ?>" class="form-control" disabled="true">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option <?php if($pameran->status == "active") echo 'selected'; ?> value="active">Active</option>
                            <option <?php if($pameran->status == "closed") echo 'selected'; ?> value="closed">Closed</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="media">Thumbnail Image
                             <small class="form-text">| Current thumbnail: 
                                <a href="<?= base_url("uploads/media/pameran/thumbnail/$pameran->thumbnail"); ?>"
                                target="blank"
                                ><?= $pameran->thumbnail; ?></a>
                            </small>
                        </label>
                        <input type="file" name="media" id="media" class="form-control">
                        <small class="form-text text-muted">*Image size recomendation: 300x160</small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="type">Type Submission</label>
                        <select name="type" id="type" class="form-control">
                            <option <?php if($pameran->type_submission == "video") echo 'selected'; ?> value="video">Video</option>
                            <option <?php if($pameran->type_submission == "image") echo 'selected'; ?> value="image">Image</option>
                            <option <?php if($pameran->type_submission == "audio") echo 'selected'; ?> value="audio">Audio</option>
                            <option <?php if($pameran->type_submission == "text") echo 'selected'; ?> value="text content">Text</option>
                        </select>
                    </div>
                    <div class="mt-2">
					    <label for="description">Description :</label>
					    <input type="hidden" name="description" value="<?= htmlspecialchars($pameran->description); ?>">
					    <div id="description" style="min-height: 160px;">
                            <?= $pameran->description; ?>
                        </div>
				    </div>
                    <button class="btn btn-primary mt-2" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-12 col-md-12 col-xl-12" >
        <div class="card pd-1" style="padding-left: 1rem; overflow-y:scroll; max-width:100%;">
        <h5 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-chat-check-line"></i> Participant</h5>
        <div class="mt-2 pd-1">
            <table id="example" class="table table-striped" style="max-width:100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Univ</th>
                        <th>ID Line</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                 <tbody>
                    <?php foreach ($listRegist as $regist) : ?> 
                        <tr>
                            <td> <a href="<?= base_url('/dashboard/pameran/').'/'.$pameran->slug.'/'.$regist->id_regist ?>"
                                style="text-decoration:none;">
                                <?= $regist->name ?></a>
                            </td>
                            <td><?= $regist->univ ?></td>
                            <td><?= $regist->id_line ?></td>
                            <td><?= $regist->phone ?></td>
                            <td><?= $regist->status ?></td>
                            <td>
                                <a href="<?= base_url('/dashboard/pameran/').'/'.$pameran->slug.'/'.$regist->id_regist ?>" >Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Univ</th>
                        <th>ID Line</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <style>
        div > .dt-buttons{
            float: left !important;
        }
    </style>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            });
        });
        var quill = new Quill('#description', {
            theme: 'snow',
        });
         quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='description']").value = quill.root.innerHTML;
        });

        var show = true;
        function toggleForm(){
            var form = document.getElementById("form");
            var formBanner = document.getElementById("formBanner");
            var button = document.getElementById("buttonShow");
            form.classList.toggle('d-none');
            formBanner.classList.toggle('d-none');
            show = !show;
            if(show){
                button.innerHTML = 'Show';
            }else{
                button.innerHTML = 'Hide';
            }
        }
         <?php
            if(session()->getFlashdata('banner')){
                 echo 'toggleForm();';
            }
        ?>
    </script>

<?= $this->endSection() ?>