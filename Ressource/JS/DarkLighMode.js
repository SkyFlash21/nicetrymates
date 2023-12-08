const modeElement = document.querySelector('.mode');
let mode = 0;

modeElement.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode-variables');
    if(mode==0){
        modeElement.innerHTML = "<i class='bx bx-moon'></i>";
        mode = 1;
    }else{
        modeElement.innerHTML = "<i class='bx bx-sun'></i>"
        mode = 0;
    }
})