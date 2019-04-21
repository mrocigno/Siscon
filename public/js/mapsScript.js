var map;

function initMap() {
    map = new google.maps.Map(document.getElementById('map_img'), {
        center: {lat: -23.550929, lng: -46.627250},
        zoom: 12,
        mapTypeControl: false
    });

    var bounds = new google.maps.LatLngBounds();
    marks.forEach(function (pin, index) {
        if(!pin.add){
            let marker = new google.maps.Marker({
                position: pin.position,
                map: map,
                title: pin.title
            });

            let contentString = pin.title;
            let infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            marker.addListener('click', function() {
                if(oldInfo != null){
                    oldInfo.close(map, oldMarker);
                }
                infowindow.open(map, marker);
                oldInfo = infowindow;
                oldMarker = marker;
            });

            pin.add = true;
            pin.marker = marker;
            pin.infowindow = infowindow;

            if(pin.other != null){
                addMapLegend(index, pin.other.address);
            }
        }
        if(pin.position.lat !== 0 && pin.position.lng !== 0){
            bounds.extend(pin.position);
        }
    });

    if(marks.length > 1){
        map.fitBounds(bounds);
    } else {
        map.setCenter(marks[0].position);
        map.setZoom(17);
    }
}

var marks = [];

function placeMarker(id, lat, lng, title, other){
    lat = parseFloat(lat);
    lng = parseFloat(lng);
    let position = {lat: lat, lng: lng};
    let index = marks.push({
        id: id,
        title: title,
        position: position,
        add: false,
        marker: null,
        other: other,
        infowindow: null
    });

    if(map != null){
        var marker = new google.maps.Marker({
            position: position,
            map: map,
            title: title
        });

        marks[index - 1].add = true;
        marks[index - 1].marker = marker;
        map.setCenter(position);
        map.setZoom(17);
    }
}

let oldMarker;
let oldInfo;

function goTo(index) {
    if (oldInfo != null){
        oldInfo.close(map, oldMarker);
    }

    pin = marks[index];
    map.setCenter({
        lat: pin.position.lat,
        lng: pin.position.lng
    });
    pin.infowindow.open(map, pin.marker);

    oldInfo = pin.infowindow;
    oldMarker = pin.marker;
}

function addMapLegend(index, address) {
    $("#map_legend").append(
        `<table class="item max-size" style="font-size: 14px" onclick="goTo(${index})">
            <tr>
                <td class="iconMenu"><i class="fas fa-map-marker-alt"></i></td>
                <td>${address}</td>
            </tr>
        </table>`
    );
}