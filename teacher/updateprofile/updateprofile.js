uploadpropicdiv=()=>{
    const uploadpropic = document.getElementById("uploadpropicdiv");
    uploadpropic.classList.toggle("d-none");
}
upDateteacher =()=>{
    const fname = document.getElementById('upteacherfname');
    const lname = document.getElementById('upteacherlname');
    const propic  =document.getElementById('uploadpropic'); 
    console.log(propic.files[0]);
    console.log(fname.value);
    console.log(lname.value);
    let url = "../../teacher/updateprofile/updateprofileprocess.php";
    const form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    if(propic){
        form.append("propic", propic.files[0]);
    }
    
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if (text.trim() === "Success") {
                window.location.reload(false)
            }
        });
}
removepropic =()=>{
    
    let url = "../../teacher/updateprofile/removepropicprocess.php";
    fetch(url)
    .then((response) => response.text())
    .then((text) => {
        console.log(text);
        if (text.trim() === "Success") {
            window.location.reload(false)
        }
    });
}