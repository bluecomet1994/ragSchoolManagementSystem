window.addEventListener("load", () => {
    const subjectNameDiv = document.getElementById("subjectName");
    const gradeNameDiv = document.getElementById("gradeName");
    const studentNameDiv = document.getElementById("studentsList");
    if (studentNameDiv) {
        let url1 = "../../academic/addstudent/getstudent.php";

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
        let url1 = "../../academic/addstudent/getstudent.php";

        fetch(url1)
            .then((response) => response.text())
            .then((text) => {
                studentNameDiv.innerHTML = text;
                console.log(text);
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
    const gender = document.getElementById("studentgender");
    const grade = document.getElementById("studentgrade");
    const duedate = document.getElementById("duedate");
    let url = "../../academic/addstudent/addstudentprocess.php";
    const form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("e", mail.value);
    form.append("a", age.value);
    form.append("gn", gender.value);
    form.append("g", grade.value);
    form.append("duedate", duedate.value);
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
removeThestudent = (id, email) => {

    let url = "../../academic/addstudent/removestudent.php";
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
    let url = "../../academic/addstudent/getstudentDetailsasAnArray.php";
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
            const gender = document.getElementById("upstudentgender");
            const age = document.getElementById("upstudentage");
            const duedate = document.getElementById("upstudentduedate");

            fname.value = array[2];
            lname.value = array[3];
            mail.value = array[1];
            age.value = array[5];
            gender.value = array[4];

            duedate.value = array[7];
            console.log(array[7]);
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

    let url = "../../academic/addstudent/updatestudent.php";
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

                //window.location.reload(false);
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
    let url = "../../academic/addstudent/sendEmailstudent.php";
    const form = new FormData();
    form.append("id", id);
    form.append("email", email);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text)


        });
}
showstudents = () => {
    const grade = document.getElementById('studentgradeselectTag');


    let url = "../../academic/addstudent/getstudent.php";
    const form = new FormData();
    form.append("grade_id", grade.value);



    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            
            document.getElementById('studentsList').innerHTML = text;
            if (text.trim() == "Success") {
                loadshowlessonnotes();

            }

        });
}
