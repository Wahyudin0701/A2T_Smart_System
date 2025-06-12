<!-- Modal Tambah Member -->
<div class="modal fade" id="createMemberModal" tabindex="-1" aria-labelledby="createMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="createMemberModalLabel">Form Tambah Member</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('members.store') }}" method="POST" id="createMemberForm">
                    @csrf
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Member</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Usia</label>
                                <input type="number" class="form-control" name="age" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block mb-2">Jenis Kelamin</label>
                                <div class="d-flex">
                                    <div class="form-check mr-2">
                                        <input class="form-check-input" type="radio" name="gender" id="genderLaki" value="laki-laki" required>
                                        <label class="form-check-label" for="genderLaki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="genderPerempuan" value="perempuan" required>
                                        <label class="form-check-label" for="genderPerempuan">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Paket</label>
                                <select class="form-control" name="package" id="packageSelect" required>
                                    <option value="" disabled selected>-- Pilih Paket --</option>
                                    <option value="1">1 Bulan</option>
                                    <option value="2">2 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">12 Bulan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="mb-3">
                                <label class="form-label">No Handphone</label>
                                <input type="text" class="form-control" name="phone_number">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mulai Membership</label>
                                <input type="date" class="form-control" name="membership_start" id="membershipStart" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Berakhir Membership</label>
                                <input type="date" class="form-control" name="membership_end" id="membershipEnd" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>