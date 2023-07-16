academiclogIn = () => {
    const email = dsid("email");
    const password = dsid("password");

    let url = "../../academic/academicLogin/academicloginprocess.php";
    const form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            alert(text);
            console.log(text);
            if(text.trim() =="SuccessSuccess"){
                window.location ="../../academic/academicLogin/academicloginverifycode.php";
            }else  if(text.trim() =="Success"){
                window.location ="../../academic/academicLogin/academicloginverifycode.php";
            }
     
        });
}
dsid = (id) => {
    const htmlElement = document.getElementById(id);
    return htmlElement;
}
academicverifycode =()=>{
    const verifycode = dsid("verifycode");
    

    let url = "../../academic/academicLogin/academicloginverifycodeprocess.php";
    const form = new FormData();
    form.append("verifycode", verifycode.value);

    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if(text.trim() =="Success"){
                window.location ="../../academic/academicLogin/deleteacademicsessions.php";
            }
     
        });
}