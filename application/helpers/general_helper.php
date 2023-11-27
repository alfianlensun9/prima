<?php

function render($view = '', $dataParams = [], $activePage = 'mainmenu')
{
    $ci = &get_instance();


    $data = array_merge($dataParams, [
        'activePage' => $activePage
    ]);
    $ci->load->view('layout/v_header', $data);
    $ci->load->view('layout/v_sidebar', $data);
    $ci->load->view('layout/v_navbar', $data);
    $ci->load->view($view, $data);
    $ci->load->view('layout/v_footer', $data);
}

function dd($data)
{
    var_dump($data);
    die();
}


function getUserGroup()
{
    $ci = &get_instance();
    return $ci->session->userdata('auth_users')['id_auth_group'];
}

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function formatdmY($date, $default_function = 'date')
{
    if ($default_function == 'datetime') {
        $dt = new DateTime($date);
        return $dt->format('d/m/Y');
    } else {
        return date('d/m/Y', strtotime($date));
    }
}

function formatYmd($date, $default_function = 'date')
{
    if ($default_function == 'datetime') {
        $dt = new DateTime($date);
        return $dt->format('Y-m-d');
    } else {
        return date('Y-m-d', strtotime($date));
    }
}

function refreshToken()
{
    $ci = &get_instance();

    $body = [
        "username" => "0800",
        "password" => "123"
    ];

    $response = $ci->ws->setbaseurl('aevy')
        ->data($body, $uat = 1)
        ->post("/auth/signin");
    // dd($response);



    $jenis_absensi = $ci->ws
        ->setToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF9hdXRoX3VzZXJzIjoyLCJmdWxsX25hbWUiOiJBbGZpYW4gUiBMZW5zdW4iLCJyb2xlcyI6W10sInVzZXJfYWdlbnQiOiJVRzl6ZEcxaGJsSjFiblJwYldVdk55NHlPUzR3IiwiaWF0IjoxNjQ5Mzc5MTg2fQ.m50w7SftspY4ynPVuUS-XKexAA7Ep8MrPSMc5wkIal8');
    // redirect('welcome');
}
