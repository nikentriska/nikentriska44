<?php 
namespace App\Models;

use CodeIgniter\Model;
class Tanggapan extends Model{
    protected $table = 'tb_tanggapan';
    //Uncomment below if you want add primarykey
    protected $primaryKey = 'id_tanggapan';
    protected $allowedFields = ['id_pengaduan','tgl_tanggapan','tanggapan','id_petugas'];
    protected $deletedFeilds = 'deleted_at';
}
