//mostly sending data to the server side back and forth

getsubjects=()=>{
    const grade = document.getElementById('studentgrade');
    const showsummitteddiv = document.getElementById('showsubmittedstudents');
    let url = "../../academic/sendstudentresult/getsubjects.php";
    const form = new FormData();
    form.append("grade_id", grade.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            
             showsummitteddiv.innerHTML ="";
             showsummitteddiv.innerHTML = text;
        });
}
window.addEventListener('load',()=>{

})

getstudentresults = ()=>{
    const student = document.getElementById('getstudent');
    

    let url = "../../academic/sendstudentresult/getspecificstudentresults.php";
    const form = new FormData();
    form.append("student_id", student.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
             
             document.getElementById('showsubmittedstudentsresults').innerHTML=text;
        });
}

approveresult = (id)=>{
     console.log(id);
     const errormessagediv = document.getElementById('showerrormessagediv');
     let url = "../../academic/sendstudentresult/approveresultprocess.php";
     const form = new FormData();
     form.append("student_assignment_id", id);
     fetch(url, { body: form, method: "POST" })
         .then((response) => response.text())
         .then((text) => {
              if(text=="Success"){
                errormessagediv.innerHTML ="";
                 console.log(text);
              }else{
                errormessagediv.style.color ="red";  
                errormessagediv.innerHTML =text;
              }
              
         });
}