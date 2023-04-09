<div>
    <div class="col-12 mb-3">
        <label class="form-label" for="provinsi">Provinsi</label>
        <select class="form-control form-select @error('provinsi')is-invalid @enderror" wire:model="selectedProvinsi" name="provinsi">
            <option value="">Pilih Provinsi</option>
            @foreach ($provinsi as $item)
            <option value="{{ $item->provinsi_id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
        @error('provinsi')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-12 mb-3">
        <label class="form-label" for="kabupaten">Kabupaten</label>
        <select class="form-control form-select @error('kabupaten')is-invalid @enderror" wire:model="selectedKabupaten" name="kabupaten">
            <option>Pilih Kabupaten</option>
            @if (!is_null($dataKabupatens))
            @foreach ($dataKabupatens as $item)
                <option value="{{ $item['kabupaten_id'] }}">{{ $item['nama'] }}</option>
            @endforeach
            @endif
        </select>
        @error('kabupaten')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-12 mb-3">
        <label class="form-label" for="kecamatan">Kecamatan</label>
        <select class="form-control form-select @error('kecamatan')is-invalid @enderror" wire:model="selectedKecamatan" name="kecamatan">
            <option>Pilih Kecamatan</option>
            @if (!is_null($dataKecamatan))
            @foreach ($dataKecamatan as $item)
                <option option value="{{ $item['kecamatan_id'] }}">{{ $item['nama'] }}</option>
            @endforeach
            @endif
        </select>
        @error('kecamatan')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>