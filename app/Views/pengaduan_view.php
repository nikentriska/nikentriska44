<?= $this->extend('layout/admin')?>
<?= $this->section('title')?>
Data Pengaduan 
<?= $this->endSection()?>
<?= $this->section('content')?> 

<div class="col">
    <div class="card">
        <div class="card-header">
            <?php 
            if(session()->get('level')== 'masyarakat'){
                ?>
                <a href="#" data-toggle="modal" data-target="#modalPengaduan" class="btn btn-primary">Tambah Pengaduan</a>
                <?php } ?>
            </div>
            <div class="card-body">
                <table class="table table-striped table bordered">
                    <tr>
                        <th>No</th>
                        <th>tanggal Pengaduan</th>
                        <th>Isi Laporan</th>
                        <th>Foto</th>
                        <th>Opsi</th>
                    </tr>
                    <?php 
                    $no=0;
                    foreach($pengaduan as $row){
                        $no++;
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$row['tgl_pengaduan']?></td>
                            <td><?=$row['isi_laporan']?></td>
                            <td>
                                <?php 
                                if ($row['foto']!="")
                                {
                                    ?>
                                    <img src='/uploads/berkas/<?=$row['foto']?>' alt="" height="50" width="50">
                                    <?php
                                }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    if(session('level')=='masyarakat'){
                                        if($row['status']=='0'){
                                            ?>
                                            <a onclick="return confirm('Yakin hapus data?');" class="btn btn-danger" href="/pengaduan/hapus/<?=$row['id_pengaduan']?>"><i class="fas fa-trash"></i></a>
                                            <?php 
                                        }else{
                                            ?>
                                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modalTanggapan" data-pengaduan="<?=$row['id_pengaduan']?>" data-aduan="selesai">Lihat Tanggapan</a>
                                            <?php 
                                        }
                                    }
                                    if(!empty(session('level')) && session('level') != 'masyarakat') {
                                        if($row['status'] == '0'){
                                            ?>
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTanggapan" data-pengaduan="<?=$row['id_pengaduan']?>">Tanggapi</a>
                                            <?php
                                        }else{
                                            ?>
                                            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modalTanggapan" data-pengaduan="<?=$row['id_pengaduan']?>" data-aduan="selesai"> Lihat Tanggapan</a>
                                            <?php 

                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="modalPengaduan" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Tambah Pengaduan</h5>
                                </div>
                                <form action="/tambahpengaduan" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Isi Laporan</label>
                                            <textarea name="isi_laporan" class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Foto</label>
                                            <input type="file" name="foto" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalTanggapan" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismis="modal" aria-hidden="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                <form action="tanggapi" method="post">
                                    <input type="hidden" name="id_pengaduan" id="id_pengaduan">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Tanggapan</label>
                                            <textarea name="tanggapan" id="tanggapans" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" id="btstanggapan">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->endSection()?>
            <?= $this->section('script')?>
            <script>
                $(document).ready(function(){
                    $('#modalTanggapan').on('show.bs.modal',function(e){
                        var button= $(e.relatedTarget);
                        var data= button.data('pengaduan');
                        var aduan= button.data('aduan');
                        $('#id_pengaduan').val(data);
                        if (aduan=="selesai")
                        {
                            var query= "id_pengaduan="+data;
                            //alert(query);

                            $('#btstanggapan').hide();
                            $.ajax({
                                url:"/getTanggapan",
                                type:"GET",
                                data:query,
                                dataType:"json",
                                success:function(data)
                                {
                                    //alert(data);
                                    $('#tanggapans').val(data[0].tanggapan);
                                },
                                error:function(error)
                                {
                                    console.log(error);
                                }
                            });
                            $('#tanggapans').val();
                        }
                        else{
                            $('#btstanggapan').val();
                            $('#tanggapans').val("");
                        }
                    });
                })
                </script>
                <?= $this->endSection()?>