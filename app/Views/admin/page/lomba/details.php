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
                        <h5 class="mt-1" style="font-weight: 400;"><i class="ri-chat-check-line"></i> Settings <?= $lomba->name; ?></h5>
                    </div>
                    <div class="col" style="text-align: right;">
                        <button id="buttonShow" class="btn btn-outline-primary" onclick="toggleForm()">Show</button>
                    </div>
                </div>
                <form id="formBanner" action="<?= base_url("/dashboard/lomba/$lomba->slug/save-banner-lomba") ?>" class="mb-4 d-none" 
                enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label for="banner">Banner Image</label>
                        <input type="file" name="banner" id="banner" class="form-control">
                        <small class="form-text text-muted">*Image size recomendation: 1200x250</small>
                        <small class="form-text">| Current thumbnail: 
                            <a href="<?= base_url("uploads/media/lomba/banner/$lomba->banner"); ?>"
                            target="blank"
                            ><?= $lomba->banner; ?></a>
                        </small>
                    </div>
                    <button class="btn btn-primary mt-2" type="submit">Update Banner</button>
                </form>
                <form id="form" action="<?= base_url("/dashboard/lomba/$lomba->slug/save-lomba") ?>" class="d-none"
                autocomplete="off" method="POST" class="mb-4" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="<?= $lomba->name; ?>" class="form-control" placeholder="Nama lomba">
                    </div>
                    <div class="form-group mt-2">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option <?php if($lomba->status == "active") echo 'selected'; ?> value="active">Active</option>
                            <option <?php if($lomba->status == "closed") echo 'selected'; ?> value="closed">Closed</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="media">Thumbnail Image</label>
                        <input type="file" name="media" id="media" class="form-control">
                        <small class="form-text text-muted">*Image size recomendation: 300x160</small>
                        <small class="form-text">| Current thumbnail: 
                            <a href="<?= base_url("uploads/media/lomba/thumbnail/$lomba->media"); ?>"
                            target="blank"
                            ><?= $lomba->media; ?></a>
                        </small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="type">Type Submission</label>
                        <select name="type" id="type" class="form-control">
                            <option <?php if($lomba->type_submission == "video") echo 'selected'; ?> value="video">Video</option>
                            <option <?php if($lomba->type_submission == "image") echo 'selected'; ?> value="image">Image</option>
                            <option <?php if($lomba->type_submission == "pdf") echo 'selected'; ?> value="pdf">PDF</option>
                            <option <?php if($lomba->type_submission == "text content") echo 'selected'; ?> value="text content">Text Content</option>
                        </select>
                    </div>
                    <div class="mt-2">
					    <label for="description">Description :</label>
					    <input type="hidden" name="description" value="<?= htmlspecialchars($lomba->description); ?>">
					    <div id="description" style="min-height: 160px;">
                            <?= $lomba->description; ?>
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
                        <th>Payment</th>
                        <th>ID Line</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                 <tbody>
                    <?php foreach ($listRegist as $regist) : ?> 
                        <tr>
                            <td> <a href="<?= base_url('/dashboard/lomba/').'/'.$lomba->slug.'/'.$regist->id_regist ?>"
                                style="text-decoration:none;">
                                <?= $regist->name ?></a>
                            </td>
                            <td><?= $regist->univ ?></td>
                            <td>
                                <?php if($regist->payment != null): ?>
                                   <a href="<?= base_url("/uploads/media/lomba/payment/$regist->payment"); ?>" target="blank">
                                        Open
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td><?= $regist->id_line ?></td>
                            <td><?= $regist->phone ?></td>
                            <td><?= $regist->status ?></td>
                            <td>
                                <?php if($regist->status == 'pending'): ?>
                                    <a href="<?= base_url('/dashboard/updateStatusLomba/confirm').'/'.$regist->id_regist ?>" class="bg-red p-1 text-white">Confirm</a>
                                    <a href="<?= base_url('/dashboard/updateStatusLomba/reject').'/'.$regist->id_regist ?>" class="bg-yellow p-1 text-white">Reject</button>
                                <?php else:?>
                                    <a href="<?= base_url('/dashboard/lomba/').'/'.$lomba->slug.'/'.$regist->id_regist ?>" >Details</a>
                                <?php endif;?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Univ</th>
                        <th>Payment</th>
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
            theme: 'snow'
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
    </script>

<?= $this->endSection() ?>