let locationsContainer = $('.locations-container');
let locationContainer = $('.location-container');
$('#kt_docs_repeater_basic').repeater({
    initEmpty: false,

    show: function () {
        $(this).find('input').val('');
        $(this).slideDown();
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});


// Elements
let mapContainer = $('.leaflet-container');
let dataRepeaterItemDivEl = $('[data-repeater-item]');
let colorInputEl = $('[name="border_color"]');

let clearCoordinatesBtnEl = $('#clear-coordinates')


// Map needs
let adas = {
    "type": "FeatureCollection",
    "features": [
        {
            "type": "Feature",
            "properties": {
                "name": "ADA Martil",
                "color": "#3475ff",
            },
            "geometry": {
                "coordinates": [],
                "type": "LineString"
            }
        },
    ]
};
let clickable = false;
let selectCoordinates = false;
let selectedCoordinate = '';
let map;
let geoJson;


init();

function init() {
    map = L.map('map').setView([35.62089741265507, -5.283973376971679], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 7,
        maxZoom: 20,
    }).addTo(map);
    mapIncludes();
    fillGeoJsonIfDataExists();
    addGeoJson();
    addLocationButton();
    addSelectCoordinatesButton();
    mapEvents();

}

function fillGeoJsonIfDataExists() {
    $('[data-repeater-item]').each(function () {
        if ($(this).find('.location-latitude').val() &&
            $(this).find('.location-longitude').val()) {
            adas.features[0].geometry.coordinates.push([
                $(this).find('.location-latitude').val(),
                $(this).find('.location-longitude').val(),
            ]);
        }
    });
    scrollToLocationsBottom();
}

function mapIncludes() {
    L.Map.include({
        getMarkerById: function (id) {
            let marker = null;
            this.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    if (layer.options.id == id) {
                        marker = layer;
                    }
                }
            });
            return marker;
        },
        removeLayerById(id) {
            console.log(id)
        },
        highlightFeature(e) {
            const layer = e.target;
            layer.setStyle({
                weight: 2,
            });
            layer.bringToFront();
        },
        resetHighlight(e) {
            geoJson.resetStyle(e.target);

        },
        zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        },
        style() {
            return {
                weight: 1,
                opacity: 1,
                color: colorInputEl.val(),
                dashArray: '2',
            };
        },

    });

}

{
    $('[data-repeater-item]').each(function () {
        if ($(this).find('.location-latitude').val() &&
            $(this).find('.location-longitude').val()) {
            adas.features[0].geometry.coordinates.push([
                $(this).find('.location-latitude').val(),
                $(this).find('.location-longitude').val(),
            ]);
        }
    });
    scrollToLocationsBottom();
}

function addGeoJson() {
    if (geoJson instanceof L.geoJson) {
        geoJson.clearLayers()
    }
    geoJson = L.geoJson(adas, {
        style: map.style(),
        onEachFeature
    }).addTo(map);
}


function addLocationButton() {

    L.Control.Button = L.Control.extend({
        options: {
            position: 'topleft'
        },
        onAdd: function (map) {

            var container = L.DomUtil.create('div', ' leaflet-bar leaflet-control');
            var button = L.DomUtil.create('a', 'd-flex justify-content-center align-items-center leaflet-control-button', container);
            $(button).append(`<i class="fa-solid fa-location-dot text-dark"></i> `);
            L.DomEvent.disableClickPropagation(button);
            L.DomEvent.on(button, 'click', function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        L.marker([latitude, longitude]).addTo(map);
                        map.flyTo([latitude, longitude]);
                    });
                } else {
                    console.log("Geolocation is not supported by this browser.");
                }
            });


            container.title = "Title";
            return container;
        },
        onRemove: function (map) {
        },
    });
    var control = new L.Control.Button()
    control.addTo(map);

}

function addSelectCoordinatesButton() {

    L.Control.Button = L.Control.extend({
        options: {
            position: 'topleft'
        },
        onAdd: function (map) {
            let container = L.DomUtil.create('div', ' leaflet-bar leaflet-control');

            let herfLinkBtnEl = L.DomUtil.create('a', 'select-coordinates d-flex justify-content-center align-items-center leaflet-control-button', container);

            $(herfLinkBtnEl).append(`<i class="fa-solid fa-hand-point-up text-dark"></i>`);
            $(herfLinkBtnEl).attr("data-select", "off");
            L.DomEvent.disableClickPropagation(herfLinkBtnEl);
            L.DomEvent.on(herfLinkBtnEl, 'click', function (e) {

                let selectCoordinatesBtnEl = $('.select-coordinates');
                let iconEl = selectCoordinatesBtnEl.find('i');
                if (selectCoordinatesBtnEl.attr("data-select") === "on") {
                    selectCoordinates = false;
                    clickable = false;
                    selectCoordinatesBtnEl.attr('data-select', "off");
                    selectCoordinatesBtnEl.removeClass('bg-primary');
                    iconEl.removeClass("text-white")
                    getMapContainerDivEl().removeClass("cursor-default")
                    getMapContainerDivEl().addClass("cursor-grab")

                } else {
                    clickable = true;
                    selectCoordinates = true;
                    selectCoordinatesBtnEl.attr('data-select', "on");
                    selectCoordinatesBtnEl.addClass('bg-primary');
                    iconEl.addClass("text-white")
                    getMapContainerDivEl().removeClass("cursor-grab")
                    getMapContainerDivEl().addClass("cursor-default")
                }
            });
            container.title = "Title";
            return container;
        },
        onRemove: function (map) {
        },
    });
    var control = new L.Control.Button()
    control.addTo(map);

}

