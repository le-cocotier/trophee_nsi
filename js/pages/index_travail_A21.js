
function update(button) {
    console.log(button);
}
var menu = document.querySelectorAll('.sidebar-header div')
menu.forEach(div => {
    div.addEventListener('click', function() {update(div.innerText)})
});
