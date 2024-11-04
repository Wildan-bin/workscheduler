@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buat Jadwal Baru</h1>
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="pegawai_id">Pilih Pegawai</label>
                <select name="pegawai_id" id="pegawai_id" class="form-control">
                    @foreach ($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="shift_id">Pilih Shift</label>
                <select name="shift_id" id="shift_id" class="form-control">
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}">{{ $shift->nama_shift }} ({{ $shift->mulai }} -
                            {{ $shift->selesai }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal">Pilih Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Buat Jadwal</button>
        </form>
    </div>
@endsection
