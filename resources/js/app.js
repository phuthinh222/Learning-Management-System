import "./bootstrap";
import "./date_picker_boostrap";
import "./filter-user";
import "./date_picker_boostrap";
import "./filter-user";
import { editExperience, delExperience, createExperience } from "./experience";
import {
    createCertificate,
    editCertificate,
    delCertificate,
} from "./certificate";

document.addEventListener("DOMContentLoaded", () => {
    createCertificate();
    editCertificate();
    delCertificate();

    createExperience();
    editExperience();
    delExperience();
});
