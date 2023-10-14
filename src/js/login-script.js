import '../css/style.css';

const toggleSwitch = document.getElementById("reg-log");
const loginContainerFront = document.querySelector(".login-container-front");
const loginContainerBack = document.querySelector(".login-container-back");

toggleSwitch.addEventListener("change", function () {
    if (this.checked) {
        loginContainerFront.style.transform = "rotateY(180deg)";
        loginContainerBack.style.transform = "rotateY(0deg)";
    } else {
        loginContainerFront.style.transform = "rotateY(0deg)";
        loginContainerBack.style.transform = "rotateY(180deg)";
    }
});