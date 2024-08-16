import $ from "jquery";
import datepickerFactory from "jquery-datepicker";

datepickerFactory($);

$(function () {
    $("#datepicker").datepicker({
        dateFormat: "dd-mm-yy",
    });
});
