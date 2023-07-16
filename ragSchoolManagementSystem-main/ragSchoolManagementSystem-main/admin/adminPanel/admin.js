function manageTeachersPage() {
    window.location = "../../admin/adminPanel/adminManageTeachers.php";
}

function manageAcademicPage() {
    window.location = "../../admin/adminPanel/adminManageAcadamic.php";
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

showAddTeacherDiv = () => {
    const teacherAddDiv = document.getElementById("teacherAddDiv");
    teacherAddDiv.classList.toggle("d-none");
};

function test(text) {
    console.log(text);
}
addTeacher = () => {
    const fname = document.getElementById("teacherfname");
    const lname = document.getElementById("teacherlname");
    const mail = document.getElementById("teacheremail");
    const age = document.getElementById("teacherage");
    const grade = document.getElementById("teachergrade");

    const subject = document.getElementById("teachersubject");
    const gender = document.getElementById("teachergender");;

    let url = "../../admin/adminPanel/addTeacher.php";
    const form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("e", mail.value);
    form.append("a", age.value);
    form.append("g", grade.value);
    form.append("s", subject.value);
    form.append("gn", gender.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log({ text })

            if (text.trim() === "abc") {

                window.location.reload(false)
            } else {

                document.getElementById("addteachererrormessage").innerHTML = text;
            }
        });
};

showRemoveTeacherDiv = () => {
    const teacherRemoveDiv = document.getElementById("teacherRemoveDiv");
    teacherRemoveDiv.classList.toggle("d-none");

};
removeTheTeacher = (id, email) => {
    console.log(email);
    console.log(id);
    let url = "../../admin/adminPanel/removeTeacher.php";
    const form = new FormData();
    form.append("id", id);
    form.append("email", email);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if (text.trim() === "Success") {
                window.location.reload(false)
            }
        });

}
documentSelectByID = (id) => {
    const htmlElement = document.getElementById(id);
    return htmlElement;
}
showUpdateTeacherDiv = (id, email) => {
    const teacherDiv = documentSelectByID("teacherUpdateDiv");
    teacherDiv.classList.toggle("d-none");
    getSingleTeacherDetails(id, email);
}
getSingleTeacherDetails = (id, email) => {
    let url = "../../admin/adminPanel/getTeacherDetailsasAnArray.php";
    const form = new FormData();
    form.append("id", id);
    form.append("email", email);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {

            const array = JSON.parse(text);


            const fname = document.getElementById("upTeacherfname");
            const lname = document.getElementById("upTeacherlname");
            const mail = document.getElementById("upTeacheremail");
            const age = document.getElementById("upTeacherage");
            const grade = document.getElementById("upTeachergrade");

            const subject = document.getElementById("upTeachersubject");
            const gender = document.getElementById("upTeachergender");
            fname.value = array[2];
            lname.value = array[3];
            mail.value = array[1];
            age.value = array[7];
            grade.value = array[5];
            subject.value = array[4];
            gender.value = array[6];
            if (text.trim() === "Success") {
                window.location.reload(false)
            }
        });
}
upDateTeacher = () => {
    const fname = document.getElementById("upTeacherfname");
    const lname = document.getElementById("upTeacherlname");
    const mail = document.getElementById("upTeacheremail");
    const age = document.getElementById("upTeacherage");
    const grade = document.getElementById("upTeachergrade");

    const subject = document.getElementById("upTeachersubject");
    const gender = document.getElementById("upTeachergender");

    let url = "../../admin/adminPanel/updateTeacher.php";
    const form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("e", mail.value);
    form.append("a", age.value);
    form.append("g", grade.value);
    form.append("s", subject.value);
    form.append("gn", gender.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text)

            if (text.trim() === "Update Success") {

                window.location.reload(false);
            } else {

                document.getElementById("addteachererrormessage").innerHTML = text;
            }
        });
}
showSendMailTeacherDiv = () => {
    sendMailDiv = documentSelectByID("teacherSendEmailDiv");
    teacherSendEmailDivInnerDiv = documentSelectByID("teacherSendEmailDivInnerDiv");
    const teacherNameDiv = document.getElementById("ShowSubjectNGradeNamesDiv");
    teacherNameDiv.classList.toggle("d-none");
    sendMailDiv.classList.toggle("d-none");
    let url1 = "../../admin/adminPanel/getSendMailTeacherDiv.php";

    fetch(url1)
        .then((response) => response.text())
        .then((text) => {
            teacherSendEmailDivInnerDiv.innerHTML = text;
        });

}
sendEmailtoTeacher = (id, email) => {
    console.log(id, email);
    let url = "../../admin/adminPanel/sendEmailTeacher.php";
    const form = new FormData();
    form.append("id", id);
    form.append("email", email);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {

            console.log(text);
        });
}