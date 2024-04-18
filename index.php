<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test PT DASHINDO SOLUSI INTEGRASI :: Test Bagian 3</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="bag-3.css" />
</head>
<body>
<header>
    <div>
        <img src="https://dashindo.com/testfullstack/derpface.png" width="70" height="70" alt="Anggap Saja Logo Wkwkwkk">
        <h3>Full Stack Programmer Test</h3>
    </div>
</header>

<div id="map-container">
    <div id="map"></div>
    <div class="card">
        <div class="card-content">
            <div class="card-title">
                <div class="pilih-provinsi">
                    <label for="lokasi">Pilih Provinsi:</label>
                    <select id="lokasi" onchange="pilihProvinsi()">
                        <option value="semua">Semua Provinsi</option>
                    </select>
                </div>
            </div>
            <div id="info"></div>
        </div>
    </div>
</div>

<p class="note">Note:</p>
<p class="note">Saya menambahkan fitur search sesuai provinsi menggunakan select agar mempermudahkan ketika hanya mencari salah satu provinsi saja</p>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-2.5489, 118.0149], 5);
    var geojsonLayer = null;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    var data;

    fetch('proxy.php?url=https://dashindo.com/testfullstack/test.geojson')
    .then(response => response.json())
    .then(geojsonData => {
        data = geojsonData;
        var provinsiOptions = document.getElementById('lokasi');
        var provinsiList = [];
        geojsonData.features.forEach(function(feature) {
            var provinsi = feature.properties.provinsi;
            if (!provinsiList.includes(provinsi)) {
                provinsiList.push(provinsi);
                var option = document.createElement('option');
                option.value = provinsi;
                option.textContent = provinsi;
                provinsiOptions.appendChild(option);
            }
        });
        pilihProvinsi();
    });

    function pilihProvinsi() {
        var provinsi = document.getElementById('lokasi').value;
        if (provinsi === 'semua') {
            if (geojsonLayer) {
                map.removeLayer(geojsonLayer);
            }
            geojsonLayer = L.geoJSON(data, {
                onEachFeature: function (feature, layer) {
                    if (feature.properties) {
                        var popupContent = "<p><b>PT DASHINDO SOLUSI INTEGRASI</b></p>"+
                                           "<p>Test Arza Rizky Nova Ramadhani</p>"+
                                           "-----"+
                                           "<p><b>Provinsi:</b> " + feature.properties.provinsi + "</p>" +
                                           "<p><b>Kecamatan:</b> " + feature.properties.kecamatan + "</p>" +
                                           "<p><b>Nama WS:</b> " + feature.properties.nm_ws + "</p>"+
                                           "-----"+
                                           "<p>Develop By <a href='https://www.arzarizky.com/' target='_blank'>Arza Rizky Nova Ramadhani</a></p>";
                        layer.bindPopup(popupContent);
                    }
                }
            }).addTo(map);
        } else {
            if (geojsonLayer) {
                map.removeLayer(geojsonLayer);
            }
            geojsonLayer = L.geoJSON(data, {
                filter: function(feature, layer) {
                    return feature.properties.provinsi === provinsi;
                },
                onEachFeature: function (feature, layer) {
                    if (feature.properties) {
                        var popupContent = "<p><b>PT DASHINDO SOLUSI INTEGRASI</b></p>"+
                                           "<p>Test Arza Rizky Nova Ramadhani</p>"+
                                           "-----"+
                                           "<p><b>Provinsi:</b> " + feature.properties.provinsi + "</p>" +
                                           "<p><b>Kecamatan:</b> " + feature.properties.kecamatan + "</p>" +
                                           "<p><b>Nama WS:</b> " + feature.properties.nm_ws + "</p>"+
                                           "-----"+
                                           "<p>Develop By <a href='https://www.arzarizky.com/' target='_blank'>Arza Rizky Nova Ramadhani</a></p>";
                        layer.bindPopup(popupContent);
                    }
                }
            }).addTo(map);
        }
    }
</script>
</body>
</html>
