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

    // Muestra campos condicionales en formulario contacto
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

const navegacionResponsive = ()=>{
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
}

const mostrarMetodosContacto = (event)=>{
    const contactoDiv = document.querySelector('#contacto');
    if(event.target.value === 'telefono'){
        contactoDiv.innerHTML = `
        <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">

        <p>Elija fecha y hora para ser contactado</p>

        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input type="time" id="hora" min="9:00" max="18:00" name="contacto[hora]">
        
        `;
    } else {
        contactoDiv.innerHTML = `
        <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        
        `;
    }
}