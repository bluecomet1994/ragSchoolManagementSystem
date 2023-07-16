teacherlogIn = () => {
    const email = dsid("email");
    const password = dsid("password");

    let url = "../../teacher/teacherLogin/teacherloginprocess.php";
    const form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if(text.trim() =="SuccessSuccess"){
                window.location ="../../teacher/teacherLogin/teacherloginverifycode.php";
            }else  if(text.trim() =="Success"){
                window.location ="../../teacher/teacherLogin/teacherloginverifycode.php";
            }
     
        });
}
dsid = (id) => {
    const htmlElement = document.getElementById(id);
    return htmlElement;
}
teacherverifycode =()=>{
    const verifycode = dsid("verifycode");
    

    let url = "../../teacher/teacherLogin/teacherloginverifycodeprocess.php";
    const form = new FormData();
    form.append("verifycode", verifycode.value);

    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if(text.trim() =="Success"){
                window.location ="../../teacher/teacherLogin/deleteteachersessions.php";
            }
     
        });
}