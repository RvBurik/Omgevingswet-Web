var map = new ol.Map({
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ],
    target: 'map',
    controls: ol.control.defaults({

    }),
    view: new ol.View({
        center: [0, 0],
        zoom: 2
    })
});


$('#zoom-out').click(function() {
    var view = map.getView();
    var zoom = view.getZoom();
    view.setZoom(zoom - 1);
});

$('#zoom-in').click(function() {
    var view = map.getView();
    var zoom = view.getZoom();
    view.setZoom(zoom + 1);
});

$('#map').click(function(event) {
        alert(map.getEventCoordinate(event));
        var coordinates = map.getEventCoordinate(event);
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $.ajax({
            type: "POST",
            url: '/project/add',
            data: {'coordinates': coordinates},
            dataType: 'json',
            success: function (data) {
                alert("Coordinaten zijn bekend!");
            },
            error: function (data) {
                if (data.status === 422) {
                    var response = JSON.parse(data.responseText);
                    alert(response['name'][0]);
                }
            }
        });

});
