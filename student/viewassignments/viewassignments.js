window.addEventListener('load', () => {
    let url = "../../student/viewassignments/viewassignmentprocess.php";
    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            const lessondiv = document.getElementById("showassignments");           
            lessondiv.innerHTML = text;
        });
})
loadshowassignments = () => {
    let url = "../../student/viewassignments/viewassignmentprocess.php";
    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            const lessondiv = document.getElementById("showassignments");                          
            lessondiv.innerHTML = text;
        });
}