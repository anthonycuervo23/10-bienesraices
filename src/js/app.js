document.addEventListener('DOMContentLoaded', ()=>{
    eventListeners();

    darkMode();
});

const darkMode = ()=>{

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    //console.log(prefiereDarkMode.matches);

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', ()=>{
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', ()=>{
        console.log('test');
        document.body.classList.toggle('dark-mode');
    });
}

const eventListeners = ()=>{
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

const navegacionResponsive = ()=>{
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
}