//change this to your own domain:
const domain = 'http://localhost';

//define admin routes here:
const adminRoute = domain + '/admin'
const adminTeacher = adminRoute + '/teacher'

//define new route in here:
const routes = {
    teacher : {
        getCertificate : adminTeacher + '/getCertificate',
        getExperience : adminTeacher + '/getExperience',
    }
}

export {routes}