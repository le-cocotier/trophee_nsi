let signIn = document.getElementById("sign-in"); //true
let signUp = document.getElementById("sign-up"); //false
let signInButton = document.getElementById("button_sing-in");
let signUpButton = document.getElementById("button_sing-up");
let current = "sign-in"

function submitSignIn(){
    let username = document.getElementById("username-signin");
    let password = document.getElementById("password-signin");

    let request = new XMLHttpRequest();
    let data = new FormData(document.getElementById("sign-in_form"))
    request.onreadystatechange = () => {
        if(request.readyState == 4 && request.status == 200){
            if (request.response != '') {
                console.log(request.response);

                let resData = JSON.parse(request.response);
                if(resData.error.includes("username")){
                    document.getElementById("username-signin-error").classList.remove('hidden');
                }
                else {
                    document.getElementById("username-signin-error").classList.add('hidden');
                }
                if (resData.error.includes('password')) {
                    document.getElementById("password-signin-error").classList.remove('hidden');
                }
                else {
                    document.getElementById("password-signin-error").classList.add('hidden');
                }
            }
            else {
                window.location.assign('../../page/index/index.php');
            }
        }
    }
    request.open("POST", "../../cible/sign_in.php", true);
    request.send(data);
}

function sumbitSignUp(){
    let username = document.getElementById("username-signup");
    let email = document.getElementById("email-signup");
    let date = document.getElementById("birth_date-signup");
    let password = document.getElementById("password-signup");
    if(username.value.length < 4){
        username.classList.add("is-alert")
        document.getElementById("username-signup-error").classList.remove('hidden')
        return
    }
    else {
        username.classList.remove("is-alert")
        document.getElementById("username-signup-error").classList.add('hidden');
    }
    if(!email.value.includes("@")){
        email.classList.add("is-alert")
        document.getElementById("email-signup-error").classList.remove('hidden');
        return
    }
    else {
        email.classList.remove("is-alert")
        document.getElementById("email-signup-error").classList.add('hidden');
    }
    if(!password.value.match("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!.@$%^&*-]).{8,}$")){
        password.classList.add("is-alert")
        document.getElementById("password-signup-error").classList.remove('hidden');
        return
    }
    else {
        password.classList.remove("is-alert")
        document.getElementById("password-signup-error").classList.add('hidden');
    }

    let request = new XMLHttpRequest();
    let data = new FormData(document.getElementById("sign-up_form"))
    request.onreadystatechange = () => {
        if(request.readyState == 4 && request.status == 200){
            if (request.response != '') {
                let resData = JSON.parse(request.response)
                if(resData.error.includes("email")){
                    document.getElementById("email-signup-error").classList.remove('hidden');
                }
                else {
                    document.getElementById("email-signup-error").classList.add('hidden');
                }
                if(resData.error.includes("date")){
                    document.getElementById("birth_date-signup-error").classList.remove('hidden');
                }
                else {
                    document.getElementById("birth_date-signup-error").classList.add('hidden');
                }
                if(resData.error.includes("username")){
                    document.getElementById("username-signup-error").classList.remove('hidden');
                }
                else {
                    document.getElementById("username-signup-error").classList.add('hidden');
                }
                if(resData.error.includes("password")){
                    document.getElementById("password-signup-error").classList.remove('hidden');
                }
                else {
                    document.getElementById("password-signup-error").classList.add('hidden');
                }
            }
            else {
                window.location.assign('../../page/index/index.php');

            }
        }
    }
    request.open("POST", "../../cible/sign_up.php", true);
    request.send(data);
}

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
