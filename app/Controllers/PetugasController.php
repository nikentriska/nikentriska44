<?php 
namespace App\Controllers;

use App\Models\Petugas;

class PetugasController extends BaseController{

    protected $petugass;

    function __construct()
    {
        $this->petugass = new Petugas();
    }

    public function index()
    {
        $data['petugas'] = $this->petugass->findAll();
        return view('Petugas_view',$data);
    }
    public function create()
    {
        return view('fpetugas_view');
    }

    public function save()
    {
        $data= array(
            'nama_petugas'=> $this->request->getPost('nama_petugas'),
            'username'=> $this->request->getPost('username'),
            'telp' => $this->request->getPost('telp'),
            'level' => $this->request->getPost('level'),
            'password' => password_hash($this->request->getPost('password')."", PASSWORD_DEFAULT),
        );
        $this->petugass->insert($data);
        session()->setFlashdata("message","Data berhasil disimpan");
        return $this->response->redirect('/petugas');
    }
    
    public function edit($id)
    {
        if ($this->request->getPost('ubahpassword')== null )
        {
            $data= array (
                'nama_petugas'=>$this->request->getPost('nama_petugas'),
                'username'=>$this->request->getPost('username'),
                'telp'=>$this->request->getPost('telp'),
                'level'=>$this->request->getPost('level'),
            ); 
            $this->petugass->update($id,$data);    
        }
        else
        {
            $data= array(
                'nama_petugas'=>$this->request->getPost('nama_petugas'),
                'username'=>$this->request->getPost('username'),
                'telp'=>$this->request->getPost('telp'),
                'level'=>$this->request->getPost('level'),
            );
            $this->petugass->update($id,$data);
            
        }
        session()->setflashdata("message","Data Berhasil Diubah");
        return $this->response->redirect('/petugas');
    }
    public function delete($id)
    {
        $this->petugass->delete($id);
        session()->setFlashdata("message","Data Berhasil Di Hapus");
        return $this->response->redirect('/petugas');
    }
}