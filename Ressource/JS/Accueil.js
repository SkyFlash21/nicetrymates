// Navigation
let pageIndice = 0;
let pageMax = 3;

let flecheDroite = document.querySelector('#fleche-droite');
let flecheGauche = document.querySelector('#fleche-gauche');

if (pageIndice == 0) {
    flecheGauche.style.display = 'none';
}

function checkIndice(mouvement){
    pageIndice += mouvement;
    if (pageIndice == 3) {
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

flecheDroite.addEventListener('click',function(event){
    checkIndice(1);
});

flecheGauche.addEventListener('click',function(event){
    checkIndice(-1);
});