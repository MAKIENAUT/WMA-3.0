document.addEventListener("DOMContentLoaded", function () {
   const firstTempEmpButton = document.getElementById("h2a-button");
   showTempEmp(0, firstTempEmpButton);
})

function showTempEmp(tempEmpIndex, clickedButton) {
   const tempEmp = document.querySelectorAll("#tempEmp");

   tempEmp.forEach(function (container) {
      container.style.display = "none";
   });

   tempEmp[tempEmpIndex].style.display = "block";

   setButtonActive(clickedButton);
}

function setButtonActive(clickedButton) {
   const allButtons = document.querySelectorAll(".temp-emp-button");

   allButtons.forEach(function (button) {
      button.classList.remove("button-active");
   });

   clickedButton.classList.add("button-active");
}