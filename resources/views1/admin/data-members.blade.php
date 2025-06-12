@extends('layouts.admin')

@section('main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Data Member') }}</h1>

<div class="content">
    <div class="container-fluid">
        <div class="card bg-white">
            <div class="card-header bg-danger text-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="card-title mb-0"><b>Daftar Member Gym</b></h4>
                    <div>
                        <a class="btn btn-light text-dark me-2 mb-1" data-toggle="modal" data-target="#modalTambahMember" href="#">
                            <i class="fas fa-plus mr-2"></i> Tambah data member
                        </a>
                        <a class="btn btn-light text-dark mb-1" id="refreshBtn" onclick="getDataGuru()" href="#" data-toggle="tab">
                            <i class="fas fa-qrcode mr-2"></i> Generate All QR
                        </a>
                    </div>
                </div>
            </div>
            <div id="dataGuru" class="p-3">
                @if(count($members) > 0)
                <table class="table table-bordered table-striped text-center">
                    <thead class="bg-danger text-white">
                        <tr>
                            <th>No.</th>
                            <th>Nama Member</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>No Handphone</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $index => $member)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->age }}</td>
                            <td>{{ ucfirst($member->gender) }}</td>
                            <td>{{ $member->phone_number }}</td>
                            <td>
                                @php
                                $isAktif = $member->status === 'active';
                                $badgeClass = $isAktif ? 'bg-success' : 'bg-secondary';
                                @endphp
                                <span class="badge {{ $badgeClass }} text-white fw-semibold text-uppercase d-inline-block text-center"
                                    style="min-width: 60%; height: 30px; line-height: 25px; font-size: 0.85rem;">
                                    {{ $isAktif ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>
                                <!-- tombol aksi -->
                                <button class="btn btn-sm btn-primary me-1" title="Edit" onclick="editMember()">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- tombol aksi -->
                                <button class="btn btn-sm btn-danger me-1" title="Edit" onclick="hapusMember()">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button class="btn btn-sm btn-success" title="QR Code" onclick="generateQrCode()">
                                    <i class="fas fa-qrcode"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                @else
                <p class="text-center mt-4 text-muted">Daftar member kosong</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data Member -->
<div class="modal fade" id="modalTambahMember" tabindex="-1" role="dialog" aria-labelledby="modalTambahMemberLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Ganti action dengan route simpan member -->
            <form action="{{ route('save-member') }}" method="POST">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalTambahMemberLabel">Tambah Data Member</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Nama Member -->
                    <div class="form-group">
                        <label for="name">Nama Member</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <!-- Usia -->
                    <div class="form-group">
                        <label for="age">Usia</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="" disabled selected>Pilih jenis kelamin</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <!-- No Handphone -->
                    <div class="form-group">
                        <label for="phone_number">No Handphone</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number">
                    </div>
                    <!-- Membership Start -->
                    <div class="form-group">
                        <label for="membership_start">Mulai Membership</label>
                        <input type="date" class="form-control" id="membership_start" name="membership_start" required>
                    </div>
                    <!-- Membership End -->
                    <div class="form-group">
                        <label for="membership_end">Berakhir Membership</label>
                        <input type="date" class="form-control" id="membership_end" name="membership_end" required>
                    </div>
                    <!-- Status -->
                    <div class="form-group">
                        <label for="status">Status Member</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active" selected>Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection