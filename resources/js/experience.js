export function createExperience() {
    document
        .querySelector('[id^="createExc"]')
        .addEventListener("click", function () {
            const teacherId = document.getElementById("teacher_id").value;

            fetch(`/teacher/${teacherId}/experiences/create`)
                .then((response) => response.json())
                .then((data) => {
                    const experienceModal =
                        document.getElementById("experienceModal");
                    const modal = new bootstrap.Modal(experienceModal);
                    modal.show();
                    document.getElementById("titleExc").innerText =
                        "Thêm thông tin kinh nghiệm làm việc";

                    const excModal = document.getElementById("excModal");
                })
                .catch((error) => console.error("Error:", error));
        });
}

export function editExperience() {
    document.querySelectorAll('[id^="editExc"]').forEach((button) => {
        button.addEventListener("click", () => {
            const teacherId = document.getElementById("teacher_id").value;
            const numericId = button.id.replace("editExc", "");

            fetch(`/teacher/${teacherId}/experiences/${numericId}/edit`)
                .then((response) => response.json())
                .then((data) => {
                    const experienceModal =
                        document.getElementById("experienceModal");
                    const modal = new bootstrap.Modal(experienceModal);
                    modal.show();

                    ("Cập nhật thông tin kinh nghiệm làm việc");
                    document.getElementById("exc_id").value = data.id;
                    document.getElementById("exc_company").value = data.company;
                    document.getElementById("exc_position").value =
                        data.position;
                    document.getElementById("exc_year").value = data.year;
                })
                .catch((error) => console.error("Error:", error));
        });
    });
}

export function delExperience() {
    document.querySelectorAll('[id^="delExc"]').forEach((button) => {
        button.addEventListener("click", () => {
            const confirmDelete = confirm(
                "Bạn có chắc muốn xóa thông tin này không?"
            );
            if (confirmDelete) {
                console.log(confirmDelete);
                const teacherId = document.getElementById("teacher_id").value;
                const experienceId = button.id.replace("delExc", "");
                const csrfToken = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");

                fetch(`/teacher/${teacherId}/experiences/${experienceId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "Content-Type": "application/json",
                    },
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok.");
                        }
                        return response.json();
                    })
                    .then(() => {
                        window.location.reload();
                    })
                    .catch((error) => console.error("Error:", error));
            }
        });
    });
}

document
    .getElementById("excModal")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        const company_input = document.getElementById("exc_company");
        const position_input = document.getElementById("exc_position");
        const year_input = document.getElementById("exc_year");
        const teacher = document.getElementById("teacher_id");
        const idTeacher = teacher.value;
        const experience = document.getElementById("exc_id");
        const idExc = experience.value;
        const url = !idExc
            ? `/teacher/${idTeacher}/experiences`
            : `/teacher/${idTeacher}/experiences/${idExc}`;

        const formData = new FormData(this);
        const options = {
            method: !idExc ? "POST" : "PUT",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: formData,
        };
        if (idExc) {
            options.headers["Content-Type"] =
                "application/x-www-form-urlencoded";
            options.body = new URLSearchParams(new FormData(this)).toString();
        }
        fetch(url, options)
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((errorData) => {
                        throw new Error(JSON.stringify(errorData.errors));
                    });
                }
                return response.json();
            })
            .then((data) => {
                location.reload();
            })
            .catch((errors) => {
                const messages = JSON.parse(errors.message);
                if (typeof messages.company !== 'undefined') {
                    company_input.classList.add('is-invalid');
                    document.getElementById("invalid_company").textContent = messages.company
                } else {
                    company_input.classList.remove('is-invalid');
                }
                if (typeof messages.position !== 'undefined') {
                    position_input.classList.add('is-invalid');
                    document.getElementById("invalid_position").textContent = messages.position
                } else {
                    position_input.classList.remove('is-invalid');
                }
                if (typeof messages.year !== 'undefined') {
                    year_input.classList.add('is-invalid');
                    document.getElementById("invalid_year").textContent = messages.year
                } else {
                    year_input.classList.remove('is-invalid');
                }
            });
    });

document.addEventListener("DOMContentLoaded", () => {
    createExperience();
    editExperience();
    delExperience();
});
