showstudents = () => {
    const grade = document.getElementById('studentgrade');


    let url = "../../teacher/addassignmentmarks/showstudentsassignments.php";
    const form = new FormData();
    form.append("grade_id", grade.value);



    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {

            document.getElementById('showsomething').innerHTML = text;
            if (text.trim() == "Success") {
                loadshowlessonnotes();

            }

        });
}

window.addEventListener('load', () => {
    const grade = document.getElementById('studentgrade');
    let url = "../../teacher/addassignmentmarks/showstudentsassignments.php";
    const form = new FormData();
    form.append("grade_id", 1);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            const showsomethingdiv = document.getElementById('showsomething')
            if (showsomethingdiv) {
                showsomethingdiv.innerHTML = text;
                if (text.trim() == "Success") {
                    loadshowlessonnotes();
                }
            }

        });
})

viewassignmentsindividual = (id) => {

    window.location = "../../teacher/addassignmentmarks/viewassignmentsindividual.php?X=" + id;
}
const marks = document.getElementById("assignmentmarks");
if (marks) {
    marks.addEventListener('mousedown', () => {
        marksbutton = document.getElementById("marksbutton");
        marksbutton.disabled = false;
    })
}
entermarks = (aid, sid) => {
    const marks = document.getElementById("assignmentmarks" + aid);
    console.log(marks.value);
    console.log(aid + "  " + sid);

    let url = "../../teacher/addassignmentmarks/addassignmentmarksprocess.php";
    const form = new FormData();
    form.append("marks", marks.value);
    form.append("aid", aid);
    form.append("sid", sid);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            viewassignmentsindividual(sid);

        });
}