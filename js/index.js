window.onload = function(){

    console.log("script logs")
getInfo()




    function getInfo(){
        const descriptionDiv = document.getElementById('descDiv')
        const objects = document.querySelectorAll('li')
        console.log(objects)
        objects.forEach(element => {
            element.addEventListener('click', function(event) {

                console.log("kek")
                descriptionDiv.textContent = event.target.title


                        })
        });
    

    }

}