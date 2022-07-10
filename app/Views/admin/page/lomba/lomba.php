<?= $this->extend('/admin/dashboard') ?>
<?= $this->section('content') ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

   <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="card pd-1" style="padding-left: 1em;">
                <h3 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-trophy-line"></i> Lomba</h3>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="card pd-1" style="padding-left: 1rem;">
        <div class="row pt-2">
            <div class="col">
                 <h5 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-chat-check-line"></i>List Lomba</h5>
            </div>
            <div class="col" style="text-align: right;">
                <button id="buttonShow" class="btn btn-primary transition-1" onclick="toggleForm()">Buat Lomba Baru</button>
            </div>
        </div>
        <form action="<?= base_url("/dashboard/lomba/new/save-lomba"); ?>" id="form" method="POST" 
        enctype="multipart/form-data" class="mt-2 mb-3 d-none" autocomplete="off">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nama lomba">
            </div>
            <div class="form-group mt-2">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="banner">Banner Image</label>
                <input type="file" name="banner" id="banner" class="form-control">
                <small class="form-text text-muted">*Image size recomendation: 1200x250</small>
                </small>
            </div>
            <div class="form-group mt-2">
                <label for="media">Thumbnail Image</label>
                <input type="file" name="media" id="media" class="form-control">
                <small id="emailHelp" class="form-text text-muted">*Image size recomendation: 300x160</small>
            </div>
            <div class="mt-2">
				<label for="description">Description :</label>
				<input type="hidden" name="description" value="<?= set_value('description') ?>">
				<div id="description" style="min-height: 160px;" col="10"></div>
			</div>
            <button class="mt-2 btn btn-primary" type="submit">Save</button>
            <span class="mt-2 btn btn-outline-danger" onclick="toggleForm()">Cancel</span>
        </form>
        <div class="mt-2 pd-1">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Participant</th>
                        <!-- <th>Submission</th> -->
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                 <tbody>
                    <?php foreach ($listLomba as $lomba) : ?> 
                        <tr>
                            <td><?= $lomba->name ?></td>
                            <td><?= $lomba->participant ?></td>
                            <td><?= $lomba->status ?></td>
                            <td><a href="<?= base_url("/dashboard/lomba/{$lomba->slug}") ?>" class="btn btn-primary">Details</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Participant</th>
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
            theme: 'snow'
        });
         quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='description']").value = quill.root.innerHTML;
        });

        function toggleForm(){
            var form = document.getElementById("form");
            var buttonShow = document.getElementById("buttonShow");
            form.classList.toggle('d-none');
            buttonShow.classList.toggle('d-none');
        }
    </script>

<?= $this->endSection() ?>