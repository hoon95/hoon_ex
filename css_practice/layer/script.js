let box1 = document.querySelector('.box1');
let box2 = document.querySelector('.box2');

box1.style.background = "#ccc";
box2.style.background = "#ccc";

box1.addEventListener('click', () => {
    alert('box1 click');
})
box2.addEventListener('click', () => {
    alert('box2 click');
})

let searchformBtn = document.querySelector('#search_form');
let aside = document.querySelector('aside');
let asideCloseBtn = aside.querySelector('[type="button"]');

aside.inert = true;

searchformBtn.addEventListener('click', () => {
    aside.classList.add('active');
    aside.inert = false;
})
asideCloseBtn.addEventListener('click', () => {
    aside.classList.remove('active');
    aside.inert = true;
})

let searchInput = aside.querySelector('input');

searchInput.addEventListener('input', (e) => {
    console.log(e.target.value);
})

// aside.setAttribute('inert', '');