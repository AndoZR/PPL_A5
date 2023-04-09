<?php

namespace App\Http\Livewire;

use App\Models\provinsi;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Region extends Component
{
    public $selectedProvinsi = null;
    public $kabupatens = null;
    public $selectedKabupaten = null;
    public $kecamatans = null;
    public $selectedKecamatan = null;
    public $dataKabupatens = null;
    public $dataKecamatan = null;
    
    public function render()
    {
        return view('livewire.region',[
            'provinsi' => provinsi::all(),
            'selectedProvinsi'=>$this->selectedProvinsi,
            'selectedKabupaten'=>$this->selectedKabupaten,
            'selectedKecamatan'=>$this->selectedKecamatan,
            'kabupatens'=>$this->kabupatens,
            'kecamatans'=>$this->kecamatans,
        ]);
    }
    
    public function updatedSelectedProvinsi($selectedProvinsi)
    {
        $this->kabupatens = DB::table('kabupaten')->where('provinsi_id', $selectedProvinsi)->get();
        $this->dataKabupatens = json_decode($this->kabupatens, true);
    }
    public function updatedSelectedKabupaten($selectedKabupaten)
    {
        $this->kecamatans = DB::table('kecamatan')->where('kabupaten_id', $selectedKabupaten)->get();
        $this->dataKecamatan = json_decode($this->kecamatans, true);
        // dd($this->kecamatans);
        // dd($this->selectedKecamatan);
    }
}
