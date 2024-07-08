<div class=" tab-pane fade show" id="content-maps" role="tabpanel" aria-labelledby="tab-maps">
    <form id="maps-form" method="POST">
        <div class="card" id="maps-card">
            {{-- <div class="card-header form-group">
                <h4>Lokasi</h4>
            </div> --}}

            <div class="card-body" id="mapid" style="height:20rem">

            </div>
            {{-- <p class="text-muted">Tandai lokasi sekolah anda di maps.</p> --}}

            <div class="card-title pr-3 pl-3">
                <div class="form-group">
                    <label for="radius" class="form-control-label ">
                        Radius Absensi</label>
                    <div class=" input-group">
                        <input type="number" name="radius" class="form-control" id="radius" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                meter
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-group"> <label for="latitude" class="form-control-label">Latitude:</label>
                    <input id="latitude" type="text" name="lat" class="form-control" readonly required/>
                </div>
                <div class="form-group">
                    <label for="longitude" class="form-control-label">Longitude:</label>
                    <input id="longitude" type="text" name="lng" class="form-control" readonly required/>
                </div>

            </div>
            <div class="card-footer bg-whitesmoke text-md-right">
                <button class="btn btn-primary" type="submit">Simpan Perbubahan</button>
            </div>
        </div>
    </form>
</div>
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
@endpush
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>

    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>

    <script>
        var distances = @JSON($distance);
        // console.log('data :>> ', data);
        onload()
        var radius;

        function onload() {
            setValue();
            addMap();
            addmarker();
            mouseDragMarker();
            addCircular();
            save();
        }
        var marker;
        var map;
        var circlemarker;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function addMap() {
            map = L.map('mapid').setView([distances.lat ? distances.lat : '-7.575489',
                distances.lng ? distances.lng : '110.824326'
            ], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            setInterval(function() {
                map.invalidateSize();
            }, 100);

            var searchControl = new L.esri.Controls.Geosearch().addTo(map);
            var results = new L.LayerGroup().addTo(map);
            searchControl.on('results', function(data) {
                results.clearLayers();
                map.removeLayer(marker);
                map.removeLayer(circlemarker);

                for (var i = data.results.length - 1; i >= 0; i--) {
                    // console.log('res :>> ', data.results[i].latlng.lat);
                    let lat = data.results[i].latlng.lat;
                    let lng = data.results[i].latlng.lng;
                    addmarker(lat, lng);
                    mouseDragMarker();
                    addCircular(lat, lng);

                }
            });


        }


        function addmarker(lat, lng) {
            marker = L.marker([lat ? lat : distances.lat ? distances.lat : -7.575489, lng ? lng : distances.lng ? distances
                .lng : 110.824326
            ], {
                draggable: true
            }).addTo(map);
        }

        function setValue() {
            $('#latitude').val(distances.lat);
            $('#longitude').val(distances.lng);
            $('#radius').val(distances.radius);
        }

        function mouseDragMarker() {

            marker.on('dragend', function(e) {
                let lat = marker.getLatLng().lat;
                let lng = marker.getLatLng().lng;
                $('#latitude').val(lat);
                $('#longitude').val(lng);
                map.removeLayer(circlemarker);
                addCircular(lat, lng);
            });
        }

        function addCircular(lat, lng) {
            circlemarker = L.circle([lat ? lat : distances.lat, lng ? lng : distances.lng], {
                color: 'blue',
                fillColor: 'blue',
                fillOpacity: 0.5,
                radius: distances.radius
            }).addTo(map);
        }

        function save() {
            $('#maps-form').submit(function(e) {
                e.preventDefault()
                let data = $(this).serialize();
                $.ajax({
                    type: "PUT",
                    url: "{{ route('setting.lokasi', $data->id) }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log('response :>> ', response);
                        iziToast.success({
                            title: 'Sukses',
                            message: response.message,
                            position: 'topRight',
                            timeout: 700,
                            onClosing: function(instance, toast, closedBy) {
                                window.location.href = '{{ route('setting.index') }}';
                            }
                        })
                    }
                });
            });

        }
    </script>
@endpush
