@extends('layouts.admin.app')

@section('main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Absen Member') }}</h1>

<div class="content">
    <div class="container-fluid">
        <hr>
        <div class="mb-3 text-danger" style="font-size: 1.5rem; ">
            {{ $format_tanggal }}
        </div>
        <div class="card primary">
            <div class="card-body">
                <div class="row align-items-center justify-content-between mb-3">
                    <div class="col-md-8">
                        <div class="ps-3 pt-3">
                            <p class="text-muted mb-0">Daftar Member Absen muncul disini</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="d-flex align-items-center justify-content-end">
                            <h5 class="mb-0 mr-2 fw-bold">Tanggal</h5>
                            <form method="GET" id="tanggalForm" action="{{ url()->current() }}" class="d-flex align-items-center">
                                <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}" class="form-control" onchange="document.getElementById('tanggalForm').submit();">
                            </form>
                            <div class="dropdown no-arrow ml-2">
                                <a class="btn btn-md btn-outline-primary dropdown-toggle" href="#" id="dropdownStatus" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-filter fa-fw mr-1"></i>
                                    @if($status === 'hadir')
                                    Hadir
                                    @elseif($status === 'belum_absen')
                                    Tidak Hadir
                                    @else
                                    Semua
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dropdownStatus">
                                    <form method="GET" action="{{ route('absensi.index') }}">
                                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-check-circle text-success mr-2"></i> Hadir
                                        </button>
                                    </form>
                                    <form method="GET" action="{{ route('absensi.belum_absen') }}">
                                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-times-circle text-warning mr-2"></i> Belum Absen
                                        </button>
                                    </form>
                                    <form method="GET" action="{{ route('absensi.semua') }}">
                                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-list text-secondary mr-2"></i> Semua
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="dataMember" class="mt-3">
                    @include('admin.absensi._table', ['members' => $members, 'tanggal' => $tanggal])
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Member -->
<div class="modal fade" id="editAbsen" tabindex="-1" aria-labelledby="editAbsenLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="editAbsenLabel">Form Edit Absen</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="editAbsenForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="member_id" id="editMemberId">
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                    <div class="mb-3">
                        <label for="editKehadiran" class="form-label">Kehadiran</label>
                        <select class="form-control" name="kehadiran" id="editKehadiran" required>
                            <option value="" disabled selected>-- Pilih Kehadiran --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="tidak_hadir">Tidak Hadir</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editWaktuScan" class="form-label">Waktu Kehadiran</label>
                        <input type="time" class="form-control" name="waktu_scan" id="editWaktuScan" step="1">
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Member Bakal-->
<div class="modal fade" id="editAbsenBakal" tabindex="-1" aria-labelledby="editAbsenLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="editAbsenLabel">Form Edit Absen</h5>
            </div>
            <div class="modal-body">
                <h2 class="my-5 text-center">Fitur Sedang dikembangkan</h2>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Tangani saat tombol edit diklik
        $('[data-target="#editAbsen"]').on('click', function() {
            const kehadiran = $(this).data('kehadiran');
            const waktuScan = $(this).data('scan');
            const memberId = $(this).data('id');
            const tanggal = $(this).data('tanggal');


            // Isi form di modal
            $('#editMemberId').val(memberId);
            $('input[name="tanggal"]').val(tanggal);
            $('#editAbsenForm').attr('action', url);

            if (kehadiran) {
                $('#editKehadiran').val(kehadiran);
            } else {
                $('#editKehadiran').val('');
            }

            if (kehadiran === 'Hadir') {
                $('#editWaktuScan').val(waktuScan).prop('disabled', false);
            } else {
                $('#editWaktuScan').val('').prop('disabled', true);
            }
        });

        // Tangani saat user mengganti kehadiran di modal
        $('#editKehadiran').on('change', function() {
            const selected = $(this).val();
            if (selected === 'Hadir') {
                $('#editWaktuScan').prop('disabled', false);
            } else {
                $('#editWaktuScan').val('').prop('disabled', true);
            }
        });
    });
</script>


@endsection