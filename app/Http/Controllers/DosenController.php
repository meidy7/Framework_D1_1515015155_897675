<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DosenRequest;
use App\Http\Requests;
use App\dosen;
use App\Pengguna;

class DosenController extends Controller
{
    protected $informasi = 'Gagal melakukan aksi'; //
    public function awal()
    {
        //return "Hello dari DosenController";
       // return view('dosen.awal', ['data'=>Dosen::all()]);
       $semuaDosen = Dosen::all();//
        return view('dosen.awal', compact('semuaDosen'));
    }

    public function tambah()
    {
        //return $this->simpan();
        return view('dosen.tambah');
    }

    public function simpan(DosenRequest $input)
    {
        $pengguna = new Pengguna($input->only('username','password'));
            if ($pengguna->save()) {
                $dosen = new Dosen;
                $dosen->nama = $input->nama;
                $dosen->nip = $input->nip;
                $dosen->alamat = $input->alamat;
                if($pengguna->dosen()->save($dosen)) $this->informasi='Berhasil simpan data';
            }        
        return redirect ('dosen')->with(['informasi'=>$this->informasi]);
    }

    public function edit($id)
    {
        $dosen = Dosen::find($id);
        return view('dosen.edit')-> with(array('dosen'=>$dosen));
    }

    public function lihat($id)
    {
        $dosen = Dosen::find($id);
        return view('dosen.lihat')->with(array('dosen'=>$dosen));
    }

    public function update($id, DosenRequest $input)
    {
        $dosen = Dosen::find($id);
        //$pengguna = $dosen->pengguna;
        $dosen->nama = $input->nama;
        $dosen->nip = $input->nip;
        $dosen->alamat = $input->alamat;
        //$dosen->pengguna_id = $input->pengguna_id;
        $dosen->save();
        if(!is_null($input->username)){
            $pengguna = $dosen->pengguna->fill($input->only('username'));
                if(!empty($input->password)) $pengguna->password = $input->password;
                if($pengguna->save()) $this->informasi = 'Berhasil simpan data';
        }
        else{
            $this->informasi = 'Berhasil simpan data';
        }
        return redirect ('dosen') -> with (['informasi'=>$this->informasi]);
    }
    public function hapus($id)
    {
        $dosen = Dosen::find($id);
        if($dosen->pengguna()->delete()){
            if($dosen->delete()) $this->informasi = 'Berhasil hapus data';
        }
        return redirect('dosen')-> with(['informasi'=>$this->informasi]);
    }










    /*
    public function awal()
    {
        # code...
        return view('dosen.awal', ['data'=>dosen::all()]);
    }
    public function tambah(){
        return view('dosen.tambah');
    }
    public function simpan(Request $input){
        $dosen = new dosen;
        $dosen->nama = $input->nama;
        $dosen->nip = $input->nip;
        $dosen->alamat = $input->alamat;
        $dosen->pengguna_id = $input->pengguna_id;
        $informasi = $dosen->save()?'Berhasil simpan data': 'Gagal simpan data';
    return redirect('dosen')->with(['informasi'=>$informasi]);
}
    public function edit($id){
        $dosen = dosen::find($id);
    
        return view('dosen.edit')->with(array('dosen' =>$dosen ));
    }
    public function lihat($id){
        $dosen = dosen::find($id);
        return view('dosen.lihat')->with(array('dosen' =>$dosen ));
    }

    public function update($id, Request $input){
        $dosen = dosen::find($id);
        $dosen->nama = $input->nama;
        $dosen->nip = $input->nip;
        $dosen->alamat = $input->alamat;
        $dosen->pengguna_id = $input->pengguna_id;
        $informasi = $dosen->save()?'Berhasil update data': 'Gagal update data';
    return redirect('dosen')->with(['informasi'=>$informasi]);
    }

    public function hapus($id){
        $dosen = dosen::find($id);
        $informasi = $dosen->delete()?'Berhasil hapus data': 'Gagal hapus data';
    return redirect('dosen')->with(['informasi'=>$informasi]);
    }*/
}
