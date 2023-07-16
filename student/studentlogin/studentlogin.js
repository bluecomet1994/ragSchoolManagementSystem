studentlogIn = () => {
    const email = dsid("email");
    const password = dsid("password");

    let url = "../../student/studentLogin/studentloginprocess.php";
    const form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            alert(text);
            console.log(text);
            if (text.trim() == "SuccessSuccess") {
                window.location = "../../student/studentlogin/studentloginverifycode.php";
            } else if (text.trim() == "Success You have to pay for accessing this service") {
                window.location = "../../paymentGateway/checkout.php";
            } else if (text.trim() == "Success") {
                window.location = "../../student/studentlogin/studentloginverifycode.php";
            }

        });
}
dsid = (id) => {
    const htmlElement = document.getElementById(id);
    return htmlElement;
}
studentverifycode = () => {
    const verifycode = dsid("verifycode");


    let url = "../../student/studentLogin/studentloginverifycodeprocess.php";
    const form = new FormData();
    form.append("verifycode", verifycode.value);

    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if (text.trim() == "Success") {
                window.location = "../../student/studentLogin/deletestudentsessions.php";
            }

        });
}