<!-- Modal Detail Member -->
<div class="modal fade" id="detailMember" tabindex="-1" aria-labelledby="detailMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="detailMemberModalLabel">Detail Member</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Member</label>
                            <input type="text" class="form-control" id="detail-name" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Usia</label>
                            <input type="text" class="form-control" id="detail-age" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="detail-gender" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No Handphone</label>
                            <input type="text" class="form-control" id="detail-phone" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Paket Membership</label>
                            <input type="text" class="form-control" id="detail-package" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control" id="detail-status" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Mulai Membership</label>
                            <input type="date" class="form-control" id="detail-start" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Berakhir Membership</label>
                            <input type="date" class="form-control" id="detail-end" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>