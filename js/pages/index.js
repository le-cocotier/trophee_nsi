const root = "/lambda";

function update(button) {
    console.log(button);
}
var menu = document.querySelectorAll('.sidebar-header div')
menu.forEach(div => {
    div.addEventListener('click', function() {update(div.innerText)})
});

let current = "is-dm";
function changeRightMenu(where){
    if(where === current) return;
    if(current === "is-dm"){
        document.querySelectorAll(".is-dm").forEach(el => el.classList.add("hidden"));
        document.querySelectorAll(".is-group").forEach(el => el.classList.remove("hidden"));
        document.querySelector("#dm-button").classList.remove("active");
        document.querySelector("#groups-button").classList.add("active");
        current = "is-group";
    }
    else{
        document.querySelectorAll(".is-group").forEach(el => el.classList.add("hidden"));
        document.querySelectorAll(".is-dm").forEach(el => el.classList.remove("hidden"));
        document.querySelector("#dm-button").classList.add("active");
        document.querySelector("#groups-button").classList.remove("active");
        current = "is-dm";
    }
}

function openGroup(){
    let group = document.querySelector(".create-group__panel");
    if(group.style.display === "block") group.style.display = "none";
    else group.style.display = "block";
}

function delete_post(id) {
    let xhr = new XMLHttpRequest();
    let data = new FormData();
    data.append('ID', id);
    console.log(data);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            window.location.assign(window.location.href);
        }
    }
    xhr.open("POST", root+'/cible/delete_post.php', true);
    xhr.send(data);
}
