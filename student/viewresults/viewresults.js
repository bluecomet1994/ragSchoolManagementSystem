window.addEventListener('load',()=>{
    const showdiv = document.getElementById('showlessonnotes');
    let url = "../../student/viewresults/viewresultsprocess.php";
    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
                      
            showdiv.innerHTML = text;
        });

})