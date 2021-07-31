window.onload = function(){

sendForm();

const exitButton = document.getElementById("exit");
exitButton.addEventListener('click', function() {

    window.location.href = '../admin/registration.html'
})

function sendForm() {
    console.log("script work")
    const button = document.getElementById('form')

    let buttons = document.querySelectorAll('.button')
console.log(buttons)
buttons.forEach(element => {
   
    element.addEventListener('click', async function(event) {

console.log(element.id)

        const id = event.target.id;
        const action = event.target.name;

        const body = `idEdit=${id}`;
        url = '../admin/admin.php';
        options = {
            method : 'POST',
            body,
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }
        };

        const response = await fetch(url, options);
        const status = await response.text();

       
 });
});


}
}