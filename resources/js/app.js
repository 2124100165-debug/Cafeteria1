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

        // Ubicación
        const ciudad = document.getElementById('ciudad');
        const estado = document.getElementById('estado');
        const pais = document.getElementById('pais');

        if (ciudad) ciudad.innerText = data.city || 'N/A';
        if (estado) estado.innerText = data.region || 'N/A';
        if (pais) pais.innerText = data.country_name || 'N/A';

        // Llamar clima con coordenadas reales
        obtenerClima(data.latitude, data.longitude);

    })
    .catch(error => {
        console.error('Error en geolocalización:', error);
    });

/*
=====================================
API 2 - CLIMA (OPENWEATHERMAP)
=====================================
*/

function obtenerClima(lat, lon) {

    const apiKey = import.meta.env.VITE_OPENWEATHER_API_KEY;

    if (!lat || !lon) {
        console.error('Coordenadas no disponibles');
        return;
    }

    // CLIMA ACTUAL
    fetch(
        `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`
    )
    .then(response => response.json())
    .then(data => {

        const temp = document.getElementById('temp');
        const humedad = document.getElementById('humedad');
        const lluvia = document.getElementById('lluvia');

        if (temp) temp.innerText = `${data.main.temp} °C`;
        if (humedad) humedad.innerText = `${data.main.humidity} %`;

        // lluvia (si existe)
        if (lluvia) {
            lluvia.innerText = data.rain?.["1h"]
                ? `${data.rain["1h"]} mm`
                : '0 mm';
        }

    })
    .catch(error => {
        console.error('Error del clima:', error);
    });

    // PROBABILIDAD DE LLUVIA (FORECAST)
    fetch(
        `https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`
    )
    .then(response => response.json())
    .then(data => {

        const lluviaProb = document.getElementById('lluviaProb');

        if (lluviaProb && data.list && data.list.length > 0) {
            const prob = (data.list[0].pop || 0) * 100;
            lluviaProb.innerText = `${prob.toFixed(0)} %`;
        }

    })
    .catch(error => {
        console.error('Error probabilidad lluvia:', error);
    });
}

/*
=====================================
API 3 - TIPO DE CAMBIO de moneddas (EXCHANGERATE-API)
=====================================
*/

fetch('https://open.er-api.com/v6/latest/USD')
    .then(response => response.json())
    .then(data => {

        const tipoCambio = document.getElementById('tipoCambio');

        if (tipoCambio && data.rates?.MXN) {
            tipoCambio.innerText = `${data.rates.MXN} MXN`;
        }

    })
    .catch(error => {
        console.error('Error tipo de cambio:', error);
    });