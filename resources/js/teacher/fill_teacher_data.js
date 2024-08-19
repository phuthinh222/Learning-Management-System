import { getTeacherCertificates } from "../url/get_data";
import { getTeacherExperiences } from "../url/get_data";
$('.confirm_information').on('click', function(e) {
    e.preventDefault();

    //Fill the Certication table of Teacher
    getTeacherCertificates(1).then((certificates) => {
        const certificateTable = document.getElementById('teacher_certificates');
        const defaultImg = '../../assets/img/default.jpg';
        certificateTable.innerHTML = ''
        certificates.forEach(certificate => {
            let rowHTML = '<tr>';
            if (certificate.photo === null) {
                rowHTML += `<td><img style="max-width:100px; max-height:100px" src="${defaultImg}"/></td>`;
            } else {
                rowHTML += `<td><img style="max-width:100px; max-height:100px" src="${certificate.photo}"/></td>`;
            }

            rowHTML += `<td>${certificate.major}</td>`;
            rowHTML += `<td>${certificate.level}</td>`;
            rowHTML += `<td>${certificate.school}</td>`;
            rowHTML += `</tr>`;
            certificateTable.innerHTML += rowHTML;
        });
    });

    //Fill the Experience table of Teacher
    getTeacherExperiences(1).then((experience) => {
        const experienceTable = document.getElementById('teacher_experiences');
        experienceTable.innerHTML = ''
        experience.forEach(experience => {
            let rowHTML = '<tr>';
            rowHTML += `<td>${experience.position}</td>`;
            rowHTML += `<td>${experience.year}</td>`;
            rowHTML += `<td>${experience.company}</td>`;
            rowHTML += `</tr>`;
            experienceTable.innerHTML += rowHTML;
        });
    })
})
