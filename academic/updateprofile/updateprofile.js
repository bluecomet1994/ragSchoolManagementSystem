uploadpropicdiv=()=>{
    const uploadpropic = document.getElementById("uploadpropicdiv");
    uploadpropic.classList.toggle("d-none");
}
upDateacademic =()=>{
    const fname = document.getElementById('upacademicfname');
    const lname = document.getElementById('upacademiclname');
    const propic  =document.getElementById('uploadpropic'); 
    console.log(propic.files[0]);
    console.log(fname.value);
    console.log(lname.value);
    let url = "../../academic/updateprofile/updateprofileprocess.php";
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
    
    let url = "../../academic/updateprofile/removepropicprocess.php";
    fetch(url)
    .then((response) => response.text())
    .then((text) => {
        console.log(text);
        if (text.trim() === "Success") {
            window.location.reload(false)
        }
    });
}