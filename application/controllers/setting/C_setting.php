<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_setting extends CI_Controller
{

	public $tokenAuth = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF9hdXRoX3VzZXJzIjoyLCJmdWxsX25hbWUiOiJBbGZpYW4gUiBMZW5zdW4iLCJyb2xlcyI6W10sInVzZXJfYWdlbnQiOiJVRzl6ZEcxaGJsSjFiblJwYldVdk55NHlPUzR3IiwiaWF0IjoxNjQ5MjkxODE0fQ.jRTIH_MYR1xFKS_YV6lpGWAnMSOgEDgyWIolVNxMDTk";

	function __construct()
	{
		parent::__construct();
		$this->middleware->canAccessBy(0, ['1', '2']);
	}

	public function nav()
	{
		render('setting/v_nav', $data = [], 'setting');
	}

	public function geofencing()
	{
		$data['breadcrumb'] = [
			[
				"uri" => "Welcome",
				"desc" => "Home",
			],
			[
				"uri" => "setting/C_setting/geofencing",
				"desc" => "Geofencing",
			]
		];
		$data['head'] = [
			'css' => [
				'https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css',
				'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.2.0/mapbox-gl-draw.css'
			],
			'js' => [
				'https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js',
				'https://api.tiles.mapbox.com/mapbox.js/plugins/turf/v3.0.11/turf.min.js',
				'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.2.0/mapbox-gl-draw.js',

			]
		];


		$this->ws->setToken($this->tokenAuth);

		$response = $this->ws->setbaseurl('absen')
			->get("/master/location");
		$json = json_decode(json_encode($response));

		$data['listMap'] = $json->data;
		// dd($data);

		$data['base_url_mobile'] =
			render('setting/v_geofencing', $data);
	}

	public function createGeofencing()
	{
		$this->ws->setToken($this->tokenAuth);

		$response = $this->ws->setbaseurl('absen')
			->data($this->input->post())
			->showStatusCode()
			->post("/master/location");

		$json = json_decode(json_encode($response));
		echo json_encode($response);
	}

	public function deleteSettingGeofencing($idMap)
	{
		$this->ws->setToken($this->tokenAuth);

		$response = $this->ws->setbaseurl('absen')
			->delete("/master/location/{$idMap}");
		$json = json_decode(json_encode($response));
		echo json_encode($response);
	}

	public function getSettingGeofencing()
	{
		$url = URI_WS_ABSENSI . '/setting/geofenc';
		$result = $this->ws->get($url);
		echo json_encode($result);
	}
}
