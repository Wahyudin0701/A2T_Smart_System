<!-- Modal Edit Member -->
<div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="editMemberModalLabel">Form Edit Member</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="editMemberForm">
                    @csrf
                    @method('PUT')
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editName" class="form-label">Nama Member</label>
                                <input type="text" class="form-control" name="name" id="editName" required>
                            </div>
                            <div class="mb-3">
                                <label for="editAge" class="form-label">Usia</label>
                                <input type="number" class="form-control" name="age" id="editAge" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block mb-2">Jenis Kelamin</label>
                                <div class="d-flex">
                                    <div class="form-check mr-2">
                                        <input class="form-check-input" type="radio" name="gender" id="editGenderLaki" value="laki-laki" required>
                                        <label class="form-check-label" for="editGenderLaki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="editGenderPerempuan" value="perempuan" required>
                                        <label class="form-check-label" for="editGenderPerempuan">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="editPackage" class="form-label">Pilih Paket</label>
                                <select class="form-control" name="package" id="editPackage" required>
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
                                <label for="editPhone" class="form-label">No Handphone</label>
                                <input type="text" class="form-control" name="phone_number" id="editPhone">
                            </div>
                            <div class="mb-3">
                                <label for="editStart" class="form-label">Mulai Membership</label>
                                <input type="date" class="form-control" name="membership_start" id="editStart" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEnd" class="form-label">Berakhir Membership</label>
                                <input type="date" class="form-control" name="membership_end" id="editEnd" readonly>
                            </div>
                        </div>
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
