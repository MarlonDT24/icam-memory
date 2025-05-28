document.getElementById("pciForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = e.target; 
    const formData = new FormData(form);

    fetch(PCI_ROUTE, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": formData.get("_token"),
        },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                const encabezado = document.getElementById("cabecera-tabla");
                const cuerpo = document.getElementById("cuerpo-tabla");
                const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';

                // Añadir encabezados si aún no están
                if (encabezado.children.length === 1) {
                    Object.keys(data.resultado).forEach((k) => {
                        const th = document.createElement("th");
                        th.textContent = k.replace(/_/g, " ");
                        encabezado.appendChild(th);
                    });
                }

                // Crear nueva fila con resultados
                const fila = document.createElement("tr");

                // Determinar el color según el tipo
                const tipo = (
                    data.resultado.tipo ||
                    data.resultado.Tipo ||
                    ""
                ).toUpperCase(); // Asegura que es mayúscula
    
                let colorFondo = isDark ? "#444" : "#6c757d"; // gris por defecto

                switch (tipo) {
                    case "AV":
                    case "AH":
                        colorFondo = isDark ? "#bb2d3b" : "#dc3545";
                        break;
                    case "B":
                        colorFondo = isDark ? "#157347" : "#198754";
                        break;
                    case "C":
                        colorFondo = isDark ? "#d3a900" : "#ffc107";
                        break;
                    case "D":
                        colorFondo = isDark ? "#0b5ed7" : "#0d6efd";
                        break;
                }

                // Columna del nombre
                const celdaNombre = document.createElement("td");
                celdaNombre.classList.add("fw-bold", "text-white", "text-center");
                celdaNombre.style.backgroundColor = colorFondo;
                celdaNombre.textContent = data.nombre;
                fila.appendChild(celdaNombre);

                // Celdas de resultado
                Object.values(data.resultado).forEach((valor) => {
                    const td = document.createElement("td");
                    td.textContent = valor;

                    if (isDark) {
                        td.style.backgroundColor = "#2c2c2c"; // fondo oscuro
                        td.style.color = "#f0f0f0"; // texto claro
                    }
                    fila.appendChild(td);
                });

                cuerpo.appendChild(fila);

                form.reset();
                form.querySelectorAll(".is-valid, .is-invalid").forEach(
                    (el) => {
                        el.classList.remove("is-valid", "is-invalid");
                    }
                );
            } else {
                alert("Error al calcular. Verifica los datos.");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Error del servidor.");
        });
});
