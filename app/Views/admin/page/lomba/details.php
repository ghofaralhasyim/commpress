<?= $this->extend('/admin/dashboard') ?>
<?= $this->section('content') ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

   <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="card pd-1" style="padding-left: 1em;">
                <h3 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-trophy-line"></i> Video Dokumenter</h3>
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
                        <button id="buttonShow" class="btn btn-outline-primary" onclick="toggleForm()">Hide</button>
                    </div>
                </div>
                <form id="formBanner" action="<?= base_url("/dashboard/lomba/$lomba->slug/save-banner-lomba") ?>" class="mb-4" 
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
                <form id="form" action="<?= base_url("/dashboard/lomba/$lomba->slug/save-lomba") ?>"
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
        <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="card pd-1" style="padding-left: 1rem;">
        <h5 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-chat-check-line"></i> Participant</h5>
        <div class="mt-2 pd-1">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>NIM</th>
                        <th>Payment</th>
                        <!-- <th>Submission</th> -->
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                 <tbody>
                    <?php foreach ($listRegist as $regist) : ?> 
                        <tr>
                            <td><?= $regist->name ?></td>
                            <td><?= $regist->nim ?></td>
                            <td>
                                <?php if($regist->payment != null): ?>
                                   <a href="<?= base_url("/uploads/media/web_settings/$regist->payment"); ?>" target="blank">
                                        <?= $regist->payment; ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td><?= $regist->status ?></td>
                            <td>
                                <button class="btn btn-primary">Confirm</button>
                                <button class="btn btn-warning">Reject</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>NIM</th>
                        <th>Payment</th>
                        <!--<th>Submission</th> -->
                        <th>Status</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        </div>
        </div>
    </div>
    
    <script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script language="JavaScript" type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });

        var quill = new Quill('#description', {
            theme: 'snow',
            modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                [{ font: [] }],
                [{ align: [] }],
                ["bold", "italic","strike"],
                ["link", "blockquote"],
                [{ list: "ordered" }, { list: "bullet" }],
            ]
            },
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
                button.innerHTML = 'Hide';
            }else{
                button.innerHTML = 'Show';
            }
        }
    </script>

<?= $this->endSection() ?>