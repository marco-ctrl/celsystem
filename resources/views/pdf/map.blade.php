<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        #map {
            width: 100%;
            height: 400px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <title>Informe</title>
</head>

<body>
    <h1>Reporte de Ubicaciones</h1>
    <div id="map"></div>
    <img id="mapImage" style="display: none;" />

    <script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js"></script>
    <script src="https://rawgit.com/mapbox/leaflet-image/gh-pages/leaflet-image.js"></script>
    <script>
        var map = L.map('map').setView([-22.735938864584394, -64.34173274785282], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var coordinates = {!! json_encode($coordinates) !!};

        L.marker([coordinates.latitude, coordinates.length]).addTo(map)
            .bindPopup(coordinates.name_celula)
            .openPopup();

        leafletImage(map, function(err, canvas) {
            var img = document.getElementById('mapImage');
            img.src = canvas.toDataURL();
            img.style.display = 'block';
            document.getElementById('map').style.display = 'none';
        });
    </script>
</body>

</html>
