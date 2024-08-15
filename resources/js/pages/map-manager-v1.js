let locationsContainerEl = $('.locations-container');
let scrollDivEl = locationsContainerEl.closest('.scroll');
let locationContainerGroupEl = $('.locations-group');
let locationGroupAdd = $('#locations-group-add');
let mapContainer = $('.leaflet-container');
let adas = {
    "type": "FeatureCollection",
    "features": []
};
let mapClickable = false;
let mapSelectAble = false;
let geoJson;
let infosMarkers;
let flyToZoom = 14;
let geometryType = $('.geo-type.active').attr('data-map--geo-type');


checkGeometryType();

function checkGeometryType() {
    let geometryTypeInputEl = $('[name=locations-group__background-color]');
    if (geometryType != 'Polygon') {
        geometryTypeInputEl.hide()
    } else {
        geometryTypeInputEl.show()
    }
}

initMap();

function initMap() {

    $('.locations-group').each(function () {

        let item = {
            "type": "Feature",
            "properties": {
                "name": "",
                "id": $(this).attr('data-map-group-id'),
                "color": $(this).find('.locations-group__color').val(),
                "backgroundColor": $(this).find('[name=locations-group__background-color]').val(),
            },
            "geometry": {
                "coordinates": [],
                "type": geometryType
            }
        }
        let x = [];
        $(this).find('.location-container').each(function () {
            if (
                $(this).find('.location-latitude').val().trim(),
                    $(this).find('.location-longitude').val().trim()
            ) {
                x.push([
                    parseFloat($(this).find('.location-latitude').val().trim()),
                    parseFloat($(this).find('.location-longitude').val().trim())
                ])
            }

        });
        item.geometry.coordinates.push(x);
        adas.features.push(item);
    });
    map = L.map('map').setView([35.62089741265507, -5.283973376971679], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 7,
        maxZoom: 20,
    }).addTo(map);

    console.log(adas)

    setInterval(function () {
        map.invalidateSize();
    }, 100);
    geoJson = L.geoJson(adas, {
        style,
        onEachFeature
    }).addTo(map);
};
addLocationButton();
addSelectCoordinatesButton();
mapEvents();

