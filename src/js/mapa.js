if(document.querySelector('#mapa')){
    const lat = 39.957701
    const lgt = -4.819902
    const zoom = 16
    
    const map = L.map('mapa').setView([lat, lgt], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lgt]).addTo(map)
    .bindPopup(`
        <h2 class="mapa__titulo">DevWebCamp</h2>
        <p class="mapa__descripcion">Talavera Ferial</p>
        `)
    .openPopup();

}