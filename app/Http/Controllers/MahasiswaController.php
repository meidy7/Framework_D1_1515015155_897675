<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengguna;
use App\Http\Requests;
use App\Http\Requests\MahasiswaRequest;
use App\mahasiswa;

class MahasiswaController extends Controller
{
    protected $informasi = 
    'Gagal melakukan aksi';
    public function awal()
    {
       
        //return view('mahasiswa.awal', ['semuaMahasiswa'=>mahasiswa::all()]);

        $semuaMahasiswa = mahasiswa::all();
        return view('mahasiswa.awal',compact('semuaMahasiswa'));
    }
    public function tambah(){
        return view('mahasiswa.tambah');
    }
    public function simpan(MahasiswaRequest $input){
        $pengguna = new pengguna($input->only('username','password'));
        if ($pengguna->save()) {
            # code...
            $mahasiswa = new mahasiswa();
            $mahasiswa->nama = $input->nama;
            $mahasiswa->nim = $input->nim;
            $mahasiswa->alamat = $input->alamat;
            if ($pengguna->mahasiswa()->save($mahasiswa)) 
                $this->informasi = 'Berhasil simpan data';
        }
    return redirect('mahasiswa')->with(['informasi'=>$this->informasi]);
}

    public function edit($id){
        $mahasiswa = mahasiswa::find($id);
        return view('mahasiswa.edit')->with(array('mahasiswa'=>$mahasiswa ));
    }
    public function lihat($id){
        $mahasiswa = mahasiswa::find($id);
        return view('mahasiswa.lihat')->with(array('mahasiswa'=>$mahasiswa ));
        // dd($mahasiswa);
    }

    public function update($id, MahasiswaRequest $input){
        $mahasiswa = mahasiswa::find($id);
        $pengguna = $mahasiswa->pengguna;
        $mahasiswa->nama = $input->nama;
        $mahasiswa->nim = $input->nim;
        $mahasiswa->alamat = $input->alamat;
        $mahasiswa->save();
        if (!is_null($input->username)) {
            # code...
            $pengguna = $mahasiswa->pengguna->fill($input->only('username'));
            if (!empty($input->password)) $pengguna->password = $input->password;
            if ($pengguna->save()) $this->informasi = 'Berhasil Simpan Data';
            }else{
                $this->informasi= 'Gagal Simpan Data';
            }
    return redirect('mahasiswa')->with(['informasi'=>$this->informasi]);
    }

    public function hapus($id){
        $mahasiswa = mahasiswa::find($id);
        if ($mahasiswa->pengguna()->delete()) {
            # code...
            if ($mahasiswa->delete()) $this->informasi = 'Berhasil Hapus Data';
            
        }
    return redirect('mahasiswa')->with(['informasi'=>$this->informasi]);
    }
}
