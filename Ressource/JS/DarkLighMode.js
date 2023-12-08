const modeElement1 = document.querySelector('.mode');
const modeElement2 = document.querySelector('.mode2');
let mode = 0;

if(modeElement1 != null){
    modeElement1.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode-variables');
        if(mode==0){
            modeElement.innerHTML = "<i class='bx bx-moon'></i>";
            mode = 1;
        }else{
            modeElement.innerHTML = "<i class='bx bx-sun'></i>"
            mode = 0;
        }
    })
}else{
    modeElement2.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode-variables');
    })
}
