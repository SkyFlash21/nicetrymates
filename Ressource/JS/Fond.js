
// Changement de theme 
let fond1 = document.querySelector('#fond1');
let fond2 = document.querySelector('#fond2');

fond1.addEventListener('click',function(event){
    document.querySelector('body').style.backgroundImage = "url('../Ressource/Images/fondForet1.jpg')";
    document.querySelectorAll('.container h2').forEach(element => {
        element.style.color="var(--spec)";
    });
});

fond2.addEventListener('click',function(event){
    document.querySelector('body').style.backgroundImage = "url('../Ressource/Images/fondMer1.jpg')";
    document.querySelectorAll('.container h2').forEach(element => {
        element.style.color="var(--spec)";
    });
});

