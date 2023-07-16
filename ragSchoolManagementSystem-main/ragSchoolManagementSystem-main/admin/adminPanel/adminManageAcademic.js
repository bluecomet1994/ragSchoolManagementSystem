window.addEventListener("load", () => {
    const subjectNameDiv = document.getElementById("subjectName");
    const gradeNameDiv = document.getElementById("gradeName");
    const academicNameDiv = document.getElementById("academicsList");
    if (academicNameDiv) {
        let url1 = "../../admin/adminPanel/getacademics.php";

        fetch(url1)
            .then((response) => response.text())
            .then((text) => {
                academicNameDiv.innerHTML = text;
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
    const academicNameDiv = document.getElementById("academicsList");
    if (academicNameDiv) {
        let url1 = "../../admin/adminPanel/getacademics.php";

        fetch(url1)
            .then((response) => response.text())
            .then((text) => {
                academicNameDiv.innerHTML = text;
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

showAddacademicDiv = () => {
    const academicAddDiv = document.getElementById("academicAddDiv");
    academicAddDiv.classList.toggle("d-none");
};

function test(text) {
    console.log(text);
}
addacademic = () => {
    const fname = document.getElementById("academicfname");
    const lname = document.getElementById("academiclname");
    const mail = document.getElementById("academicemail");
    const age = document.getElementById("academicage");

    const gender = document.getElementById("academicgender");;

    let url = "../../admin/adminPanel/addacademic.php";
    const form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("e", mail.value);
    form.append("a", age.value);
    form.append("gn", gender.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log({ text })

            if (text.trim() === "abc") {

                window.location.reload(false)
            } else {

                document.getElementById("addacademicerrormessage").innerHTML = text;
            }
        });
};

showRemoveacademicDiv = () => {
    const academicRemoveDiv = document.getElementById("academicRemoveDiv");
    academicRemoveDiv.classList.toggle("d-none");

};
removeTheacademic = (id, email) => {
    console.log(email);
    console.log(id);
    let url = "../../admin/adminPanel/removeacademic.php";
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
showUpdateacademicDiv = (id, email) => {
    const academicDiv = documentSelectByID("academicUpdateDiv");
    academicDiv.classList.toggle("d-none");
    getSingleacademicDetails(id, email);
}
getSingleacademicDetails = (id, email) => {
    let url = "../../admin/adminPanel/getacademicDetailsasAnArray.php";
    const form = new FormData();
    form.append("id", id);
    form.append("email", email);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            const array = JSON.parse(text);


            const fname = document.getElementById("upacademicfname");
            const lname = document.getElementById("upacademiclname");
            const mail = document.getElementById("upacademicemail");
            const age = document.getElementById("upacademicage");

            const gender = document.getElementById("upacademicgender");
            fname.value = array[2];
            lname.value = array[3];
            mail.value = array[1];
            age.value = array[5];
            gender.value = array[4];
            if (text.trim() === "Success") {
                window.location.reload(false)
            }
        });
}
upDateacademic = () => {
    const fname = document.getElementById("upacademicfname");
    const lname = document.getElementById("upacademiclname");
    const mail = document.getElementById("upacademicemail");
    const age = document.getElementById("upacademicage");
    const gender = document.getElementById("upacademicgender");

    let url = "../../admin/adminPanel/updateacademic.php";
    const form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("e", mail.value);
    form.append("a", age.value);
    form.append("gn", gender.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text)

            if (text.trim() === "Update Success") {

                window.location.reload(false);
            } else {

                document.getElementById("addacademicerrormessage").innerHTML = text;
            }
        });
}
showSendMailacademicDiv = () => {
    sendMailDiv = documentSelectByID("academicSendEmailDiv");
    academicSendEmailDivInnerDiv = documentSelectByID("academicSendEmailDivInnerDiv");
    const academicNameDiv = document.getElementById("ShowSubjectNGradeNamesDiv");
    academicNameDiv.classList.toggle("d-none");
    sendMailDiv.classList.toggle("d-none");
    let url1 = "../../admin/adminPanel/getSendMailacademicDiv.php";

    fetch(url1)
        .then((response) => response.text())
        .then((text) => {
            academicSendEmailDivInnerDiv.innerHTML = text;
        });

}
sendEmailtoacademic = (id, email) => {
    console.log(id, email);
    let url = "../../admin/adminPanel/sendEmailacademic.php";
    const form = new FormData();
    form.append("id", id);
    form.append("email", email);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {

            console.log(text);
        });
}