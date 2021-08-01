window.onload = function () {
  getInfo();

  function getInfo() {
    const descriptionDiv = document.getElementById("descDiv");
    const objects = document.querySelectorAll("span");
    objects.forEach((element) => {
      element.addEventListener("click", function (event) {
        descriptionDiv.textContent = event.target.title;
      });
    });
  }
};
