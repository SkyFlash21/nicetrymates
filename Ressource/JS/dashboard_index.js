const sideMenu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');
let tablinks = document.querySelectorAll(".tablinks");
let sectionContainer = document.querySelectorAll('.section-container');
let count = 0;

const darkMode = document.querySelector('.dark-mode');

const part1 = document.querySelector('#part1');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

darkMode.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode-variables');
    darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
    darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
})

function reset(){
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
}

function resetDiv(){
    for(j = 0; j < sectionContainer.length; j++){
        sectionContainer[j].style.display = "none";
    }
}
function clickBtn(indice){
    reset(); // Réinitialise les styles ou autres propriétés si nécessaire
    resetDiv(); // Réinitialise les div si nécessaire

    tablinks[indice].classList.add("active");
    // Affiche la section correspondant au compteur actuel
    sectionContainer[indice].style.display='block';
}