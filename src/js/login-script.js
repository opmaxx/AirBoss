// Get references to DOM elements
const toggleSwitch = document.getElementById("reg-log");
const loginContainerFront = document.querySelector(".login-container-front");
const loginContainerBack = document.querySelector(".login-container-back");

// Add event listener to the toggle switch
toggleSwitch.addEventListener("change", function () {
    // Check the state of the toggle switch
    if (this.checked) {
        // If checked, rotate the front and back login containers accordingly
        loginContainerFront.style.transform = "rotateY(180deg)";
        loginContainerBack.style.transform = "rotateY(0deg)";
    } else {
        // If not checked, reset the rotation of the front and back login containers
        loginContainerFront.style.transform = "rotateY(0deg)";
        loginContainerBack.style.transform = "rotateY(180deg)";
    }
});