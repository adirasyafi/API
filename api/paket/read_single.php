<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Paket.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $paket = new Paket($db);

  // Get ID
  $paket->id_paket = isset($_GET['id_paket']) ? $_GET['id_paket'] : die();

  // Get post
  $paket->read_single();

  // Create array
  $paket_item = array(
    'id_paket' => $paket->id_paket,
    'nama_pengirim' => $paket->nama_pengirim,
    'nama_penerima' => $pket->nama_penerima,
    'no_hp' => $paket->no_hp,
    'unit' => $paket->unit,
    'tanggal_datang' => $paket->tanggal_datang,
    'tanggal_pengambilan' => $paket->tanggal_pengambilan,                
    'status' => $paket->status
  );

  // Make JSON
  print_r(json_encode($paket_arr));
