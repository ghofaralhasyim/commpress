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
             <div class="form-group mt-2">
                <label for="type">Submission type</label>
                <select name="type" id="type" class="form-control">
                    <option value="image">Image</option>
                    <option value="video">Video</option>
                    <option value="text content">Text Content</option>
                </select>
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
            <table id="table" class="table table-striped" style="width:100%">
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
                            <td><a href="<?= base_url("/dashboard/lomba/{$lomba->slug}") ?>" >Details</a></td>
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

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable({
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

        function toggleForm(){
            var form = document.getElementById("form");
            var buttonShow = document.getElementById("buttonShow");
            form.classList.toggle('d-none');
            buttonShow.classList.toggle('d-none');
        }
    </script>

<?= $this->endSection() ?>