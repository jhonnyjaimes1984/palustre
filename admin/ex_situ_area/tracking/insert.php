<?php include_once "../../../conf/Config.php";
include_once BASE_URL . "/paginas/cabecera_tercer_nivel.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex-situ Tracking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 1100px; margin-top: 30px; }
        #map { height: 500px; width: 100%; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1 class="mb-4 text-primary">Ex-situ Tracking</h1>
        <p class="lead">Use filters to view specific observations, including GPS-tracked birds.</p>

        <!-- Filter Form -->
        <form id="filterForm" class="row g-3 justify-content-center">
            <div class="col-md-3">
                <label for="species" class="form-label">Species</label>
                <select class="form-control" id="species" name="species">
                    <option value="">All</option>
                    <option value="Species A">Species A</option>
                    <option value="Species B">Species B</option>
                    <option value="Species C">Species C</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="individual" class="form-label">Individual</label>
                <input type="text" class="form-control" id="individual" name="individual" placeholder="Enter ID">
            </div>
            <div class="col-md-2">
                <label for="observerID" class="form-label">Observer ID</label>
                <input type="text" class="form-control" id="observerID" name="observerID" placeholder="Observer ID">
            </div>
            <div class="col-md-2">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="startDate" name="start_date">
            </div>
            <div class="col-md-2">
                <label for="endDate" class="form-label">End Date</label>
                <input type="date" class="form-control" id="endDate" name="end_date">
            </div>
            <div class="col-md-2">
                <label for="observationType" class="form-label">Observation Type</label>
                <select class="form-control" id="observationType" name="observationType">
                    <option value="">All Types</option>
                    <option value="Anilla">Anilla</option>
                    <option value="Visual/Auditivo">Visual/Auditivo</option>
                    <option value="Satélite">Satélite</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>

        <div id="map" class="mt-4"></div>
    </div>

    <script>
        var map = L.map('map').setView([39.35, -0.33], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var markers = [];
        var satelliteTracks = [];
        var satelliteData = [];

        let baseLat = 39.35;
        let baseLon = -0.33;
        for (let i = 0; i < 20; i++) {
            let lat = baseLat + (Math.random() * 0.01 - 0.005);
            let lon = baseLon + (Math.random() * 0.01 - 0.005);
            let date = `2024-02-${String(i + 1).padStart(2, '0')}`;
            satelliteData.push({ lat, lon, date });
        }

        var exampleData = [
            { species: "Species A", individual: "IND001", date_observed: "2024-02-01", latitude: 39.36, longitude: -0.32, type: "Anilla", observerID: "OBS-001" },
            { species: "Species B", individual: "IND002", date_observed: "2024-02-02", latitude: 39.37, longitude: -0.34, type: "Visual/Auditivo", observerID: "OBS-002" },
            { species: "Species C", individual: "IND003", date_observed: "2024-02-03", latitude: 39.38, longitude: -0.35, type: "Anilla", observerID: "OBS-003" }
        ];

        function getMarkerIcon(type, date) {
            let iconUrl = "red-dot.png";

            if (type === "Satélite") {
                if (date === "2024-02-01") iconUrl = "yellow-dot.png";
                else if (date === "2024-02-14") iconUrl = "orange-dot.png";
            } else {
                iconUrl = type === "Anilla" ? "blue-dot.png" : "green-dot.png";
            }

            return L.icon({
                iconUrl: `https://maps.google.com/mapfiles/ms/icons/${iconUrl}`,
                iconSize: [32, 32]
            });
        }

        function clearSatelliteTracks() {
            satelliteTracks.forEach(track => map.removeLayer(track));
            satelliteTracks = [];
        }

        function loadTrackingData() {
            markers.forEach(marker => map.removeLayer(marker));
            clearSatelliteTracks();
            markers = [];

            let selectedSpecies = document.getElementById("species").value;
            let selectedObserver = document.getElementById("observerID").value;
            let selectedType = document.getElementById("observationType").value;

            let hasSatelliteData = false;
            let satelliteCoords = [];

            exampleData.forEach(point => {
                if ((selectedSpecies === "" || point.species === selectedSpecies) &&
                    (selectedObserver === "" || point.observerID === selectedObserver) &&
                    (selectedType === "" || point.type === selectedType)) {
                    
                    let marker = L.marker([point.latitude, point.longitude], {
                        icon: getMarkerIcon(point.type, point.date_observed)
                    }).addTo(map);
                    marker.bindPopup(`<strong>Species:</strong> ${point.species}<br><strong>Individual:</strong> ${point.individual}<br><strong>Date:</strong> ${point.date_observed}<br><strong>Observer:</strong> ${point.observerID}<br><strong>Type:</strong> ${point.type}`);
                    markers.push(marker);
                }
            });

            if (selectedType === "" || selectedType === "Satélite") {
                satelliteData.forEach(point => {
                    let marker = L.marker([point.lat, point.lon], {
                        icon: getMarkerIcon("Satélite", point.date)
                    }).addTo(map);
                    marker.bindPopup(`<strong>Individual:</strong> SAT-001<br><strong>Date:</strong> ${point.date}<br><strong>Type:</strong> Satélite`);
                    markers.push(marker);
                    hasSatelliteData = true;
                    satelliteCoords.push([point.lat, point.lon]);
                });

                if (hasSatelliteData && satelliteCoords.length > 1) {
                    let polyline = L.polyline(satelliteCoords, { color: 'red', weight: 3 }).addTo(map);
                    satelliteTracks.push(polyline);
                }
            }
        }

        document.getElementById('filterForm').addEventListener('submit', function(event) {
            event.preventDefault();
            loadTrackingData();
        });

        loadTrackingData();
    </script>
</body>
</html>
<?php  include_once BASE_URL . "/paginas/pie_3.php";   ?>
