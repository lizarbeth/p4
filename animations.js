window.onload = function () {

    document.getElementById("replyiconlisten").addEventListener("click",replyFunction)

    document.getElementById("bottleiconlisten").addEventListener("click",bottleiconfunction)

    document.getElementById("dropleticonlisten").addEventListener("click",dropleticonfunction)

    var gear = document.getElementById("gear");
    gear.addEventListener("mouseover",gearfunction)
    gear.addEventListener("mouseout",gearfunctionout)

    var drop = document.getElementById("drop");
    drop.addEventListener("mouseover",dropfunction)
    drop.addEventListener("mouseout",dropfunctionout)

    var profile = document.getElementById("profile");
    profile.addEventListener("mouseover",profilefunction)
    profile.addEventListener("mouseout",profilefunctionout)

    var home = document.getElementById("home");
    home.addEventListener("mouseover",homefunction)
    home.addEventListener("mouseout",homefunctionout)
    
    /* js for comment button */
    var add = document.getElementsByClassName("showComments");
    add.onclick = showForm;
    var form = document.getElementsByClassName("display");

}

function gearfunction() {
    var x = document.getElementById("gearin");
    x.classList.add("fa-spin");
    var y =document.getElementById("gear");
    y.classList.add("card");
}
function gearfunctionout() {
    var x = document.getElementById("gearin");
    x.classList.remove("fa-spin");
    var y =document.getElementById("gear");
    y.classList.remove("card");
}

function dropfunction() {
    var x = document.getElementById("dropin");
    x.classList.add("fa-bounce");
    var y =document.getElementById("drop");
    y.classList.add("card");
}
function dropfunctionout() {
    var x = document.getElementById("dropin");
    x.classList.remove("fa-bounce");
    var y =document.getElementById("drop");
    y.classList.remove("card");
}

function profilefunction() {
    var x = document.getElementById("profilein");
    x.classList.add("fa-shake");
    var y =document.getElementById("profile");
    y.classList.add("card");
}
function profilefunctionout() {
    var x = document.getElementById("profilein");
    x.classList.remove("fa-shake");
    var y =document.getElementById("profile");
    y.classList.remove("card");
}

function homefunction() {
    var x = document.getElementById("homein");
    x.classList.add("fa-beat");
    var y =document.getElementById("home");
    y.classList.add("card");
}
function homefunctionout() {
    var x = document.getElementById("homein");
    x.classList.remove("fa-beat");
    var y =document.getElementById("home");
    y.classList.remove("card");
}

function replyFunction() {
    var x = document.getElementById("replyiconin");
    x.classList.toggle("colorone");
    x.classList.toggle("colortwo");
    x.classList.toggle("fa-beat");
}
function bottleiconfunction() {
    var x = document.getElementById("bottleiconin");

    x.classList.toggle("colortwo")
    x.classList.toggle("fa-beat");
    x.classList.toggle("colorone");

}
function dropleticonfunction() {
    var x = document.getElementById("dropleticonin");
    x.classList.toggle("fa-beat");
    x.classList.toggle("colorone");
    x.classList.toggle("colortwo");
}
/* js for show comments */
function showForm(formID){
    var form = document.getElementById(formID);
    if(form.style.display === "none"){
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}
