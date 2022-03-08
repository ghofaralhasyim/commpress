<?= $this->extend('admin/dasboard') ?>
<?= $this->section('content') ?>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

   <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="card pd-1" style="padding-left: 1rem;">
                <h5 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-body-scan-line"></i> Comm-press Recruitment</h5>
                <div class="mt-2 pd-1 col-sm-12 col-md-8 col-xl-6">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">Nama Panitia</label>
                            <input type="text" class="form-control <?php if (session()->getFlashdata('nameError')){echo 'is-invalid';}?>" id="name" name="name" aria-describedby="name" placeholder="Nama panitia">
                            <div class="invalid-feedback">
                            <?php if (session()->getFlashdata('nameError')) : ?>
                                <?php echo session()->getFlashdata('nameError'); ?>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="nim">NIM</label>
                            <input type="number" class="form-control <?php if(session()->getFlashdata('nimError')){echo 'is-invalid';}?>" id="nim" name="nim" aria-describedby="nim" placeholder="Nomor Induk Mahasiswa">
                            <div class="invalid-feedback">
                            <?php if (session()->getFlashdata('nimError')) : ?>
                                <?php echo session()->getFlashdata('nimError'); ?>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="divisi">Divisi</label>
                            <select class="form-select" name="divisi" id="divisi">
                                <option value="Acara">Acara</option>
                                <option value="Webdev">Webdev</option>
                                <option value="Visual">Visual</option>
                                <option value="Dokumentasi">Dokumentasi</option>
                                <option value="Media Relations">media relation</option>
                                <option value="Publikasi">Publikasi</option>
                                <option value="Sponsor">Sponsor</option>
                                <option value="Fresh Money">Fresh Money</option>
                                <option value="Keamanan">Keamanan</option>
                                <option value="Lomba">Lomba</option>
                                <option value="Perlengkapan">Perlengkapan</option>
                            </select>
                        </div>
                        <button class="btn btn-success mt-3" type="submit">Tambahkan Panitia</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="card pd-1" style="padding-left: 1rem;">
        <h5 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-chat-check-line"></i> Daftar Panitia Diterima</h5>
        <div class="mt-2 pd-1">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Divisi</th>
                        <th>NIM</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataOprec as $panit) : ?> 
                    <tr>
                        <td><?= $panit->name ?></td>
                        <td><?= $panit->divisi ?></td>
                        <td><?= $panit->nim ?></td>
                        <td>
                            <a href="/dasboard/edit-data-panit/<?= $panit->id ?>" style="margin-right: 5px;" class="btn btn-primary">Edit</a> 
                            <a id="#btn-delete" href="#!" type="button" onclick="modalDelete('<?= base_url('/dasboard/delete-data-panit/') . '/' . $panit->id; ?>')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Divisi</th>
                        <th>NIM</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        </div>
        </div>
    </div>

    <?= $this->include('admin/modal') ?>

    <script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script language="JavaScript" type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function modalDelete(url) {
            $('#btn-delete').attr('href',url);
            $('#deleteModal').modal();
        }
    </script>

<?= $this->endSection() ?>