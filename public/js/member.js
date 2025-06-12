document.addEventListener("DOMContentLoaded", function () {
    // Package to Date (Create Form)
    const packageSelect = document.getElementById("packageSelect");
    const startInput = document.getElementById("membershipStart");
    const endInput = document.getElementById("membershipEnd");

    function updateDates() {
        const today = new Date();
        const selectedMonths = parseInt(packageSelect.value);

        if (!isNaN(selectedMonths)) {
            startInput.valueAsDate = today;

            let endDate = new Date(today);
            endDate.setMonth(endDate.getMonth() + selectedMonths);
            endDate.setDate(endDate.getDate());

            endInput.valueAsDate = endDate;
        }
    }

    if (packageSelect) {
        packageSelect.addEventListener("change", updateDates);
    }

    // Package to Date (Edit Form)
    const editPackage = document.getElementById("editPackage");
    const editStart = document.getElementById("editStart");
    const editEnd = document.getElementById("editEnd");

    function updateEndDate() {
        const months = parseInt(editPackage.value);
        const startDate = new Date(editStart.value);

        if (!isNaN(months) && editStart.value) {
            const endDate = new Date(startDate);
            endDate.setMonth(startDate.getMonth() + months);
            endDate.setDate(endDate.getDate());

            editEnd.value = endDate.toISOString().split('T')[0];
        }
    }

    if (editPackage && editStart && editEnd) {
        editPackage.addEventListener("change", updateEndDate);
        editStart.addEventListener("change", updateEndDate);
    }

    // SweetAlert Confirmation on Delete
    const deleteForms = document.querySelectorAll(".delete-form");

    deleteForms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Modal: Detail Member
    $('button[data-toggle="modal"][data-target="#detailMember"]').on('click', function () {
        const data = $(this).data();

        $('#detail-id').val(data.id);
        $('#detail-name').val(data.name);
        $('#detail-age').val(data.age + " Tahun");
        $('#detail-gender').val(data.gender);
        $('#detail-package').val(data.package + " Bulan");
        $('#detail-phone').val(data.phone);
        $('#detail-start').val(data.start);
        $('#detail-end').val(data.end);
        $('#detail-status').val(data.status);

        $('#editMemberForm').attr('action', data.url);
    });

    // Modal: Edit Member
    $('button[data-toggle="modal"][data-target="#editMemberModal"]').on('click', function () {
        const data = $(this).data();

        $('#editId').val(data.id);
        $('#editName').val(data.name);
        $('#editAge').val(data.age);

        $('#editGenderLaki').prop('checked', data.gender === 'laki-laki');
        $('#editGenderPerempuan').prop('checked', data.gender === 'perempuan');
        
        $('#editPackage').val(data.package);
        $('#editPhone').val(data.phone);
        $('#editStart').val(data.start);
        $('#editEnd').val(data.end);
        
        $('#editStatusAktif').prop('checked', data.status === 'Active');
        $('#editStatusTidakAktif').prop('checked', data.status === 'Inactive');

        $('#editMemberForm').attr('action', data.url);
    });
});
