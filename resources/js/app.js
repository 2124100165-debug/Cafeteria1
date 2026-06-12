import './bootstrap';
import 'bootstrap';

/*
=====================================
API 1 - GEOLOCALIZACIÓN (IPAPI)
=====================================
*/

fetch('https://ipapi.co/json/')
    .then(response => response.json())
    .then(data => {

        const ciudad = document.getElementById('ciudad');
        const estado = document.getElementById('estado');
        const pais = document.getElementById('pais');

        if (ciudad) ciudad.innerText = data.city;
        if (estado) estado.innerText = data.region;
        if (pais) pais.innerText = data.country_name;

        obtenerClima(data.latitude, data.longitude);

    })
    .catch(error => {
        console.error('Error de geolocalización:', error);
    });

/*
=====================================
API 2 - CLIMA (OPENWEATHERMAP)
=====================================
*/

function obtenerClima(lat, lon) {

    const apiKey = import.meta.env.VITE_OPENWEATHER_API_KEY;

    fetch(
        `https://api.openweathermap.org/data/2.5/weather?q=London,uk&APPID=4befe011c90d79ba63e37ab6934e5553&units=metric`
    )
    .then(response => response.json())
    .then(data => {

        console.log('CLIMA:', data);

        const temp = document.getElementById('temp');
        const humedad = document.getElementById('humedad');
        const lluvia = document.getElementById('lluvia');

        if (temp) temp.innerText = data.main.temp;
        if (humedad) humedad.innerText = data.main.humidity;

        if (lluvia) {
            lluvia.innerText = data.rain
                ? Object.values(data.rain)[0]
                : 0;
        }

    })
    .catch(error => {
        console.error('Error del clima:', error);
    });
}

/*
=====================================
API 3 - TIPO DE CAMBIO
=====================================
*/

fetch(
    `https://v6.exchangerate-api.com/v6/0b24c258710bf792ea7bc799/latest/USD`
)
.then(response => response.json())
.then(data => {

    console.log('MONEDA:', data);

    const tipoCambio = document.getElementById('tipoCambio');

    if (tipoCambio) {
        tipoCambio.innerText =
            data.conversion_rates.MXN;
    }

})
.catch(error => {
    console.error('Error en tipo de cambio:', error);
});