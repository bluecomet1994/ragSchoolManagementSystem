window.addEventListener('load', () => {
    loadform();
})

loadform = () => {
    let url = "../../student/uploadassignment/assignmentuploadform.php";

    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            document.getElementById("studentuploadassignmentDiv").innerHTML = text;
           // gradechange();
        });
}
const studentassignmentsubjectselector = document.getElementById("studentassignmentsubject");
if (studentassignmentsubjectselector) {
    console.log('noe');
}
uploadassignments = () => {
    const errordiv =document.getElementById("errordiv") ;
    const lfile = dsid("studentassignmentpdf");
    const subject = dsid("studentassignmentsubject");
    const assignmentid = dsid("studentassignmentassignment");
   
    
    let url = "../../student/uploadassignment/uploadassignmentprocess.php";
    const form = new FormData();
    form.append("subject", subject.value);
    form.append("assignmentid",assignmentid.value);
    form.append("lfile", lfile.files[0]);
    
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if(text.trim()=="Success"){
                errordiv.style.color ="white";
                errordiv.classList.remove("py-1");
                errordiv.innerHTML="";
            }else{
               
                errordiv.style.color ="red";
                errordiv.classList.add("py-1");
                errordiv.innerHTML=text;              
            }
        });
}
dsid = (id) => {
    const htmlElement = document.getElementById(id);
    return htmlElement;
}
window.addEventListener('load', () => {

})
gradechange = () => {
    const subject = dsid("studentassignmentsubject");
    let url = "../../student/uploadassignment/getsubjectsforgrade.php";
    const form = new FormData();
    form.append("subjectid", subject.value);



    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {

            const assignmentdiv = document.getElementById("showassignmentsdiv");

            assignmentdiv.innerHTML = "";
            assignmentdiv.innerHTML = text;



        });
}