<?= $this->extend('/admin/dashboard') ?>

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

    <div class="row mt-2">
        <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="card pd-1" style="padding-left: 1rem;">
        <div class="row pt-2">
            <div class="col">
                 <h5 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-chat-check-line"></i> List Media & Sponsor</h5>
            </div>
            <div class="col" style="text-align: right;">
                <button id="buttonShow" class="btn btn-primary transition-1" onclick="toggleForm()">Tambah Data</button>
            </div>
        </div>
        <form action="<?= base_url("/dashboard/media-sponsor/save"); ?>" id="form" method="POST" 
        enctype="multipart/form-data" class="mb-4 d-none" autocomplete="off">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Sponsor / media name">
                <?php if (session()->getFlashdata('name')) : ?>
                    <span class="text-red text-small mt-8"><?= session()->getflashdata('name'); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group mt-1">
                <label for="image">Logo</label>
                <input type="file" class="form-control" id="image" name="image" placeholder="Image">
                <?php if (session()->getFlashdata('image')) : ?>
                    <span class="text-red text-small mt-8"><?= session()->getflashdata('image'); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group mt-1">
                <label for="url">Redirect url</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="Redirect url">
                <?php if (session()->getFlashdata('url')) : ?>
                    <span class="text-red text-small mt-8"><?= session()->getflashdata('url'); ?></span>
                <?php endif; ?>
            </div>
            <div class="mt-2">
                <button class="mt-2 btn btn-primary" type="submit">Save</button>
                <span class="mt-2 btn btn-outline-danger" onclick="toggleForm()">Cancel</span>
            </div>
        </form>
        <div class="mt-2 pd-1">
            <table id="table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Redirect Url</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($media as $data): ?>
                       <tr>
                            <td><?= $data->name ?></td>
                            <td><img src="<?= base_url('uploads/media/media_sponsor/')."/$data->media" ?>" alt="" style="max-width:150px;"></td>
                            <td><?= $data->url ?></td>
                            <td>
                                <div class="col">
                                    <div class="row mb-2">
                                        <a href="<?= base_url("/dashboard/media-sponsor/edit/$data->id_media_sponsor"); ?>">Edit</a>
                                    </div>
                                    <div class="row">
                                        <a href="<?= base_url("/dashboard/media-sponsor/delete/$data->id_media_sponsor"); ?>">Delete</a>
                                    </div>
                                </div>
                            </td>
                       </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Redirect Url</th>
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
    <script>
        var form = document.getElementById("form");
        var buttonShow = document.getElementById("buttonShow");
        
        function toggleForm(){
            form.classList.toggle('d-none');
            buttonShow.classList.toggle('d-none');
        }

        $(document).ready(function() {
            $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            });
            <?php if (session()->getFlashdata('error')): ?>
                    toggleForm();
            <?php endif; ?>
        });

    </script>
<?= $this->endSection() ?>