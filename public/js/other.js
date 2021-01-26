function loginAlert() {
  alert("ごめんなさい。ログインしてください(T_T)");
}

const panels = document.querySelectorAll('.panel')

panels.forEach(panel => {
panel.addEventListener('click', () => {
removeActiveClasses()
panel.classList.add('active')
})
})

function removeActiveClasses() {
panels.forEach(panel => {
panel.classList.remove('active')
})
}
const menuToggle = document.querySelector('.toggle');
const showcase = document.querySelector('.showcase');
const menu = document.querySelector('.menu');

menuToggle.addEventListener('click', () => {
menuToggle.classList.toggle('active');
showcase.classList.toggle('active');
menu.classList.add("show");
})
function myFunction() {
var x = document.getElementById("myTopnav");
if (x.className === "topnav") {
x.className += " responsive";
} else {
x.className = "topnav";
}
}