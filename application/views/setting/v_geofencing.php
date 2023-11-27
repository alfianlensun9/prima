<div class="flex-1 bg-gray-100 flex flex-col p-4">
	<div class="col-lg-12" id="map" style="height: 600px; width: 100%;">

	</div>
	<div class="calculation-box absolute bottom-0 text-white text-xs mb-14 left-4 p-4 opacity-50 rounded bg-black">
		<p class="badge badge-success" style="font-size: 16px;">Atur jarak geofencing aplikasi dengan menggunakan <span class="font-bold">Draw tools</span> kemudian tekan <span class="font-bold">enter</span>.</p>
		<div id="calculated-area" class="hidden"></div>
	</div>
	<div class="absolute right-4 bottom-0 mb-14 hidden" id="btn-simpan">
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="location_name">Nama Lokasi</label>
				<input type="text" class="form-control" name="tanggal_awal" id="location-name" required>
			</div>
			<div class="form-group col-md-12">
				<!-- <label for="submit">&nbsp;</label> -->
				<button class="btn btn-primary btn-sm" id="simpan_geofenc">Simpan <i class="fa fa-paper-plane"></i></button>
			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table tablesorter " id="">
						<thead class=" text-primary">
							<tr>
								<th>Label</th>
								<th>Coord.</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listMap as $map) :  ?>
								<tr>
									<td><?= $map->location_name; ?></td>
									<td><button class="btn btn-success" onclick='setLocation(<?= json_encode($map->coordinates); ?>)'>View</button></td>
									<td>
										<button onclick="deleteMap(<?= $map->id_mst_setting_location ?>)" class="btn btn-secondary btn-sm btn_get_absen"><i class="fa fa-trash "></i></button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	function deleteMap(id) {
		let prom = confirm("Apakah anda yakin?");
		console.log(prom);
		if (!prom) return;
		$.ajax({
			url: '/setting/C_setting/deleteSettingGeofencing/' + id,
			method: 'get',
			dataType: 'json',
			success: (response) => {
				console.log(response);
				location.reload();
			},
			error: (err) => {
				console.log(err)
			}
		})
	}

	const draw = new MapboxDraw({
		displayControlsDefault: false,
		controls: {
			polygon: true,
			trash: true
		}
	});

	function setLocation(data) {

		let list = data.map(item => {
			return [parseFloat(item.latitude), parseFloat(item.longitude)]
		})
		console.log(list);

		const feature = {
			type: "Polygon",
			coordinates: [list]
		};

		const featureIds = draw.add(feature);

	};

	mapboxgl.accessToken = 'pk.eyJ1IjoiYWxmaWFubGVuc3VuIiwiYSI6ImNqbmFhc3RzbjdteDIzcW55dzl0ZWwzdzEifQ.3M-jznSp5U5rwWxO1h01Lw';
	const map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/alfianlensun/ckjnxv3952uuo19o3rg642ajt',
		center: [124.7001298996881, 0.8693894217962035],
		zoom: 17
	});



	$(function() {
		console.log(window.coordinates);
		$('#simpan_geofenc').on('click', function() {
			const location_name = $("#location-name").val();
			if (location_name.length == 0) {
				alert("Nama lokasi tidak boleh kosong");
				return;
			}
			console.log(location_name.length);
			const html = $(this).html()
			$(this).html(`<i class="fa fa-spin fa-spinner"></i>`)
			$.ajax({
				url: '/setting/C_setting/createGeofencing',
				method: 'post',
				dataType: 'json',
				data: {
					location_name: location_name,
					coordinates: window.coordinates.map(item => {
						return {
							latitude: parseFloat(item[0]),
							longitude: parseFloat(item[1])
						}
					})
				},
				success: (resp) => {
					console.log(
						resp.data.msg
					)
					setTimeout(() => {
						location.reload();
					}, 1000)
					$(this).html(`${resp.data.msg} <i class="fa fa-check"></i>`)
				},
				error: (err) => {
					$(this).html(html)
				}
			})
		})

		$.ajax({
			url: '/setting/C_setting/getSettingGeofencing',
			method: 'get',
			dataType: 'json',
			success: ({
				response
			}) => {
				if (response[0].detail_setting.length > 0) {
					$('#btn-simpan').show()
				} else {
					$('#btn-simpan').hide()
				}

				let list = response[0].detail_setting.map(item => {
					return [item.Longitude, item.Latitude]
				})

				const feature = {
					type: "Polygon",
					coordinates: [list]
				};
				const featureIds = draw.add(feature);

			},
			error: (err) => {
				console.log(err)
			}
		})
	})

	map.addControl(draw);
	map.on('draw.create', updateArea);
	map.on('draw.delete', updateArea);
	map.on('draw.update', updateArea);

	function updateArea(e) {
		var data = draw.getAll();

		if (data.features[0]) {
			window.coordinates = data.features[0].geometry.coordinates[0]
			$('#btn-simpan').show()
		} else {
			$('#btn-simpan').hide()
		}
	}
</script>