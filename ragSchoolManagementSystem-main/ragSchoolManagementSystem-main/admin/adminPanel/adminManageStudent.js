window.addEventListener("load", () => {
    const subjectNameDiv = document.getElementById("subjectName");
    const gradeNameDiv = document.getElementById("gradeName");
    const studentNameDiv = document.getElementById("studentsList");
    if (studentNameDiv) {
        let url1 = "../../admin/adminPanel/getstudents.php";

        fetch(url1)
            .then((response) => response.text())
            .then((text) => {
                studentNameDiv.innerHTML = text;
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
    const studentNameDiv = document.getElementById("studentsList");
    if (studentNameDiv) {
        let url1 = "../../admin/adminPanel/getstudents.php";

        fetch(url1)
            .then((response) => response.text())
            .then((text) => {
                studentNameDiv.innerHTML = text;
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

showAddstudentDiv = () => {
    const studentAddDiv = document.getElementById("studentAddDiv");
    studentAddDiv.classList.toggle("d-none");
};

function test(text) {
    console.log(text);
}
addstudent = () => {
    const fname = document.getElementById("studentfname");
    const lname = document.getElementById("studentlname");
    const mail = document.getElementById("studentemail");
    const age = document.getElementById("studentage");

    const gender = document.getElementById("studentgender");;

    let url = "../../admin/adminPanel/addstudent.php";
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

                document.getElementById("addstudenterrormessage").innerHTML = text;
            }
        });
};

showRemovestudentDiv = () => {
    const studentRemoveDiv = document.getElementById("studentRemoveDiv");
    studentRemoveDiv.classList.toggle("d-none");

};
askRemoveThestudent = (id, email, fname) => {
    console.log(email);
    console.log(id);
    const warningDiv = document.getElementById("showRemoveWarningDiv");
    warningDiv.classList.toggle("d-none");
    const fnamediv = documentSelectByID("studentfname");
    const emaildiv = documentSelectByID("studentemail");
    fnamediv.innerHTML = fname;
    emaildiv.innerHTML = email;
    const yesButton = documentSelectByID("removeYesButton");
    const noButton = documentSelectByID("removeNoButton");

    yesButton.addEventListener('click', () => {
        removeThestudent(id, email)
    })
    noButton.addEventListener('click', () => {
        cancelRemoveThestudent()
    });
    // if yesButton is clicked do this function 
    // if noButton is clicked do that function 

}
cancelRemoveThestudent = () => {
    const warningDiv = document.getElementById("showRemoveWarningDiv");
    warningDiv.classList.toggle("d-none");
}
removeThestudent = (id, email) => {

    console.log(id + " " + email);
    let url = "../../admin/adminPanel/removestudent.php";
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
showUpdatestudentDiv = (id, email) => {
    const studentDiv = documentSelectByID("studentUpdateDiv");
    studentDiv.classList.toggle("d-none");
    getSinglestudentDetails(id, email);
}
getSinglestudentDetails = (id, email) => {
    let url = "../../admin/adminPanel/getstudentDetailsasAnArray.php";
    const form = new FormData();
    form.append("id", id);
    form.append("email", email);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            const array = JSON.parse(text);


            const fname = document.getElementById("upstudentfname");
            const lname = document.getElementById("upstudentlname");
            const mail = document.getElementById("upstudentemail");
            const age = document.getElementById("upstudentage");

            const gender = document.getElementById("upstudentgender");
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
upDatestudent = () => {
    const fname = document.getElementById("upstudentfname");
    const lname = document.getElementById("upstudentlname");
    const mail = document.getElementById("upstudentemail");
    const age = document.getElementById("upstudentage");
    const gender = document.getElementById("upstudentgender");

    let url = "../../admin/adminPanel/updatestudent.php";
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

                document.getElementById("addstudenterrormessage").innerHTML = text;
            }
        });
}
showSendMailstudentDiv = () => {
    sendMailDiv = documentSelectByID("studentSendEmailDiv");
    studentSendEmailDivInnerDiv = documentSelectByID("studentSendEmailDivInnerDiv");
    const studentNameDiv = document.getElementById("ShowSubjectNGradeNamesDiv");
    studentNameDiv.classList.toggle("d-none");
    sendMailDiv.classList.toggle("d-none");
    let url1 = "../../admin/adminPanel/getSendMailstudentDiv.php";

    fetch(url1)
        .then((response) => response.text())
        .then((text) => {
            studentSendEmailDivInnerDiv.innerHTML = text;
        });

}
sendEmailtostudent = (id, email) => {
    console.log(id, email);
    let url = "../../admin/adminPanel/sendEmailstudent.php";
    const form = new FormData();
    form.append("id", id);
    form.append("email", email);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {

            console.log(text);
        });
}