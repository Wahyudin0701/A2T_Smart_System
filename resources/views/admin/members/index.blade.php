@extends('layouts.admin.app')

@section('main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Data Member') }}</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="content">
    <div class="container-fluid">
        <div class="card mb-3"></div>
        <div class="card bg-white">
            <div class="card-header bg-danger text-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="card-title mb-0"><b>Daftar Member Gym</b></h4>
                    <div>
                        <a class="btn btn-light text-dark me-2 mb-1" data-toggle="modal" data-target="#createMemberModal" href="#">
                            <i class="fas fa-plus mr-2"></i> Tambah data member
                        </a>
                        <a class="btn btn-light text-dark mb-1" id="refreshBtn" onclick="alert('Fitur Generate All sedang dikembangkan')" href="#" data-toggle="tab">
                            <i class="fas fa-qrcode mr-2"></i> Generate All QR
                        </a>
                    </div>
                </div>
            </div>
            <div class="p-3">
                @if(count($members) > 0)
                <table class="table table-bordered table-striped text-center">
                    <thead class="bg-danger text-white">
                        <tr>
                            <th>No.</th>
                            <th>Nama Member</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- nomor -->
                            <td>{{ $member->name }}</td>
                            <td>{{ ucfirst($member->gender) }}</td>
                            <td>
                                @php
                                $isAktif = $member->status === 'Active';
                                $badgeClass = $isAktif ? 'bg-success' : 'bg-secondary';
                                @endphp
                                <span class="badge {{ $badgeClass }} text-white fw-semibold text-uppercase d-inline-block text-center"
                                    style="min-width: 60%; height: 30px; line-height: 25px; font-size: 0.85rem;">
                                    {{ $isAktif ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-detail"
                                    data-id="{{ $member->id }}"
                                    data-name="{{ $member->name }}"
                                    data-age="{{ $member->age }}"
                                    data-gender="{{ $member->gender }}"
                                    data-package="{{ $member->package }}"
                                    data-phone="{{ $member->phone_number }}"
                                    data-start="{{ $member->membership_start }}"
                                    data-end="{{ $member->membership_end }}"
                                    data-status="{{ $member->status }}"
                                    data-toggle="modal"
                                    data-target="#detailMember">
                                    Detail
                                </button>
                            </td>
                            <td class="d-flex justify-content-center">
                                <button type="button" class="btn btn-sm btn-primary me-1"
                                    data-id="{{ $member->id }}"
                                    data-name="{{ $member->name }}"
                                    data-age="{{ $member->age }}"
                                    data-gender="{{ $member->gender }}"
                                    data-package="{{ $member->package }}"
                                    data-phone="{{ $member->phone_number }}"
                                    data-start="{{ $member->membership_start }}"
                                    data-end="{{ $member->membership_end }}"
                                    data-status="{{ $member->status }}"
                                    data-url="{{ route('members.update', $member->id) }}"
                                    data-toggle="modal"
                                    data-target="#editMemberModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mx-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <a href="{{ route('members.generateDownloadQr', $member->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-qrcode"></i>
                                </a>

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
@include('admin.members.create')
@include('admin.members.edit')
@include('admin.members.detail')
@endsection

@section('scripts')
<script src="{{ asset('js/member.js') }}"></script>
@endsection