@if(count($members) > 0)
<table class="table table-bordered table-striped text-center">
    <thead class="bg-danger text-white">
        <tr>
            <th>No.</th>
            <th>Nama Member</th>
            <th>Kehadiran</th>
            <th>Waktu Kehadiran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
        @php
        $attendance = $member->attendances->firstWhere('tanggal', $tanggal);
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $member->name }}</td>
            <td>
                @if ($attendance)
                <span class="badge badge-success text-white
                                fw-semibold
                                text-uppercase
                                d-inline-block
                                text-center"
                    style="min-width: 60%; height: 30px; line-height: 25px; font-size: 0.85rem;">
                    {{ ucfirst($attendance->kehadiran) }}
                </span>
                @else
                <span class="badge
                                badge-secondary
                                text-white
                                fw-semibold
                                text-uppercase
                                d-inline-block
                                text-center"
                    style="min-width: 60%; height: 30px; line-height: 25px; font-size: 0.85rem;">
                    Belum Absen
                </span>

                @endif
            </td>
            <td>
                {{ $attendance && $attendance->waktu_scan ? $attendance->waktu_scan : '-' }}
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-primary me-1 btn-edit-absen"
                    @if ($attendance)
                    data-id="{{ $attendance->member_id }}"
                    data-kehadiran="{{ $attendance->kehadiran }}"
                    data-scan="{{ $attendance->waktu_scan }}"
                    data-tanggal="{{ $tanggal }}"
                    data-url="{{ route('absensi.edit', $attendance->member_id) }}"
                    @endif
                    data-toggle="modal"
                    data-target="#editAbsenBakal">
                    <i class="fas fa-edit"></i> Edit
                </button>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<hr style="border: 2px solid red;">
<p class="text-center mt-4 text-muted">Data tidak ditemukan</p>
@endif