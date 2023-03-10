<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\petugas;

use App\Models\Masyarakat;
class LoginController extends BaseController{
    protected $masyarakats;
    function __construct()
    {
        $this->masyarakats = new Masyarakat;
    }

    public function index()
    {
        return view('login_view');
    }

    public function register()
    {
        return view('register_view');
    }

    public function profil()
    {
        return view('profil_view');
    }

    public function saveRegister()
    {
        $ceknik = $this->masyarakats->where('nik',$this->request->getPost('nik'))->findAll();
        if ($ceknik==null)
        {
            $data=array(
                'nik'=> $this->request->getPost('nik'),
                'nama'=> $this->request->getPost('nama'),'username'=>$this->request->getPost('username'),
                'password'=> password_hash($this->request->getPost('password')."",PASSWORD_DEFAULT),
                'telp'=> $this->request->getPost('telp')
            );
            $this->masyarakats->insert($data);
            return redirect('login');
        }
        else
        {
            return redirect('register')->with('error', lang('Nik sudah ada'));
        }
    }
    public function login()
    {
        $masy= new Masyarakat();
        $petugass= new petugas();
        
        $username= $this->request->getPost('username');
        $password= $this->request->getPost('password').""; 
        $cekpetugas= $petugass->where(['username'=>$username])->first();
        $cekmasy= $masy->where(['username'=>$username])->first();
        if (!($cekmasy)&&!($cekpetugas))
        {
            return redirect('login')->with("error",lang('Username tidak ditemukan'));
        }
        else
        {
            if ($cekmasy)
            {
                if (password_verify($password, $cekmasy['password'])) {
                    session()->set([
                        'nik'=>$cekmasy['nik'],
                        'nama'=>$cekmasy['nama'],
                        'username'=>$cekmasy['username'],
                        'telp'=>$cekmasy['telp'],
                        'level'=>'masyarakat',
                        'log_in'=>true,
                    ]);
                    return redirect('/');
                }
                else
                {
                    return redirect('login')->with("error",lang('Password masyarakat salah'));
                }
            }
            if($cekpetugas)
            {
                if (password_verify($password, $cekpetugas['password'])) {
                    session()->set([
                        'id_petugas'=>$cekpetugas['id_petugas'],
                        'nama'=>$cekpetugas['nama_petugas'],
                        'level'=>$cekpetugas['level'],
                        'log_in'=>true,
                    ]);
                    return redirect('/');
                }
                else
                {
                    return redirect('login')->with("error",lang('Password Petugas salah'));
                }

               
            }
        }
    }

    public function logout()
    {
        $session = session();
        session()->destroy();
        return $this->response->redirect('/login');
    }

    public function lihatprofil(){
        $petugass = new petugas();
        $masyarakats = new Masyarakat();
        if(session('level')=='masyarakat'){
            $data['user'] = $masyarakats->where('nik',session('nik'))->findAll();
        }else{
            $data['user'] = $petugass->where('id_petugas',session('id_petugas'))->findAll();
        }
        return view('profil_view',$data);
    }

    public function editProfil()
    {
       $petugass = new petugas();
       $masyarakats = new Masyarakat();
       $id = $this->request->getPost('id');
       $nama = $this->request->getPost('nama');
       $nama = $this->request->getPost('nama');
       $username = $this->request->getPost('usernam');
       $telp = $this->request->getPost('telp');
       $pass_old = $this->request->getPost('password_old');
       $pass_new = $this->request->getPost('password_new');

       if(session('level')=='masyarakat') {
        $datamasy = $masyarakats->where('id_masyarakat',$id)->first();
        if(empty($pass_old)){
            $data = [
                'nama'=>$nama,
                'username'=>$username,
                'telp'=>$telp,
                'password'=>password_hash($pass_new."",PASSWORD_DEFAULT)
            ];
        }
       
       $masyarakats->update($id,$data);
    }else{
        $datapetugas = $petugass->where('id_petugas',$id)->first();
        if(empty($pass_old)){
            $data = [
                'nama_petugas'=>$nama,
                'username'=>$username,
                'telp'=>$telp,
            ];
        }else{
            if(password_verify($pass_old."",$datapetugas['password'])){
                $data = array(
                    'nama_petugas'=>$nama,
                    'username'=>$username,
                    'telp'=>$telp,
                    'password'=>password_hash($pass_new."",PASSWORD_DEFAULT)."",
                );
            }
        }
        $petugass->update($id,$data);
    }
    session()->setFlashdata('sukses','Update profil berhasil');
    return redirect('profil');
}
}