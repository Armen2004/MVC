<style>
    html, body, #map-canvas {
        height: 100%;
        margin: 0;
        padding: 0;
    }

</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script>
    var data = <?= $data['allData'] ?>;
    var LocationData = [];
    for (var key in data) {
        if (data.hasOwnProperty(key)) {
            var Data = [];
            Data.push(parseFloat(data[key].latitude));
            Data.push(parseFloat(data[key].longitude));
            Data.push(data[key].name);
            LocationData.push(Data);
        }
    }
    function initialize()
    {
        var mapOptions = {
            minZoom: 2
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var bounds = new google.maps.LatLngBounds();
        var infowindow = new google.maps.InfoWindow();

        for (var i in LocationData)
        {
            var p = LocationData[i];
            var latlng = new google.maps.LatLng(p[0], p[1]);
            bounds.extend(latlng);

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: p[2]
            });

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(this.title);
                infowindow.open(map, this);
            });
        }

        map.fitBounds(bounds);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>



<h1 class="text-center"><?= $data['title'] ?></h1>
<div id="map-canvas"></div>

