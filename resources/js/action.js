import $ from "jquery";
import "jquery-ui";
import "jquery-ui/dist/jquery-ui";
import datepickerFactory from "jquery-datepicker";
// Just pass your jquery instance and you're done
datepickerFactory($);

$(function () {
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
    });
    $("#datepicker").val("2000-01-01");
});
