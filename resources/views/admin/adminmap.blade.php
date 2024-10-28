<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes en el Mapa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <!-- Leaflet MarkerCluster CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        body {
            padding-top: 70px; /* Para evitar solapamiento con el navbar */
        }

        #map {
            height: 600px;
            margin-bottom: 20px;
            border: 2px solid #e9ecef;
            border-radius: 5px;
        }

        .info-popup {
            font-size: 14px;
        }

        .filter-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter-container select {
            width: auto;
            min-width: 250px;
        }

        .container-fluid {
            margin-top: 20px;
        }

        /* Ajustes para el sidebar */
        #sidebar {
            background-color: #343a40;
            min-height: 100vh;
            padding: 20px;
            position: fixed;
        }

        #main-content {
            margin-left: 260px; /* Dejar espacio para el sidebar */
            padding: 20px;
        }

        #sidebar .nav-link {
            color: #fff;
        }

        #sidebar .nav-link.active {
            background-color: #495057;
            border-radius: 5px;
        }

    </style>
</head>

<body>

    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIFOREST</a>
            <div class="d-flex align-items-center ms-auto">
                <span class="text-white me-3">Bienvenido, {{ Auth::user()->name }}</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="btn btn-danger btn-sm"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-md-3 sidebar bg-dark text-white">
                <ul class="nav flex-column p-3">
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i> Inicio</a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white" href="{{ route('admin.usuarios') }}">
                            <i class="fas fa-users"></i> Usuarios</a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white" href="{{ route('admin.documentos') }}">
                            <i class="fas fa-file-alt"></i> Documentos</a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white" href="{{ route('admin.solicitudes') }}">
                            <i class="fas fa-folder-open"></i> Solicitudes</a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-map-marker-alt"></i> Mapa de Solicitudes</a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white" href="{{ route('historial.index') }}">
                            <i class="fas fa-history"></i> Historial de Cambios</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div id="main-content" class="col-md-9 main-content">
                <div class="container mt-4 pt-3">
                    <h1 class="mb-3">Solicitudes en el Mapa</h1>

                    <!-- Filtros -->
                    <div class="filter-container">
                        <div>
                            <select class="form-select" id="filtroRegion">
                                <option value="">Todos</option>
                                <option value="San Salvador">San Salvador</option>
                                <option value="San Miguel">San Miguel</option>
                                <option value="La Libertad">La Libertad</option>
                                <option value="Santa Ana">Santa Ana</option>
                                <option value="Sonsonate">Sonsonate</option>
                                <option value="La Paz">La Paz</option>
                                <option value="Usulután">Usulután</option>
                                <option value="La Unión">La Unión</option>
                                <option value="Morazán">Morazán</option>
                                <option value="Cabañas">Cabañas</option>
                                <option value="Chalatenango">Chalatenango</option>
                                <option value="Cuscatlán">Cuscatlán</option>
                                <option value="Ahuachapán">Ahuachapán</option>
                            </select>
                        </div>
                        <div>
                            <button id="miUbicacionBtn" class="btn btn-success">
                                <i class="fas fa-map-marker-alt"></i> Centrar en mi ubicación
                            </button>
                        </div>
                    </div>

                    <!-- Mapa -->
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

    <!-- Scripts -->
    <script>
        // Inicializamos el mapa centrado en El Salvador
        var map = L.map('map').setView([13.794185, -88.89653], 8);

        // Añadir la capa base del mapa (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Clúster de marcadores
        var markersCluster = L.markerClusterGroup();

        // Lista de solicitudes con latitud y longitud (proporcionadas por el backend)
        var solicitudes = @json($solicitudes);

        // Añadir iconos personalizados para los diferentes estados
        var iconos = {
            "aprobado": L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/845/845646.png',
                iconSize: [30, 30]
            }),
            "rechazado": L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/1828/1828665.png',
                iconSize: [30, 30]
            }),
            "en proceso": L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/2211/2211986.png',
                iconSize: [30, 30]
            })
        };

        // Iteramos sobre las solicitudes y añadimos marcadores
        solicitudes.forEach(function (solicitud) {
            if (solicitud.latitud && solicitud.longitud) {
                var marker = L.marker([solicitud.latitud, solicitud.longitud], {
                    icon: iconos[solicitud.estado] || iconos['en proceso']
                });

                // Añadir información emergente al marcador
                marker.bindPopup(
                    '<div class="info-popup">' +
                    '<strong>Solicitante:</strong> ' + solicitud.nombre + '<br>' +
                    '<strong>Teléfono:</strong> ' + solicitud.celular + '<br>' +
                    '<strong>Motivo:</strong> ' + solicitud.justificacion +
                    '</div>'
                );

                markersCluster.addLayer(marker);
            }
        });

        // Añadir el clúster de marcadores al mapa
        map.addLayer(markersCluster);

        document.getElementById('filtroRegion').addEventListener('change', function () {
            var regionSeleccionada = this.value.trim().toLowerCase(); // Elimina espacios y convierte a minúsculas

            markersCluster.clearLayers(); // Limpiar los marcadores actuales

            solicitudes.forEach(function (solicitud) {
                if (solicitud.departamento_solicitante &&
                    solicitud.departamento_solicitante.trim().toLowerCase().includes(regionSeleccionada)) {
                    var marker = L.marker([solicitud.latitud, solicitud.longitud], {
                        icon: iconos[solicitud.estado] || iconos['en proceso']
                    });

                    marker.bindPopup(
                        '<div class="info-popup">' +
                        '<strong>Solicitante:</strong> ' + solicitud.nombre + '<br>' +
                        '<strong>Teléfono:</strong> ' + solicitud.celular + '<br>' +
                        '<strong>Motivo:</strong> ' + solicitud.justificacion +
                        '</div>'
                    );

                    markersCluster.addLayer(marker);
                }
            });

            map.addLayer(markersCluster); // Volver a añadir el clúster filtrado
        });

        // Centrar el mapa en la ubicación del administrador
        document.getElementById('miUbicacionBtn').addEventListener('click', function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    map.setView([lat, lon], 12);
                }, function () {
                    alert("No se pudo obtener la ubicación.");
                });
            } else {
                alert("La geolocalización no está soportada en este navegador.");
            }
        });
    </script>

</body>

</html>
