<?= $this->extend('/admin/dashboard') ?>
<?= $this->section('content') ?>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

   <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="card pd-1" style="padding-left: 1rem;">
                <h5 class="mb-1 mt-1" style="font-weight: 400;"><i class="ri-edit-line"></i> Edit Data</h5>
                <div class="mt-2 pd-1 col-sm-12 col-md-8 col-xl-6">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo session()->getflashdata('success'); ?>
                    </div>
                <?php endif; ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">Nama Panitia</label>
                            <input type="text" value="<?= $dataPanit['name'] ?>" class="form-control <?php if (session()->getFlashdata('nameError')){echo 'is-invalid';}?>" id="name" name="name" aria-describedby="name" placeholder="Nama panitia">
                            <div class="invalid-feedback">
                            <?php if (session()->getFlashdata('nameError')) : ?>
                                <?php echo session()->getFlashdata('nameError'); ?>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="nim">NIM</label>
                            <input type="number" value="<?= $dataPanit['nim'] ?>" class="form-control <?php if(session()->getFlashdata('nimError')){echo 'is-invalid';}?>" id="nim" name="nim" aria-describedby="nim" placeholder="Nomor Induk Mahasiswa">
                            <div class="invalid-feedback">
                            <?php if (session()->getFlashdata('nimError')) : ?>
                                <?php echo session()->getFlashdata('nimError'); ?>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="divisi">Divisi</label>
                            <select class="form-select" name="divisi" id="divisi">
                                <option <?php if(!strcmp($dataPanit['divisi'],'Acara')){echo 'selected';} ?> value="Acara">Acara</option>
                                <option <?php if(!strcmp($dataPanit['divisi'],'Webdev')){echo 'selected';} ?> value="Webdev">Webdev</option>
                                <option <?php if(!strcmp($dataPanit['divisi'],'Visual')){echo 'selected';} ?> value="Visual">Visual</option>
                                <option <?php if(!strcmp($dataPanit['divisi'],'Dokumentasi')){echo 'selected';} ?> value="Dokumentasi">Dokumentasi</option>
                                <option <?php if(!strcmp($dataPanit['divisi'],'Media Relations')){echo 'selected';} ?> value="Media Relations">media relation</option>
                                <option <?php if(!strcmp($dataPanit['divisi'],'Publikasi')){echo 'selected';} ?> value="Publikasi">Publikasi</option>
                                <option <?php if(!strcmp($dataPanit['divisi'],'Sponsor')){echo 'selected';} ?> value="Sponsor">Sponsor</option>
                                <option <?php if(!strcmp($dataPanit['divisi'],'Fresh Money')){echo 'selected';} ?> value="Fresh Money">Fresh Money</option>
                                <option <?php if(!strcmp($dataPanit['divisi'],'Keamanan')){echo 'selected';} ?> value="Keamanan">Keamanan</option>
                                <option <?php if(!strcmp($dataPanit['divisi'],'Lomba')){echo 'selected';} ?> value="Lomba">Lomba</option>
                                <option <?php if(!strcmp($dataPanit['divisi'],'Perlengkapan')){echo 'selected';} ?> value="Perlengkapan">Perlengkapan</option>
                            </select>
                        </div>
                        <button class="btn btn-success mt-3" style="margin-right: 5px;" type="submit">Save</button><a href="<?= base_url();?>/dashboard/oprec" class="btn btn-danger mt-3">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>