function mapEvents() {

    map.on('click', function (e) {


        if ( $('[name="auto-select-locations"]').filter(":checked").val() == true  && clickable && selectCoordinates) {
            let coord = e.latlng;
            let lat = coord.lat;
            let lng = coord.lng;
            let id = idFormat(lat, lng);

            let marker = L.marker([lat, lng], {
                icon: icon(id),
                id: id,
            }).addTo(map);

            addSelectedCoordinatesArray(id)
            $('.location-longitude').last().val(lat);
            $('.location-latitude').last().val(lng);
            marker.on('mouseover', function (ev) {
            });


            locationsContainer.append(
                $('.location-container').first().clone()
            );


            $('.location-container').last().find('input').each(function () {
                $(this).val('');
            });

            fillGeoJsonIfDataExists();
            removeDuplicated();
            addGeoJson();


        }


    });


    $(document).on('click', ".remove-marker", function () {
        let marker = map.getMarkerById($(this).attr('data-marker-id'));
        if (marker instanceof L.Marker) {
            map.removeLayer(marker);
        }
        selectedCoordinate = null;
        clickable = true;
    });
    $(document).on('mouseenter', ".custom-div-icon_parent", function () {
        clickable = false;
    });
    $(document).on('mouseleave', ".custom-div-icon_parent", function () {
        clickable = true;
    });
    $('[data-repeater-create]').on('click', function () {
        scrollToLocationsBottom();
    });
    colorInputEl.on('change', function () {
        addGeoJson();
    });
    $(document).on('click', '.add-location', function () {
        let parent = $(this).closest('[data-repeater-item]');
        adas.features[0].geometry.coordinates.push([
            parent.find('.location-latitude').val(),
            parent.find('.location-longitude').val()
        ]);
        removeDuplicated(adas.features[0].geometry.coordinates);
        console.log()
        addGeoJson();
        map.flyTo([parent.find('.location-longitude').val(), parent.find('.location-latitude').val()], 15);
    });
    $(document).on('click', '.remove-location', function () {
        let parent = $(this).closest('[data-repeater-item]');
        if (
            parent.find('.location-latitude').val() &&
            parent.find('.location-longitude').val()) {
            let data = adas.features[0].geometry.coordinates.filter(function (location) {
                return location[0] != parent.find('.location-latitude').val() && location[1] != parent.find('.location-longitude').val();
            });
            adas.features[0].geometry.coordinates = data;
            addGeoJson();
        }
    });
    $('#save-coordinates').on('click', function (e) {
        e.preventDefault();
        let data = [];
        $('[data-repeater-item]').each(function () {
            if ($(this).find('.location-latitude').val() &&
                $(this).find('.location-longitude').val()) {
                data.push([
                    $(this).find('.location-latitude').val(),
                    $(this).find('.location-longitude').val(),

                ]);
            }

        });


        axios.post($('#route').val(), {
            'locatioable-id': $('#locatioable-id').val(),
            'color': colorInputEl.val(),
            'data': data,
        })
            .then(function ({data}) {

                Swal.fire({
                    text: data.alert.text,
                    title: data.alert.title,
                    icon: data.alert.icon,
                    buttonsStyling: false,
                    confirmButtonText: Lang.get('app.done'),
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            })
            .catch(function (error) {
                console.log(error)
            });
    });
    clearCoordinatesBtnEl.on('click', function () {
        if (locationContainer.length) {
            Swal.fire({
                title: Lang.get('messages.sure_message'),
                text: Lang.get('messages.confirm_delete_message'),
                icon: 'warning',
                cancelButtonText: Lang.get('app.close'),
                showCancelButton: true,
                confirmButtonText: Lang.get('app.confirm'),
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: 'btn btn-primary'
                }
            })
                .then(function (result) {
                    if (result.value) {
                        geoJson.clearLayers();
                        locationContainer.remove();
                    }
                });
        }
    });
    $('#preview-coordinates').on('click', function () {

        fillGeoJsonIfDataExists();
        removeDuplicated();
        addGeoJson();


    });


}


function onEachFeature(feature, layer) {
    layer.on({
        mouseover: map.highlightFeature,
        mouseout: map.resetHighlight,
        click: map.zoomToFeature
    });
}


function icon(id) {
    return L.divIcon({
        className: 'custom-div-icon',
        html: `
             <div class="position-relative custom-div-icon_parent" >
                 <i style="font-size: 30px;" class="text-dark fa-solid fa-location-dot"></i>
                <div class="position-absolute custom-div-icon_parent-son " style="top: -46px;right: -22%">
                        <a href="javascript:;" data-marker-id="${id}" class="remove-marker btn btn-sm btn-light-danger mt-3 mt-md-8">
                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span
                                    class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                        </a>
               </div>
            </div>
        `,
        iconSize: [30, 42],
        iconAnchor: [15, 42]
    });
}

function addSelectedCoordinatesArray(id) {
    if (selectedCoordinate !== "") {
        let marker = map.getMarkerById(selectedCoordinate);
        if (marker instanceof L.Marker) {
            map.removeLayer(marker);
        }
    }
    selectedCoordinate = id;
}


// Check if map container exists and return it if exists , if not try to find it
function getMapContainerDivEl() {
    if (!mapContainer.length) {
        mapContainer = $('.leaflet-container');
    }
    return mapContainer;
}

function idFormat(lat, lng) {
    return `${lat} ${lng}`;
}


function scrollToLocationsBottom() {
    let scrol = $('.kt_scroll_change_pos');
    setTimeout(() => {
        scrol.get(0).scrollTop = parseInt(scrol.get(0).scrollHeight);
    }, 400);
}

function removeDuplicated() {
    adas.features[0].geometry.coordinates = Array.from(new Set(adas.features[0].geometry.coordinates.map(JSON.stringify)), JSON.parse);
}


