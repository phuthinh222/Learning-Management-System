import "./bootstrap";
import "./action";
import { editExperience, delExperience, createExperience } from "./experience";
import { editCertificate, delCertificate } from "./certificate";

document.addEventListener("DOMContentLoaded", () => {
    createExperience();
    editExperience();
    delExperience();
    editCertificate();
    delCertificate();
});
