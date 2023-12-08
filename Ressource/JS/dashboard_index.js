const sideMenu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');
let tablinks = document.querySelectorAll(".tablinks");
let sectionContainer = document.querySelectorAll('.section-container');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

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


//Fonction pour le charlie
function charlieInvarders(){
    document.getElementById("charlie").style.display ="block";
    /*setTimeout(function() {
       window.location.href = "Accueil.html";
    }, 500);*/
}