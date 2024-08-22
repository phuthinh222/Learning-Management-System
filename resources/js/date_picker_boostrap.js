import $ from "jquery";
import "bootstrap-datepicker/dist/js/bootstrap-datepicker.min";
import "bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css";
$(document).ready(function () {
    $("#datepicker").datepicker({
        format: "dd-mm-yyyy",
    });

    $("#search_attendance")
        .datepicker({
            format: "mm/yyyy",
            startView: "months",
            minViewMode: "months",
            autoclose: true,
        })
        .on("changeDate", function (e) {
            $(this).closest("form").submit();
        });
    $(".icon_calendar").on("click", function () {
        $("#search_attendance").datepicker("show");
    });
});
