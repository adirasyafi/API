<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Paket.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $paket = new Paket($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $paket->nama_pengirim = $data->nama_pengirim;
  $paket->nama_penerima = $data->nama_penerima;
  $paket->no_hp = $data->no_hp;
  $paket->unit = $data->unit;
  $paket->tanggal_datang = $data->tanggal_datang;
  $paket->tanggal_pengambilan = $data->tanggal_pengambilan;
  $paket->status = $data->status;

  // Create paket
  if($paket->create()) {
    echo json_encode(
      array('message' => 'Paket berhasil ditambahkan')
    );
  } else {
    echo json_encode(
      array('message' => 'Paket tidak berhasil ditambahkan')
    );
  }

