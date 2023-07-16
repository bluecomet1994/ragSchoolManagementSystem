uploadlessonnotes = () => {
    const lname = dsid("teacherlessonname");
    const lfile = dsid("teacherlessonpdf");
    const grade = dsid("lessongrade");

    let url = "../../teacher/teacherlessonnotes/addlessonnotesprocess.php";
    const form = new FormData();
    form.append("lname", lname.value);
    form.append("grade", grade.value);
    form.append("lfile", lfile.files[0]);
    console.log(lfile.files[0]);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if (text.trim() == "Success") {
                lname.value = ""
                lfile.value = ""
                grade.value = ""
                loadshowlessonnotes();
            };

        });
}
window.addEventListener('load', () => {
    let url = "../../teacher/teacherlessonnotes/getlessonnotes.php";
    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            const lessondiv = document.getElementById("showlessonnotes");
            lessondiv.classList.toggle("d-none");
            lessondiv.innerHTML = text;
        });
})
loadshowlessonnotes = () => {
    let url = "../../teacher/teacherlessonnotes/getlessonnotes.php";
    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            const lessondiv = document.getElementById("showlessonnotes");
            if(lessondiv.classList.contains("d-none")){
                lessondiv.classList.toggle("d-none");
            }
           
            lessondiv.innerHTML = text;
        });
}
dsid = (id) => {
    const htmlElement = document.getElementById(id);
    return htmlElement;
}

removetheLesson = (tid, lsnsrc) => {

    let url = "../../teacher/teacherlessonnotes/removelesson.php";
    const form = new FormData();
    form.append("tid", tid);
    form.append("lsnsrc", lsnsrc);


    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if (text.trim() == "Success") {
                loadshowlessonnotes();
            }

        });
}

clickbutton = () => {
    console.log("EE");
}