adminlogIn = () => {
  const emailField = document.getElementById("signem");
  let url = "../adminLogin/loginProcessSendVerifyCode.php";
  const form = new FormData();
  form.append("email", emailField.value);
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
      if (text == "Success") {
        emailField.value = "";
        window.location = "../adminLogin/adminVerifyCode.php";
      }
    });
};

adminVerifyCode = () => {
  const verifyCodeInput = document.getElementById("verifyCode");
  let url = "../adminLogin/loginProcessComplete.php";
  const form = new FormData();
  form.append("code", verifyCodeInput.value);
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
      if (text == "Success") {
        window.location = "../../admin/adminLogin/createAdminSession.php";
        
      }
    });
};
