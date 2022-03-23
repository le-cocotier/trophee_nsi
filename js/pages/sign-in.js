let signIn = document.getElementById("sign-in"); //true
let signUp = document.getElementById("sign-up"); //false
let signInButton = document.getElementById("button_sing-in");
let signUpButton = document.getElementById("button_sing-up");
let current = "sign-in"

/*let password = document.getElementById("password-signup");
password.addEventListener("input", (event) => {
    console.log(password.value)
    if(password.value == ""){
        password.classList.remove("is-error")
        password.classList.remove("is-alert")
    }
    else if(password.value.length < 8){
        if(!password.classList.contains("is-error")) password.classList.add("is-error");
    }
    else{
        password.classList.remove("is-error")
        if(!password.value.match("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$")){
            if(!password.classList.contains("is-alert")) password.classList.add("is-alert");
        }
        else password.classList.remove("is-alert");
    }
})*/

document.getElementById("sign-up_form_submit").addEventListener("click", () => {
    let username = document.getElementById("username-signup");
    let email = document.getElementById("email-signup");
    let date = document.getElementById("birth_date-signup");
    let password = document.getElementById("password-signup");
    let pass = true;
    if(!username.value > 3){
        username.classList.add("is-alert")
        pass = false
    }
    if(!email.value.includes("@")){
        email.classList.add("is-alert")
        pass = false
    }
    if(!password.value.match("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$")){
        password.classList.add("is-alert")
        pass = false
    }

    if(pass){
        let request = new XMLHttpRequest();
        let data = new FormData(document.getElementById("sign-up_form"))
        request.onreadystatechange = (res) => {
            console.log(res)
            if(res.readyState == 4 && res.status == 200){
                //redirect...
                console.log("youou")
            }
            else{
                let resData = JSON.parse(res.response)
                if(resData.error == "email") email.classList.add("is-error")
                else if(resData.error == "date") date.classList.add("is-error")
                else if(resData.error == "username") username.classList.add("is-error")
                else if(resData.error == "password") password.classList.add("is-error")
            }
        }
        request.open("POST", "../cible/sign_up.php", true);
        request.send(data);
    }
})

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