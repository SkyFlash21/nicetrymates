// Navigation
let pageIndice = 0;
let pageMax = 2;

let flecheDroite = document.querySelector('#fleche-droite');
let flecheGauche = document.querySelector('#fleche-gauche');
let partieIndicateur = document.querySelectorAll('.partie-container p');
let partieDiv = document.querySelectorAll('.container');
let titreChangement = document.querySelectorAll('.partie-container p');

if (pageIndice == 0) {
    flecheGauche.style.display = 'none';
}

updateTitle();
updateDiv();

function checkIndice(mouvement){
    pageIndice += mouvement;
    if (pageIndice == 2) {
        flecheDroite.style.display = 'none';
    }else{
        flecheDroite.style.display = 'block';
    }

    if (pageIndice == 0) {
        flecheGauche.style.display = 'none';
    }else{
        flecheGauche.style.display = 'block';
    }
    console.log(pageIndice);
}

function updateTitle(){
    partieIndicateur.forEach(element =>
        element.style.color = "var(--vertGris)"
    );
    partieIndicateur[pageIndice].style.color="#fff";
}

function updateDiv(){
    partieDiv.forEach(element => 
        element.style.display = "none"
    );

    partieDiv[pageIndice].style.display = "block";
}

flecheDroite.addEventListener('click',function(event){
    checkIndice(1);
    updateTitle();
    updateDiv();
});

flecheGauche.addEventListener('click',function(event){
    checkIndice(-1);
    updateTitle()
    updateDiv();
});

let count = 0;

titreChangement.forEach((element,count) => {
    element.addEventListener("click",function(event){
        pageIndice = count;
        updateTitle();
        updateDiv();
    });
});
