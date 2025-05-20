async function getGeoInfo(postalCode, callback) {
    try {
        const res = await fetch(`/geolookup?postalcode=${postalCode}`);
        const data = await res.json();
        if (data.postalcodes && data.postalcodes.length > 0) {
            const info = data.postalcodes[0];
            callback(info.placeName, info.adminName2 || info.adminName1);
        }
    } catch (error) {
        console.error('Error al obtener la localidad/municipio:', error);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('cod_address')?.addEventListener('blur', function () {
        const postal = this.value.trim();
        if (postal.length === 5) {
            getGeoInfo(postal, (localidad, municipio) => {
                document.getElementById('local_address').value = localidad;
                document.getElementById('town_address').value = municipio;
            });
        }
    });

    document.getElementById('cod_location')?.addEventListener('blur', function () {
        const postal = this.value.trim();
        if (postal.length === 5) {
            getGeoInfo(postal, (localidad, municipio) => {
                document.getElementById('name_location').value = localidad;
                document.getElementById('name_town').value = municipio;
            });
        }
    });
});