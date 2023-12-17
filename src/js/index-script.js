import './style-node.css';
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

// Declare variables for elements and current index
let images;
let title;
let description_1;
let description_2;
let description_3;
let currentIndex = 1;

// Call the init function with an event
document.addEventListener('DOMContentLoaded', function() {
  init();
});

function init() {
  // Register GSAP plugins
  gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
  // Set initial styles for animation
  gsap.set('.reception', {position:'fixed', width:'100%', height:'100%'})
  gsap.set('.first-move', {width:'100%', height:'250%'})
  // Call scroll animation function
  scrollAnimation();

  // Initialize carousel elements
  images = document.querySelectorAll('.image-1, .image-2, .image-3');
  title = document.getElementById('title');
  description_1= document.getElementById('description-1');
  description_2= document.getElementById('description-2');
  description_3= document.getElementById('description-3');

  // Add click event listeners to arrows
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
  // Update carousel to initial state
  updateCarousel();
}

function scrollAnimation() {
  // Define timeline for scroll-triggered animations
  gsap.timeline({
    scrollTrigger:{
      trigger:'.first-move', 
      start:'top top', 
      end:'bottom bottom', 
      scrub:1}
    })
    .fromTo('.sky', { y: 0 }, { y: -200 }, 0)
    .fromTo('.cloud1-flower1', {y:100},{y:-800}, 0)
    .fromTo('.flower2', {y:-50},{y:-650}, 0)
    .fromTo('.mountBg', {y:-10},{y:-100}, 0)
    .fromTo('.mountMg', {y:-30},{y:-250}, 0)
    .fromTo('.mountFg', {y:-50},{y:-600}, 0)
}

function updateCarousel() {
  // Update carousel display based on current index
  images.forEach((image, index) => {
    if (index === currentIndex) {
      image.style.display = 'block';
      title.textContent = image.getAttribute('data-title');
      description_1.textContent = image.getAttribute('data-description-1');
      description_2.textContent = image.getAttribute('data-description-2');
      description_3.textContent = image.getAttribute('data-description-3');
    } else {
      image.style.display = 'none';
    }
  });
}