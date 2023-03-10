<?php 
namespace App\Models;

use CodeIgniter\Model;
class Pengaduan extends Model{
    protected $table = 'tb_pengaduan';
    //Uncomment below if you want add primarykey
    protected $primaryKey = 'id_pengaduan';
    protected $allowedFields = ['tgl_pengaduan','nik','isi_laporan','foto','status'];
    protected $deletedFeilds = 'deleted_at';
}
