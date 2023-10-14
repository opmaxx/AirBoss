/*********************** Import ***********************/
import '../css/style.css';
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

let images;
let title;
let description_1;
let description_2;
let description_3;
let description_4;
let currentIndex = 1;
/******************************************************/



/***************** Calling functions ******************/
document.addEventListener('DOMContentLoaded', function() {
    init();
  });
/******************************************************/



/********************* Functions **********************/
function init() {

    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
    gsap.set('.reception', {position:'fixed', width:'100%', height:'100%'})
    gsap.set('.first-move', {width:'100%', height:'250%'})
    scrollAnimation();

    images = document.querySelectorAll('.image-1, .image-2, .image-3');
    title = document.getElementById('title');
    description_1= document.getElementById('description-1');
    description_2= document.getElementById('description-2');
    description_3= document.getElementById('description-3');
    description_4= document.getElementById('description-4');
    const arrowLeft = document.querySelector('.arrow-left');
    const arrowRight = document.querySelector('.arrow-right');
    arrowLeft.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateCarousel();
    });
    arrowRight.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateCarousel();
    });
    updateCarousel();

}

function scrollAnimation() {

    gsap.timeline({
        scrollTrigger:{
            trigger:'.first-move', 
            start:'top top', 
            end:'bottom bottom', 
            scrub:1}
        })
        .fromTo('.sky', {y:0},{y:-200}, 0)
        .fromTo('.cloud1', {y:100},{y:-800}, 0)
        .fromTo('.cloud2', {y:-150},{y:-500}, 0)
        .fromTo('.cloud3', {y:-50},{y:-650}, 0)
        .fromTo('.mountBg', {y:-10},{y:-100}, 0)
        .fromTo('.mountMg', {y:-30},{y:-250}, 0)
        .fromTo('.mountFg', {y:-50},{y:-600}, 0)
    gsap.timeline({
        scrollTrigger:{
            trigger:'.first-move', 
            start:'top top', 
            end:'center center',
            ease: 'customEase',
            scrub:1}
        })
        .fromTo('.plane', {x:70, y:350},{x:1200, y:-250}, 0)
    gsap.registerEase('customEase', (progress) => {
        return Math.sin(progress * Math.PI / 2);
    });

}

function updateCarousel() {

    images.forEach((image, index) => {
      if (index === currentIndex) {
        image.style.display = 'block';
        title.textContent = image.getAttribute('data-title');
        description_1.textContent = image.getAttribute('data-description-1');
        description_2.textContent = image.getAttribute('data-description-2');
        description_3.textContent = image.getAttribute('data-description-3');
        description_4.textContent = image.getAttribute('data-description-4');
      } else {
        image.style.display = 'none';
      }
    });

}
/******************************************************/
