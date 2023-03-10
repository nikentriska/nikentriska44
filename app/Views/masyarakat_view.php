<?= $this->extend('layout/admin') ?>
<?= $this->section('title') ?>
Masyarakat
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary">
                <a href="#" data-masyarakat="" class="btn btn-outline-light" data-target="#modalMasyarakat" data-toggle="modal"><i class="fas fa-fw fa-solid fa-user-plus"></i>Masyarakat</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="masyarakat">
                    <head>
                        <tr>
                            <th>No</th>
                            <th>Nik</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Telp</th>
                            <th>aksi</th>
                        </tr>
                    </head>
                    <body>
                        <?php
                        $no = 0;
                        foreach ($masyarakat as $row) {
                            $no++;
                            $data = $row['nik'] . "," . $row['nama'] . "," . $row['username'] . "," . $row['telp'] . "," . base_url('masyarakat/edit/' . $row['id_masyarakat']);
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['nik'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['telp'] ?></td>
                                <td>
                                    <a href="" data-masyarakat="<?= $data ?>" data-target="#modalMasyarakat" data-toggle="modal" class="btn btn-warning">Edit</a>
                                    <a href="<?= base_url('masyarakat/delete/' . $row['id_masyarakat']) ?>" onclick="return confirm('yakin mau hapus?')" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </body>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMasyarakat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModelLabel">Input data Masyarakat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editMasyarakat" action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik">Nik</label>
                        <input type="number" name="nik" class="form-control" id="nik">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="type" name="nama" class="form-control" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="telp">telp</label>
                        <input type="number" name="telp" class="form-control" id="telp">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
<?= $this->Section("script") ?>
<script>
    $(document).ready(function() {
        $("#modalMasyarakat").on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var data = button.data('masyarakat');
            
            if (data != "add") {
               
                const barisdata = data.split(",");
                $('#nik').val(barisdata[0]);
                $('#nama').val(barisdata[1]);
                $('#username').val(barisdata[2]);
                $('#password').val(barisdata[4]);
                $('#telp').val(barisdata[5]).change();
                $('#editmasyarakat').attr('action', barisdata[4]);
                $('#ubahpassword').show();
            } else {
                $('#nik').val('');
                $('#nama').val('');
                $('#username').val('');
                $('#password').val('');
                $('#telp').val('').change();
                $('#editmasyarakat').attr('action', 'masyarakat');
            }
        });
    })
</script>
<?= $this->endSection() ?>