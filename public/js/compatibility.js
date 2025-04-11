function getCsrfToken() {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
}
async function sendAjaxRequest(method, url, data = null) {
    const headers = {
        "X-CSRF-TOKEN": getCsrfToken(), // envía el token CSRF de Laravel para protegerte contra ataques CSRF.
        "Content-Type": "application/json", // se van a enviar los datos en formato JSON
        Accept: "application/json", // se van a recibir los datos en formato JSON
    };

    const options = {
        method, // se llaman a las funciones GET, POST, PUT
        headers,
    };

    if (data) {
        options.body = JSON.stringify(data); //si existen datos como los del formulario se convierten en JSON para que el servidor los entienda
    }

    const response = await fetch(url, options); //fetch envia la petición al servidor de Laravel y "await" detiene la función hasta que se reciba la respuesta
    if (!response.ok) {
        //se manejan los errores
        const errorData = await response.json();
        throw errorData;
    }

    return response.json(); //si todo fue bien se devuelve el resultado en JSON
}
// Ahora vamos a crear funciones para los temas OSCURO Y CLARO
function setTheme(theme) {
    //Función para colocar el tema
    //Cambia el atributo "data-bs-theme" del elemento <html> que Bootstrap 5.3 usa
    //para saber qué tema aplicar (light o dark).
    document.documentElement.setAttribute("data-bs-theme", theme);
    localStorage.setItem("theme", theme);
}

function themeOption() {
    //Obtiene el tema actual sino pilla "light" por defecto
    const theme = localStorage.getItem("theme") || "light";
    setTheme(theme === "light" ? "dark" : "light"); // Cambia los temas segun la elección
}

document.addEventListener("DOMContentLoaded", () => {
    // Se inicia el tema elegido o por defecto
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        setTheme(savedTheme);
    } else {
        const preferDark = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;
        setTheme(preferDark ? "dark" : "light");
    }
    // Boton de cambio de tema en funcionamiento
    const btnOption = document.getElementById("theme");
    if (btnOption) {
        btnOption.addEventListener("click", themeOption);
    }

    // Tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach((el) => {
        new bootstrap.Tooltip(el);
    });

    // Validaciones con ticks visuales
    document.querySelectorAll("input, textarea, select").forEach((input) => {
        input.addEventListener("input", () => {
            // Se caza el tipo, el valor y el id de cada input
            const type =
                input.getAttribute("type") || input.tagName.toLowerCase();
            const value = input.value.trim();
            const id = input.id;

            let isValid = false;

            // Función para validar hasta 2 decimales
            const hasMaxTwoDecimals = (val) => {
                const num = parseFloat(val);
                if (isNaN(num)) return false;
                const decimals = val.includes(".")
                    ? val.split(".")[1].length
                    : 0;
                return decimals <= 2;
            };

            switch (id) {
                case "name":
                case "holder":
                case "name_agent":
                case "mark":
                case "model":
                case "method":
                case "build":
                    isValid = value.length > 0;
                    break;
                case "address":
                case "location":
                case "description":
                case "requirements":
                case "name_location":
                    isValid = value.length >= 5;
                    break;
                case "cod_address":
                case "cod_location":
                    isValid = value.length >= 5;
                    break;
                case "cif":
                case "nif":
                    isValid = value.length >= 9 && value.length <= 20;
                    break;
                case "activity":
                    isValid = value.length >= 10;
                    break;
                case "m_parcels":
                case "m_surface":
                case "kva":
                case "kw":
                case "budget":
                case "air_entry":
                case "air_flow":
                case "w":
                case "factor":
                    const parsed = parseFloat(value);
                    isValid = !isNaN(parsed) && parsed >= 0 && hasMaxTwoDecimals(value);
                    break;
                default:
                    isValid = input.checkValidity();
                    break;
            }

            //Se denomina la funcion isValid en base a los requisitos del switch
            input.classList.toggle("is-valid", isValid);
            input.classList.toggle("is-invalid", !isValid);
        });
    });

    // Animaciones en cards (ejemplo fade-in)
    document.querySelectorAll(".card").forEach((card, index) => {
        setTimeout(() => {
            //Hace un efecto cascada en cada card de las memorias
            card.classList.add("animate__animated", "animate__fadeInUp");
        }, index * 150);
    });
});
