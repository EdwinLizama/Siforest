
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Solicitud para Aprovechamiento Forestal</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/formulario.css') }}">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #303845;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                SIFOREST
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dashboard') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('solicitudes') }}">Solicitudes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-10 text-center text-green">
                <h1>FORMULARIO DE SOLICITUD PARA APROVECHAMIENTO FORESTAL</h1>
                <p class="font-weight-bold">DIRECCION GENERAL DE ORDENAMIENTO FORESTAL, CUENCAS Y RIEGO</p>
                <p class="font-weight-bold">DIVISION DE RECURSOS FORESTALES/AREA DE ADMINISTRACION FORESTAL</p>
                <p class="font-weight-bold">SOLICITUD DE AUTORIZACION PARA EL APROVECHAMIENTO DE ÁRBOLES</p>
            </div>
        </div>

        <form action="{{ route('formulario.store') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="expediente_r" class="col-sm-2 col-form-label">Nº Expediente:</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="expediente_r" name="expediente_r">
                </div>
                <label for="fecha_solicitud" class="col-sm-2 col-form-label">Formato SA-01</label>
            </div>

            <div class="form-group row">
                <label for="fecha_solicitud" class="col-sm-2 col-form-label">Fecha de solicitud:</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" required>
                </div>
            </div>

            <fieldset class="border p-2 mb-3 border-green">
                <legend class="w-auto legend-green">A. Datos generales del solicitante:</legend>
                <div class="form-group">
                    <label for="nombre">Nombre completo del propietario (a) o representante legal:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="nit">NIT:</label>
                        <input type="text" class="form-control" id="nit" name="nit">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dui">DUI:</label>
                        <input type="text" class="form-control" id="dui" name="dui" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="emitido_en">Emitido en:</label>
                        <input type="text" class="form-control" id="emitido_en" name="emitido_en">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_emision">con fecha:</label>
                        <input type="date" class="form-control" id="fecha_emision" name="fecha_emision">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="departamento_solicitante">Departamento:</label>
                        <select class="form-control" id="departamento_solicitante" name="departamento_solicitante" required>
                            <option value="">Seleccione un departamento</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento }}">{{ $departamento }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="municipio_solicitante">Municipio:</label>
                        <select class="form-control" id="municipio_solicitante" name="municipio_solicitante" disabled>
                            <option value="">Seleccione un municipio</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="canton">Cantón:</label>
                        <input type="text" class="form-control" id="canton" name="canton">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="caserio">Caserío:</label>
                        <input type="text" class="form-control" id="caserio" name="caserio">
                    </div>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección particular:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="telefono_fijo">Teléfono fijo:</label>
                        <input type="tel" class="form-control" id="telefono_fijo" name="telefono_fijo">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="celular">Celular:</label>
                        <input type="tel" class="form-control" id="celular" name="celular" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="correo">Correo electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                </div>
            </fieldset>

            <fieldset class="border p-2 mb-3 border-green">
                <legend class="w-auto legend-green">B. Detalle de árboles solicitados*:</legend>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="especie">Especie:</label>
                        <input type="text" class="form-control" id="especie" name="especie" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="total">Total:</label>
                        <input type="text" class="form-control" id="total" name="total" required>
                    </div>
                </div>
                <p>*Si son más especies, completar el siguiente cuadro.</p>
            </fieldset>

            <!-- Detalles adicionales -->
            <fieldset class="border p-2 mb-3 border-green">
                <legend class="w-auto legend-green">Detalle de árboles adicionales solicitados:</legend>
                <!-- Árbol adicional 1 -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="especie_adicional1">Especie:</label>
                        <input type="text" class="form-control" id="especie_adicional1" name="especie_adicional1">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cantidad_adicional1">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad_adicional1" name="cantidad_adicional1">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="total_adicional1">Total:</label>
                        <input type="text" class="form-control" id="total_adicional1" name="total_adicional1">
                    </div>
                </div>

                <!-- Árbol adicional 2 -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="especie_adicional2">Especie:</label>
                        <input type="text" class="form-control" id="especie_adicional2" name="especie_adicional2">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cantidad_adicional2">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad_adicional2" name="cantidad_adicional2">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="total_adicional2">Total:</label>
                        <input type="text" class="form-control" id="total_adicional2" name="total_adicional2">
                    </div>
                </div>

                <!-- Árbol adicional 3 -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="especie_adicional3">Especie:</label>
                        <input type="text" class="form-control" id="especie_adicional3" name="especie_adicional3">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cantidad_adicional3">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad_adicional3" name="cantidad_adicional3">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="total_adicional3">Total:</label>
                        <input type="text" class="form-control" id="total_adicional3" name="total_adicional3">
                    </div>
                </div>
            </fieldset>

            <fieldset class="border p-2 mb-3 border-green">
                <legend class="w-auto legend-green">C. Ubicación de la propiedad:</legend>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="departamento_propiedad">Departamento:</label>
                        <select class="form-control" id="departamento_propiedad" name="departamento_propiedad" required>
                            <option value="">Seleccione un departamento</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento }}">{{ $departamento }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="municipio_propiedad">Municipio:</label>
                        <select class="form-control" id="municipio_propiedad" name="municipio_propiedad" disabled>
                            <option value="">Seleccione un municipio</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="canton_prop">Cantón:</label>
                        <input type="text" class="form-control" id="canton_prop" name="canton_prop">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="caserio_prop">Caserío:</label>
                        <input type="text" class="form-control" id="caserio_prop" name="caserio_prop">
                    </div>
                </div>
                <div class="form-group">
                    <label for="acceso">Acceso:</label>
                    <input type="text" class="form-control" id="acceso" name="acceso">
                </div>
            </fieldset>

            <fieldset class="border p-2 mb-3 border-green">
                <legend class="w-auto legend-green">D. Justificación del aprovechamiento (marcar solamente una opción):
                </legend>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="justificacion1" name="justificacion"
                                value="planes_aprovechamiento">
                            <label class="form-check-label" for="justificacion1">
                                Formulación de planes de aprovechamiento en carbonales a productores de escasos recursos
                                económicos menores o iguales a 7.0 hectáreas (Art. 4 c) y Art. 8 LF y Art. 4 RLF
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="justificacion2" name="justificacion"
                                value="mantenimiento_raleo">
                            <label class="form-check-label" for="justificacion2">
                                Mantenimiento, raleo o aprovechamiento final de plantación forestal Art. 16
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="justificacion3" name="justificacion"
                                value="aprovechamiento_sistemas_agroforestales">
                            <label class="form-check-label" for="justificacion3">
                                Aprovechamiento de árboles en sistemas agroforestales Art. 16 y Art. 17 b
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="justificacion4" name="justificacion"
                                value="proteccion_saneamiento">
                            <label class="form-check-label" for="justificacion4">
                                Protección y saneamiento del bosque natural. Art. 10
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="justificacion5" name="justificacion"
                                value="aprovechamiento_cafetales">
                            <label class="form-check-label" for="justificacion5">
                                Aprovechamiento de árboles en cafetal. Art. 17 a
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="justificacion6" name="justificacion"
                                value="peligro_dano">
                            <label class="form-check-label" for="justificacion6">
                                Peligro y/o daño (Vidas, infraestructura)
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="justificacion7" name="justificacion"
                                value="arboles_danados">
                            <label class="form-check-label" for="justificacion7">
                                Árboles dañados o derribados por causas naturales. Art. 11
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="justificacion8" name="justificacion"
                                value="frutales_cultivos_permanentes">
                            <label class="form-check-label" for="justificacion8">
                                Aprovechamiento de árboles frutales y otros cultivos agrícolas permanentes Art. 17 b
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="justificacion9" name="justificacion"
                                value="aprovechamiento_areas_bosque">
                            <label class="form-check-label" for="justificacion9">
                                Aprovechamiento de árboles en áreas de bosque natural menores o iguales a 1ha Art. 12 RL
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="justificacion10" name="justificacion"
                                value="aprovechamiento_fuera_bosques">
                            <label class="form-check-label" for="justificacion10">
                                Aprovechamiento de árboles aislados con capacidad de rebrote Art. 17 b y c (Fuera de los
                                bosques naturales)
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-success">Enviar Solicitud</button>
        </form>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Detecta si hay un mensaje de éxito en la sesión
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Formulario enviado!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = "{{ route('user.dashboard') }}"; // Redirigir después de que se cierra el mensaje
        });
        @endif

        // Manejo de envío del formulario
        $('#formulario').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Enviando...',
                text: 'Tu solicitud está siendo procesada.',
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 2000
            }).then(() => {
                this.submit(); // Enviar el formulario después de mostrar el mensaje
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Para el primer conjunto de selects
            $('#departamento_solicitante').on('change', function() {
                var departamento = $(this).val();
                var municipios = [];

                // Agregar los municipios según el departamento seleccionado
                if (departamento === 'Ahuachapán') {
                    municipios = ['Ahuachapán', 'Apaneca', 'Atiquizaya', 'Concepción de Ataco',
                        'El Refugio', 'Guaymango', 'Jujutla', 'San Francisco Menéndez', 'San Lorenzo',
                        'San Pedro Puxtla', 'Tacuba', 'Turín'
                    ];
                } else if (departamento === 'Cabañas') {
                    municipios = ['Cinquera', 'Dolores', 'Guacotecti', 'Ilobasco', 'Jutiapa', 'San Isidro',
                        'Sensuntepeque', 'Tejutepeque', 'Victoria'
                    ];
                } else if (departamento === 'Chalatenango') {
                    municipios = ['Agua Caliente', 'Arcatao', 'Azacualpa', 'Chalatenango', 'Citalá',
                        'Comalapa', 'Concepción Quezaltepeque', 'Dulce Nombre de María', 'El Carrizal',
                        'El Paraíso', 'La Laguna', 'La Palma', 'La Reina', 'Las Vueltas',
                        'Nombre de Jesús', 'Nueva Concepción', 'Nueva Trinidad', 'Ojos de Agua',
                        'Potonico', 'San Antonio de la Cruz', 'San Antonio Los Ranchos', 'San Fernando',
                        'San Francisco Lempa', 'San Francisco Morazán', 'San Ignacio',
                        'San Isidro Labrador', 'San Luis del Carmen', 'San Miguel de Mercedes',
                        'San Rafael', 'Santa Rita', 'Tejutla'
                    ];
                } else if (departamento === 'Cuscatlán') {
                    municipios = ['Candelaria', 'Cojutepeque', 'El Carmen', 'El Rosario', 'Monte San Juan',
                        'Oratorio de Concepción', 'San Bartolomé Perulapía', 'San Cristóbal',
                        'San José Guayabal', 'San Pedro Perulapán', 'San Rafael Cedros', 'San Ramón',
                        'Santa Cruz Analquito', 'Santa Cruz Michapa', 'Suchitoto', 'Tenancingo'
                    ];
                } else if (departamento === 'La Libertad') {
                    municipios = ['Antiguo Cuscatlán', 'Chiltiupán', 'Ciudad Arce', 'Colón', 'Comasagua',
                        'Huizúcar', 'Jayaque', 'Jicalapa', 'La Libertad', 'Nueva San Salvador',
                        'San Juan Opico', 'Quezaltepeque', 'Sacacoyo', 'San José Villanueva',
                        'San Matías', 'San Pablo Tacachico', 'Talnique', 'Tamanique', 'Teotepeque',
                        'Tepecoyo', 'Zaragoza'
                    ];
                } else if (departamento === 'La Paz') {
                    municipios = ['Cuyultitán', 'El Rosario', 'Jerusalén', 'Mercedes La Ceiba', 'Olocuilta',
                        'Paraíso de Osorio', 'San Antonio Masahuat', 'San Emigdio',
                        'San Francisco Chinameca', 'San Pedro Masahuat', 'San Juan Nonualco',
                        'San Juan Talpa', 'San Juan Tepezontes', 'San Luis La Herradura',
                        'San Luis Talpa', 'San Miguel Tepezontes', 'San Pedro Nonualco',
                        'San Rafael Obrajuelo', 'Santa María Ostuma', 'Santiago Nonualco', 'Tapalhuaca',
                        'Zacatecoluca'
                    ];
                } else if (departamento === 'La Unión') {
                    municipios = ['Anamorós', 'Bolívar', 'Concepción de Oriente', 'Conchagua', 'El Carmen',
                        'El Sauce', 'Intipucá', 'La Unión', 'Lislique', 'Meanguera del Golfo',
                        'Nueva Esparta', 'Pasaquina', 'Polorós', 'San Alejo', 'San José',
                        'Santa Rosa de Lima', 'Yayantique', 'Yucuaiquín'
                    ];
                } else if (departamento === 'Morazán') {
                    municipios = ['Arambala', 'Cacaopera', 'Chilanga', 'Corinto', 'Delicias de Concepción',
                        'El Divisadero', 'El Rosario', 'Gualococti', 'Guatajiagua', 'Joateca',
                        'Jocoaitique', 'Jocoro', 'Lolotiquillo', 'Meanguera', 'Osicala', 'Perquín',
                        'San Carlos', 'San Fernando', 'San Francisco Gotera', 'San Isidro', 'San Simón',
                        'Sensembra', 'Sociedad', 'Torola', 'Yamabal', 'Yoloaiquín'
                    ];
                } else if (departamento === 'San Miguel') {
                    municipios = ['Carolina', 'Chapeltique', 'Chinameca', 'Chirilagua', 'Ciudad Barrios',
                        'Comacarán', 'El Tránsito', 'Lolotique', 'Moncagua', 'Nueva Guadalupe',
                        'Nuevo Edén de San Juan', 'Quelepa', 'San Antonio', 'San Gerardo', 'San Jorge',
                        'San Luis de la Reina', 'San Miguel', 'San Rafael Oriente', 'Sesori', 'Uluazapa'
                    ];
                } else if (departamento === 'San Salvador') {
                    municipios = ['Aguilares', 'Apopa', 'Ayutuxtepeque', 'Cuscatancingo', 'Delgado',
                        'El Paisnal', 'Guazapa', 'Ilopango', 'Mejicanos', 'Nejapa', 'Panchimalco',
                        'Rosario de Mora', 'San Marcos', 'San Martín', 'San Salvador',
                        'Santiago Texacuangos', 'Santo Tomás', 'Soyapango', 'Tonacatepeque'
                    ];
                } else if (departamento === 'San Vicente') {
                    municipios = ['Apastepeque', 'Guadalupe', 'San Cayetano Istepeque',
                        'San Esteban Catarina', 'San Ildefonso', 'San Lorenzo', 'San Sebastián',
                        'San Vicente', 'Santa Clara', 'Santo Domingo', 'Tecoluca', 'Tepetitán',
                        'Verapaz'
                    ];
                } else if (departamento === 'Santa Ana') {
                    municipios = ['Candelaria de la Frontera', 'Chalchuapa', 'Coatepeque', 'El Congo',
                        'El Porvenir', 'Masahuat', 'Metapán', 'San Antonio Pajonal',
                        'San Sebastián Salitrillo', 'Santa Ana', 'Santa Rosa Guachipilín',
                        'Santiago de la Frontera', 'Texistepeque'
                    ];
                } else if (departamento === 'Sonsonate') {
                    municipios = ['Acajutla', 'Armenia', 'Caluco', 'Cuisnahuat', 'Izalco', 'Juayúa',
                        'Nahuizalco', 'Nahulingo', 'Salcoatitán', 'San Antonio del Monte', 'San Julián',
                        'Santa Catarina Masahuat', 'Santa Isabel Ishuatán', 'Santo Domingo de Guzmán',
                        'Sonsonate', 'Sonzacate'
                    ];
                } else if (departamento === 'Usulután') {
                    municipios = ['Alegría', 'Berlín', 'California', 'Concepción Batres', 'El Triunfo',
                        'Ereguayquín', 'Estanzuelas', 'Jiquilisco', 'Jucuapa', 'Jucuarán',
                        'Mercedes Umaña', 'Nueva Granada', 'Ozatlán', 'Puerto El Triunfo',
                        'San Agustín', 'San Buenaventura', 'San Dionisio', 'San Francisco Javier',
                        'Santa Elena', 'Santa María', 'Santiago de María', 'Tecapán', 'Usulután'
                    ];
                }

                $('#municipio_solicitante').empty().prop('disabled', false);
                municipios.forEach(function(municipio) {
                    $('#municipio_solicitante').append(new Option(municipio, municipio));
                });
            });

            // Para el segundo conjunto de selects
            $('#departamento_propiedad').on('change', function() {
                var departamento = $(this).val();
                var municipios = [];

                // Agregar los municipios según el departamento seleccionado
                if (departamento === 'Ahuachapán') {
                    municipios = ['Ahuachapán', 'Apaneca', 'Atiquizaya', 'Concepción de Ataco',
                        'El Refugio', 'Guaymango', 'Jujutla', 'San Francisco Menéndez', 'San Lorenzo',
                        'San Pedro Puxtla', 'Tacuba', 'Turín'
                    ];
                } else if (departamento === 'Cabañas') {
                    municipios = ['Cinquera', 'Dolores', 'Guacotecti', 'Ilobasco', 'Jutiapa', 'San Isidro',
                        'Sensuntepeque', 'Tejutepeque', 'Victoria'
                    ];
                } else if (departamento === 'Chalatenango') {
                    municipios = ['Agua Caliente', 'Arcatao', 'Azacualpa', 'Chalatenango', 'Citalá',
                        'Comalapa', 'Concepción Quezaltepeque', 'Dulce Nombre de María', 'El Carrizal',
                        'El Paraíso', 'La Laguna', 'La Palma', 'La Reina', 'Las Vueltas',
                        'Nombre de Jesús', 'Nueva Concepción', 'Nueva Trinidad', 'Ojos de Agua',
                        'Potonico', 'San Antonio de la Cruz', 'San Antonio Los Ranchos', 'San Fernando',
                        'San Francisco Lempa', 'San Francisco Morazán', 'San Ignacio',
                        'San Isidro Labrador', 'San Luis del Carmen', 'San Miguel de Mercedes',
                        'San Rafael', 'Santa Rita', 'Tejutla'
                    ];
                } else if (departamento === 'Cuscatlán') {
                    municipios = ['Candelaria', 'Cojutepeque', 'El Carmen', 'El Rosario', 'Monte San Juan',
                        'Oratorio de Concepción', 'San Bartolomé Perulapía', 'San Cristóbal',
                        'San José Guayabal', 'San Pedro Perulapán', 'San Rafael Cedros', 'San Ramón',
                        'Santa Cruz Analquito', 'Santa Cruz Michapa', 'Suchitoto', 'Tenancingo'
                    ];
                } else if (departamento === 'La Libertad') {
                    municipios = ['Antiguo Cuscatlán', 'Chiltiupán', 'Ciudad Arce', 'Colón', 'Comasagua',
                        'Huizúcar', 'Jayaque', 'Jicalapa', 'La Libertad', 'Nueva San Salvador',
                        'San Juan Opico', 'Quezaltepeque', 'Sacacoyo', 'San José Villanueva',
                        'San Matías', 'San Pablo Tacachico', 'Talnique', 'Tamanique', 'Teotepeque',
                        'Tepecoyo', 'Zaragoza'
                    ];
                } else if (departamento === 'La Paz') {
                    municipios = ['Cuyultitán', 'El Rosario', 'Jerusalén', 'Mercedes La Ceiba', 'Olocuilta',
                        'Paraíso de Osorio', 'San Antonio Masahuat', 'San Emigdio',
                        'San Francisco Chinameca', 'San Pedro Masahuat', 'San Juan Nonualco',
                        'San Juan Talpa', 'San Juan Tepezontes', 'San Luis La Herradura',
                        'San Luis Talpa', 'San Miguel Tepezontes', 'San Pedro Nonualco',
                        'San Rafael Obrajuelo', 'Santa María Ostuma', 'Santiago Nonualco', 'Tapalhuaca',
                        'Zacatecoluca'
                    ];
                } else if (departamento === 'La Unión') {
                    municipios = ['Anamorós', 'Bolívar', 'Concepción de Oriente', 'Conchagua', 'El Carmen',
                        'El Sauce', 'Intipucá', 'La Unión', 'Lislique', 'Meanguera del Golfo',
                        'Nueva Esparta', 'Pasaquina', 'Polorós', 'San Alejo', 'San José',
                        'Santa Rosa de Lima', 'Yayantique', 'Yucuaiquín'
                    ];
                } else if (departamento === 'Morazán') {
                    municipios = ['Arambala', 'Cacaopera', 'Chilanga', 'Corinto', 'Delicias de Concepción',
                        'El Divisadero', 'El Rosario', 'Gualococti', 'Guatajiagua', 'Joateca',
                        'Jocoaitique', 'Jocoro', 'Lolotiquillo', 'Meanguera', 'Osicala', 'Perquín',
                        'San Carlos', 'San Fernando', 'San Francisco Gotera', 'San Isidro', 'San Simón',
                        'Sensembra', 'Sociedad', 'Torola', 'Yamabal', 'Yoloaiquín'
                    ];
                } else if (departamento === 'San Miguel') {
                    municipios = ['Carolina', 'Chapeltique', 'Chinameca', 'Chirilagua', 'Ciudad Barrios',
                        'Comacarán', 'El Tránsito', 'Lolotique', 'Moncagua', 'Nueva Guadalupe',
                        'Nuevo Edén de San Juan', 'Quelepa', 'San Antonio', 'San Gerardo', 'San Jorge',
                        'San Luis de la Reina', 'San Miguel', 'San Rafael Oriente', 'Sesori', 'Uluazapa'
                    ];
                } else if (departamento === 'San Salvador') {
                    municipios = ['Aguilares', 'Apopa', 'Ayutuxtepeque', 'Cuscatancingo', 'Delgado',
                        'El Paisnal', 'Guazapa', 'Ilopango', 'Mejicanos', 'Nejapa', 'Panchimalco',
                        'Rosario de Mora', 'San Marcos', 'San Martín', 'San Salvador',
                        'Santiago Texacuangos', 'Santo Tomás', 'Soyapango', 'Tonacatepeque'
                    ];
                } else if (departamento === 'San Vicente') {
                    municipios = ['Apastepeque', 'Guadalupe', 'San Cayetano Istepeque',
                        'San Esteban Catarina', 'San Ildefonso', 'San Lorenzo', 'San Sebastián',
                        'San Vicente', 'Santa Clara', 'Santo Domingo', 'Tecoluca', 'Tepetitán',
                        'Verapaz'
                    ];
                } else if (departamento === 'Santa Ana') {
                    municipios = ['Candelaria de la Frontera', 'Chalchuapa', 'Coatepeque', 'El Congo',
                        'El Porvenir', 'Masahuat', 'Metapán', 'San Antonio Pajonal',
                        'San Sebastián Salitrillo', 'Santa Ana', 'Santa Rosa Guachipilín',
                        'Santiago de la Frontera', 'Texistepeque'
                    ];
                } else if (departamento === 'Sonsonate') {
                    municipios = ['Acajutla', 'Armenia', 'Caluco', 'Cuisnahuat', 'Izalco', 'Juayúa',
                        'Nahuizalco', 'Nahulingo', 'Salcoatitán', 'San Antonio del Monte', 'San Julián',
                        'Santa Catarina Masahuat', 'Santa Isabel Ishuatán', 'Santo Domingo de Guzmán',
                        'Sonsonate', 'Sonzacate'
                    ];
                } else if (departamento === 'Usulután') {
                    municipios = ['Alegría', 'Berlín', 'California', 'Concepción Batres', 'El Triunfo',
                        'Ereguayquín', 'Estanzuelas', 'Jiquilisco', 'Jucuapa', 'Jucuarán',
                        'Mercedes Umaña', 'Nueva Granada', 'Ozatlán', 'Puerto El Triunfo',
                        'San Agustín', 'San Buenaventura', 'San Dionisio', 'San Francisco Javier',
                        'Santa Elena', 'Santa María', 'Santiago de María', 'Tecapán', 'Usulután'
                    ];
                }

                $('#municipio_propiedad').empty().prop('disabled', false);
                municipios.forEach(function(municipio) {
                    $('#municipio_propiedad').append(new Option(municipio, municipio));
                });
            });
        });
    </script>
</body>

</html>
