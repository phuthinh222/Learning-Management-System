import { routes } from "./route";
export function getTeacherCertificates(id_teacher) {
    return fetch(routes.teacher.getCertificate + '/' + id_teacher).then((response) => response.json())
    .then((data) => {
        return data.certificates;
    });
}

export function getTeacherExperiences(id_teacher) {
    return fetch(routes.teacher.getExperience + '/' +id_teacher).then((response) => response.json())
    .then((data) => {
        return data.experiences;
    });
}