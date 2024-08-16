document.getElementById("cer_photo").addEventListener("change", function () {
    if (!this.files.length) {
        document.getElementById("photoReview").style.display = "none";
    }
});
export function createCertificate() {
    document.querySelector('[id^="createCer"]').onclick = function () {
        const teacher_id = document.getElementById("teacher_id").value;
        $.ajax({
            type: "GET",
            url: "/teacher/" + teacher_id + "/certificates/create",
            success: (response) => {
                $("#cerModal").trigger("reset");
                const imagePath = "../../assets/img/default.jpg";
                $("#photoReview").attr("src", imagePath);
                $("#certificateModal").modal("show");
                $("#titleCer").html("Thêm thông tin chứng chỉ");
            },
        });
    };
}
export function editCertificate() {
    document.querySelectorAll('[id^="editCer"]').forEach((button) => {
        button.addEventListener("click", () => {
            const teacher = document.getElementById("teacher_id");
            const id_teacher = teacher.value;
            const id_cer = button.id.replace("editCer", "");
            $.ajax({
                type: "GET",
                url:
                    "/teacher/" +
                    id_teacher +
                    "/certificates/" +
                    id_cer +
                    "/edit",
                success: (response) => {
                    $("#cerModal").trigger("reset");
                    $("#certificateModal").modal("show");
                    $("#titleCer").html("Cập nhật thông tin chứng chỉ");
                    $("#cer_id").val(response.id);
                    $("#cer_major").val(response.major);
                    $("#cer_level").val(response.level);
                    $("#cer_school").val(response.school);
                    var photoUrl = "/storage/teachers/" + response.photo;
                    $("#photoReview").attr("src", photoUrl);
                    $("#hiddenImage").attr("src", photoUrl);
                },
            });
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
                const teacher = document.getElementById("teacher_id").value;
                const id_teacher = teacher.value;
                const id_cer = button.id.replace("delCer", "");
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "DELETE",
                    url: "/teacher/" + id_teacher + "/certificates/" + id_cer,
                    success: (response) => {
                        location.reload();
                    },
                });
            }
        });
    });
}
$("#cerModal").submit(function (event) {
    event.preventDefault();
    const id_teacher = document.getElementById("teacher_id").value;
    const cer = document.getElementById("cer_id");
    const id_cer = cer.value;
    const url = !id_cer
        ? "/teacher/" + id_teacher + "/certificates"
        : "/teacher/" + id_teacher + "/certificates/" + id_cer;
    const formData = new FormData(this);
    if (id_cer) {
        formData.append("_method", "PUT");
    }
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        data: formData,
        url: url,
        contentType: false,
        processData: false,
        success: (response) => {
            location.reload();
        },
        error: (response) => {
            console.log(response);
        },
    });
});
