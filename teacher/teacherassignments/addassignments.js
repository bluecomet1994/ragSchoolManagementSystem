uploadassignments = () => {
    const lname = dsid("teacherassignmentname");
    const lfile = dsid("teacherassignmentpdf");
    const grade = dsid("assignmentgrade");
    const duedate = dsid("teacherassignmentduedate");

    let url = "../../teacher/teacherassignments/addassignmentsprocess.php";
    const form = new FormData();
    form.append("lname", lname.value);
    form.append("grade", grade.value);
    form.append("duedate",duedate.value);
    form.append("lfile", lfile.files[0]);
    
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if (text.trim() == "Success") {
                lname.value = ""
                lfile.value = ""
                duedate.value = ""
                grade.value = ""
                loadshowassignments();
            };

        });
}
window.addEventListener('load', () => {
    let url = "../../teacher/teacherassignments/getassignments.php";
    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            const assignmentdiv = document.getElementById("showassignments");
            assignmentdiv.classList.toggle("d-none");
            assignmentdiv.innerHTML = text;
        });
})
loadshowassignments = () => {
    let url = "../../teacher/teacherassignments/getassignments.php";
    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            const assignmentdiv = document.getElementById("showassignments");
            if(assignmentdiv.classList.contains("d-none")){
                assignmentdiv.classList.toggle("d-none");
            }
           
            assignmentdiv.innerHTML = text;
        });
}
dsid = (id) => {
    const htmlElement = document.getElementById(id);
    return htmlElement;
}

removetheassignment = (tid, lsnsrc) => {

    let url = "../../teacher/teacherassignments/removeassignment.php";
    const form = new FormData();
    form.append("tid", tid);
    form.append("lsnsrc", lsnsrc);


    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if (text.trim() == "Success") {
                loadshowassignments();
            }

        });
}

clickbutton = () => {
    console.log("EE");
}