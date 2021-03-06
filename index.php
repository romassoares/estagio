<html>

<head>
    <meta charset="UTF-8">
    <title> Mapa </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <style type="text/css">
        .mapid {
            height: 400px;
            border: 2px solid;
        }
    </style>
    <script type="text/javascript" src="municipios.js"></script>
    <script>

        async function cidade(id) {
            const local = await fetch('https://llcb.opendatabr.org/api/' + id);
            const localJson = await local.json();
            la = 51.505;
            lo = -0.09;
        };

        function formatMoney(params) {
            return new Intl.NumberFormat('pt-BR').format(params);

        }

        // async function getCidade() {
        //     const dados = await fetch('https://servicodados.ibge.gov.br/api/v1/localidades/microrregioes/22005/distritos');
        //     const dadosJson = await dados.json();
        //     const select = document.getElementById('cities');
        //     dadosJson.forEach(element => {
        //         const option = document.createElement('option');
        //         option.value = element.id;
        //         option.setAttribute('onClick', cidade(element.id));
        //         option.innerHTML = element.nome;
        //         select.appendChild(option);
        //     });
        // }
        function latiLong() {
            return [51.505, -0.09];
        }
        function ponteiro(params) {
            return [51.5, -0.09];
        }
        // setInterval(() => {
        //     if (mymap) {
        //         const select = document.getElementById('cities');
        //         if (select) {
        //             const value = select.options[select.selectedIndex].value;
        //             cidade(value);
        //         }
        //         clearInterval()
        //     }
        // }, 1000);

        // getPrefeitura();

    </script>


    <script type="text/javascript" src="./geojson/piaui.js"></script>
</head>

<body>
    <div class="text-center m-0">
        <h1 class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.2)">Médio Parnaíba Transparente</h1>
    </div>
    <div class="container">
        <div class="row">
            <div id="mapid" class="mapid"></div>
        </div>
        <div class="row">
            <div class="container-md">
                <br />
                <p>Essa página foi criada com o intuito de disponibilizar informações relevantes para a sociedade,
                    sendo
                    de fácil compreensão e acesso para a sociedade interessada.</p>
            </div>
            <div class="row">
                <h3>Alguns dos links de API utilizadas:</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">http://sistemas.tce.pi.gov.br/api/portaldacidadania/prefeituras</li>
                    <li class="list-group-item">http://sistemas.tce.pi.gov.br/api/portaldacidadania/despesas/</li>
                    <li class="list-group-item">
                        https://servicodados.ibge.gov.br/api/v1/localidades/microrregioes/22005/distritos</li>
                </ul>
            </div>
            <div class="row pt-4">
                <h3> Como fazer: </h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">criar um arquivo HTML;</li>
                    <li class="list-group-item">carregar um modelo de mapa:
                        https://leafletjs.com/reference-1.7.1.html#map-option
                    </li>
                    <li class="list-group-item">escolher região para ser carregada inicialmente e fixar essas
                        coordenadas no código do mapa;</li>
                    <li class="list-group-item">
                        marcar pontos ou delimitar regiões com coordenadas geográficas utilizando uma linguagem de
                        programção. Ex.: javascript;
                    </li>
                    <li class="list-group-item">
                        pegar um Jsom() com as coordenadas das cidades que voçê quer exibir com as fronteiras
                        demarcadas;
                    </li>
                    <li class="list-group-item">criar funções com uma linguagem de programação para “pegar” as
                        informações das API’s;</li>
                    <li class="list-group-item">carregar as informações que voçê quer exibir das API's no mapa.</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2020 Copyright:
        <a class="text-dark" href="#">Sociedade</a>
    </div>
</body>
<script>
    var mymap = L.map('mapid').setView([-6.088600, -42.737638], 8.3);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        tileLayer: null,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoicm9tYXJpb3NvYXJlcyIsImEiOiJja2sydGMxYjIwZTNiMnBudW83MmpsZnp5In0.OgY6SxTiUBOLyJlisOB6Cw'
    }).addTo(mymap);


    async function getDespesas() {

        async function getDespesaMunicipio(id_ibge) {

            const id = Object.values(municipios).filter(municipio => {
                return municipio.id_ibge === id_ibge;
            })[0].id;

            const response = await fetch(`https://sistemas.tce.pi.gov.br/api/portaldacidadania/despesas/${id}/2020/porFuncao`);

            const despesas = await response.json();

            return `
                <b>${despesas[0].funcao}</b>: R$ ` + formatMoney(despesas[0].paga) + `<br/>
                <b>${despesas[1].funcao}</b>: R$ ` + formatMoney(despesas[1].paga) + `<br/>
                <b>${despesas[2].funcao}</b>: R$ ` + formatMoney(despesas[2].paga) + `<br/>
                <b>${despesas[3].funcao}</b>: R$ ` + formatMoney(despesas[3].paga) + `<br/>
            `;
        }

        async function onEachFeature(feature, layer) {
            const despesa = await getDespesaMunicipio(feature.properties.id);
            layer.bindPopup(`<b>${feature.properties.name}</b>
            <hr/>
            ${despesa}
            `);
        }

        L.geoJSON(fronteiras, {
            onEachFeature: onEachFeature,
        }).addTo(mymap);

    };

    getDespesas();


    // marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
    // circle.bindPopup("I am a circle.");
    // polygon.bindPopup("I am a polygon.");
</script>

</html>