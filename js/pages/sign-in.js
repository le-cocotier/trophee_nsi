let signIn = document.getElementById("sign-in"); //true
let signUp = document.getElementById("sign-up"); //false
let signInButton = document.getElementById("button_sing-in");
let signUpButton = document.getElementById("button_sing-up");
let current = "sign-in"

function switchForm(sent){
    if (current == sent) return
    signUp.style.display = "block"
    signUpButton.classList.add("active")

    signIn.style.display = "none"
    signInButton.classList.remove("active")

    let temp = signIn;
    signIn = signUp;
    signUp = temp;

    temp = signInButton;
    signInButton = signUpButton;
    signUpButton = temp;
    current = sent;
}