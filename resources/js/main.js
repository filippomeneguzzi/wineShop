//hamburger menu
const containerNav = document.querySelector('.link_container');
const linkNav = document.querySelectorAll(".link");
const hamburger = document.getElementById('hamburger');

//show menu
hamburger.addEventListener('click',()=>{

    containerNav.classList.toggle('showMenu');
    hamburger.classList.toggle('open');
    })
    //chiude il menu ogni volta che clicco un link
    linkNav.forEach((link)=>{
        link.addEventListener("click",()=>{
            containerNav.classList.toggle("showMenu");
            hamburger.classList.toggle('open');
        })
    })

//scroll color navbar
window.addEventListener('scroll',()=> {
    const home = document.querySelector(".wineSection");
    const navbar = document.getElementById('navbar');
    if(home){
        if (window.scrollY > 0.94 * window.innerHeight) {
            navbar.style.backgroundColor = '#871928';
        } else {
            navbar.style.backgroundColor = 'transparent';
        }
    }
});


//check per cambiare il colore della navbar quando é tra home and other pages
document.addEventListener('DOMContentLoaded', ()=> {

    const home = document.querySelector(".wineSection");
    const navbar = document.getElementById('navbar');
    if(home && navbar) {
        navbar.style.backgroundColor = 'transparent';
    } else if (navbar) {
        navbar.style.backgroundColor = '#871928';
    }
})



//card height
window.onload = function(){
    //take class
    let cards = document.querySelectorAll(".card");
    //variable for the height
    let heightMax = 550;

    cards.forEach((card)=>{
        let cardHeight = card.offsetHeight;
        if (cardHeight > heightMax) {
            heightMax = cardHeight;
        }
    })


    cards.forEach((card)=>{
        card.style.height = heightMax + 'px';
    })

}
