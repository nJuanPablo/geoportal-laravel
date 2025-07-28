<!doctype html>
<html lang="en">
    <head>
        <title>Geovisor</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <link
            rel="stylesheet"
            href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""
        />

        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">


    </head>

    <body>
        <header>
            <nav class="navbar2 navbar-expand-lg bg-personalizadonav navbar-compact">
                    <div class="container-fluid d-flex align-items-center justify-content-between">

                        <div class="px-4">
                            <div class="dropdown">
                                <button class="btn btn-outline-light dropdown-toggle btn-sm" data-bs-toggle="dropdown">
                                Módulos
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/geovisor">Geovisor</a></li>
                                    <li><a class="dropdown-item" href="#">Tierras</a></li>
                                    <li><a class="dropdown-item" href="#">Minas</a></li>
                                    <li><a class="dropdown-item" href="#">Sistema de salud</a></li>
                                    <li><a class="dropdown-item" href="#">Mujer, familia y género</a></li>
                                </ul>
                            </div>
                        </div>
                    
                        <a href="/home" class="navbar-brand2 mx-auto text-white align-items-center mb-2 d-flex" style="font-size: 1.5rem; font-weight: bold; text-decoration: none;">
                            <i class="fas fa-globe " style="font-size: 1.5rem; font-weight: bold; "></i>    
                            <span class="ms-2">GeoPortal</span>
                        </a>

                        <div class="px-4">
                            <!-- Aquí puedes agregar otro botón o dejarlo vacío -->
                            <div class="dropdown">
                                <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-user"></i>
                                    <span class="ms-2">
                                        @auth
                                            {{ auth()->user()->name ?? auth()->user()->username }}
                                        @else
                                            Usuario
                                        @endauth
                                    </span>
                                </button>
                                <ul class="dropdown-menu">
                                    @auth   
                                        <li><a class="dropdown-item " href="/logout">Cerrar sesión</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="/login">Iniciar sesión</a></li>
                                        <li><a class="dropdown-item" href="/register">Registrarse</a></li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
            </nav>
        </header>
        <main>
            <div class="flex-grow-1 position-relative">
                <div id="map" style="width: 100%;"></div>
                    <div class="barra-geovisor">
                        <button class="btn btn-outline-light mb-3" id="btn-wfswms" data-bs-toggle="tooltip" title="Buscar capa WFS/WMS">
                            <i class="fas fa-search"></i>
                        </button>   
                            <!-- Panel WFS/WMS -->
                            <div id="panel-wfswms" class="panel-wfswms">
                                <!-- Tipo de servicio -->
                                <select id="tipo-servicio" class="form-select mb-2 text-center">
                                    <option value="wfs">WFS </option>
                                    <option value="wms">WMS </option>
                                </select>
                                <label for="url-capa" class="form-label text-white">🔗 URL del servicio WMS/WFS</label>
                                <input type="text" id="url-capa" class="form-control mb-3" placeholder="https://ejemplo.com/geoserver/wfs">
                                <!-- Nombre de la capa -->
                                <input type="text" id="nombre-capa" class="form-control mb-3" placeholder="Nombre personalizado">

                                <!-- Color de la capa -->
                                <input type="color" id="color-capa" class="form-control form-control-color mb-3" value="#00bfff" title="Color de la capa" style="display: block; margin: auto;">
                                
                                <!-- Botón para agregar capa -->
                                <button class="btn btn-success w-100 mb-3" id="agregar-capa">Agregar capa</button>

                                <!-- Spinner y mensaje -->
                                <div class="text-center" id="mensaje-carga" style="display: none;">
                                    <div class="spinner-border text-light mb-2" role="status"></div>
                                    <div class="text-white">Cargando capa, por favor espera...</div>
                                </div>
                            </div>
                            
                        <button class="btn btn-outline-light mb-3" id="btn-capas" data-bs-toggle="tooltip" title="Capas activas">
                            <i class="fas fa-layer-group"></i>
                        </button>

                            <!-- Panel de capas -->
                            <div id="panel-capas" class="bg-dark text-white p-3 rounded-start" style="position: absolute; top: 50%; left: 60px; transform: translateY(-50%); display: none; z-index: 1000; min-width: 300px;">
                                <h6 class="mb-3">Capas activas</h6>
                                <ul id="lista-capas" class="list-group list-group-flush bg-dark"></ul>
                            </div>                    

                        <!-- Boton para ubicar en el centro del mapa     -->
                        <button class="btn btn-outline-light mb-3" data-bs-toggle="tooltip" id="btn-ubicar" data-bs-placement="right"  title="Ubicar" >
                            <i class="fas fa-crosshairs"></i>
                        </button>

                        <!-- Botón mapa base -->
                        <button class="btn btn-outline-light mb-2" data-bs-toggle="tooltip" id="btn-mapa-base" title="Mapa base">
                            <i class="fa fa-map-o"></i>
                        </button>
                            <div id="menu-mapa-base" class="mapa-base">
                                <button class="btn btn-sm btn-light w-100 mb-1" onclick="cambiarMapa('calles')">Calles</button>
                                <button class="btn btn-sm btn-light w-100 mb-1" onclick="cambiarMapa('satelital')">Satelital</button>
                                <button class="btn btn-sm btn-light w-100 mb-1" onclick="cambiarMapa('relieve')">Relieve</button>
                                <button class="btn btn-sm btn-light w-100 mb-1" onclick="cambiarMapa('topografia')">Topografía</button>
                                <button class="btn btn-sm btn-light w-100 mb-1" onclick="cambiarMapa('humanitario')">Humanitario</button>
                                <button class="btn btn-sm btn-light w-100 mb-1" onclick="cambiarMapa('grises')">Tonos grises</button>
                                <button class="btn btn-sm btn-light w-100" onclick="cambiarMapa('nocturno')">Nocturno</button>

                            </div>

                    </div>

                    <!-- Panel derecho para atributos -->
                    <div id="panel-atributos" class="bg-light border p-3" style="position: absolute; top: 10px; right: 10px; width: 300px; max-height: 90vh; overflow-y: auto; display: none; z-index: 1000;">
                        <h6>Atributos de la selección</h6>
                        <div id="contenido-atributos"></div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin="">
        </script>

        <script src="https://kit.fontawesome.com/2839a934dd.js" crossorigin="anonymous"></script>

        <script>

            var map = L.map('map').setView([4.5709, -74.2973], 6); // Centro de Colombia
            L.control.scale({ position: 'bottomleft', imperial: false }).addTo(map);    

            // MAPA BASE
            document.getElementById("btn-mapa-base").addEventListener("click", () => {
                const menu = document.getElementById("menu-mapa-base");
                menu.style.display = menu.style.display === "none" ? "block" : "none";
            });

            // Calle (OpenStreetMap)
            const mapaCalles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
            });

            // Satelital (Esri)
            const mapaSatelital = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '© Esri & NASA'
            });

            // Relieve (Esri)
            const mapaRelieve = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Shaded_Relief/MapServer/tile/{z}/{y}/{x}', {
            attribution: '© Esri'
            });

            // Topografia
            const mapaTopografia = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenTopoMap'
            });

            // Humanitario
            const mapaHumanitario = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap HOT'
            });

            //Tonos grises
            const mapaGrises = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
            attribution: '© CartoDB Positron'
            });          

            // Añadir capas al mapa
            const mapaNocturno = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png', {
                attribution: '© CartoDB Dark'
            });

            // Agrega uno como inicial
            mapaCalles.addTo(map);

            // Función para cambiar
            function cambiarMapa(tipo) {
                map.eachLayer(layer => {
                    if (layer instanceof L.TileLayer) {
                    map.removeLayer(layer);
                    }
                });

                if (tipo === "calles") mapaCalles.addTo(map);
                if (tipo === "satelital") mapaSatelital.addTo(map);
                if (tipo === "relieve") mapaRelieve.addTo(map);
                if (tipo === "topografia") mapaTopografia.addTo(map);
                if (tipo === "humanitario") mapaHumanitario.addTo(map);
                if (tipo === "grises") mapaGrises.addTo(map);
                if (tipo === "nocturno") mapaNocturno.addTo(map);
                
                document.getElementById("menu-mapa-base").style.display = "none";
            }

        </script>

        <script>
            // Inicializar Tooltips Bootstrap
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (el) {
                return new bootstrap.Tooltip(el);
            });
            // Cerrar tooltips al hacer clic fuera
            document.addEventListener("click", function (e) {
                tooltipTriggerList.forEach(function (el) {
                    const tip = bootstrap.Tooltip.getInstance(el);
                    if (tip) tip.hide();
                });
            });
        </script>

        <script>
            const capasAgregadas = [];
            let entidadSeleccionada = null;


            // Mostrar/ocultar panel de WFS/WMS
            document.getElementById('btn-wfswms').addEventListener('click', () => {
                const panel = document.getElementById('panel-wfswms');
                panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
            });

            // Mostrar/ocultar panel de capas
            document.getElementById("btn-capas").addEventListener("click", () => {
                const panel = document.getElementById("panel-capas");
                panel.style.display = panel.style.display === "none" ? "block" : "none";
            });

            document.getElementById("tipo-servicio").addEventListener("change", function () {
                const colorCampo = document.getElementById("color-capa");
                const urlCampo = document.getElementById("url-capa");
                const nombreCampo = document.getElementById("nombre-capa");
                if (this.value === "wms") {
                    colorCampo.style.display = "none"; // Ocultar si es WMS
                    nombreCampo.placeholder = "Nombre de la capa"; // Actualizar placeholder
                } else {
                    colorCampo.style.display = "block"; // Mostrar si es WFS
                    colorCampo.value = "#00bfff"; // Restablecer color
                }
            });

            // Agregar capa desde URL WFS
            document.getElementById("agregar-capa").addEventListener("click", () => {
                const tipo = document.getElementById("tipo-servicio").value;
                const url = document.getElementById("url-capa").value.trim();
                const nombre = document.getElementById("nombre-capa").value.trim() || `Capa ${capasAgregadas.length + 1}`;
                const color = document.getElementById("color-capa").value || "#00bfff";

                const panel = document.getElementById("panel-wfswms");
                const boton = document.getElementById("agregar-capa");
                const spinner = document.getElementById("mensaje-carga");

                if (!url) {
                    alert("❗ Ingresa una URL válida");
                    return;
                }

                spinner.style.display = "block";
                boton.disabled = true;

                // Cargar WFS (GeoJSON)
                if (tipo === "wfs") {
                    fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        const nuevaCapa = L.geoJSON(data, {
                        style: () => ({ color }),
                        pointToLayer: (f, latlng) => L.circleMarker(latlng, {
                            radius: 6,
                            fillColor: color,
                            color: "#000",
                            weight: 1,
                            opacity: 1,
                            fillOpacity: 0.8
                        }),
                        onEachFeature: (feature, layer) => {
                            layer.on("click", () => {
                            mostrarAtributos(feature.properties);
                            map.flyToBounds(layer.getBounds(), {
                                duration: 1.5,
                                maxZoom: 16,
                                padding: [10, 10]
                            });
                            if (entidadSeleccionada) entidadSeleccionada.setStyle({ color: color, weight: 2 });
                            layer.setStyle({ color: "#ff6600", weight: 5 });
                            entidadSeleccionada = layer;
                            });
                        }
                        }).addTo(map);

                        agregarAlPanel(nombre, nuevaCapa, color);
                        finalizarCarga(panel, boton, spinner);
                    })
                    .catch(() => {
                        alert("⚠️ Error al cargar WFS. Verifica la URL y formato GeoJSON.");
                        finalizarCarga(panel, boton, spinner);
                    });
                }

                // Cargar WMS
                if (tipo === "wms") {
                    const capaWMS = L.tileLayer.wms(url, {
                    layers: nombre,           // Hay que tener en cuenta que debe coincidir con el nombre de la capa en el servidor
                    format: "image/png",
                    transparent: true,
                    attribution: "WMS"
                    }).addTo(map);

                    agregarAlPanel(nombre, capaWMS, color);
                    finalizarCarga(panel, boton, spinner);
                }
                });

                // Helpers
                function agregarAlPanel(nombre, capa, color) {
                capasAgregadas.push({ nombre, capa });
                const item = document.createElement("li");
                item.className = "list-group-item bg-dark text-white d-flex justify-content-between align-items-center";
                item.innerHTML = `<span style="color:${color};">${nombre}</span>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash-o"></i>
                                    </button>`;
                item.querySelector("button").addEventListener("click", () => {
                    map.removeLayer(capa);
                    item.remove();
                });
                document.getElementById("lista-capas").appendChild(item);
                }

                function finalizarCarga(panel, boton, spinner) {
                spinner.style.display = "none";
                boton.disabled = false;
                panel.style.display = "none";

                // Limpiar campos
                document.getElementById("url-capa").value = "";
                document.getElementById("nombre-capa").value = "";
            }

            function mostrarAtributos(properties) {
                const panel = document.getElementById("panel-atributos");
                const contenido = document.getElementById("contenido-atributos");

                // Construir HTML con los atributos
                contenido.innerHTML = Object.entries(properties).map(
                    ([key, val]) => `<strong>${key}:</strong> ${val}<br>`
                ).join("");

                panel.style.display = "block";
            }

            document.addEventListener("click", (event) => {
                const panelBuscar = document.getElementById("panel-wfswms");
                const panelCapas = document.getElementById("panel-capas");

                const btnBuscar = document.getElementById("btn-wfswms");
                const btnCapas = document.getElementById("btn-capas");

                const btnMapaBase = document.getElementById("btn-mapa-base");
                const menuMapaBase = document.getElementById("menu-mapa-base");

                const panel = document.getElementById("panel-atributos");


  
                // Verifica si el clic fue fuera de los paneles y botones relacionados
                if (
                    !panelBuscar.contains(event.target) &&
                    !btnBuscar.contains(event.target)
                ) {
                    panelBuscar.style.display = "none";
                }

                if (
                    !panelCapas.contains(event.target) &&
                    !btnCapas.contains(event.target)
                ) {
                    panelCapas.style.display = "none";
                }

                if (
                    !btnMapaBase.contains(event.target) &&
                    !menuMapaBase.contains(event.target)
                ) {
                    menuMapaBase.style.display = "none";
                }

                if (!panel.contains(event.target) && !event.target.closest(".leaflet-interactive")) {
                    panel.style.display = "none";
                }
            });

            document.getElementById("btn-ubicar").addEventListener("click", () => {
                // Opción A: Centrar con coordenadas y zoom
                map.setView([4.5709, -74.2973], 6); // 🇨🇴 Coordenadas centrales de Colombia
            });

            
        </script>    
    </body>
</html>
