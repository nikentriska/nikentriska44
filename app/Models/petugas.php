<?php 
namespace App\Models;

use CodeIgniter\Model;
class petugas extends Model{
    protected $table = 'tb_petugas';
    //Uncomment below if you want add primarykey
    protected $primaryKey = 'id_petugas';
    protected $allowedFields = ['nama_petugas','username','password','telp','level'];
    protected $deletedFeilds = 'deleted_at';
}
