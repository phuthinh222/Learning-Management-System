document.getElementById("cer_photo").addEventListener("change", function () {
    if (!this.files.length) {
        document.getElementById("photoReview").style.display = "none";
    }
});
export function createCertificate() {
    document
        .querySelector('[id^="createCer"]')
        .addEventListener("click", () => {
            const teacherId = document.getElementById("teacher_id").value;
            fetch(`/teacher/${teacherId}/certificates/create`)
                .then((response) => response.json())
                .then((data) => {
                    const cerModal = document.getElementById("cerModal");
                    const photoCertificate =
                        document.getElementById("photoCertificate");
                    const certificateModal = new bootstrap.Modal(
                        document.getElementById("certificateModal")
                    );
                    certificateModal.show();
                    document.getElementById("titleCer").innerText =
                        "Thêm thông tin chứng chỉ";
                })
                .catch((error) => console.error("Error:", error));
        });
}

export function editCertificate() {
    document.querySelectorAll('[id^="editCer"]').forEach((button) => {
        button.addEventListener("click", () => {
            const teacherId = document.getElementById("teacher_id").value;
            const certificateId = button.id.replace("editCer", "");
            fetch(`/teacher/${teacherId}/certificates/${certificateId}/edit`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    document.getElementById("cerModal").reset();
                    const certificateModal = new bootstrap.Modal(
                        document.getElementById("certificateModal")
                    );
                    certificateModal.show();
                    document.getElementById("titleCer").innerText =
                        "Cập nhật thông tin chứng chỉ";
                    document.getElementById("cer_id").value = data.id;
                    document.getElementById("cer_major").value = data.major;
                    document.getElementById("cer_level").value = data.level;
                    document.getElementById("cer_school").value = data.school;
                    const photoUrl = `/storage/teachers/${data.photo}`;
                    document.getElementById("photoReview").src = photoUrl;
                    document.getElementById("hiddenImage").src = photoUrl;
                })
                .catch((error) => console.error("Error:", error));
        });
    });
}

export function delCertificate() {
    document.querySelectorAll('[id^="delCer"]').forEach((button) => {
        button.addEventListener("click", () => {
            const confirmDelete = confirm(
                "Bạn có chắc muốn xóa thông tin này không?"
            );
            if (confirmDelete) {
                const teacherId = document.getElementById("teacher_id").value;
                const certificateId = button.id.replace("delCer", "");
                const csrfToken = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");

                fetch(`/teacher/${teacherId}/certificates/${certificateId}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(() => {
                        location.reload();
                    })
                    .catch((error) => console.error("Error:", error));
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const major_input = document.getElementById("cer_major");
    const level_input = document.getElementById("cer_level");
    const school_input = document.getElementById("cer_school");
    const photo_input = document.getElementById("cer_photo");
    const cerModal = document.getElementById("cerModal");
    cerModal.addEventListener("submit", function (event) {
        event.preventDefault();
        const idTeacher = document.getElementById("teacher_id").value;
        const cerIdElement = document.getElementById("cer_id");
        const idCer = cerIdElement.value;
        const url = idCer
            ? `/teacher/${idTeacher}/certificates/${idCer}`
            : `/teacher/${idTeacher}/certificates`;
        const formData = new FormData(cerModal);
        if (idCer) {
            formData.append("_method", "PUT");
        }
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((errorData) => {
                        throw new Error(JSON.stringify(errorData.errors));
                    });
                }
                return response.json();
            })
            .then(() => {
                location.reload();
            })
            .catch((errors) => {
                const messages = JSON.parse(errors.message);
                if (typeof messages.major !== 'undefined') {
                    major_input.classList.add('is-invalid');
                    document.getElementById("invalid_mafor").textContent = messages.major
                } else {
                    major_input.classList.remove('is-invalid');
                }
                if (typeof messages.level !== 'undefined') {
                    level_input.classList.add('is-invalid');
                    document.getElementById("invalid_level").textContent = messages.level
                } else {
                    level_input.classList.remove('is-invalid');
                }
                if (typeof messages.school !== 'undefined') {
                    school_input.classList.add('is-invalid');
                    document.getElementById("invalid_school").textContent = messages.school
                } else {
                    school_input.classList.remove('is-invalid');
                }
                if (typeof messages.photo !== 'undefined') {
                    photo_input.classList.add('is-invalid');
                    document.getElementById("invalid_photo").textContent = messages.photo
                } else {
                    photo_input.classList.remove('is-invalid');
                }
            });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    createCertificate();
    editCertificate();
    delCertificate();
});
