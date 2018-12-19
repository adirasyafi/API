<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // Set ID to update
  $paket->id_paket = $data->id_paket;

  $paket->nama_pengirim = $data->nama_pengirim;
  $paket->nama_penerima = $data->nama_penerima;
  $paket->no_hp = $data->no_hp;
  $paket->unit = $data->unit;
  $paket->tanggal_datang = $data->tanggal_datang;
  $paket->tanggal_pengambilan = $data->tanggal_pengambilan; 
  $paket->status = $data->status;    

  // Update post
  if($pakett->update()) {
    echo json_encode(
      array('message' => 'Paket terupdate')
    );
  } else {
    echo json_encode(
      array('message' => 'Paket tidak berhasil diupdate')
    );
  }

