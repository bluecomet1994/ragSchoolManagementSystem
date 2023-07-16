function manageTeachersPage() {
    window.location = "../../admin/adminPanel/adminManageTeachers.php";
}

function manageAcademicPage() {
    window.location = "../../admin/adminPanel/adminManageAcademic.php";
}


function manageStudentPage() {
    window.location = "../../admin/adminPanel/adminManageStudent.php";
}
window.addEventListener("load", () => {
    const subjectNameDiv = document.getElementById("subjectName");
    const gradeNameDiv = document.getElementById("gradeName");
    const teacherNameDiv = document.getElementById("teachersList");
    if (teacherNameDiv) {
        let url1 = "../../admin/adminPanel/getTeachers.php";

        fetch(url1)
            .then((response) => response.text())
            .then((text) => {
                teacherNameDiv.innerHTML = text;
            });
    }
    if (subjectNameDiv) {
        let url2 = "../../admin/adminPanel/getSubjects.php";
        fetch(url2)
            .then((response) => response.text())
            .then((text) => {
                subjectNameDiv.innerHTML = text;
            });
    }
    if (gradeNameDiv) {
        let url3 = "../../admin/adminPanel/getGrades.php";
        fetch(url3)
            .then((response) => response.text())
            .then((text) => {
                gradeNameDiv.innerHTML = text;
            });
    }
});
loadSnGnT = () => {
    const subjectNameDiv = document.getElementById("subjectName");
    const gradeNameDiv = document.getElementById("gradeName");
    const teacherNameDiv = document.getElementById("teachersList");
    if (teacherNameDiv) {
        let url1 = "../../admin/adminPanel/getTeachers.php";

        fetch(url1)
            .then((response) => response.text())
            .then((text) => {
                teacherNameDiv.innerHTML = text;
            });
    }
    if (subjectNameDiv) {
        let url = "../../admin/adminPanel/getSubjects.php";

        fetch(url)
            .then((response) => response.text())
            .then((text) => {
                subjectNameDiv.innerHTML = text;
            });
    }
    if (gradeNameDiv) {
        let url = "../../admin/adminPanel/getGrades.php";

        fetch(url)
            .then((response) => response.text())
            .then((text) => {
                gradeNameDiv.innerHTML = text;
            });
    }
};
addSubject = () => {
    const subjectField = document.getElementById("subjectField");
    let url = "../../admin/adminPanel/addSubjectNGradesProcess.php";
    const form = new FormData();
    form.append("SF", subjectField.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            loadSnG();
        });
};
addGrade = () => {
    const subjectField = document.getElementById("gradeField");
    let url = "../../admin/adminPanel/addSubjectNGradesProcess.php";
    const form = new FormData();
    form.append("GF", subjectField.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            loadSnG();
        });
};