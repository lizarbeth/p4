window.onload = function(){
    var add = document.getElementById("addButton");
    add.onclick = showForm;
    var form = document.getElementById("addText");
}

function showForm(){
    var form = document.getElementById("addText");
    if(form.style.display === "none"){
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}
