<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Paket.php';

  $database = new Database();
  $db = $database->connect();

  $paket = new Paket($db);

  $paket->id_paket = isset($_GET['id_paket']) ? $_GET['id_paket'] : die();

  $paket->read_single();

  $paket_arr = array(
    'id_paket' => $paket->id_paket,
    'nama_pengirim' => $paket->nama_pengirim,
    'nama_penerima' => $paket->nama_penerima,
    'no_hp' => $paket->no_hp,
    'unit' => $paket->unit,
    'tanggal_datang' => $paket->tanggal_datang,
    'tanggal_pengambilan' => $paket->tanggal_pengambilan,                
    'status' => $paket->status
  );

  print_r(json_encode($paket_arr));