function mapEvents() {

    map.on('click', function (e) {
        let coord = e.latlng;
        let lat = coord.lat;
        let lng = coord.lng;
        $('[name="locations-group_check"]').each(function () {
            if ($(this).is(':checked')) {

                if (mapClickable && mapSelectAble) {
                    let clone = $(this).closest('.locations-group').find('.location-container').last();


                    if (clone.find('.location-longitude').val() || clone.find('.location-latitude ').val()) {
                        clone = clone.clone(true);
                    }


                    clone.find('input').val('');
                    clone.addClass('bg-gray-500 bg-opacity-25');
                    $(this).closest('.locations-group').append(
                        clone
                    );
                    setTimeout(() => {
                        clone.removeClass('bg-gray-500 bg-opacity-25')
                    }, 2000);


                    scrollDivEl.scrollTop(scrollDivEl.scrollTop() + clone.position().top);


                    // clone.get(0).scrollIntoView();

                    clone.find('.location-longitude').val(lat);
                    clone.find('.location-latitude ').val(lng);

                    let id = idFormat(lat, lng);
                    let marker = L.marker([lat, lng], {
                        icon: icon(id),
                        id: lat,
                        keyboard: false,
                        title: 'riseOnHover',
                        shadowPane: 'shadowPane',
                        riseOnHover: false,
                        bubblingMouseEvents: false,
                        autoPanOnFocus: false,
                    }).addTo(map);


                    let featureFounded = adas.features.some(feature => {

                        if (feature.properties.id == $(this).closest('.locations-group').attr('data-map-group-id')) {

                            if (isIterable(feature.geometry.coordinates[0])) {
                                feature.geometry.coordinates[0].push([
                                    lng, lat
                                ]);
                            } else {
                                feature.geometry.coordinates.push([[
                                    lng, lat
                                ]]);
                            }

                            if (geoJson instanceof L.geoJson) {
                                geoJson.clearLayers()
                            }
                            geoJson = L.geoJson(adas, {
                                style
                            }).addTo(map);
                            if (isIterable(feature.properties.markers)) {
                                feature.properties.markers.push(marker);
                            } else {
                                feature.properties.markers = [];
                                feature.properties.markers.push(marker);
                            }
                            return true;
                        }
                    });
                    if (!featureFounded) {

                        console.log($(this).closest('.locations-group').find('.locations-group__color').val())
                        let item = {
                            "type": "Feature",
                            "properties": {
                                "name": "",
                                "id": $(this).closest('.locations-group').attr('data-map-group-id'),
                                "color": $(this).closest('.locations-group').find('.locations-group__color').val(),
                            },
                            "geometry": {
                                "coordinates": [],
                                "type": geometryType
                            }
                        }
                        item.geometry.coordinates.push([[
                            lng, lat
                        ]]);
                        item.properties.markers = [];
                        item.properties.markers.push(marker);


                        adas.features.push(item);
                        if (geoJson instanceof L.geoJson) {
                            geoJson.clearLayers()
                        }
                        geoJson = L.geoJson(adas, {
                            style
                        }).addTo(map);
                    }


                }
            }
        });
        if (!mapClickable && !mapSelectAble) {
            if (infosMarkers) {
                map.removeLayer(infosMarkers);
            }
            infosMarkers = L.marker([lat, lng], {
                id: lat,
                keyboard: false,
                title: 'riseOnHover',
                shadowPane: 'shadowPane',
                riseOnHover: false,
                bubblingMouseEvents: false,
                autoPanOnFocus: false,
            }).addTo(map);
            var popup = L.popup()
                .setLatLng([lat, lng])
                .setContent(`
                    ${lat}, ${lng}
                `)
                .openOn(map);

            map.flyTo([lat, lng], flyToZoom);

        }
    });
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
                        map.flyTo([latitude, longitude], flyToZoom);
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

                    mapClickable = false;
                    mapSelectAble = false;
                    selectCoordinatesBtnEl.attr('data-select', "off");
                    selectCoordinatesBtnEl.removeClass('bg-primary');
                    iconEl.removeClass("text-white");
                    getMapContainerDivEl().removeClass("cursor-default")
                    getMapContainerDivEl().addClass("cursor-grab")

                } else {
                    mapClickable = true;
                    mapSelectAble = true;

                    selectCoordinatesBtnEl.attr('data-select', "on");
                    selectCoordinatesBtnEl.addClass('bg-primary');
                    iconEl.addClass("text-white")
                    iconEl.removeClass("text-dark")
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

// locations group events
locationGroupAdd.on('click', function (e) {
    e.preventDefault();
    let clone = $('#locations-group-empty').clone(true);
    console.log(clone)
    clone.removeClass('d-none');
    clone.addClass('locations-group');
    locationsContainerEl.append(
        clone
    );
    newGroup(clone);
    clone.find('[name=locations-group_check]').attr('checked', true)
    clone.removeAttr('id')
    scrollDivEl.scrollTop(scrollDivEl.scrollTop() + clone.position().top);


});
$('#locations-clear-all').on('click', function (e) {
    e.preventDefault();
    locationContainerGroupEl.remove();


    adas.features = [];
    geoJson.clearLayers();

});
// location group events
$(document).on('click', '.location-group-tools-delete', function () {
    if ($('.locations-group').length != 1) {
        hideElement($(this).closest('.locations-group'));

        let featureFounded = adas.features.some((feature, i) => {
            if (feature.properties.id == $(this).closest('.locations-group').attr('data-map-group-id')) {
                adas.features.splice(i, 1);

                geoJson.clearLayers();
                geoJson = L.geoJson(adas, {
                    style
                }).addTo(map);
                return true;
            }
        });


    } else {
        alert('Empty')
    }

});
$(document).on('click', '.location-group-tools-clone', function () {
    let clone = $(this).closest(".locations-group").clone(true);
    $(this).closest(locationsContainerEl).append(
        clone
    );
    newGroup(clone);

});
$(document).on('change', '.locations-group__color', function () {
    let feature = adas.features.some(feature => {
        if (feature.properties.id == $(this).closest('.locations-group').attr('data-map-group-id')) {
            console.log(feature.properties.color)
            feature.properties.color = $(this).val();
            console.log(feature.properties.color)
            if (geoJson instanceof L.geoJson) {
                geoJson.clearLayers()
            }
            geoJson = L.geoJson(adas, {
                style
            }).addTo(map);
            return true;
        }
    });
});
$(document).on('click', '.location-group-tools-delete-markers', function () {
    let feature = adas.features.some(feature => {
        if (feature.properties.id == $(this).closest('.locations-group').attr('data-map-group-id')) {
            if (isIterable(feature.properties.markers)) {
                for (const marker of feature.properties.markers) {
                    map.removeLayer(marker);
                }
                feature.properties.markers = [];
            }
        }
    });
});
$(document).on('click', '.location-group-tools-see-location', function () {
    adas.features.some(feature => {
        if (feature.properties.id == $(this).closest('.locations-group').attr('data-map-group-id')) {
            return feature.geometry.coordinates[0].some(function (e, i) {
                if (isIterable(feature.geometry.coordinates[0])) {
                    for (const location of feature.geometry.coordinates[0]) {
                        let marker = L.marker(
                            [location[1], location[0]], {
                                icon: L.divIcon({
                                    className: 'custom-div-icon',
                                    html: `<i class="fa-solid text-dark     fa-map-pin"></i>`,

                                })
                            }).addTo(map);
                        map.flyTo([location[1], location[0]], flyToZoom);
                        if (isIterable(feature.properties.markers)) {
                            feature.properties.markers.push(marker);
                        } else {
                            feature.properties.markers = [];
                            feature.properties.markers.push(marker);
                        }
                    }
                }
                return true;
            });
        }

    });

});
$('.location-group-tools-add-location').on('click', function () {
    let clone = $('#locations-group-empty').find('.location-container').clone(true);
    clone.addClass('bg-gray-500 bg-opacity-25');
    $(this).closest('.locations-group').append(
        clone
    );
    scrollDivEl.scrollTop(scrollDivEl.scrollTop() + clone.position().top);

    setTimeout(() => {
        clone.removeClass('bg-gray-500 bg-opacity-25')
    }, 1000);


});
$('#locations-fullscreen').on('click', function () {
    let fullScreenStatus = $(this).attr('data-fullscrren');

    if (fullScreenStatus == 1) {
        $(this).attr('data-fullscrren', 0)
        $(this).find('i').attr('class', 'fa-solid fa-expand me-2')
        $('#kt_customer_view_overview_events_and_logs_tab').removeClass('full-screen-div')

    } else {
        console.log($('#map'))

        $(this).find('i').attr('class', 'fa-solid fa-down-left-and-up-right-to-center me-2')
        $(this).attr('data-fullscrren', 1)
        $('#kt_customer_view_overview_events_and_logs_tab').addClass('full-screen-div')
    }
});
$(document).on('change', '[name=locations-group__background-color]', function () {
    let $this = $(this);
    adas.features.forEach(function (feature) {
        feature.properties.backgroundColor = $this.val()
    });
    geoJson.clearLayers();
    geoJson = L.geoJson(adas, {
        style
    }).addTo(map);

    console.log(adas.features)

});
// location events
$(document).on('click', '.location-tools-delete', function (e) {
    e.preventDefault();
    if (
        $(this).closest('.locations-container').find('.location-container').length == 1
    ) {
        alert('empty')
        return true;
    }

    let locationLongitude = $(this).closest('.location-container').find('.location-longitude');
    let locationLatitude = $(this).closest('.location-container').find('.location-latitude');
    let feature = adas.features.some(feature => {
        if (feature.properties.id == $(this).closest('.locations-group').attr('data-map-group-id')) {
            return feature.geometry.coordinates[0].some(function (e, i) {
                if (
                    e[0] == parseFloat(locationLatitude.val()),
                    e[1] == parseFloat(locationLongitude.val())
                ) {
                    feature.geometry.coordinates[0].splice(i, 1)
                }
            });
        }

    });


    geoJson.clearLayers();
    geoJson = L.geoJson(adas, {
        style
    }).addTo(map);


    hideElement($(this).closest('.location-container'));
});
$(document).on('click', '.location-tools-clone', function (e) {
    e.preventDefault();
    let clone = $(this).closest('.location-container').clone(true);
    clone.addClass('bg-gray-500 bg-opacity-25');
    $(this).closest('.locations-group').append(
        clone
    );
    setTimeout(() => {
        clone.removeClass('bg-gray-500 bg-opacity-25')
    }, 1000);
});
$(document).on('click', '.location-tools-goto', function (e) {
    e.preventDefault();
    let locationLongitude = $(this).closest('.location-container').find('.location-longitude').val();
    let locationLatitude = $(this).closest('.location-container').find('.location-latitude').val();
    if (locationLatitude && locationLongitude) {
        map.flyTo([locationLongitude, locationLatitude], flyToZoom);
        let marker = L.marker([locationLongitude, locationLatitude]).addTo(map);

        let feature = adas.features.some(feature => {
            if (feature.properties.id == $(this).closest('.locations-group').attr('data-map-group-id')) {
                if (isIterable(feature.properties.markers)) {
                    feature.properties.markers.push(marker);
                } else {
                    feature.properties.markers = [];
                    feature.properties.markers.push(marker);
                }

                return true;
            }
        });
    }
});
$('.location-input').on('change', function (e) {
    e.preventDefault();
    let $this = $(this);
    let group = $this.closest('.locations-group');
    let locationContainer = $this.closest('.location-container');
    let groupId = group.attr('data-map-group-id');

    let dataLocation = locationContainer.attr('data-location');
    // console.log(dataLocation)


    let featureFounded = adas.features.some(feature => {
        if (feature.properties.id == groupId) {
            return feature.geometry.coordinates[0].some(function (e, i) {
                if (e.toString() == dataLocation) {
                    locationContainer.attr('data-location',
                        locationContainer.find('.location-latitude').val() + ',' +
                        locationContainer.find('.location-longitude').val()
                    );
                    feature.geometry.coordinates[0][i] = [
                        locationContainer.find('.location-latitude').val(),
                        locationContainer.find('.location-longitude').val()
                    ];


                    geoJson.clearLayers()
                    geoJson = L.geoJson(adas, {
                        style
                    }).addTo(map);

                    return true;
                }
            });
        }
    });

});
$('.location-tools-main').on('click', function (e) {
    e.preventDefault();
    let group = $(this).closest(locationContainerGroupEl);
    console.log(group)
    let locationToolsEL = $(this).closest('.location-tools');
    let isdataLocationCenter = locationToolsEL.attr('data-location-center');
    if (isdataLocationCenter == 1) {
        console.log("same")
    } else {
        group.find('[data-location-center]').attr('data-location-center', 0);
        locationToolsEL.attr('data-location-center', 1);
        group.find('.location-container').removeClass('center-location');
        $(this).closest('.location-container').addClass('center-location');

        adas.features.some(feature => {
            if (feature.properties.id == group.attr('data-map-group-id')) {
                feature.properties.centerPoint = {
                    longitude: $(this).closest('.location-container').find('.location-longitude').val(),
                    latitude: $(this).closest('.location-container').find('.location-latitude').val()
                };
                return true;
            }
        });


    }
});
// MAP BUTTONS EVENTS
$(document).on('mouseenter', ".custom-div-icon_parent", function (e) {
    e.preventDefault();
    mapClickable = false;
});
$(document).on('mouseleave', ".custom-div-icon_parent", function (e) {
    e.preventDefault();
    mapClickable = true;
});


function hideElement(jqueryElm) {
    jqueryElm.fadeOut(200, function () {
        $(this).remove();
    });
}

function isIterable(obj) {
    return obj != null && typeof obj[Symbol.iterator] === 'function';
}

function newGroup(clone) {
    let id = $('.locations-group').length + 1;
    clone.find('.locations-group__title').text("Group " + id);
    clone.attr('data-map-group-id', id);
    clone.addClass('bg-gray-500 bg-opacity-25');
    setTimeout(() => {
        clone.removeClass('bg-gray-500 bg-opacity-25')
    }, 1000);
}

function getMapContainerDivEl() {
    if (!mapContainer.length) {
        mapContainer = $('.leaflet-container');
    }
    return mapContainer;
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

function idFormat(lat, lng) {
    return `${lat} ${lng}`;
}

function style(feature) {
    return {
        color: feature.properties.color,
        fillColor: $('[name=locations-group__background-color]').val(),
        weight: 3,
        opacity: 1,
        dashArray: 3,
        // stroke:false,
        lineCap: 'round',
        lineJoin: 'round',
        dashOffset: 'ff',
        fillRule: 'evenodd',
        bubblingMouseEvents: true,
        className: '',
    };
}

function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
    });
}

function highlightFeature(e) {
    console.log('ffds')
    const layer = e.target;
    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: '',
        fillOpacity: 0.7
    });
    layer.bringToFront();
}

function resetHighlight(e) {
    geoJson.resetStyle(e.target);
}

function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}

$('#locations-save').on('click', function (e) {
    e.preventDefault();
    for (const feature of adas.features) {
        if (isIterable(feature.properties.markers)) {
            for (const marker of feature.properties.markers) {
                map.removeLayer(marker);
            }
            feature.properties.markers = [];
        }
    }
    axios.post($('#route').val(), {
        'locatioable-id': $('#locatioable-id').val(),
        'data': adas,
    })
        .then(function ({data}) {
            console.log(data)
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
            console.log(error.response.data.message);
        });
});
$('.geo-type').on('click', function (e) {
    e.preventDefault();
    if (geometryType != $(this).attr('data-map--geo-type')) {
        geometryType = $(this).attr('data-map--geo-type');
        adas.features.forEach(function (feature, index) {
            feature.geometry.type = geometryType;
        })
        geoJson.clearLayers()
        geoJson = L.geoJson(adas, {
            style
        }).addTo(map);
        $('.geo-type').removeClass('active');
        $(this).addClass('active');
    }
    checkGeometryType();
});


