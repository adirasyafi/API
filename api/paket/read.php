<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Paket.php';

  $database = new Database();
  $db = $database->connect();

  $paket = new Paket($db);

  $result = $paket->read();

  $num = $result->rowCount();

  if($num > 0) {
    $paket_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $paket_item = array(
        'id_paket' => $id_paket,
        'nama_pengirim' => $nama_pengirim,
        'nama_penerima' => $nama_penerima,
        'no_hp' => $no_hp,
        'unit' => $unit,
        'tanggal_datang' => $tanggal_datang,
        'tanggal_pengambilan' => $tanggal_pengambilan,                
        'status' => $status
      );

      array_push($paket_arr, $paket_item);
    }

    echo json_encode($paket_arr);

  } else {
    echo json_encode(
      array('message' => 'Tidak ada paket')
    );
  }
