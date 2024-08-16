export function createExperience() {
    document.querySelector('[id^="createExc"]').onclick = function () {
        const teacher_id = document.getElementById("teacher_id").value;
        $.ajax({
            type: "GET",
            url: "/teacher/" + teacher_id + "/experiences/create",
            success: (response) => {
                $("#experienceModal").modal("show");
                $("#titleExc").html("Thêm thông tin kinh nghiệm làm việc");
                $("#excModal").trigger("reset");
            },
        });
    };
}
export function editExperience() {
    document.querySelectorAll('[id^="editExc"]').forEach((button) => {
        button.addEventListener("click", () => {
            const teacher_id = document.getElementById("teacher_id");
            const id = teacher_id.value;
            const numericId = button.id.replace("editExc", "");
            $.ajax({
                type: "GET",
                url: "/teacher/" + id + "/experiences/" + numericId + "/edit",
                success: (response) => {
                    $("#experienceModal").modal("show");
                    $("#titleExc").html(
                        "Cập nhật thông tin kinh nghiệm làm việc"
                    );
                    $("#exc_id").val(response.id);
                    $("#exc_company").val(response.company);
                    $("#exc_position").val(response.position);
                    $("#exc_year").val(response.year);
                },
            });
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
                const teacher = document.getElementById("teacher_id");
                const id_teacher = teacher.value;
                const id_exc = button.id.replace("delExc", "");
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "DELETE",
                    url: "/teacher/" + id_teacher + "/experiences/" + id_exc,
                    success: (response) => {
                        location.reload();
                    },
                });
            }
        });
    });
}

$("#excModal").submit(function (event) {
    event.preventDefault();
    const teacher = document.getElementById("teacher_id");
    const id_teacher = teacher.value;
    const experience = document.getElementById("exc_id");
    const id_exc = experience.value;
    const url = !id_exc
        ? "/teacher/" + id_teacher + "/experiences"
        : "/teacher/" + id_teacher + "/experiences/" + id_exc;
    const formData = !id_exc ? new FormData(this) : $(this).serialize();
    const method = !id_exc ? "POST" : "PUT";
    const contentType = !id_exc ? false : undefined;
    const processData = !id_exc ? false : undefined;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: method,
        data: formData,
        url: url,
        contentType: contentType,
        processData: processData,
        success: (data) => {
            location.reload();
        },
        error: (response) => {
            console.log(response);
        },
    });
});
