teacherlogIn = () => {
    const vfcode = dsid("verify_code");
    const password = dsid("password");

    let url = "../../teacher/teacherLogin/teacherloginprocess.php";
    const form = new FormData();
    form.append("vfcode", vfcode.value);
    form.append("password", password.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            // if (text == "Success") {
            //     emailField.value = "";

            // }
        });
}
dsid = (id) => {
    const htmlElement = document.getElementById(id);
    return htmlElement;
}