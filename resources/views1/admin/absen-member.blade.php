@extends('layouts.admin')

@section('main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Absen Member') }}</h1>

@php
$absenMembers = [
['id' => 1, 'nama' => 'Andi Saputra', 'kehadiran' => 'Hadir'],
['id' => 2, 'nama' => 'Sari Dewi', 'kehadiran' => 'Tidak Hadir'],
['id' => 3, 'nama' => 'Budi Santoso', 'kehadiran' => 'Tidak Hadir'],
['id' => 4, 'nama' => 'Lia Kartika', 'kehadiran' => 'Hadir'],
];
@endphp

<div class="content">
    <div class="container-fluid">
        <div class="card mb-3">

        </div>
        <div class="card primary">
            <div class="card-body">
                <div class="row align-items-center justify-content-between mb-3">
                    <div class="col-md">
                        <div class="ps-3 pt-3">
                            <h4 class="fw-bold">Absen Member</h4>
                            <p class="text-muted mb-0">Daftar Member muncul disini</p>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="d-flex align-items-center gap-2 pe-3 pt-3 pb-2">
                            <h5 class="mb-0 mr-2 fw-bold">Tanggal</h5>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ date('Y-m-d') }}" onchange="getGuru()" style="max-width: 200px;">
                        </div>
                    </div>
                </div>


                <div id="dataGuru" class="mt-3">
                    <table class="table table-bordered table-striped text-center">
                        <thead class="bg-danger text-white">
                            <tr>
                                <th>No.</th>
                                <th>Nama Member</th>
                                <th>Kehadiran</th>
                                <th>Waktu kehadiran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absenMembers as $index => $member)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $member['nama'] }}</td>
                                <td>
                                    <span class="badge text-white fw-semibold text-uppercase d-inline-block text-center
                                        @if($member['kehadiran'] == 'Hadir') bg-success
                                        @elseif($member['kehadiran'] == 'Tidak Hadir') bg-danger
                                        @elseif($member['kehadiran'] == 'Izin') bg-warning text-dark
                                        @endif"
                                        style="min-width: 60%; height: 30px; line-height: 25px; font-size: 0.85rem;">
                                        {{ $member['kehadiran'] }}
                                    </span>
                                </td>
                                <td>17:12</td>
                                <td>
                                    <button class="btn btn-sm btn-primary"
                                        data-toggle="modal" data-target="#modalUbahKehadiran"
                                        data-id="{{ $member['id'] }}"
                                        data-nama="{{ $member['nama'] }}"
                                        data-kehadiran="{{ $member['kehadiran'] }}">
                                        Ubah Absen
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Kehadiran Member -->
    <div class="modal fade" id="modalUbahKehadiran" tabindex="-1" role="dialog" aria-labelledby="modalUbahKehadiranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="ubah_id" name="id">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modalUbahKehadiranLabel">Ubah Data Kehadiran</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Status Kehadiran -->
                        <div class="form-group">
                            <label for="ubah_kehadiran">Status Kehadiran</label>
                            <select class="form-control" id="ubah_kehadiran" name="kehadiran" required>
                                <option value="Hadir">Hadir</option>
                                <option value="Tidak Hadir">Tidak Hadir</option>
                                <option value="Izin">Izin</option>
                            </select>
                        </div>
                        <!-- Waktu Masuk -->
                        <div class="form-group">
                            <label for="ubah_waktu_masuk">Waktu Masuk</label>
                            <input type="datetime-local" class="form-control" id="ubah_waktu_masuk" name="waktu_masuk" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
@endsection

@push('scripts')
<script>
    $('#ubahModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nama = button.data('nama');
        var kehadiran = button.data('kehadiran');

        var modal = $(this);
        modal.find('.modal-title').text('Ubah Kehadiran - ' + nama);

        var formHtml = `
            <form id="formUbahKehadiran">
                <input type="hidden" name="id" value="${id}">
                <div class="form-group">
                    <label>Nama Member</label>
                    <input type="text" class="form-control" value="${nama}" disabled>
                </div>
                <div class="form-group">
                    <label>Status Kehadiran</label>
                    <select name="kehadiran" class="form-control">
                        <option value="Hadir" ${kehadiran == 'Hadir' ? 'selected' : ''}>Hadir</option>
                        <option value="Tidak Hadir" ${kehadiran == 'Tidak Hadir' ? 'selected' : ''}>Tidak Hadir</option>
                        <option value="Izin" ${kehadiran == 'Izin' ? 'selected' : ''}>Izin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
        `;
        modal.find('#modalFormUbahGuru').html(formHtml);
    });

    $(document).on('submit', '#formUbahKehadiran', function(e) {
        e.preventDefault();
        alert('Fungsi simpan kehadiran belum dibuat, ini hanya demo');
        $('#ubahModal').modal('hide');
    });
</script>
@endpush