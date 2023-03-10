<?= $this->extend('layout/admin') ?>
<?= $this->section('title') ?>
Petugas
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-gradient-primary">
                    <h3>Petugas</h3>
                    <a href="" data-toggle="modal" data-target="#fPetugas" data-petugas="add"
                        class="btn btn-primary">Tambah data</a>
                    <!-- <a href="/fpetugas" class="btn btn-success">Tambah Data</a> -->
                </div>
                <div class="card-body">
                    <table class="table table-border">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Telp</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        $no=0;
                        foreach ($petugas as $row) {
                            $data = $row['id_petugas'] . "," . $row['nama_petugas'] . "," . $row['username'] . "," . $row['password'] . "," . $row['telp'] . "," . $row['level'] . "," . base_url('petugas/edit/'. $row['id_petugas']);
                            # code...
                            $no++;
                            ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama_petugas']?></td>
                            <td><?= $row['username']?></td>
                            <td><?= $row['telp']?></td>
                            <td><?= $row['level']?></td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#fPetugas" class="btn btn-primary"
                                    data-petugas="<?= $data?>">edit</a>   
                                <a href="/petugas/delete/<?= $row['id_petugas']?>"
                                    onclick="return confirm('Yakin ingin hapus data ?')"
                                    class="btn btn-danger">hapus</a>
                            </td>
                        </tr>
                        <?php
                       }
                     ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php if(!empty(session()->getFlashdata("message"))):?>
    <div class="alert alert-success">
        <?= session()->getFlashdata("message")?>
    </div>
    <?php endif ?>
</div>
<div class="modal fade" id="fPetugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="editPetugas" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_petugas">Nama Petugas</label>
                        <input type="text" name="nama_petugas" id="nama_petugas" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telp">Telp</label>
                        <input type="number" name="telp" id="telp" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" class="form-control" id="level">
                            <option value="">Pilih Level</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="ubahpassword">
                    <label for="ubahpassword">Ubah Password</label>
                    <input type="checkbox" name="ubahpassword" aria-label="Mau Ubah Password" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection()?>
<?= $this->section('script')?>
<script>
$(document).ready(function() {
    $("#fPetugas").on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var data = button.data('petugas');
        //alert("asa");

        if (data!="add") {
            const barisdata = data.split(",");
            // alert(barisdata[4]);
            $("#nama_petugas").val(barisdata[1]);
            $("#username").val(barisdata[2]);
            $("#password").val(barisdata[3]);
            $("#telp").val(barisdata[4]);
            $("#level").val(barisdata[5]);
            $("#editPetugas").attr('action', barisdata[6]);
            // alert(barisdata[6]);
            $("#ubahpassword").show();
        } else {
            $("#nama_petugas").val("");
            $("#username").val("");
            $("#telp").val("");
            $("#level").val("");
            $("#editPetugas").attr('action', "petugas");
            // $("#ubahpassword").hide();
        }
    });
})
</script>
<?= $this->endSection()?>