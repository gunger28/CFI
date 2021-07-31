
let mailButton = document.getElementById('inputButton')
let level = "mail"
let mail = ""


sendForm();


function sendForm() {
    document.querySelector('#form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = Object.fromEntries(new FormData(event.target).entries());
        const {inputArea} = formData;
        console.log(mail)
        const body = `mail=${mail}&inputArea=${inputArea}&level=${level}`;
        url = '../admin/authorization.php';
        options = {
            method : 'POST',
            body,
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }
        };

        const response = await fetch(url, options);
        const status = await response.text();

        if (+status === 1) {
            alert('Code sended on your Mail!' + status);
            SetCode()
            console.log(inputArea)
            mail = inputArea
            console.log("code sended to mail" + mail + inputArea + level)
             console.log(status)
        } 
        if(+status === 2){
            alert('Access to account granted)))' + status);
            console.log("logged in" + mail + inputArea + level)
            console.log(status)
            loadUserPage()
        }
        console.log(status)
        if(+status === 666) {
        alert("Access deny" + status);
        console.log("error")}
    });
};


function loadUserPage(){
console.log("loaded new page")
      window.location.href = '../admin/admin.php'
     
}

function SetCode(){

    let imgCode = document.getElementById('inputImg')
    let inputCode = document.getElementById('inputData')
    let buttonCode = document.getElementById('inputButton')

    imgCode.style.backgroundImage = "url(../assets/code.png)"
inputCode.placeholder = "code"
inputCode.value = ""
buttonCode.value = "Go into"
buttonCode.onblur="lol"
level = "code";

}

