import { getTeacherCertificatesRoute } from "./route";
import { getTeacherExperiencesRoute } from "./route";

export function getTeacherCertificates(id_teacher) {
    return fetch(getTeacherCertificatesRoute(id_teacher)).then((response) => response.json())
    .then((data) => {
        return data.certificates;
    });
}

export function getTeacherExperiences(id_teacher) {
    return fetch(getTeacherExperiencesRoute(id_teacher)).then((response) => response.json())
    .then((data) => {
        return data.experiences;
    });
}