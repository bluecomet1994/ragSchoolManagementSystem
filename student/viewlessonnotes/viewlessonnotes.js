window.addEventListener('load', () => {
    let url = "../../student/viewlessonnotes/viewlessonnotesprocess.php";
    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            const lessondiv = document.getElementById("showlessonnotes");           
            lessondiv.innerHTML = text;
        });
})
loadshowlessonnotes = () => {
    let url = "../../student/viewlessonnotes/viewlessonnotesprocess.php";
    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            const lessondiv = document.getElementById("showlessonnotes");                          
            lessondiv.innerHTML = text;
        });
}